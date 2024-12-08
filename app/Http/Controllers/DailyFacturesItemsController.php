<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\DailyFactures;
use App\Models\DailyFacturesItems;
use Illuminate\Support\Facades\Auth;

class DailyFacturesItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $facture = null;

        if ($request->has('facture_id')) {
            $facture = Auth::user()->account->dailyfactures()->find($request->query('facture_id'));
        }
        $cars = Cars::all();

        return Inertia::render('DailyFactureItem/Create', [
            'facture' => $facture,
            'cars' => $cars,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'facture_id' => 'required|exists:daily_factures,id', // Assuming facture ID is related to a Facture model
            'date' => 'required|date',
            'items' => 'required|array',
            'items.*.cars_id' => 'required|exists:cars,id', // Ensure each car ID is valid
            'items.*.reservation_id' => 'nullable|string|max:100',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.is_price' => 'required|boolean',
            'items.*.description' => 'nullable|string|max:255',
        ]);

        foreach ($validated['items'] as $itemData) {
            Auth::user()->account->items()->create([
                'facture_id' => $validated['facture_id'],
                'date' => $validated['date'],
                'cars_id' => $itemData['cars_id'],
                'reservation_id' => $itemData['reservation_id'],
                'price' => $itemData['price'],
                'is_price' => $itemData['is_price'],
                'description' => $itemData['description'],
            ]);
        }

        return redirect()->route('dailyfactures')->with('success', 'Facture Items created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyFacturesItems $dailyFacturesItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyFacturesItems $dailyFacturesItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyFacturesItems $dailyFacturesItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyFacturesItems $dailyFacturesItems)
    {
        //
    }
}
