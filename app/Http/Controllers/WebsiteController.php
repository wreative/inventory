<?php

namespace App\Http\Controllers;

use App\Models\TempWebsite;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FunctionController $FunctionController)
    {
        $this->middleware(['auth', 'website.auth']);
        $this->FunctionController = $FunctionController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    function getData($data)
    {
        $website = Website::where('add', 0)
            ->where('edit', 0);

        return $data == 1 ? $website->where('del', 0)->get() :
            $website->where('del', 1)->get();
    }

    public function index()
    {
        if ($this->FunctionController->authUser() == true) {
            return view('pages.data.website.indexWebsite', [
                'website' => $this->getData(1),
                'total' => $this->FunctionController->total('web'),
                'dtotal' => $this->FunctionController->dtotal('web')
            ]);
        } else {
            return view('pages.data.website.indexWebsite', [
                'website' => $this->getData(1),
                'total' => $this->FunctionController->total('web'),
                'dtotal' => $this->FunctionController->dtotal('web'),
                'notUser' => true
            ]);
        }
    }

    public function deny()
    {
        return view('pages.data.website.declineWebsite', [
            'website' => $this->getData(0),
            'total' => $this->FunctionController->total('web'),
            'dtotal' => $this->FunctionController->dtotal('web')
        ]);
    }

    public function create()
    {
        $code = "WB-" . str_pad(
            $this->FunctionController->getRandom('web'),
            5,
            '0',
            STR_PAD_LEFT
        );
        return view('pages.data.website.createWebsite', ['code' => $code]);
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
            'code' => 'required',
            'name' => 'required',
            'category' => 'required',
            'due' => 'required|date',
        ])->validate();

        // Permissions
        $addPermissions = $this->FunctionController->add();

        Website::create([
            'code' => $req->code,
            'name' => $req->name,
            'category' => $req->category,
            'due' => $req->due,
            'info' => $req->info,
            'add' => $addPermissions == true ? 1 : 0,
            'edit' => 0,
            'del' => 0,
        ]);

        return $this->FunctionController->onlyUserWebsite() == true ?
            Redirect::route('website.index')
            ->with([
                'status' => 'Data anda sedang di proses Admin, 
                    silahkan menunggu atau melihat status data Anda di halaman persetujuan.'
            ]) :
            Redirect::route('website.index');
    }

    public function edit($id)
    {
        // Auth Roles Website
        if (
            $this->FunctionController->onlyAdminWebsite() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if (
                $this->FunctionController->authAdmin() == true or
                $this->FunctionController->superAdmin() == true
            ) {
                $website = Website::find($id);
                return view('pages.data.website.updateWebsite', [
                    'website' => $website
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
        // Auth Roles Website
        if (
            $this->FunctionController->onlyAdminWebsite() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'name' => 'required',
                'category' => 'required',
                'due' => 'required|date',
            ])->validate();

            // Initiation
            $website = Website::find($id);

            // Add real data to temp 
            if ($this->FunctionController->superAdmin() == false) {
                TempWebsite::create([
                    'code' => $website->code,
                    'name' => $req->name,
                    'category' => $website->category,
                    'due' => $website->due,
                    'info' => $website->info,
                ]);
            }

            // Permissions
            $editPermissions = $this->FunctionController->edit();

            $website->name = $req->name;
            $website->category = $req->category;
            $website->due = $req->due;
            $website->info = $req->info;
            $website->add = 0;
            $website->edit = $editPermissions == true ? 1 : 0;
            $website->del = 0;
            $website->save();
            return Redirect::route('website.index')->with([
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
        $website = Website::find($id);
        // Auth Roles Website
        if ($this->FunctionController->superAdmin() == true) {
            $website->delete();
            return Redirect::route('website.index')
                ->with(['status' => 'Data dengan kode item ' . $website->code .
                    __(' berhasil dihapus')]);
        } else if ($this->FunctionController->authAdmin() == true) {
            $website->add = 0;
            $website->edit = 0;
            $website->del = 1;
            $website->save();
            return Redirect::route('website.index')
                ->with(['status' => 'Penolakan dengan kode item ' .
                    $website->code . __(' berhasil ditolak')]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function show($id)
    {
        $website = Website::find($id);
        return view(
            'pages.data.website.showWebsite',
            ['website' => $website]
        );
    }

    public function approv()
    {
        // Auth Roles Website
        if ($this->FunctionController->onlyAdminWebsite() == true) {
            $website = Website::where('add', 1)
                ->get();
            return view('pages.approval.indexWebsite', ['website' => $website]);
        } elseif ($this->FunctionController->onlyUserWebsite() == true) {
            $website = Website::where('add', 1)
                ->get();
            return view('pages.approval.indexWebsite', [
                'website' => $website,
                'user' => true
            ]);
        } elseif ($this->FunctionController->superAdmin() == true) {
            $website = Website::where('edit', 1)
                ->orWhere('del', 1)
                ->get();
            return view('pages.approval.indexWebsite', ['website' => $website]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    // Approval Items
    public function accept($id)
    {
        // Auth Roles Website 
        if (
            $this->FunctionController->onlyAdminWebsite() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $website = Website::find($id);
            if ($website->edit == 1) {
                return $this->acceptEdit($id);
            } elseif ($website->del == 1) {
                return $this->acceptDelete($id);
            } elseif ($website->add == 1) {
                return $this->acceptAdd($id);
            } else {
                return Redirect::route('website.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function acceptAdd($id)
    {
        $website = Website::find($id);
        if (
            $this->FunctionController->onlyAdminWebsite() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $website->add = 0;
            $website->save();
            return Redirect::route('website.index')
                ->with(
                    ['status' => 'Penerimaan dengan kode item ' .
                        $website->code . __(' berhasil diterima')]
                );
        } else {
            return Redirect::route('website.index');
        }
    }

    function acceptEdit($id)
    {
        $website = Website::find($id);
        if ($this->FunctionController->authAdmin() == true) {
            $website->edit = 0;
            $website->save();
            return Redirect::route('website.index');
        } elseif ($this->FunctionController->superAdmin() == true) {
            // Change Record
            $website->edit = 0;
            $website->save();
            return Redirect::route('website.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $website->code .
                    __(' berhasil diterima')]);
        } else {
            return Redirect::route('website.index');
        }
    }

    function acceptDelete($id)
    {
        return $this->destroy($id);
    }

    public function reject($id)
    {
        $website = Website::find($id);
        if ($website->edit == 1) {
            return $this->rejectEdit($id);
        } elseif ($this->FunctionController->authAdmin() == true) {
            $website->del = 1;
            $website->add = 0;
            $website->edit = 0;
            $website->save();
            return Redirect::route('website.index')
                ->with([
                    'status' => 'Penolakan dengan kode item ' .
                        $website->code . __(' berhasil ditolak')
                ]);
        } else {
            return Redirect::route('website.index');
        }
    }

    function rejectEdit($id)
    {
        $website = Website::find($id);
        $websiteTemp = TempWebsite::where(
            'code',
            $website->code
        )->first();
        $websiteTemp->delete();

        // Edit Data
        $website->name = $websiteTemp->name;
        $website->category = $websiteTemp->category;
        $website->due = $websiteTemp->due;
        $website->info = $websiteTemp->info;
        $website->add = 0;
        $website->edit = 0;
        $website->del = 0;
        $website->save();

        return Redirect::route('website.index')
            ->with([
                'status' => 'Penolakan dengan kode item ' .
                    $website->code . __(' berhasil ditolak')
            ]);
    }
}
