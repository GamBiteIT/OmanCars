<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\DailyFactures;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\DailyFacturesItemsController;


class DailyFacturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('DailyFacture/Index', [
            'filters' => Request::all('search'),
            'cars' => Auth::user()->account->cars()
                ->orderByName()
                ->filter(Request::only('search'))
                ->get()
                ->transform(fn ($car) => [
                    'id' => $car->id,
                    'brand' => $car->brand,
                    'model' => $car->model,
                    'registration_number' => $car->registration_number,
                    'color' => $car->color,
                    'year'=>$car->year,
                    'price_per_day'=>$car->price_per_day,
                    'price_per_week'=>$car->price_per_week,
                    'price_per_month'=>$car->price_per_month,
                    'km_day'=>$car->km_day,
                    'km_week'=>$car->km_week,
                    'km_month'=>$car->km_month,
                    'rent_out_price'=>$car->rent_out_price,
                    'photo' => $car->photo_path ? URL::route('image', ['path' => $car->photo_path, 'w' => 50, 'h' => 40, 'fit' => 'crop']) : null,

                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('DailyFacture/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Request::validate([
           'date_facture' => ['required', 'date', Rule::unique('daily_factures')],
            'image' => ['nullable', 'image'],
        ]);
   $facture=Auth::user()->account->dailyfactures()->create([
'date_facture' =>Request::get('date_facture'),
'image' => Request::file('image') ? Request::file('image')->store('dailyfactures') : null,
        ]);

        return Redirect::route('dailyfactureitem.create', ['facture_id' => $facture->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyFactures $dailyFactures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyFactures $dailyFactures)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyFactures $dailyFactures)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyFactures $dailyFactures)
    {
        //
    }
}
