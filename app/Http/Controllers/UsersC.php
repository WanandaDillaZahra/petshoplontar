<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;


class UsersC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Users'
        ]);
        $user = User::search(request('search'))->paginate(10);
        $vcari = request('search');
        $subtitle = "Daftar User";
        return view('users_index', compact('user', 'vcari','subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Tambah Data Users'
        ]);
        $subtitle = 'tambah users'; // Define the $subtitle variable
        return view('users_create', compact('subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'name' => 'required',
            'role' => 'required',
        ]);
 
        $users =  new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $users->save();

        return redirect()->route('users.index')->with('success', 'Pengguna Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Edit Data Users'
        ]);
        $subtitle = 'edit data users'; // Define the $subtitle variable
        $user = User::find($id);
        return view('users_edit', compact('user', 'subtitle')); // Pass $subtitle to the view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Berhasil Perbarui Data Users'
        ]);
        $request->validate([
            'username'=>'required',
            'name'=>'required',
            'role'=>'required',
        ]);
        $users = User::find($id);
        $users->username = $request->input('username');
        $users->name = $request->input('name');
        $users->role = $request->input('role');

        $users->update();
        return redirect()->route('users.index')-> with('success','Data User Berhasil Di Perbaharui');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changepassword($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengganti Kata Sandi'
        ]);
        $subtitle = "Edit Kata Sandi Pengguna";
        $data = User::find($id);
        return view ('users_changepassword', compact('subtitle', 'data'));
    }

    public function change(Request $request,$id)
    {
        $request->validate([
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new',
        ]);
        $users = User::where("id", $id)->first();
        $users->update([
            'password' => Hash::make($request->password_new),
        ]);
        return redirect()->route('users.index')->with('success', 'User Berhasil Diperbaharui!');
    }

    public function destroy($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Data Users'
        ]);
        User::where("id", $id)->delete();
        return redirect()->route('users.index')->with('success', 'User Berhasil Dihapus');
    }

    public function pdf(){
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak PDF'
        ]);
        $User = User::all();
        //return view('users_pdf', compact('User'));
         $pdf = PDF::loadview('users_pdf', ['User' => $User]);
         return $pdf->stream('users.pdf'); 
    }
}