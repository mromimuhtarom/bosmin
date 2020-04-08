<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;
use Validator;

class PerpusWalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username = '';
        $fullname = '';
        $kelas = '';
        $api_url = 'http://192.168.1.2:3000/api/perpus/walikelasview';
 
        $json_data = file_get_contents($api_url);
        
        $data_walikelas = json_decode($json_data);
        return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
    }

    public function walikelassearch(Request $request) 
    {
        $username = $request->username;
        $fullname = $request->fullname;
        $kelas    = $request->kelas;

        if($username != NULL && $fullname != NULL && $kelas != NULL):
            $api_url_walikelas = 'http://192.168.1.2:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($username != NULL && $fullname != NULL):
            $api_url_walikelas = 'http://192.168.1.2:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($username != NULL && $kelas != NULL):
            $api_url_walikelas = 'http://192.168.1.2:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($fullname != NULL && $kelas != NULL):
            $api_url_walikelas = 'http://192.168.1.2:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($username != NULL): 
            $api_url_walikelas = 'http://192.168.1.2:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($fullname != NULL):
            $api_url_walikelas = 'http://192.168.1.2:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($kelas != NULL):
            $api_url_walikelas = 'http://192.168.1.2:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        else:
            $api_url = 'http://192.168.1.2:3000/api/perpus/walikelasview';
 
            $json_data = file_get_contents($api_url);
            
            $data_walikelas = json_decode($json_data);
            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        endif;
    }

    public function add()
    {
        return view('pages.perpustakaan.addwalikelas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $username = $request->username;
        $password = bcrypt($request->password);
        $fullname = $request->fullname;
        $kelas    = $request->kelas;
        $nip      = $request->nip;

        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
            'fullname' => 'required',
            'kelas'    => 'required',
            'nip'      => 'required'
        ]);
        
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        

        DB::table('operator')->insert([
            'username'       => $username,
            'password'       => $password,
            'role_id'        => 1
        ]);

        $login = DB::table('operator')->where('username', '=', $username)->first();

        DB::table('wali_kelas')->insert([
            'id_wali_kelas' => $nip,
            'op_id'         => $login->op_id,
            'fullname'      => $fullname,
            'kelas'         => $kelas
        ]);

        DB::table('log_operator')->insert([
            'action_id'   => 1,
            'op_id'       => Session::get('userId'),
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Tambah data walikelas ('.$fullname.')'
        ]);

        return  redirect(route('walikelas-view'))->with('success', 'input data telah berhasil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
