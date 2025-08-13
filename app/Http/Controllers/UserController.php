<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModels;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $data = userModels::orderBy('id', 'asc')->get();
        return view('users.user', compact('data'));
    }

    public function create()
    {
        return view('users.createUser');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'alamat'        => 'required',
            'no_hp'         => 'required',
            'email'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        userModels::create([
            'nama'          => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,

        ]);

        return redirect()->route('user');
    }

    public function edit($id) {
        $data = userModels::find($id);
        $data->tanggal_lahir = \Carbon\Carbon::parse($data->tanggal_lahir)->format('Y-m-d');
        if (!$data) {
            return redirect()->route('user')->with('error', 'User not found.');
        }
        return view('users.editUser', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => 'required',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'alamat'        => 'required',
            'no_hp'         => 'required',
            'email'         => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = userModels::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $data->update([
            'nama'          => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
        ]);

        return redirect()->route('user')->with('success', 'User updated successfully.');
    }

    public function delete($id){
        $data = userModels::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('user');
    }
}
