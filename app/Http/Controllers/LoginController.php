<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;
use Carbon\Carbon;
use App\User;
use Cache;


class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){

            Session::put('userId', Auth::user()->op_id);
            Session::put('username',Auth::user()->username);
            Session::put('roleId',Auth::user()->role_id);
            Session::put('login1',TRUE);
            $username = $request->username;
            $password = $request->password;
            $login = User::select('op_id', 'username')->where('username', '=', $username)->first();
            $session_id = session()->getId();
            Cache::put('op_key', $login->op_id);
            Cache::put('session_id', $session_id);
  
            
            if(Auth::user()->role_id === 1): 
                $walikelas = DB::table('wali_kelas')
                             ->join('kelas', 'kelas.id_kelas', '=', 'wali_kelas.id_kelas')
                             ->where('op_id', '=', $login->op_id)
                             ->first();
                Session::put('kelas', $walikelas->id_kelas);
                Session::put('nama_kelas', $walikelas->nama_kelas);
                Session::put('kelas_number', $walikelas->kelas);
                return redirect(route('dashboard-walikelas'));
            elseif(Auth::user()->role_id === 2): 
                return redirect(route('dashboard-perpus'));
            elseif(Auth::user()->role_id === 3): 
                return redirect(route('Dashboard'));
            elseif(Auth::user()->role_id === 4):
                return redirect(route('Dashboard'));
            endif;
  
         } else {
            return redirect('/')->with('alert','Username or Password are wrong!!');
        }
    }


    public function logout()
    {
        $op_idcache   = Cache::get('op_key');
        $session_id   = Cache::get('session_id');
        Session::flush();
        Cache::flush();
        return redirect('/')->with('alert', 'Terima kasih, akun anda telah keluar');
    }
}
