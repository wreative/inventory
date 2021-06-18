<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Production;
use App\Models\Vehicle;
use App\Models\Rental;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $production = Production::where('del', 0)
            ->count();
        $equipment = Equipment::where('del', 0)
            ->count();
        $rental = Rental::where('del', 0)
            ->count();
        $vehicle = Vehicle::where('del', 0)
            ->count();
        return view('home', [
            'production' => $production,
            'equipment' => $equipment,
            'rental' => $rental,
            'vehicle' => $vehicle,
        ]);
    }
}
