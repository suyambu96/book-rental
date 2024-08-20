<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\User;  
use App\Models\Book;

class RentalController extends Controller
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
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            // You might want to validate other fields like due_date if applicable
        ]);
    
        $rental = new Rental();
        $rental->user_id = $validated['user_id'];
        $rental->book_id = $validated['book_id'];
        $rental->rented_on = now();  // Assuming 'rented_on' is set at the time of creation
        $rental->due_date = now()->addWeeks(2);  // Example: setting a due date 2 weeks from now
        $rental->save();
    
        return response()->json([
            'data' => [
                'user_id' => $rental->user_id,
                'book_id' => $rental->book_id,
                'rented_on' => $rental->rented_on,
                'due_date' => $rental->due_date
            ]
        ], 201);
    }

    public function returnBook(Request $request, $id)
    {
        // Try to find the rental by ID
        $rental = Rental::find($id);
    
        // If rental not found, return a 404 response
        if (!$rental) {
            return response()->json(['error' => 'Rental not found'], 404);
        }
    
        // Update the returned_on field
        $rental->update(['returned_on' => now()]);
    
        // Return the updated rental information
        return response()->json($rental);
    }

    public function history(Request $request)
    {
        $rentals = Rental::with(['user', 'book'])->get();

        return response()->json($rentals);
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
}
