<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryProductionController extends Controller
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
        return view('pages.data.production.category.indexCategory', [
            'category' => CategoryProduction::all()
        ]);
    }

    public function create()
    {
        return view('pages.data.production.category.createCategory');
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required',
        ])->validate();

        CategoryProduction::create([
            'name' => $req->name,
        ]);

        return Redirect::route('category-production.index');
    }

    public function edit($id)
    {
        return view('pages.data.production.category.updateCategory', [
            'category' => CategoryProduction::find($id)
        ]);
    }

    public function update($id, Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required',
        ])->validate();

        CategoryProduction::where('id', $id)
            ->update([
                'name' => $req->name,
            ]);

        return Redirect::route('category-production.index');
    }
}
