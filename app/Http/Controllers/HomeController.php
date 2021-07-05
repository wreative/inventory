<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Production;
use App\Models\Vehicle;
use App\Models\Rental;
use Illuminate\Support\Facades\Redirect;

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
        $production = Production::count();
        $equipment = Equipment::count();
        $rental = Rental::count();
        $vehicle = Vehicle::count();
        return view('home', [
            'production' => $production,
            'equipment' => $equipment,
            'rental' => $rental,
            'vehicle' => $vehicle,
        ]);
    }

    public function printPage($name)
    {
        switch ($name) {
            case 'equipment':
                $equipment = Equipment::where('add', 0)
                    ->where('edit', 0)
                    ->where('del', 0)
                    ->get();
                dd($equipment);
                break;
            case 'production':
                $production = Production::where('add', 0)
                    ->where('edit', 0)
                    ->where('del', 0)
                    ->get();
                return view('pages.print.productionPrint');
                break;
            case 'rental':
                $rental = Rental::where('add', 0)
                    ->where('edit', 0)
                    ->where('del', 0)
                    ->get();
                dd($rental);
                break;
            case 'vehicle':
                $vehicle = Vehicle::where('add', 0)
                    ->where('edit', 0)
                    ->where('del', 0)
                    ->get();
                dd($vehicle);
                break;
            default:
                return Redirect::route('home')
                    ->with(['status' => 'Terdapat error hubungi Administrator.']);
        }
    }
}
