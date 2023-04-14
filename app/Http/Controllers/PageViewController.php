<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PageView;
use Illuminate\Http\Request;

class PageViewController extends Controller
{
    public function index()
    {
        $dailyViews = $this->getDailyPageViews();
        $monthlyViews = $this->getMonthlyPageViews();

        return view('page_views.index', compact('dailyViews', 'monthlyViews'));
    }

    protected function getDailyPageViews()
    {
        return PageView::leftJoin('page_view_logs', function ($join) {
            $join->on('page_views.ulid', '=', 'page_view_logs.page_view_id')
                ->whereNull('page_view_logs.deleted_at');
        })
            ->selectRaw('DATE(page_views.created_at) as date')
            ->selectRaw('COUNT(page_views.ulid) as total_views')
            ->selectRaw('COUNT(page_view_logs.ulid) as authenticated_views')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

    protected function getMonthlyPageViews()
    {
        return PageView::leftJoin('page_view_logs', function ($join) {
            $join->on('page_views.ulid', '=', 'page_view_logs.page_view_id')
                ->whereNull('page_view_logs.deleted_at');
        })
            ->selectRaw('CONCAT(YEAR(page_views.created_at), "-", MONTH(page_views.created_at)) as month')
            ->selectRaw('COUNT(page_views.ulid) as total_views')
            ->selectRaw('COUNT(page_view_logs.ulid) as authenticated_views')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($row) {
                $date = Carbon::parse($row->month . '-01');
                $row->month_name = $date->format('F Y');
                return $row;
            });
    }
}
