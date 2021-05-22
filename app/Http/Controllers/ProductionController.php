<?php

namespace App\Http\Controllers;

use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductionController extends Controller
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
        $production = Production::where('add', null)
            ->where('edit', null)
            ->get();
        return view('pages.data.production.indexProduction', ['production' => $production]);
    }

    public function create()
    {
        $code = "AP-" . str_pad($this->FunctionController->getRandom('production'), 5, '0', STR_PAD_LEFT);
        return view('pages.data.production.createProduction', ['code' => $code]);
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
                    $req->file('img')
                )
            );
        } else {
            $dataIMG = null;
        }

        // Permissions
        $addPermissions = $this->FunctionController->add();

        Production::create([
            'code' => $req->code,
            'name' => $req->name,
            'brand' => $req->brand,
            'price_acq' => $price_acq,
            'date_acq' => $req->date_acq,
            'qty' => $qty,
            'condition' => $this->FunctionController->condition($req->condition),
            'img' => $dataIMG,
            'info' => $req->info,
            'add' => $addPermissions == false ? 1 : null,
            'edit' => null,
        ]);

        return Redirect::route('production.index');
    }

    public function edit($id)
    {
        if ($this->FunctionController->authUser() == true) {
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
            'condition' => 'required'
        ])->validate();

        $items = Items::find($id);
        $items->name = $req->name;
        $items->condition = $req->condition == 1 ? 'Bagus' : 'Buruk';
        $items->save();
        return Redirect::route('items.index');
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
        $production = Production::where('add', '!=', null)
            ->where('edit', '!=', null)
            ->get();
        return view('pages.approval.indexproduction', ['production' => $production]);
    }
}
