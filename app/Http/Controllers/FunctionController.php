<?php

namespace App\Http\Controllers;

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

    function storedIMG($code, $photoFile, $photo)
    {
        // Create User Collection
        Storage::disk('public')->makeDirectory(
            "production/" . $code
        );
        // Upload Files
        $dataIMG = array();
        foreach ($photo as $number => $file) {
            // putFileAs It is okay
            $photoName = $number . '.' . $photoFile[$number]->getClientOriginalExtension();
            Storage::disk('public')->putFileAs(
                "production/" . $code,
                $file,
                $photoName
            );
            // Add Data From Array
            array_push($dataIMG, $photoName);
        }
        return $dataIMG;
    }
}
