<!-- resources/views/page_views/index.blade.php -->
@extends('layout.app')

<h1>Page Views</h1>

<h2>Daily Views</h2>

@if($dailyViews->isEmpty())
    <p>No data available.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Total Views</th>
                <th>Authenticated Views</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dailyViews as $row)
                <tr>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->total_views }}</td>
                    <td>{{ $row->authenticated_views }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<h2>Monthly Views</h2>

@if($monthlyViews->isEmpty())
    <p>No data available.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Month</th>
                <th>Total Views</th>
                <th>Authenticated Views</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyViews as $row)
                <tr>
                    <td>{{ $row->month_name }}</td>
                    <td>{{ $row->total_views }}</td>
                    <td>{{ $row->authenticated_views }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
