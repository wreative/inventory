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
        // if ($this->FunctionController->authUser() == true) {
        //     $equipment = Production::where('add', 1)
        //         ->get();
        //     return view('pages.approval.indexproduction', [
        //         'production' => $equipment, 'user' => true
        //     ]);
        // } else {
        //     $equipment = Production::where('add', 0)
        //         ->where('edit', 0)
        //         ->get();
        //     return view('pages.data.production.indexProduction', [
        //         'production' => $equipment
        //     ]);
        // }
        $equipment = Equipment::all();
        return view('pages.data.equipment.indexEquipment', ['equipment' => $equipment]);
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
        if ($this->FunctionController->authAdmin() == true or $this->FunctionController->authSuper() == true) {
            $production = Production::find($id);
            return view('pages.data.production.updateProduction', ['production' => $production]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
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

        $production = Production::find($id);
        $production->name = $req->name;
        $production->brand = $req->brand;
        $production->price_acq = $price_acq;
        $production->date_acq = $req->date_acq;
        $production->qty = $qty;
        $production->condition = $this->FunctionController->condition($req->condition);
        if ($req->hasFile('img')) {
            $production->img = $dataIMG;
        }
        $production->location = $req->room;
        $production->info = $req->info;
        $production->add = 0;
        $production->edit = $editPermissions == true ? 1 : 0;
        $production->save();
        return Redirect::route('production.index');
    }

    public function destroy($id)
    {
        $production = Production::find($id);
        Storage::disk('public')->deleteDirectory('production/' . $production->code);
        $production->delete();
        return Redirect::route('production.index');
    }

    public function show($id)
    {
        $production = Production::find($id);
        return view('pages.data.production.showProduction', ['production' => $production]);
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
            return Redirect::route('production.index');
        }
    }

    public function acceptAdd($id)
    {
        $production = Production::find($id);

        if ($this->FunctionController->authAdmin() == true) {
            $production->add = 0;
            $production->save();
            return Redirect::route('production.index');
        } elseif ($this->FunctionController->authSuper() == true) {
            $production->edit = 0;
            $production->save();
            return Redirect::route('production.index');
        } else {
            return Redirect::route('production.index');
        }
    }
}
