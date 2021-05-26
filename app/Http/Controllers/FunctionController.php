<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FunctionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getRandom($table)
    {
        do {
            $random = rand(00001, 99999);
            $check = DB::table($table)
                ->select('code')
                ->having('code', '=', $random)
                ->first();
        } while ($check != null);
        return $random;
    }

    public function countID($table)
    {
        return DB::table($table)->count() == 0 ?
            1 :
            DB::table($table)
            ->select('id')
            ->orderByDesc('id')
            ->limit('1')
            ->first()->id + 1;
    }

    public function condition($number)
    {
        switch ($number) {
            case 1:
                return 'Ada';
                break;
            case 2:
                return 'Tidak Ada';
                break;
            case 3:
                return 'Rusak';
                break;
            case 4:
                return 'Hilang';
                break;
            default:
                return null;
                break;
        }
    }

    function storedIMG($code, $photoFile, $photo, $folderName)
    {
        // Create User Collection
        Storage::disk('public')->makeDirectory(
            $folderName . "/" . $code
        );
        // Upload Files
        $dataIMG = array();
        foreach ($photo as $number => $file) {
            // putFileAs It is okay
            $photoName = $number . '.' . $photoFile[$number]->getClientOriginalExtension();
            Storage::disk('public')->putFileAs(
                $folderName . "/" . $code,
                $file,
                $photoName
            );
            // Add Data From Array
            array_push($dataIMG, $photoName);
        }
        return $dataIMG;
    }

    public function authSuper()
    {
        return Auth::user()->roles == 1 ? true : false;
    }

    public function authAdmin()
    {
        return Auth::user()->roles == 2 ? true : (Auth::user()->roles == 3 ? true : (Auth::user()->roles == 4 ? true : (Auth::user()->roles == 5 ? true : false)));
    }

    public function authUser()
    {
        return Auth::user()->roles == 6 ? true : (Auth::user()->roles == 7 ? true : (Auth::user()->roles == 8 ? true : (Auth::user()->roles == 9 ? true : false)));
    }

    public function removeComma($number)
    {
        return str_replace(',', '', $number);
    }

    public function add()
    {
        if ($this->authUser() == false) {
            return false;
        } else {
            return true;
        }
    }

    public function edit()
    {
        if ($this->authAdmin() == false) {
            return false;
        } else {
            return true;
        }
    }

    public function approve()
    {
    }

    public function decline()
    {
    }

    public function onlyUserProduction()
    {
        return Auth::user()->roles == 6 ? true : false;
    }

    public function onlyUserEquipment()
    {
        return Auth::user()->roles == 7 ? true : false;
    }

    public function onlyUserRental()
    {
        return Auth::user()->roles == 8 ? true : false;
    }

    public function onlyUserVehicle()
    {
        return Auth::user()->roles == 9 ? true : false;
    }

    public function onlyAdminProduction()
    {
        return Auth::user()->roles == 2 ? true : false;
    }

    public function onlyAdminEquipment()
    {
        return Auth::user()->roles == 3 ? true : false;
    }

    public function onlyAdminRental()
    {
        return Auth::user()->roles == 4 ? true : false;
    }

    public function onlyAdminVehicle()
    {
        return Auth::user()->roles == 5 ? true : false;
    }

    public function superAdmin()
    {
        return Auth::user()->roles == 1 ? true : false;
    }
}
