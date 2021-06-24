<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\TempRental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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

    function getData($data)
    {
        $rental = Rental::where('add', 0)
            ->where('edit', 0);

        return $data == 1 ? $rental->where('del', 0)->get() :
            $rental->where('del', 1)->get();
    }

    public function index()
    {
        // Auth Roles Rental   
        if (
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if ($this->FunctionController->authUser() == true) {
                return view('pages.data.rental.indexRental', [
                    'rental' => $this->getData(1),
                    'total' => $this->FunctionController->total('rental'),
                    'dtotal' => $this->FunctionController->dtotal('rental')
                ]);
            } else {
                return view('pages.data.rental.indexRental', [
                    'rental' => $this->getData(1),
                    'total' => $this->FunctionController->total('rental'),
                    'dtotal' => $this->FunctionController->dtotal('rental'),
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
        // Auth Roles Rental
        if (
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            return view('pages.data.rental.declineRental', [
                'rental' => $this->getData(0),
                'total' => $this->FunctionController->total('rental'),
                'dtotal' => $this->FunctionController->dtotal('rental')
            ]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function create()
    {
        // Auth Roles Rental   
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
        // Auth Roles Rental     
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
                'info' => $req->info,
                'add' => $addPermissions == true ? 1 : 0,
                'edit' => 0,
                'del' => 0
            ]);

            return $this->FunctionController->onlyUserRental() == true ?
                Redirect::route('rental.index')
                ->with([
                    'status' => 'Data anda sedang di proses Admin, 
                    silahkan menunggu atau melihat status data Anda di halaman persetujuan.'
                ]) :
                Redirect::route('rental.index');
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function edit($id)
    {
        // Auth Roles Rental     
        if (
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if (
                $this->FunctionController->authAdmin() == true or
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
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function update($id, Request $req)
    {
        // Auth Roles Rental        
        if (
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
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

            // Initiation
            $rental = Rental::find($id);

            // Add real data to temp 
            if ($this->FunctionController->superAdmin() == false) {
                TempRental::create([
                    'code' => $rental->code,
                    'name' => $rental->name,
                    'address' => $rental->address,
                    'status' => $rental->status,
                    'pln' => $rental->pln,
                    'pdam' => $rental->pdam,
                    'pbb' => $rental->pbb,
                    'wifi' => $rental->wifi,
                    'rental' => $rental->rental,
                    'due' => $rental->due,
                    'info' => $rental->info
                ]);
            }

            // Permissions
            $editPermissions = $this->FunctionController->edit();

            $rental->name = $req->name;
            $rental->address = $req->address;
            $rental->status = $req->status;
            $rental->pln = $req->pln;
            $rental->pdam = $req->pdam;
            $rental->pbb = $req->pbb;
            $rental->wifi = $req->wifi;
            $rental->rental = $req->rental;
            $rental->due = $req->due;
            $rental->info = $req->info;
            $rental->add = 0;
            $rental->edit = $editPermissions == true ? 1 : 0;
            $rental->del = 0;
            $rental->save();
            return Redirect::route('rental.index')->with([
                'status' => 'Data anda berhasil diubah, 
            silahkan menunggu atau melihat status data Anda di halaman persetujuan.'
            ]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function destroy($id)
    {
        $rental = Rental::find($id);
        // Auth Roles Rental
        if ($this->FunctionController->superAdmin() == true) {
            $rental->delete();
            return Redirect::route('rental.index')
                ->with(['status' => 'Data dengan kode item ' . $rental->code .
                    __(' berhasil dihapus')]);
        } else if ($this->FunctionController->authAdmin() == true) {
            $rental->add = 0;
            $rental->edit = 0;
            $rental->del = 1;
            $rental->save();
            return Redirect::route('rental.index')
                ->with(['status' => 'Penolakan dengan kode item ' . $rental->code . __(' berhasil ditolak')]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function show($id)
    {
        // Auth Roles Rental        
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
        // Auth Roles Rental        
        if ($this->FunctionController->onlyAdminRental() == true) {
            $rental = Rental::where('add', 1)
                ->get();
            return view('pages.approval.indexRental', ['rental' => $rental]);
        } elseif ($this->FunctionController->onlyUserRental() == true) {
            $rental = Rental::where('add', 1)
                ->get();
            return view('pages.approval.indexRental', [
                'rental' => $rental,
                'user' => true
            ]);
        } elseif ($this->FunctionController->superAdmin() == true) {
            $rental = Rental::where('edit', 1)
                ->orWhere('del', 1)
                ->get();
            return view('pages.approval.indexRental', ['rental' => $rental]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    // Approval Items
    public function accept($id)
    {
        // Auth Roles Rental        
        if (
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $rental = Rental::find($id);
            if ($rental->edit == 1) {
                return $this->acceptEdit($id);
            } elseif ($rental->del == 1) {
                return $this->acceptDelete($id);
            } elseif ($rental->add == 1) {
                return $this->acceptAdd($id);
            } else {
                return Redirect::route('rental.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function acceptAdd($id)
    {
        $rental = Rental::find($id);
        if (
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $rental->add = 0;
            $rental->save();
            return Redirect::route('rental.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $rental->code . __(' berhasil diterima')]);
        } else {
            return Redirect::route('rental.index');
        }
    }

    function acceptEdit($id)
    {
        $rental = Rental::find($id);
        if ($this->FunctionController->authAdmin() == true) {
            $rental->edit = 0;
            $rental->save();
            return Redirect::route('rental.index');
        } elseif ($this->FunctionController->superAdmin() == true) {
            // Delete Temp Record
            TempRental::where('code', $rental->code)->first()->delete();
            // Change Record
            $rental->edit = 0;
            $rental->save();
            return Redirect::route('rental.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $rental->code .
                    __(' berhasil diterima')]);
        } else {
            return Redirect::route('rental.index');
        }
    }

    function acceptDelete($id)
    {
        return $this->destroy($id);
    }

    public function reject($id)
    {
        // Auth Roles Rental        
        if (
            $this->FunctionController->onlyUserRental() == true ||
            $this->FunctionController->onlyAdminRental() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $rental = Rental::find($id);
            if ($rental->edit == 1) {
                return $this->rejectEdit($id);
            } elseif ($this->FunctionController->authAdmin() == true) {
                $rental->del = 1;
                $rental->add = 0;
                $rental->edit = 0;
                $rental->save();
                return Redirect::route('rental.index')
                    ->with(['status' => 'Penolakan dengan kode item ' . $rental->code . __(' berhasil ditolak')]);
            } else {
                return Redirect::route('rental.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function rejectEdit($id)
    {
        $rental = Rental::find($id);
        $rentalTemp = TempRental::where(
            'code',
            $rental->code
        )->first();
        $rentalTemp->delete();

        // Edit Data
        $rental->name = $rentalTemp->name;
        $rental->address = $rentalTemp->address;
        $rental->status = $rentalTemp->status;
        $rental->pln = $rentalTemp->pln;
        $rental->pdam = $rentalTemp->pdam;
        $rental->pbb = $rentalTemp->pbb;
        $rental->wifi = $rentalTemp->wifi;
        $rental->rental = $rentalTemp->rental;
        $rental->due = $rentalTemp->due;
        $rental->info = $rentalTemp->info;
        $rental->add = 0;
        $rental->edit = 0;
        $rental->del = 0;
        $rental->save();

        return Redirect::route('rental.index')
            ->with(['status' => 'Penolakan dengan kode item ' . $rental->code . __(' berhasil ditolak')]);
    }
}
