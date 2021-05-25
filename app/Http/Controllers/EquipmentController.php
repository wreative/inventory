<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Equipment;
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
        if ($this->FunctionController->authSuper() == true) {
            $equipment = Equipment::where('add', 0)
                ->where('edit', 0)
                ->get();
            return view('pages.data.equipment.indexEquipment', [
                'equipment' => $equipment
            ]);
        } elseif ($this->FunctionController->authAdmin() == true) {
            $equipment = Equipment::where('add', 0)
                ->where('edit', 0)
                ->get();
            return view('pages.data.equipment.indexEquipment', [
                'equipment' => $equipment, 'admin' => true
            ]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function create()
    {
        $code = "EQ-" . str_pad($this->FunctionController->getRandom('equipment'), 5, '0', STR_PAD_LEFT);
        $room = Room::all();
        return view('pages.data.equipment.createEquipment', ['code' => $code, 'room' => $room]);
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
            'code' => 'required',
            'name' => 'required',
            'brand' => 'required',
            'price_acq' => 'required',
            'date_acq' => 'required|date',
            'qty' => 'required',
            'condition' => 'required',
            'room' => 'required',
            'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|nullable',
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
        ]);

        return Redirect::route('equipment.index');
    }

    public function edit($id)
    {
        // if ($this->FunctionController->authAdmin() == true or $this->FunctionController->authSuper() == true) {
        //     $production = Production::find($id);
        //     return view('pages.data.production.updateProduction', ['production' => $production]);
        // } else {
        //     return Redirect::route('home')
        //         ->with(['status' => 'Anda tidak punya akses disini.']);
        // }
        $equipment = Equipment::find($id);
        $room = Room::all();
        return view('pages.data.equipment.updateEquipment', [
            'equipment' => $equipment,
            'room' => $room
        ]);
    }

    public function update($id, Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required',
            'brand' => 'required',
            'price_acq' => 'required',
            'date_acq' => 'required|date',
            'qty' => 'required',
            'condition' => 'required',
            'room' => 'required',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
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
        }

        // Permissions
        $editPermissions = $this->FunctionController->edit();

        $equipment = Equipment::find($id);
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
        $equipment->save();
        return Redirect::route('equipment.index');
    }

    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        Storage::disk('public')->deleteDirectory('equipment/' . $equipment->code);
        $equipment->delete();
        return Redirect::route('equipment.index');
    }

    public function show($id)
    {
        $equipment = Equipment::find($id);
        return view('pages.data.equipment.showEquipment', ['equipment' => $equipment]);
    }

    public function approv()
    {
        if ($this->FunctionController->authAdmin() == true) {
            $production = Production::where('add', 1)
                ->get();
            return view('pages.approval.indexproduction', ['production' => $production]);
        } elseif ($this->FunctionController->authSuper() == true) {
            $production = Production::where('edit', 1)
                ->get();
            return view('pages.approval.indexproduction', ['production' => $production]);
        } else {
            return Redirect::route('equipment.index');
        }
    }

    public function acceptAdd($id)
    {
        $production = Production::find($id);

        if ($this->FunctionController->authAdmin() == true) {
            $production->add = 0;
            $production->save();
            return Redirect::route('equipment.index');
        } elseif ($this->FunctionController->authSuper() == true) {
            $production->edit = 0;
            $production->save();
            return Redirect::route('equipment.index');
        } else {
            return Redirect::route('equipment.index');
        }
    }
}
