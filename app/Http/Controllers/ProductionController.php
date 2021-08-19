<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduction;
use App\Models\Production;
use App\Models\TempProduction;
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
        $this->middleware(['auth', 'production.auth']);
        $this->FunctionController = $FunctionController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    function getData($data)
    {
        $production = Production::where('add', 0)
            ->where('edit', 0);

        return $data == 1 ? $production->where('del', 0)->get() :
            $production->where('del', 1)->get();
    }

    public function index()
    {
        if ($this->FunctionController->authUser() == true) {
            return view('pages.data.production.indexProduction', [
                'production' => $this->getData(1),
                'total' => $this->FunctionController->total('production'),
                'dtotal' => $this->FunctionController->dtotal('production')
            ]);
        } else {
            return view('pages.data.production.indexProduction', [
                'production' => $this->getData(1),
                'total' => $this->FunctionController->total('production'),
                'dtotal' => $this->FunctionController->dtotal('production'),
                'notUser' => true
            ]);
        }
    }

    public function deny()
    {
        return view('pages.data.production.declineProduction', [
            'production' => $this->getData(0),
            'total' => $this->FunctionController->total('production'),
            'dtotal' => $this->FunctionController->dtotal('production')
        ]);
    }

    public function create()
    {
        $code = "AP-" . str_pad(
            $this->FunctionController->getRandom('production'),
            5,
            '0',
            STR_PAD_LEFT
        );
        return view('pages.data.production.createProduction', [
            'code' => $code,
            'category' => CategoryProduction::all()
        ]);
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
            'category' => 'required'
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
            'category' => $req->category,
            'add' => $addPermissions == true ? 1 : 0,
            'edit' => 0,
            'del' => 0,
        ]);

        return $this->FunctionController->onlyUserProduction() == true ?
            Redirect::route('production.index')
            ->with([
                'status' => 'Data anda sedang di proses Admin, 
                    silahkan menunggu atau melihat status data Anda di halaman persetujuan.'
            ]) :
            Redirect::route('production.index');
    }

    public function edit($id)
    {
        if (
            $this->FunctionController->authAdmin() == true or
            $this->FunctionController->superAdmin() == true
        ) {
            $production = Production::find($id);
            return view('pages.data.production.updateProduction', [
                'production' => $production,
                'category' => CategoryProduction::all()
            ]);
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
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            'category' => 'required'
        ])->validate();

        // Remove Comma
        $price_acq = $this->FunctionController->removeComma($req->price_acq);
        $qty = $this->FunctionController->removeComma($req->qty);

        // Initiation
        $production = Production::find($id);

        // Add real data to temp 
        if ($this->FunctionController->superAdmin() == false) {
            TempProduction::create([
                'code' => $production->code,
                'name' => $production->name,
                'brand' => $production->brand,
                'qty' => $production->qty,
                'price_acq' => $production->price_acq,
                'date_acq' => $production->date_acq,
                'condition' => $production->condition,
                'img' => $production->img,
                'info' => $production->info,
                'category' => $production->category
            ]);
        }

        // Image
        if ($req->hasFile('img')) {
            if ($this->FunctionController->superAdmin() == false) {
                // Moving Original Files
                Storage::disk('public')->makeDirectory(
                    "production-tmp/" . $production->code
                );
                $beginning = Storage::disk('public')->get("production/" . $production->code);
                $files = Storage::allFiles($beginning . '/public/production/' . $production->code);
                foreach ($files as $number => $path) {
                    $file = pathinfo($path);
                    Storage::move(
                        $files[$number],
                        'public/production-tmp/' . $production->code . '/' . $file['basename']
                    );
                }
            }

            // Upload New Files
            $dataIMG = json_encode(
                $this->FunctionController->storedIMG(
                    $production->code,
                    $req->img,
                    $req->file('img'),
                    'production'
                )
            );
        }

        // Permissions
        $editPermissions = $this->FunctionController->edit();

        // Edit Data
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
        $production->category = $req->category;
        $production->add = 0;
        $production->edit = $editPermissions == true ? 1 : 0;
        $production->del = 0;
        $production->save();
        return Redirect::route('production.index')->with([
            'status' => 'Data anda berhasil diubah, 
            silahkan menunggu atau melihat status data Anda di halaman persetujuan.'
        ]);
    }

    public function destroy($id)
    {
        $production = Production::find($id);

        if ($this->FunctionController->superAdmin() == true) {
            Storage::disk('public')->deleteDirectory('production/' . $production->code);
            $production->delete();
            return Redirect::route('production.index')
                ->with(['status' => 'Data dengan kode item ' . $production->code .
                    __(' berhasil dihapus')]);
        } else if ($this->FunctionController->authAdmin() == true) {
            $production->add = 0;
            $production->edit = 0;
            $production->del = 1;
            $production->save();
            return Redirect::route('production.index')
                ->with([
                    'status' => 'Penolakan dengan kode item ' . $production->code . __(' berhasil ditolak')
                ]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function show($id)
    {
        $production = Production::find($id);
        return view('pages.data.production.showProduction', [
            'production' => $production,
            'category' => CategoryProduction::all()
        ]);
    }

    public function approv()
    {
        if ($this->FunctionController->onlyAdminProduction() == true) {
            $production = Production::where('add', 1)
                ->get();
            return view('pages.approval.indexProduction', ['production' => $production]);
        } elseif ($this->FunctionController->onlyUserProduction() == true) {
            $production = Production::where('add', 1)
                ->get();
            return view('pages.approval.indexProduction', [
                'production' => $production,
                'user' => true
            ]);
        } elseif ($this->FunctionController->superAdmin() == true) {
            $production = Production::where('edit', 1)
                ->orWhere('del', 1)
                ->get();
            return view('pages.approval.indexProduction', ['production' => $production]);
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
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $production = Production::find($id);
            if ($production->edit == 1) {
                return $this->acceptEdit($id);
            } elseif ($production->del == 1) {
                return $this->acceptDelete($id);
            } elseif ($production->add == 1) {
                return $this->acceptAdd($id);
            } else {
                return Redirect::route('production.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function acceptAdd($id)
    {
        $production = Production::find($id);
        if (
            $this->FunctionController->onlyAdminProduction() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $production->add = 0;
            $production->save();
            return Redirect::route('production.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $production->code . __(' berhasil diterima')]);
        } else {
            return Redirect::route('production.index');
        }
    }

    function acceptEdit($id)
    {
        $production = Production::find($id);
        if ($this->FunctionController->authAdmin() == true) {
            $production->edit = 0;
            $production->save();
            return Redirect::route('production.index');
        } elseif ($this->FunctionController->superAdmin() == true) {
            // Delete Temp Record
            TempProduction::where('code', $production->code)->first()->delete();
            // Delete Folder Temp
            Storage::disk('public')->deleteDirectory(
                "production-tmp/" . $production->code
            );
            // Change Record
            $production->edit = 0;
            $production->save();
            return Redirect::route('production.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $production->code .
                    __(' berhasil diterima')]);
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
        $production = Production::find($id);
        if ($production->edit == 1) {
            return $this->rejectEdit($id);
        } elseif ($this->FunctionController->authAdmin() == true) {
            $production->del = 1;
            $production->add = 0;
            $production->edit = 0;
            $production->save();
            return Redirect::route('production.index')
                ->with(['status' => 'Penolakan dengan kode item ' . $production->code . __(' berhasil ditolak')]);
        } else {
            return Redirect::route('production.index');
        }
    }

    function rejectEdit($id)
    {
        $production = Production::find($id);
        $productionTemp = TempProduction::where(
            'code',
            $production->code
        )->first();
        $productionTemp->delete();

        // Edit Data
        $production->name = $productionTemp->name;
        $production->brand = $productionTemp->brand;
        $production->price_acq = $productionTemp->price_acq;
        $production->date_acq = $productionTemp->date_acq;
        $production->qty = $productionTemp->qty;
        $production->condition = $productionTemp->condition;
        $production->img = $productionTemp->img;
        $production->info = $productionTemp->info;
        $production->category = $productionTemp->category;
        $production->add = 0;
        $production->edit = 0;
        $production->del = 0;
        $production->save();

        // Delete Directory Original
        Storage::disk('public')->deleteDirectory('production/' . $production->code);

        // Moving Original Files
        $beginning = Storage::disk('public')->get("production-tmp/" . $production->code);
        $files = Storage::allFiles($beginning . '/public/production-tmp/' . $production->code);
        foreach ($files as $number => $path) {
            $file = pathinfo($path);
            Storage::move(
                $files[$number],
                'public/production/' . $production->code . '/' . $file['basename']
            );
        }

        // Delete Directory Temp
        Storage::disk('public')->deleteDirectory('production-tmp/' . $production->code);

        return Redirect::route('production.index')
            ->with(['status' => 'Penolakan dengan kode item ' . $production->code . __(' berhasil ditolak')]);
    }
}
