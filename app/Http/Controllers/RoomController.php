<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
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
        $room = Room::all();
        return view('pages.data.room.indexRoom', ['room' => $room]);
    }

    public function create()
    {
        return view('pages.data.room.createRoom');
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required',
        ])->validate();

        Room::create([
            'name' => $req->name,
        ]);

        return Redirect::route('room.index');
    }

    public function edit($id)
    {
        $room = Room::find($id);
        return view('pages.data.room.updateRoom', [
            'room' => $room
        ]);
    }

    public function update($id, Request $req)
    {
        Validator::make($req->all(), [
            'name' => 'required',
        ])->validate();

        $room = Room::find($id);
        $room->name = $req->name;
        $room->save();
        return Redirect::route('room.index');
    }

    public function destroy($id)
    {
        Room::find($id)->delete();
        return Redirect::route('room.index');
    }
}
