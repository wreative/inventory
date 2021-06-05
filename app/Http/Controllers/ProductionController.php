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
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $production = Production::where('add', 0)
                ->where('edit', 0)
                ->where('del', 0)
                ->get();
            if ($this->FunctionController->authUser() == true) {
                return view('pages.data.production.indexProduction', [
                    'production' => $production
                ]);
            } else {
                return view('pages.data.production.indexProduction', [
                    'production' => $production, 'notUser' => true
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
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $code = "AP-" . str_pad($this->FunctionController->getRandom('production'), 5, '0', STR_PAD_LEFT);
            return view('pages.data.production.createProduction', ['code' => $code]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function store(Request $req)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
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
                        'production'
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
                'add' => $addPermissions == true ? 1 : 0,
                'edit' => 0,
                'del' => 0,
            ]);

            return Redirect::route('production.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function edit($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if (
                $this->FunctionController->authAdmin() == true or
                $this->FunctionController->superAdmin() == true
            ) {
                $production = Production::find($id);
                return view('pages.data.production.updateProduction', ['production' => $production]);
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
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'name' => 'required',
                'brand' => 'required',
                'price_acq' => 'required',
                'date_acq' => 'required|date',
                'qty' => 'required',
                'condition' => 'required',
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
                        'production'
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
            $production->info = $req->info;
            $production->add = 0;
            $production->edit = $editPermissions == true ? 1 : 0;
            $production->del = 0;
            $production->save();
            return Redirect::route('production.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function destroy($id)
    {
        $production = Production::find($id);
        // Auth Roles Production        
        if ($this->FunctionController->superAdmin() == true) {
            Storage::disk('public')->deleteDirectory('production/' . $production->code);
            $production->delete();
            return Redirect::route('production.index');
        } else if ($this->FunctionController->authAdmin() == true) {
            $production->del = 1;
            $production->save();
            return Redirect::route('production.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function show($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $production = Production::find($id);
            return view('pages.data.production.showProduction', ['production' => $production]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function approv()
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if ($this->FunctionController->authAdmin() == true) {
                $production = Production::where('add', 1)
                    ->get();
                return view('pages.approval.indexProduction', ['production' => $production]);
            } elseif ($this->FunctionController->superAdmin() == true) {
                $production = Production::where('edit', 1)
                    ->orWhere('del', 1)
                    ->get();
                return view('pages.approval.indexProduction', ['production' => $production]);
            } else {
                return Redirect::route('home')
                    ->with(['status' => 'Anda tidak punya akses disini.']);
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    // Approval Items
    public function accept($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $production = Production::find($id);
            if ($production->edit == 1) {
                $this->acceptEdit($id);
            } elseif ($production->del == 1) {
                return $this->acceptDelete($id);
            } else {
                return Redirect::route('production.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function acceptEdit($id)
    {
        $production = Production::find($id);
        if ($this->FunctionController->authAdmin() == true) {
            $production->add = 0;
            $production->save();
            return Redirect::route('production.index');
        } elseif ($this->FunctionController->superAdmin() == true) {
            $production->edit = 0;
            $production->save();
            return Redirect::route('production.index');
        } else {
            return Redirect::route('production.index');
        }
    }

    function acceptDelete($id)
    {
        return $this->destroy($id);
    }

    public function reject($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserProduction() == true ||
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $production = Production::find($id);
            if ($production->edit == 1) {
                // $this->acceptEdit($id);
            } elseif ($production->del == 1) {
                $production->del = 0;
                $production->save();
                return Redirect::route('production.index');
            } else {
                return Redirect::route('production.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }
}
