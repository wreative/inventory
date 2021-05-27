<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FunctionController $FunctionController)
    {
        $this->middleware('auth');
        $this->FunctionController = $FunctionController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if ($this->FunctionController->superAdmin() == true) {
                $vehicle = Vehicle::where('add', 0)
                    ->where('edit', 0)
                    ->get();
                return view('pages.data.vehicle.indexVehicle', [
                    'vehicle' => $vehicle
                ]);
            } elseif ($this->FunctionController->authAdmin() == true) {
                $vehicle = Vehicle::where('add', 0)
                    ->where('edit', 0)
                    ->get();
                return view('pages.data.vehicle.indexVehicle', [
                    'vehicle' => $vehicle, 'admin' => true
                ]);
            } else {
                $vehicle = Vehicle::all();
                return view('pages.data.vehicle.indexVehicle', [
                    'vehicle' => $vehicle
                ]);
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function create()
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $code = "VH-" . str_pad($this->FunctionController->getRandom('vehicle'), 5, '0', STR_PAD_LEFT);
            return view('pages.data.vehicle.createVehicle', ['code' => $code]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function store(Request $req)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'code' => 'required',
                'name' => 'required',
                'type' => 'required',
                'brand' => 'required',
                'plat' => 'required',
                'step' => 'required',
                'engine' => 'required',
                'kir' => 'required|date',
                'tax' => 'required|date',
                'stnk' => 'required|date',
            ])->validate();

            // Permissions
            $addPermissions = $this->FunctionController->add();

            Vehicle::create([
                'code' => $req->code,
                'name' => $req->name,
                'type' => $req->type,
                'brand' => $req->brand,
                'plat' => $req->plat,
                'step' => $req->step,
                'engine' => $req->engine,
                'kir' => $req->kir,
                'tax' => $req->tax,
                'stnk' => $req->stnk,
                'status' => $req->status,
                'add' => $addPermissions == true ? 1 : 0,
                'edit' => 0,
            ]);

            return Redirect::route('vehicle.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function edit($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $vehicle = Vehicle::find($id);
            return view('pages.data.vehicle.updateVehicle', [
                'vehicle' => $vehicle,
            ]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
        // if ($this->FunctionController->authAdmin() == true or $this->FunctionController->superAdmin() == true) {
        //     $production = Production::find($id);
        //     return view('pages.data.production.updateProduction', ['production' => $production]);
        // } else {
        //     return Redirect::route('home')
        //         ->with(['status' => 'Anda tidak punya akses disini.']);
        // }        
    }

    public function update($id, Request $req)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'name' => 'required',
                'type' => 'required',
                'brand' => 'required',
                'plat' => 'required',
                'kir' => 'required|date',
                'tax' => 'required|date',
                'stnk' => 'required|date',
            ])->validate();

            // Permissions
            $editPermissions = $this->FunctionController->edit();

            $vehicle = Vehicle::find($id);
            $vehicle->name = $req->name;
            $vehicle->type = $req->type;
            $vehicle->brand = $req->brand;
            $vehicle->plat = $req->plat;
            $vehicle->step = $req->step;
            $vehicle->engine = $req->engine;
            $vehicle->kir = $req->kir;
            $vehicle->tax = $req->tax;
            $vehicle->stnk = $req->stnk;
            $vehicle->status = $req->status;
            $vehicle->add = 0;
            $vehicle->edit = $editPermissions == true ? 1 : 0;
            $vehicle->save();
            return Redirect::route('vehicle.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function destroy($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $vehicle = Vehicle::find($id);
            $vehicle->delete();
            return Redirect::route('equipment.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function show($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $vehicle = Vehicle::find($id);
            return view('pages.data.vehicle.showVehicle', ['vehicle' => $vehicle]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function approv()
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if ($this->FunctionController->authAdmin() == true) {
                $vehicle = Vehicle::where('add', 1)
                    ->get();
                return view('pages.approval.indexVehicle', ['vehicle' => $vehicle]);
            } elseif ($this->FunctionController->superAdmin() == true) {
                $vehicle = Vehicle::where('edit', 1)
                    ->get();
                return view('pages.approval.indexVehicle', ['vehicle' => $vehicle]);
            } else {
                return Redirect::route('vehicle.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function acceptAdd($id)
    {
        // Auth Roles Equipment      
        if (
            $this->FunctionController->onlyUserEquipment() == true ||
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $equipment = Equipment::find($id);

            if ($this->FunctionController->authAdmin() == true) {
                $equipment->add = 0;
                $equipment->save();
                return Redirect::route('equipment.index');
            } elseif ($this->FunctionController->superAdmin() == true) {
                $equipment->edit = 0;
                $equipment->save();
                return Redirect::route('equipment.index');
            } else {
                return Redirect::route('equipment.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }
}
