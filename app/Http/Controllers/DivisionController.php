<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
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
        $division = Division::all();
        return view('pages.data.division.indexDivision', [
            'division' => $division
        ]);
    }

    public function create()
    {
        return view('pages.data.division.createDivision');
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required',
        ])->validate();

        Division::create([
            'name' => $req->name,
        ]);

        return Redirect::route('division.index');
    }

    public function edit($id)
    {
        $division = Division::find($id);
        return view('pages.data.division.updateDivision', [
            'division' => $division
        ]);
    }

    public function update($id, Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required',
        ])->validate();

        Division::where('id', $id)
            ->update([
                'name' => $req->name
            ]);

        return Redirect::route('division.index');
    }
}
