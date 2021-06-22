<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Equipment;
use App\Models\TempEquipment;
use App\Models\TempVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
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
        // Auth Roles Equipment        
        if (
            $this->FunctionController->onlyUserEquipment() == true ||
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $equipment = Equipment::where('add', 0)
                ->where('edit', 0);
            if ($this->FunctionController->authUser() == true) {
                return view('pages.data.equipment.indexEquipment', [
                    'equipment' => $equipment->where('del', 0)->get(),
                    'total' => $equipment->where('del', 0)->count(),
                    'dtotal' => $equipment->where('del', 1)->count()
                ]);
            } else {
                return view('pages.data.equipment.indexEquipment', [
                    'equipment' => $equipment->where('del', 0)->get(),
                    'total' => $equipment->where('del', 0)->count(),
                    'dtotal' => $equipment->where('del', 1)->count(),
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
        // Auth Roles Equipment        
        if (
            $this->FunctionController->onlyUserEquipment() == true ||
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $equipment = Equipment::where('add', 0)
                ->where('edit', 0);
            return view('pages.data.equipment.declineEquipment', [
                'equipment' => $equipment->where('del', 1)->get(),
                'total' => $equipment->where('del', 0)->count(),
                'dtotal' => $equipment->where('del', 1)->count()
            ]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function create()
    {
        // Auth Roles Equipment        
        if (
            $this->FunctionController->onlyUserEquipment() == true ||
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $code = "EQ-" . str_pad($this->FunctionController->getRandom('equipment'), 5, '0', STR_PAD_LEFT);
            $room = Room::all();
            return view('pages.data.equipment.createEquipment', ['code' => $code, 'room' => $room]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function store(Request $req)
    {
        // Auth Roles Equipment        
        if (
            $this->FunctionController->onlyUserEquipment() == true ||
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'code' => 'required',
                'name' => 'required',
                'brand' => 'required',
                'price_acq' => 'required',
                'date_acq' => 'required|date',
                'qty' => 'required',
                'condition' => 'required',
                'room' => 'required',
                'img.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|nullable',
            ])->validate();

            // Remove Comma
            $price_acq = $this->FunctionController->removeComma($req->price_acq);
            $qty = $this->FunctionController->removeComma($req->qty);

            // Image
            if ($req->hasFile('img')) {
                $dataIMG = json_encode(
                    $this->FunctionController->storedIMG(
                        $req->code,
                        $req->img,
                        $req->file('img'),
                        'equipment'
                    )
                );
            } else {
                $dataIMG = null;
            }

            // Permissions
            $addPermissions = $this->FunctionController->add();

            Equipment::create([
                'code' => $req->code,
                'name' => $req->name,
                'brand' => $req->brand,
                'price_acq' => $price_acq,
                'date_acq' => $req->date_acq,
                'qty' => $qty,
                'condition' => $this->FunctionController->condition($req->condition),
                'img' => $dataIMG,
                'info' => $req->info,
                'location' => $req->room,
                'add' => $addPermissions == true ? 1 : 0,
                'edit' => 0,
                'del' => 0
            ]);

            return $this->FunctionController->onlyUserEquipment() == true ?
                Redirect::route('equipment.index')
                ->with([
                    'status' => 'Data anda sedang di proses Admin, 
                    silahkan menunggu atau melihat status data Anda di halaman persetujuan.'
                ]) :
                Redirect::route('equipment.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function edit($id)
    {
        // Auth Roles Equipment        
        if (
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if (
                $this->FunctionController->authAdmin() == true or
                $this->FunctionController->superAdmin() == true
            ) {
                $equipment = Equipment::find($id);
                $room = Room::all();
                return view('pages.data.equipment.updateEquipment', [
                    'equipment' => $equipment,
                    'room' => $room
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
        // Auth Roles Equipment    
        if (
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'name' => 'required',
                'brand' => 'required',
                'price_acq' => 'required',
                'date_acq' => 'required|date',
                'qty' => 'required',
                'condition' => 'required',
                'room' => 'required',
                'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            ])->validate();

            // Remove Comma
            $price_acq = $this->FunctionController->removeComma($req->price_acq);
            $qty = $this->FunctionController->removeComma($req->qty);

            // Initiation
            $equipment = Equipment::find($id);

            // Add real data to temp 
            if ($this->FunctionController->superAdmin() == false) {
                TempEquipment::create([
                    'code' => $equipment->code,
                    'name' => $equipment->name,
                    'brand' => $equipment->brand,
                    'price_acq' => $equipment->price_acq,
                    'date_acq' => $equipment->date_acq,
                    'qty' => $equipment->qty,
                    'condition' => $equipment->condition,
                    'img' => $equipment->img,
                    'location' => $equipment->location,
                    'info' => $equipment->info
                ]);
            }

            // Image
            if ($req->hasFile('img')) {
                if ($this->FunctionController->superAdmin() == false) {
                    // Moving Original Files
                    Storage::disk('public')->makeDirectory(
                        "equipment-tmp/" . $equipment->code
                    );
                    $beginning = Storage::disk('public')->get("equipment/" . $equipment->code);
                    $files = Storage::allFiles($beginning . '/public/equipment/' . $equipment->code);
                    foreach ($files as $number => $path) {
                        $file = pathinfo($path);
                        Storage::move(
                            $files[$number],
                            'public/equipment-tmp/' . $equipment->code . '/' . $file['basename']
                        );
                    }
                }

                // Upload New Files
                $dataIMG = json_encode(
                    $this->FunctionController->storedIMG(
                        $equipment->code,
                        $req->img,
                        $req->file('img'),
                        'equipment'
                    )
                );
            }

            // Permissions
            $editPermissions = $this->FunctionController->edit();

            $equipment->name = $req->name;
            $equipment->brand = $req->brand;
            $equipment->price_acq = $price_acq;
            $equipment->date_acq = $req->date_acq;
            $equipment->qty = $qty;
            $equipment->condition = $this->FunctionController->condition($req->condition);
            if ($req->hasFile('img')) {
                $equipment->img = $dataIMG;
            }
            $equipment->location = $req->room;
            $equipment->info = $req->info;
            $equipment->add = 0;
            $equipment->edit = $editPermissions == true ? 1 : 0;
            $equipment->del = 0;
            $equipment->save();
            return Redirect::route('equipment.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        // Auth Roles Equipment       
        if ($this->FunctionController->superAdmin() == true) {
            Storage::disk('public')->deleteDirectory('equipment/' . $equipment->code);
            $equipment->delete();
            return Redirect::route('equipment.index');
        } else if ($this->FunctionController->authAdmin() == true) {
            $equipment->add = 0;
            $equipment->edit = 0;
            $equipment->del = 1;
            $equipment->save();
            return Redirect::route('equipment.deny')
                ->with(['status' => 'Penolakan dengan kode item ' . $equipment->code . __(' berhasil ditolak')]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function show($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserEquipment() == true ||
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $room = Room::all();
            $equipment = Equipment::find($id);
            return view('pages.data.equipment.showEquipment', [
                'equipment' => $equipment,
                'room' => $room
            ]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function approv()
    {
        // Auth Roles Production        
        if ($this->FunctionController->onlyAdminEquipment() == true) {
            $equipment = Equipment::where('add', 1)
                ->get();
            return view('pages.approval.indexEquipment', ['equipment' => $equipment]);
        } elseif ($this->FunctionController->onlyUserEquipment() == true) {
            $equipment = Equipment::where('add', 1)
                ->get();
            return view('pages.approval.indexEquipment', [
                'equipment' => $equipment,
                'user' => true
            ]);
        } elseif ($this->FunctionController->superAdmin() == true) {
            $equipment = Equipment::where('edit', 1)
                ->orWhere('del', 1)
                ->get();
            return view('pages.approval.indexEquipment', ['equipment' => $equipment]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    // Approval Items
    public function accept($id)
    {
        // Auth Roles Equipment        
        if (
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $equipment = Equipment::find($id);
            if ($equipment->edit == 1) {
                return $this->acceptEdit($id);
            } elseif ($equipment->del == 1) {
                return $this->acceptDelete($id);
            } elseif ($equipment->add == 1) {
                return $this->acceptAdd($id);
            } else {
                return Redirect::route('equipment.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function acceptAdd($id)
    {
        $equipment = Equipment::find($id);
        if (
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $equipment->add = 0;
            $equipment->save();
            return Redirect::route('equipment.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $equipment->code . __(' berhasil diterima')]);
        } else {
            return Redirect::route('equipment.index');
        }
    }

    function acceptEdit($id)
    {
        $equipment = Equipment::find($id);
        if ($this->FunctionController->authAdmin() == true) {
            $equipment->edit = 0;
            $equipment->save();
            return Redirect::route('equipment.index');
        } elseif ($this->FunctionController->superAdmin() == true) {
            // Delete Temp Record
            TempEquipment::where('code', $equipment->code)->first()->delete();
            // Delete Folder Temp
            Storage::disk('public')->deleteDirectory(
                "equipment-tmp/" . $equipment->code
            );
            // Change Record
            $equipment->edit = 0;
            $equipment->save();
            return Redirect::route('equipment.index');
        } else {
            return Redirect::route('equipment.index');
        }
    }

    function acceptDelete($id)
    {
        return $this->destroy($id);
    }

    public function reject($id)
    {
        // Auth Roles Equipment        
        if (
            $this->FunctionController->onlyUserEquipment() == true ||
            $this->FunctionController->onlyAdminEquipment() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $equipment = Equipment::find($id);
            if ($equipment->edit == 1) {
                return $this->rejectEdit($id);
            } elseif ($this->FunctionController->authAdmin() == true) {
                $equipment->del = 1;
                $equipment->add = 0;
                $equipment->edit = 0;
                $equipment->save();
                return Redirect::route('equipment.deny')
                    ->with(['status' => 'Penolakan dengan kode item ' . $equipment->code . __(' berhasil ditolak')]);
            } else {
                return Redirect::route('equipment.index');
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
        $vehicle->brand = $vehicleTemp->brand;
        $vehicle->price_acq = $vehicleTemp->price_acq;
        $vehicle->date_acq = $vehicleTemp->date_acq;
        $vehicle->qty = $vehicleTemp->qty;
        $vehicle->condition = $vehicleTemp->condition;
        $vehicle->img = $vehicleTemp->img;
        $vehicle->location = $vehicleTemp->location;
        $vehicle->info = $vehicleTemp->info;
        $vehicle->add = 0;
        $vehicle->edit = 0;
        $vehicle->del = 0;
        $vehicle->save();

        // Delete Directory Original
        Storage::disk('public')->deleteDirectory('vehicle/' . $vehicle->code);

        // Moving Original Files
        $beginning = Storage::disk('public')->get("vehicle-tmp/" . $vehicle->code);
        $files = Storage::allFiles($beginning . '/public/vehicle-tmp/' . $vehicle->code);
        foreach ($files as $number => $path) {
            $file = pathinfo($path);
            Storage::move(
                $files[$number],
                'public/vehicle/' . $vehicle->code . '/' . $file['basename']
            );
        }

        // Delete Directory Temp
        Storage::disk('public')->deleteDirectory('vehicle-tmp/' . $vehicle->code);

        return Redirect::route('vehicle.index');
    }
}
