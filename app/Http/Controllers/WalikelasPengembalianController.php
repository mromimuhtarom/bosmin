<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;

class WalikelasPengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nama_siswa = '';
        $nama_buku  = '';
        $tgl_min    = Carbon::now('GMT+7')->toDateString();
        $tgl_maks   = Carbon::now('GMT+7')->toDateString();
        $op_id       = Session::get('userId');


        $api_url = 'http://192.168.1.5:3000/api/walikelas/pengembalianview?op_id='.$op_id;
 
        $json_data = file_get_contents($api_url);
        
        $pengembalian = json_decode($json_data);
    
        return view('pages.walikelas.pengembalianbuku', compact('pengembalian', 'tgl_min', 'tgl_maks', 'nama_siswa', 'nama_buku'));
    }

    public function searchpengembalian(Request $request)
    {
        $nama_siswa = $request->nama_siswa;
        $nama_buku  = $request->nama_buku;
        $tgl_min    = $request->tgl_min;
        $tgl_maks   = $request->tgl_maks;
    

        $api_url = 'http://192.168.1.5:3000/api/walikelas/pengembaliansearch?nama_siswa='.$nama_siswa.'&nama_buku='.$nama_buku.'&tgl_min='.$tgl_min.'&tgl_maks='.$tgl_maks.'&op_id='.$op_id;
 
        $json_data = file_get_contents($api_url);
        
        $pengembalian = json_decode($json_data);

        return view('pages.walikelas.peminjamanbuku', compact('pengembalian', 'tgl_min', 'tgl_maks', 'nama_siswa', 'nama_buku'));
    }

    public function add()
    {
        $siswa = '';
        $buku = '';

        $op_id = Session::get('userId');

        // ----- data siswa ------//
        $api_url_data_siswa = 'http://192.168.1.5:3000/api/walikelas/data_siswapengembalian?op_id='.$op_id;
 
        $json_data_data_siswa = file_get_contents($api_url_data_siswa);
        
        $data_siswa_pengembalian = json_decode($json_data_data_siswa);
        // -----end data siswa ------//

        // ----- data buku ------//
        $api_url_buku = 'http://192.168.1.5:3000/api/Walikelas/data_bukupengembalian';
        $json_data_buku = file_get_contents($api_url_buku);
        $buku_all = json_decode($json_data_buku);
        // ----- End data buku ------//
        $data_peminjaman = null;
        return view('pages.walikelas.addpengembalian', compact('data_peminjaman', 'data_siswa_pengembalian', 'siswa', 'buku', 'buku_all'));
    }

    public function caripeminjaman(Request $request)
    {
        $siswa = $request->id_siswa;
        $buku = $request->buku_id;
        $op_id = Session::get('userId');
        $api_url_data_siswa = 'http://192.168.1.5:3000/api/walikelas/data_siswapengembalian?op_id='.$op_id;
 
        $json_data_data_siswa = file_get_contents($api_url_data_siswa);
        
        $data_siswa_pengembalian = json_decode($json_data_data_siswa);

        // ----- data buku ------//
        $api_url_buku = 'http://192.168.1.5:3000/api/Walikelas/data_bukupengembalian';
        $json_data_buku = file_get_contents($api_url_buku);
        $buku_all = json_decode($json_data_buku);
        // ----- End data buku ------//

        if($siswa != NULL && $buku != NULL): 
            $api_url_peminjaman = 'http://192.168.1.5:3000/api/walikelas/data_peminjamanpengembalian?id_siswa='.$siswa.'&buku_id='.$buku;
 
            $json_data_peminjaman = file_get_contents($api_url_peminjaman);
            
            $data_peminjaman = json_decode($json_data_peminjaman);

            return view('pages.walikelas.addpengembalian', compact('data_peminjaman', 'siswa', 'buku', 'data_siswa_pengembalian', 'buku_all'));
        elseif($siswa != NULL):
            $api_url_peminjaman = 'http://192.168.1.5:3000/api/walikelas/data_peminjamanpengembalian?id_siswa='.$siswa;
 
            $json_data_peminjaman = file_get_contents($api_url_peminjaman);
            
            $data_peminjaman = json_decode($json_data_peminjaman);

            return view('pages.walikelas.addpengembalian', compact('data_peminjaman', 'siswa', 'buku', 'data_siswa_pengembalian', 'buku_all'));
        elseif($buku != NULL): 
            $api_url_peminjaman = 'http://192.168.1.5:3000/api/walikelas/data_peminjamanpengembalian?buku_id='.$buku;
 
            $json_data_peminjaman = file_get_contents($api_url_peminjaman);
            
            $data_peminjaman = json_decode($json_data_peminjaman);

            return view('pages.walikelas.addpengembalian', compact('data_peminjaman', 'siswa', 'buku', 'data_siswa_pengembalian', 'buku_all'));
        else:
            $data_peminjaman = null;
            return view('pages.walikelas.addpengembalian', compact('data_peminjaman', 'siswa', 'buku', 'data_siswa_pengembalian', 'buku_all'))->with('alert', 'harus wajib pilih salah satu untuk cari');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $siswa            = $request->id_siswa;
        $buku             = $request->buku_id;
        $peminjaman_id    = $request->peminjaman_id;
        $tgl_pengembalian = Carbon::now('GMT+7');
        $op_id            = Session::get('userId');

        DB::table('pengembalian')->insert([
            'id_siswa'         => $siswa,
            'buku_id'          => $buku,
            'tgl_pengembalian' => $tgl_pengembalian,
            'op_id'            => $op_id
        ]);

        DB::table('peminjaman')->where('peminjaman_id', '=', $peminjaman_id)->delete();
        $siswa = DB::table('siswa')->where('id_siswa', '=', $siswa)->first();
        $buku = DB::table('buku')->where('buku_id', '=', $buku)->first();
        DB::table('log_operator')->insert([
            'action_id'   => 1,
            'op_id'       => $op_id,
            'datetime'    => $tgl_pengembalian,
            'description' => 'Tambah data Pengembalian ('.$siswa->nama_siswa.') dengan buku ('.$buku->nama_buku.')'
        ]);

        return redirect(route('pengembalian-buku'))->with('success', 'input data telah berhasil');
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
    public function destroy(Request $request)
    {
        $pk           = $request->pk;
        $op_id        = Session::get('userId');
        $pengembalian = DB::table('pengembalian')->where('pengembalian_id', '=', $pk)->first();
        $siswa        = DB::table('siswa')->where('id_siswa', '=', $pengembalian->id_siswa)->first();
        $buku         = DB::table('buku')->where('buku_id', '=', $pengembalian->buku_id)->first();

        DB::table('pengembalian')->where('pengembalian_id', '=', $pk)->delete();

        DB::table('log_operator')->insert([
            'action_id'   => 2,
            'op_id'       => $op_id,
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Hapus data Pengembalian ('.$siswa->nama_siswa.') dengan buku ('.$buku->nama_buku.')'
        ]);

        return redirect(route('pengembalian-buku'))->with('success', 'Hapus data telah berhasil');
    }
}
