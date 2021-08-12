<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use DateTime;
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

    public function authAdmin()
    {
        switch (Auth::user()->role_id) {
            case 2:
                return true;
            case 3:
                return true;
            case 4:
                return true;
            case 5:
                return true;
            case 11:
                return true;
            default:
                return false;
        }
    }

    public function authUser()
    {
        switch (Auth::user()->role_id) {
            case 6:
                return true;
            case 7:
                return true;
            case 8:
                return true;
            case 9:
                return true;
            case 10:
                return true;
            default:
                return false;
        }
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

    public function onlyUserProduction()
    {
        return Auth::user()->role_id == 6 ? true : false;
    }

    public function onlyUserEquipment()
    {
        return Auth::user()->role_id == 7 ? true : false;
    }

    public function onlyUserRental()
    {
        return Auth::user()->role_id == 8 ? true : false;
    }

    public function onlyUserVehicle()
    {
        return Auth::user()->role_id == 9 ? true : false;
    }

    public function onlyUserWebsite()
    {
        return Auth::user()->role_id == 10 ? true : false;
    }

    public function onlyAdminProduction()
    {
        return Auth::user()->role_id == 2 ? true : false;
    }

    public function onlyAdminEquipment()
    {
        return Auth::user()->role_id == 3 ? true : false;
    }

    public function onlyAdminRental()
    {
        return Auth::user()->role_id == 4 ? true : false;
    }

    public function onlyAdminVehicle()
    {
        return Auth::user()->role_id == 5 ? true : false;
    }

    public function onlyAdminWebsite()
    {
        return Auth::user()->role_id == 11 ? true : false;
    }

    public function superAdmin()
    {
        return Auth::user()->role_id == 1 ? true : false;
    }

    function data($model)
    {
        return $model
            ->where('add', '=', 0)
            ->where('edit', '=', 0)
            ->where('del', '=', 0)
            ->get();
    }

    public function total($table)
    {
        return DB::table($table)
            ->where('add', '=', 0)
            ->where('edit', '=', 0)
            ->where('del', '=', 0)
            ->count();
    }

    public function dtotal($table)
    {
        return DB::table($table)
            ->where('add', '=', 0)
            ->where('edit', '=', 0)
            ->where('del', '=', 1)
            ->count();
    }

    public function notification()
    {
        $data = [];
        foreach (Rental::get(['due', 'code', 'due_type']) as $rental) {
            $now = new DateTime();
            $date = new DateTime($rental->due);
            $interval = date_diff($now, $date)->format('%R%a');
            if (
                $interval == -0 or $interval == +1 or $interval == +2 or
                $interval == +3 or $interval == +4 or $interval == +5 or
                $interval == +6 or $interval == +7
            ) {
                $data[] = [
                    'due' => $rental->due,
                    'code' => $rental->code,
                    'due_type' => $rental->due_type
                ];
            }
        }
        return json_encode($data);
    }
}
