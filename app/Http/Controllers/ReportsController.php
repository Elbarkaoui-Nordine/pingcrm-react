<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportCollection;
use Illuminate\Support\Facades\Request;
use App\Models\Report;
use Inertia\Inertia;

class ReportsController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Reports/Index', [
            'filters' => array_merge(Request::all('search', 'hideOption')),
            'reports' => new ReportCollection(
                Report::orderBy('title')
                    ->filter(Request::only('search'))
                    ->paginate()
                    ->appends(Request::all())
            ),
        ]);
    }
}
