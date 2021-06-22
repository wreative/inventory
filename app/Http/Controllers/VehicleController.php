<?php

namespace App\Http\Controllers;

use App\Models\TempVehicle;
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
        // Auth Roles Rental        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $vehicle = Vehicle::where('add', 0)
                ->where('edit', 0);
            if ($this->FunctionController->authUser() == true) {
                return view('pages.data.vehicle.indexVehicle', [
                    'vehicle' => $vehicle->where('del', 0)->get(),
                    'total' => $vehicle->where('del', 0)->count(),
                    'dtotal' => $vehicle->where('del', 1)->count()
                ]);
            } else {
                return view('pages.data.vehicle.indexVehicle', [
                    'vehicle' => $vehicle->where('del', 0)->get(),
                    'total' => $vehicle->where('del', 0)->count(),
                    'dtotal' => $vehicle->where('del', 1)->count(),
                    'notUser' => true
                ]);
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function deny()
    {
        // Auth Roles Vehicle
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $vehicle = Vehicle::where('add', 0)
                ->where('edit', 0)->where('del', 1)->get();
            return view('pages.data.vehicle.declineVehicle', [
                'vehicle' => $vehicle,
                'total' => $vehicle->where('del', 0)->count(),
                'dtotal' => $vehicle->where('del', 1)->count()
            ]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function create()
    {
        // Auth Roles Vehicle      
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
        // Auth Roles Vehicle        
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
                'kir' => 'date',
                'tax' => 'required|date',
                'stnk' => 'required|date',
            ])->validate();

            // Initiation KIR
            $kir = $req->kir == date("Y-m-d") ? null : $req->kir;

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
                'kir' => $kir,
                'tax' => $req->tax,
                'stnk' => $req->stnk,
                'status' => $req->status,
                'info' => $req->info,
                'add' => $addPermissions == true ? 1 : 0,
                'edit' => 0,
                'del' => 0,
            ]);

            return $this->FunctionController->onlyUserVehicle() == true ?
                Redirect::route('vehicle.index')
                ->with([
                    'status' => 'Data anda sedang di proses Admin, 
                    silahkan menunggu atau melihat status data Anda di halaman persetujuan.'
                ]) :
                Redirect::route('vehicle.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function edit($id)
    {
        // Auth Roles Vehicle        
        if (
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if (
                $this->FunctionController->authAdmin() == true or
                $this->FunctionController->superAdmin() == true
            ) {
                $vehicle = Vehicle::find($id);
                return view('pages.data.vehicle.updateVehicle', [
                    'vehicle' => $vehicle
                ]);
            } else {
                return Redirect::route('home')
                    ->with(['status' => 'Anda tidak punya akses disini.']);
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function update($id, Request $req)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'name' => 'required',
                'type' => 'required',
                'brand' => 'required',
                'plat' => 'required',
                'kir' => 'date',
                'tax' => 'required|date',
                'stnk' => 'required|date',
            ])->validate();

            // Initiation
            $vehicle = Vehicle::find($id);
            $kir = $req->kir == date("Y-m-d") ? null : $req->kir;

            // Add real data to temp 
            if ($this->FunctionController->superAdmin() == false) {
                TempVehicle::create([
                    'code' => $vehicle->code,
                    'name' => $vehicle->name,
                    'type' => $vehicle->type,
                    'brand' => $vehicle->brand,
                    'plat' => $vehicle->plat,
                    'step' => $vehicle->step,
                    'engine' => $vehicle->engine,
                    'kir' => $vehicle->kir,
                    'tax' => $vehicle->tax,
                    'stnk' => $vehicle->stnk,
                    'info' => $vehicle->info,
                ]);
            }

            // Permissions
            $editPermissions = $this->FunctionController->edit();

            $vehicle->name = $req->name;
            $vehicle->type = $req->type;
            $vehicle->brand = $req->brand;
            $vehicle->plat = $req->plat;
            $vehicle->step = $req->step;
            $vehicle->engine = $req->engine;
            $vehicle->kir = $kir;
            $vehicle->tax = $req->tax;
            $vehicle->stnk = $req->stnk;
            $vehicle->info = $req->info;
            $vehicle->add = 0;
            $vehicle->edit = $editPermissions == true ? 1 : 0;
            $vehicle->del = 0;
            $vehicle->save();
            return Redirect::route('vehicle.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        // Auth Roles Vehicle
        if ($this->FunctionController->superAdmin() == true) {
            $vehicle->delete();
            return Redirect::route('vehicle.index');
        } else if ($this->FunctionController->authAdmin() == true) {
            $vehicle->add = 0;
            $vehicle->edit = 0;
            $vehicle->del = 1;
            $vehicle->save();
            return Redirect::route('vehicle.index')
                ->with(['status' => 'Penolakan dengan kode item ' . $vehicle->code . __(' berhasil ditolak')]);
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
        // Auth Roles Vehicle     
        if ($this->FunctionController->onlyAdminVehicle() == true) {
            $vehicle = Vehicle::where('add', 1)
                ->get();
            return view('pages.approval.indexVehicle', ['vehicle' => $vehicle]);
        } elseif ($this->FunctionController->onlyUserVehicle() == true) {
            $vehicle = Vehicle::where('add', 1)
                ->get();
            return view('pages.approval.indexVehicle', [
                'vehicle' => $vehicle,
                'user' => true
            ]);
        } elseif ($this->FunctionController->superAdmin() == true) {
            $vehicle = Vehicle::where('edit', 1)
                ->orWhere('del', 1)
                ->get();
            return view('pages.approval.indexVehicle', ['vehicle' => $vehicle]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    // Approval Items
    public function accept($id)
    {
        // Auth Roles Vehicle    
        if (
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $vehicle = Vehicle::find($id);
            if ($vehicle->edit == 1) {
                return $this->acceptEdit($id);
            } elseif ($vehicle->del == 1) {
                return $this->acceptDelete($id);
            } elseif ($vehicle->add == 1) {
                return $this->acceptAdd($id);
            } else {
                return Redirect::route('vehicle.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function acceptAdd($id)
    {
        $vehicle = Vehicle::find($id);
        if (
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $vehicle->add = 0;
            $vehicle->save();
            return Redirect::route('vehicle.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $vehicle->code . __(' berhasil diterima')]);
        } else {
            return Redirect::route('vehicle.index');
        }
    }

    function acceptEdit($id)
    {
        $vehicle = Vehicle::find($id);
        if ($this->FunctionController->authAdmin() == true) {
            $vehicle->edit = 0;
            $vehicle->save();
            return Redirect::route('vehicle.index');
        } elseif ($this->FunctionController->superAdmin() == true) {
            // Change Record
            $vehicle->edit = 0;
            $vehicle->save();
            return Redirect::route('vehicle.index');
        } else {
            return Redirect::route('vehicle.index');
        }
    }

    function acceptDelete($id)
    {
        return $this->destroy($id);
    }

    public function reject($id)
    {
        // Auth Roles Vehicle        
        if (
            $this->FunctionController->onlyUserVehicle() == true ||
            $this->FunctionController->onlyAdminVehicle() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $vehicle = Vehicle::find($id);
            if ($vehicle->edit == 1) {
                return $this->rejectEdit($id);
            } elseif ($this->FunctionController->authAdmin() == true) {
                $vehicle->del = 1;
                $vehicle->add = 0;
                $vehicle->edit = 0;
                $vehicle->save();
                return Redirect::route('vehicle.index')
                    ->with(['status' => 'Penolakan dengan kode item ' . $vehicle->code . __(' berhasil ditolak')]);
            } else {
                return Redirect::route('vehicle.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function rejectEdit($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicleTemp = TempVehicle::where(
            'code',
            $vehicle->code
        )->first();
        $vehicleTemp->delete();

        // Edit Data
        $vehicle->name = $vehicleTemp->name;
        $vehicle->type = $vehicleTemp->type;
        $vehicle->brand = $vehicleTemp->brand;
        $vehicle->plat = $vehicleTemp->plat;
        $vehicle->step = $vehicleTemp->step;
        $vehicle->engine = $vehicleTemp->engine;
        $vehicle->kir = $vehicleTemp->kir;
        $vehicle->tax = $vehicleTemp->tax;
        $vehicle->stnk = $vehicleTemp->stnk;
        $vehicle->status = $vehicleTemp->status;
        $vehicle->info = $vehicleTemp->info;
        $vehicle->add = 0;
        $vehicle->edit = 0;
        $vehicle->del = 0;
        $vehicle->save();

        return Redirect::route('vehicle.index');
    }
}
