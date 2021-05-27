<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RentalController extends Controller
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
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if ($this->FunctionController->superAdmin() == true) {
                $rental = Rental::where('add', 0)
                    ->where('edit', 0)
                    ->get();
                return view('pages.data.rental.indexRental', [
                    'rental' => $rental
                ]);
            } elseif ($this->FunctionController->authAdmin() == true) {
                $rental = Rental::where('add', 0)
                    ->where('edit', 0)
                    ->get();
                return view('pages.data.rental.indexRental', [
                    'rental' => $rental, 'admin' => true
                ]);
            } else {
                $rental = Rental::all();
                return view('pages.data.rental.indexRental', [
                    'rental' => $rental
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
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $code = "RT-" . str_pad($this->FunctionController->getRandom('rental'), 5, '0', STR_PAD_LEFT);
            return view('pages.data.rental.createRental', ['code' => $code]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function store(Request $req)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'code' => 'required',
                'name' => 'required',
                'address' => 'required',
                'status' => 'required',
                'pln' => 'required',
                'pdam' => 'required',
                'pbb' => 'required',
                'wifi' => 'required',
                'rental' => 'required',
                'due' => 'required|date',
            ])->validate();

            // Permissions
            $addPermissions = $this->FunctionController->add();

            Rental::create([
                'code' => $req->code,
                'name' => $req->name,
                'address' => $req->address,
                'status' => $req->status,
                'pln' => $req->pln,
                'pdam' => $req->pdam,
                'pbb' => $req->pbb,
                'wifi' => $req->wifi,
                'rental' => $req->rental,
                'due' => $req->due,
                'add' => $addPermissions == true ? 1 : 0,
                'edit' => 0,
            ]);

            return Redirect::route('rental.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function edit($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $rental = Rental::find($id);
            return view('pages.data.rental.updateRental', [
                'rental' => $rental
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
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'name' => 'required',
                'address' => 'required',
                'status' => 'required',
                'pln' => 'required|date',
                'pdam' => 'required',
                'pbb' => 'required',
                'wifi' => 'required',
                'rental' => 'required',
                'due' => 'required|date',
            ])->validate();

            // Permissions
            $editPermissions = $this->FunctionController->edit();

            $rental = Rental::find($id);
            $rental->name = $req->name;
            $rental->address = $req->address;
            $rental->status = $req->status;
            $rental->pln = $req->pln;
            $rental->pdam = $req->pdam;
            $rental->pbb = $req->pbb;
            $rental->wifi = $req->wifi;
            $rental->rental = $req->rental;
            $rental->due = $req->due;
            $rental->add = 0;
            $rental->edit = $editPermissions == true ? 1 : 0;
            $rental->save();
            return Redirect::route('rental.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function destroy($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $rental = Rental::find($id);
            $rental->delete();
            return Redirect::route('rental.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function show($id)
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $rental = Rental::find($id);
            return view('pages.data.rental.showRental', ['rental' => $rental]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function approv()
    {
        // Auth Roles Production        
        if (
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if ($this->FunctionController->authAdmin() == true) {
                $rental = Rental::where('add', 1)
                    ->get();
                return view('pages.approval.indexRental', ['rental' => $rental]);
            } elseif ($this->FunctionController->superAdmin() == true) {
                $rental = Rental::where('edit', 1)
                    ->get();
                return view('pages.approval.indexRental', ['rental' => $rental]);
            } else {
                return Redirect::route('rental.index');
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
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $rental = Rental::find($id);

            if ($this->FunctionController->authAdmin() == true) {
                $rental->add = 0;
                $rental->save();
                return Redirect::route('rental.index');
            } elseif ($this->FunctionController->superAdmin() == true) {
                $rental->edit = 0;
                $rental->save();
                return Redirect::route('rental.index');
            } else {
                return Redirect::route('rental.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }
}
