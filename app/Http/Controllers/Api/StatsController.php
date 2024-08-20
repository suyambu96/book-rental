<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use DB;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function mostOverdue()
    {
        $overdueBooks = Rental::whereNull('returned_on')
            ->where('due_date', '<', now())
            ->with('book')
            ->get();

        return response()->json($overdueBooks);
    }

    public function mostPopular()
    {
        $popular = Rental::select('book_id', DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderBy('total', 'desc')
            ->with('book')
            ->first();

        return response()->json($popular);
    }

    public function leastPopular()
    {
        $leastPopular = Rental::select('book_id', DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderBy('total', 'asc')
            ->with('book')
            ->first();

        return response()->json($leastPopular);
    }
}
