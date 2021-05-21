<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $production = Production::count();
        $equipment = Equipment::count();
        return view('home', [
            'production' => $production,
            'equipment' => $equipment
        ]);
    }

    public function checkTransaction(Request $req)
    {
        Validator::make($req->all(), [
            'code' => 'required',
        ])->validate();

        $transaction = DB::table('borrow')
            ->having('code', '=', $req->code)
            ->get();

        if ($transaction->count() != "0") {
            $nomor = $req->code;
        } else {
            return Redirect::route('home')
                ->with(['status' => 'Kode Transaksi tidak ditemukan']);
        }

        $result = DB::table('transaction')
            ->select('borrow.*', 'workshop.name as workshop', 'student.name as student', 'class.name as class')
            ->join('borrow', 'transaction.b_id', '=', 'borrow.id')
            ->join('workshop', 'transaction.w_id', '=', 'workshop.id')
            ->join('student', 'transaction.s_id', '=', 'student.id')
            ->join('class', 'transaction.s_id', '=', 'class.id')
            ->where('borrow.code',  $nomor)
            ->get()->first();

        return view('pages.data.check', ['result' => $result]);
    }
}
