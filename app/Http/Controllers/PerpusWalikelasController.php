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
        $api_url = 'http://192.168.1.3:3000/api/perpus/walikelasview';
 
        $json_data = file_get_contents($api_url);
        
        $data_walikelas = json_decode($json_data);

        $api_url_kelas = 'http://192.168.1.3:3000/api/kelas';
 
        $json_data_kelas = file_get_contents($api_url_kelas);
        
        $data_kelas = json_decode($json_data_kelas);

        return view('pages.perpustakaan.walikelas', compact('data_kelas', 'data_walikelas', 'username', 'fullname', 'kelas'));
    }

    public function walikelassearch(Request $request) 
    {
        $username = $request->username;
        $fullname = $request->fullname;
        $kelas    = $request->kelas;

        if($username != NULL && $fullname != NULL && $kelas != NULL):
            $api_url_walikelas = 'http://192.168.1.3:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($username != NULL && $fullname != NULL):
            $api_url_walikelas = 'http://192.168.1.3:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($username != NULL && $kelas != NULL):
            $api_url_walikelas = 'http://192.168.1.3:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($fullname != NULL && $kelas != NULL):
            $api_url_walikelas = 'http://192.168.1.3:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($username != NULL): 
            $api_url_walikelas = 'http://192.168.1.3:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($fullname != NULL):
            $api_url_walikelas = 'http://192.168.1.3:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        elseif($kelas != NULL):
            $api_url_walikelas = 'http://192.168.1.3:3000/api/perpus/walikelassearch?username='.$username.'&fullname='.$fullname.'&kelas='.$kelas;
 
            $json_data_walikelas = file_get_contents($api_url_walikelas);
            
            $data_walikelas = json_decode($json_data_walikelas);

            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        else:
            $api_url = 'http://192.168.1.3:3000/api/perpus/walikelasview';
 
            $json_data = file_get_contents($api_url);
            
            $data_walikelas = json_decode($json_data);
            return view('pages.perpustakaan.walikelas', compact('data_walikelas', 'username', 'fullname', 'kelas'));
        endif;
    }

    public function add()
    {
        $api_url = 'http://192.168.1.3:3000/api/kelas';
 
        $json_data = file_get_contents($api_url);
        
        $data_kelas = json_decode($json_data);

        return view('pages.perpustakaan.addwalikelas', compact('data_kelas'));
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
            'id_kelas'    => 'required',
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
    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
        $value = $request->value;

        if($name === 'username' || $name === 'password'): 
            if($name === 'password'):
                $value = bcrypt($value);
                $name = "Kata Sandi";
            endif;
            $walikelas = DB::table('operator')->where('op_id', '=', $pk)->first();
            $firtscolumn = $walikelas->username;

 
            DB::table('operator')->where('op_id', '=', $pk)->update([
                $name => $value
            ]);
            switch($name){
                case "username":
                    $name = "Nama Pengguna";
                    $currentvalue = $walikelas->username;
                    break;
                default:
                    "";
            }
            if($name === 'password'):
                DB::table('log_operator')->insert([
                    'action_id'   => 3,
                    'op_id'       => Session::get('userId'),
                    'datetime'    => Carbon::now('GMT+7'),
                    'description' => 'Edit '.$name.' data walikelas ('.$firtscolumn.')'
                ]);
            else: 
                DB::table('log_operator')->insert([
                    'action_id'   => 3,
                    'op_id'       => Session::get('userId'),
                    'datetime'    => Carbon::now('GMT+7'),
                    'description' => 'Edit '.$name.' data walikelas ('.$firtscolumn.').'.$currentvalue.' => '.$value
                ]);
            endif;
        else: 
            $walikelas = DB::table('wali_kelas')->where('id_wali_kelas', '=', $pk)->first();
            $walikelas1 = DB::table('operator')->where('op_id', '=', $walikelas->op_id)->first();
            $firtscolumn = $walikelas1->username;

            DB::table('wali_kelas')->where('id_wali_kelas', '=', $pk)->update([
                $name => $value
            ]);

            switch($name){
                case "id_wali_kelas":
                    $name = "NIP";
                    $currentvalue = $walikelas->id_wali_kelas;
                    break;
                case "fullname":
                    $name = "Nama Lengkap";
                    $currentvalue = $walikelas->fullname;
                    break;
                case "id_kelas":
                    $name = "kelas";
                    $currentvalue = $walikelas->id_kelas;
                    break;
                default:
                    "";
            }

            DB::table('log_operator')->insert([
                'action_id'   => 3,
                'op_id'       => Session::get('userId'),
                'datetime'    => Carbon::now('GMT+7'),
                'description' => 'Edit '.$name.' data walikelas ('.$firtscolumn.').'.$currentvalue.' => '.$value
            ]);
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $pk           = $request->pk;
        $op_id        = Session::get('userId');
        $walikelas = DB::table('wali_kelas')->where('id_wali_kelas', '=', $pk)->join('operator', 'operator.op_id', '=', 'wali_kelas.op_id')->first();

        DB::table('wali_kelas')->where('id_wali_kelas', '=', $pk)->delete();
        DB::table('operator')->where('op_id', '=', $walikelas->op_id)->delete();

        DB::table('log_operator')->insert([
            'action_id'   => 2,
            'op_id'       => $op_id,
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Hapus data Walikelas ('.$walikelas->username.')'
        ]);

        return redirect(route('walikelas-view'))->with('success', 'Hapus data telah berhasil');
    }
}
