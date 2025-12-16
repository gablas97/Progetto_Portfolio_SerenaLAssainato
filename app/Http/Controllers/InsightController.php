<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    public function insight_index()
    {
        return view('insights');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Insight $insight)
    {
        //
    }

    public function edit(Insight $insight)
    {
        //
    }

    public function update(Request $request, Insight $insight)
    {
        //
    }

    public function destroy(Insight $insight)
    {
        //
    }
}
