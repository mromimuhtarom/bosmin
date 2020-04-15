<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;

class PerpusSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = '';
        $kelas = '';
        $api_url = 'http://192.168.1.5:3000/api/perpus/siswaview';
 
        $json_data = file_get_contents($api_url);
        
        $data_siswa = json_decode($json_data);

        $api_url_kelas = 'http://192.168.1.5:3000/api/kelas';
 
        $json_data_kelas = file_get_contents($api_url_kelas);
        
        $data_kelas = json_decode($json_data_kelas);
        return view('pages.perpustakaan.siswa', compact('data_kelas', 'data_siswa', 'siswa', 'kelas'));
    }

    public function siswasearch(Request $request)
    {
        $siswa = $request->siswa;
        $kelas = $request->kelas;

        if($siswa != NULL && $kelas != NULL): 
            $api_url = 'http://192.168.1.5:3000/api/perpus/siswasearch?siswa='.$siswa.'&kelas='.$kelas;
 
            $json_data = file_get_contents($api_url);
            
            $data_siswa = json_decode($json_data);

            return view('pages.perpustakaan.siswa', compact('data_siswa', 'siswa', 'kelas'));
        elseif($siswa != NULL):
            $api_url = 'http://192.168.1.5:3000/api/perpus/siswasearch?siswa='.$siswa;
 
            $json_data = file_get_contents($api_url);
            
            $data_siswa = json_decode($json_data); 

            return view('pages.perpustakaan.siswa', compact('data_siswa', 'siswa', 'kelas'));
        elseif($kelas != NULL): 
            $api_url = 'http://192.168.1.5:3000/api/perpus/siswasearch?kelas='.$kelas;
 
            $json_data = file_get_contents($api_url);
            
            $data_siswa = json_decode($json_data);

            return view('pages.perpustakaan.siswa', compact('data_siswa', 'siswa', 'kelas'));
        else: 
            $api_url = 'http://192.168.1.5:3000/api/perpus/siswaview';
 
            $json_data = file_get_contents($api_url);
            
            $data_siswa = json_decode($json_data);

            return view('pages.perpustakaan.siswa', compact('data_siswa', 'siswa', 'kelas'));
        endif;
        
    }

    public function add()
    {
        $api_url_kelas = 'http://192.168.1.5:3000/api/kelas';
 
        $json_data_kelas = file_get_contents($api_url_kelas);
        
        $data_kelas = json_decode($json_data_kelas);
        return view('pages.perpustakaan.addsiswa',compact('data_kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $nis        = $request->nis;
        $nama_siswa = $request->nama_siswa;
        $kelas      = $request->kelas;
        $kontak     = $request->no_ortu;
        $alamat     = $request->alamat;

        DB::table('siswa')->insert([
            'id_siswa'       => $nis,
            'nama_siswa'     => $nama_siswa,
            'id_kelas'          => $kelas,
            'no_kontak_ortu' => $kontak,
            'alamat'         => $alamat
        ]);

        DB::table('log_operator')->insert([
            'action_id'   => 1,
            'op_id'       => Session::get('userId'),
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Tambah data Siswa ('.$nama_siswa.')'
        ]);

        return  redirect(route('siswa-view'))->with('success', 'input data telah berhasil');
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

        $siswa = DB::table('siswa')->where('id_siswa', '=', $pk)->first();

        DB::table('siswa')->where('id_siswa', '=', $pk)->update([
            $name => $value
        ]);

        switch($name){
            case "id_siswa":
                $name         = "NIS";
                $currentvalue = $siswa->id_siswa;
                break;
            case "nama_siswa":
                $name         = "Nama Siswa";
                $currentvalue = $siswa->nama_siswa;
                break;
            case "id_kelas":
                $name         = "kelas";
                $currentvalue = $siswa->id_kelas;
                break;
            case "no_kontak_ortu":
                    $name         = "No Kontak Orang Tua";
                    $currentvalue = $siswa->no_kontak_ortu;
                    break;
            case "alamat":
                    $name         = "alamat";
                    $currentvalue = $siswa->alamat;
                    break;
            default:
                "";
        }

        DB::table('log_operator')->insert([
            'action_id'   => 3,
            'op_id'       => Session::get('userId'),
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Edit '.$name.' data siswa ('.$siswa->nama_siswa.').'.$currentvalue.' => '.$value
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $pk         = $request->pk;
        $op_id      = Session::get('userId');
        $siswa      = DB::table('siswa')->where('id_siswa', '=', $pk)->first();

        DB::table('siswa')->where('id_siswa', '=', $pk)->delete();

        DB::table('log_operator')->insert([
            'action_id'   => 2,
            'op_id'       => $op_id,
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Hapus data Siswa ('.$siswa->nama_siswa.')'
        ]);

        return redirect(route('siswa-view'))->with('success', 'Hapus data telah berhasil');
    }
}
