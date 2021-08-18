<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Division;
use App\Models\TempDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FunctionController $FunctionController)
    {
        $this->middleware(['auth', 'device.auth']);
        $this->FunctionController = $FunctionController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    function getData($data)
    {
        $device = Device::where('add', 0)
            ->where('edit', 0);

        return $data == 1 ? $device->where('del', 0)->get() :
            $device->where('del', 1)->get();
    }

    public function index()
    {
        if ($this->FunctionController->authUser() == true) {
            return view('pages.data.device.indexDevice', [
                'device' => $this->getData(1),
                'total' => $this->FunctionController->total('device'),
                'dtotal' => $this->FunctionController->dtotal('device')
            ]);
        } else {
            return view('pages.data.device.indexDevice', [
                'device' => $this->getData(1),
                'total' => $this->FunctionController->total('device'),
                'dtotal' => $this->FunctionController->dtotal('device'),
                'notUser' => true
            ]);
        }
    }

    public function deny()
    {
        return view('pages.data.device.declineDevice', [
            'device' => $this->getData(0),
            'total' => $this->FunctionController->total('device'),
            'dtotal' => $this->FunctionController->dtotal('device')
        ]);
    }

    public function create()
    {
        $code = "DV-" . str_pad(
            $this->FunctionController->getRandom('device'),
            5,
            '0',
            STR_PAD_LEFT
        );
        return view('pages.data.device.createDevice', [
            'code' => $code,
            'division' => Division::all(),
        ]);
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'code_phone' => 'required',
            'no' => 'required',
            'wa' => 'required',
            'active' => 'required|date',
            'grace' => 'required|date',
            'division' => 'required',
        ])->validate();

        // Permissions
        $addPermissions = $this->FunctionController->add();

        Device::create([
            'code' => $req->code,
            'name' => $req->name,
            'type' => $req->type,
            'code_phone' => $req->code_phone,
            'no' => $req->no,
            'wa' => $req->wa,
            'active' => $req->active,
            'grace' => $req->grace,
            'division' => $req->division,
            'acc' => $req->acc,
            'add' => $addPermissions == true ? 1 : 0,
            'edit' => 0,
            'del' => 0
        ]);

        return $this->FunctionController->onlyUserDevice() == true ?
            Redirect::route('device.index')
            ->with([
                'status' => 'Data anda sedang di proses Admin, 
                    silahkan menunggu atau melihat status data Anda di halaman persetujuan.'
            ]) :
            Redirect::route('device.index');
    }

    public function edit($id)
    {
        // Auth Roles Device
        if (
            $this->FunctionController->onlyAdminDevice() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            if (
                $this->FunctionController->authAdmin() == true or
                $this->FunctionController->superAdmin() == true
            ) {
                $device = Device::find($id);
                return view('pages.data.device.updateDevice', [
                    'device' => $device,
                    'division' => Division::all()
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
        // Auth Roles Device
        if (
            $this->FunctionController->onlyAdminDevice() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            Validator::make($req->all(), [
                'name' => 'required',
                'type' => 'required',
                'code_phone' => 'required',
                'no' => 'required',
                'wa' => 'required',
                'active' => 'required|date',
                'grace' => 'required|date',
                'division' => 'required',
            ])->validate();

            // Initiation
            $device = Device::find($id);

            // Add real data to temp 
            if ($this->FunctionController->superAdmin() == false) {
                TempDevice::create([
                    'code' => $device->code,
                    'name' => $device->name,
                    'type' => $device->type,
                    'code_phone' => $device->code_phone,
                    'no' => $device->no,
                    'wa' => $device->wa,
                    'active' => $req->active,
                    'grace' => $req->grace,
                    'division' => $req->division,
                    'acc' => $req->acc,
                ]);
            }

            // Permissions
            $editPermissions = $this->FunctionController->edit();

            Device::where('id', $id)
                ->update([
                    'code' => $req->code,
                    'name' => $req->name,
                    'type' => $req->type,
                    'code_phone' => $req->code_phone,
                    'no' => $req->no,
                    'wa' => $req->wa,
                    'active' => $req->active,
                    'grace' => $req->grace,
                    'division' => $req->division,
                    'acc' => $req->acc,
                    'add' => 0,
                    'edit' => $editPermissions == true ? 1 : 0,
                    'del' => 0
                ]);
            return Redirect::route('device.index')->with([
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
        $device = Device::find($id);
        // Auth Roles Device
        if ($this->FunctionController->superAdmin() == true) {
            $device->delete();
            return Redirect::route('device.index')
                ->with(['status' => 'Data dengan kode item ' . $device->code .
                    __(' berhasil dihapus')]);
        } else if ($this->FunctionController->authAdmin() == true) {
            $device->add = 0;
            $device->edit = 0;
            $device->del = 1;
            $device->save();
            return Redirect::route('device.index')
                ->with(['status' => 'Penolakan dengan kode item ' . $device->code . __(' berhasil ditolak')]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    public function show($id)
    {
        $device = Device::find($id);
        return view('pages.data.device.showDevice', [
            'device' => $device,
            'division' => Division::all()
        ]);
    }

    public function approv()
    {
        // Auth Roles Device
        if ($this->FunctionController->onlyAdminDevice() == true) {
            $device = Device::where('add', 1)
                ->get();
            return view('pages.approval.indexDevice', ['device' => $device]);
        } elseif ($this->FunctionController->onlyUserDevice() == true) {
            $device = Device::where('add', 1)
                ->get();
            return view('pages.approval.indexDevice', [
                'device' => $device,
                'user' => true
            ]);
        } elseif ($this->FunctionController->superAdmin() == true) {
            $device = Device::where('edit', 1)
                ->orWhere('del', 1)
                ->get();
            return view('pages.approval.indexDevice', ['device' => $device]);
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    // Approval Items
    public function accept($id)
    {
        // Auth Roles Device     
        if (
            $this->FunctionController->onlyAdminDevice() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $device = Device::find($id);
            if ($device->edit == 1) {
                return $this->acceptEdit($id);
            } elseif ($device->del == 1) {
                return $this->acceptDelete($id);
            } elseif ($device->add == 1) {
                return $this->acceptAdd($id);
            } else {
                return Redirect::route('device.index');
            }
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Anda tidak punya akses disini.']);
        }
    }

    function acceptAdd($id)
    {
        $device = Device::find($id);
        if (
            $this->FunctionController->onlyAdminDevice() == true ||
            $this->FunctionController->superAdmin() == true
        ) {
            $device->add = 0;
            $device->save();
            return Redirect::route('device.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $device->code . __(' berhasil diterima')]);
        } else {
            return Redirect::route('device.index');
        }
    }

    function acceptEdit($id)
    {
        $device = Device::find($id);
        if ($this->FunctionController->authAdmin() == true) {
            $device->edit = 0;
            $device->save();
            return Redirect::route('device.index');
        } elseif ($this->FunctionController->superAdmin() == true) {
            // Delete Temp Record
            TempDevice::where('code', $device->code)->first()->delete();
            // Change Record
            $device->edit = 0;
            $device->save();
            return Redirect::route('device.index')
                ->with(['status' => 'Penerimaan dengan kode item ' . $device->code .
                    __(' berhasil diterima')]);
        } else {
            return Redirect::route('device.index');
        }
    }

    function acceptDelete($id)
    {
        return $this->destroy($id);
    }

    public function reject($id)
    {
        $device = Device::find($id);
        if ($device->edit == 1) {
            return $this->rejectEdit($id);
        } elseif ($this->FunctionController->authAdmin() == true) {
            $device->del = 1;
            $device->add = 0;
            $device->edit = 0;
            $device->save();
            return Redirect::route('device.index')
                ->with(['status' => 'Penolakan dengan kode item ' . $device->code . __(' berhasil ditolak')]);
        } else {
            return Redirect::route('device.index');
        }
    }

    function rejectEdit($id)
    {
        $deviceTemp = TempDevice::where(
            'code',
            Device::find($id)->code
        )->first();
        $deviceTemp->delete();

        // Edit Data
        Device::where('id', $id)
            ->update([
                'name' => $deviceTemp->name,
                'type' => $deviceTemp->type,
                'code_phone' => $deviceTemp->code_phone,
                'no' => $deviceTemp->no,
                'wa' => $deviceTemp->wa,
                'active' => $deviceTemp->active,
                'grace' => $deviceTemp->grace,
                'division' => $deviceTemp->division,
                'acc' => $deviceTemp->acc,
                'add' => 0,
                'edit' => 0,
                'del' => 0
            ]);

        return Redirect::route('device.index')
            ->with([
                'status' => 'Penolakan dengan kode item ' .
                    Device::find($id)->code . __(' berhasil ditolak')
            ]);
    }
}
