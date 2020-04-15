<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
use Validator;

class WalikelasPeminjamanController extends Controller
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


        $api_url = 'http://192.168.1.5:3000/api/walikelas/pemijamanview?op_id='.$op_id;
 
        $json_data = file_get_contents($api_url);
        
        $peminjaman = json_decode($json_data);
    
        return view('pages.walikelas.peminjamanbuku', compact('peminjaman', 'tgl_min', 'tgl_maks', 'nama_siswa', 'nama_buku'));
    }

    public function searchpeminjaman(Request $request)
    {
        $nama_siswa = $request->nama_siswa;
        $nama_buku  = $request->nama_buku;
        $tgl_min    = $request->tgl_min;
        $tgl_maks   = $request->tgl_maks;
        $op_id       = Session::get('userId');

        $api_url = 'http://192.168.1.5:3000/api/walikelas/peminjamansearch?nama_siswa='.$nama_siswa.'&nama_buku='.$nama_buku.'&tgl_min='.$tgl_min.'&tgl_maks='.$tgl_maks.'&op_id='.$op_id;
 
        $json_data = file_get_contents($api_url);
        
        $peminjaman = json_decode($json_data);

        return view('pages.walikelas.peminjamanbuku', compact('peminjaman', 'tgl_min', 'tgl_maks', 'nama_siswa', 'nama_buku'));
    }

    public function add()
    {
        $kelas = Session::get('kelas_number');
        // ----- data siswa ------//
        $api_url_siswa_peminjaman = 'http://192.168.1.5:3000/api/walikelas/data_siswapeminjaman?kelas='.$kelas;
        $json_data_siswa_peminjaman = file_get_contents($api_url_siswa_peminjaman);
        $siswa_peminjaman = json_decode($json_data_siswa_peminjaman);
        // ----- End data siswa ------//

        // ----- data buku ------//
        $api_url_buku_peminjaman = 'http://192.168.1.5:3000/api/walikelas/data_bukupeminjaman?kelas='.$kelas;
        $json_data_buku_peminjaman = file_get_contents($api_url_buku_peminjaman);
        $buku_peminjaman = json_decode($json_data_buku_peminjaman);
        // ----- End data buku ------//

        return view('pages.walikelas.addpeminjaman', compact('siswa_peminjaman', 'buku_peminjaman'));
    }
    public function create(Request $request)
    {
        $siswa = $request->id_siswa;
        $buku = $request->buku_id;
        $validator = Validator::make($request->all(),[
            'id_siswa' => 'required|integer',
            'buku_id'     => 'required|integer'
        ]);
        
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        DB::table('peminjaman')->insert([
            'id_siswa'       => $siswa,
            'buku_id'        => $buku,
            'tgl_peminjaman' => Carbon::now('GMT+7'),
            'op_id'          => Session::get('userId')
        ]);

        $siswa = DB::table('siswa')->where('id_siswa', '=', $siswa)->first();
        $buku = DB::table('buku')->where('buku_id', '=', $$peminjaman->buku_id)->first();
        DB::table('log_operator')->insert([
            'action_id'   => 1,
            'op_id'       => Session::get('userId'),
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Tambah data Peminjaman ('.$siswa->nama_siswa.') dengan buku ('.$buku->nama_buku.')'
        ]);

        return  redirect(route('peminjaman-buku'))->with('success', 'input data telah berhasil');
    }

    public function destroy(Request $request)
    {
        $pk         = $request->pk;
        $op_id      = Session::get('userId');
        $peminjaman = DB::table('peminjaman')->where('peminjaman_id', '=', $pk)->first();
        $siswa      = DB::table('siswa')->where('id_siswa', '=', $peminjaman->id_siswa)->first();
        $buku       = DB::table('buku')->where('buku_id', '=', $peminjaman->buku_id)->first();

        DB::table('peminjaman')->where('peminjaman_id', '=', $pk)->delete();

        DB::table('log_operator')->insert([
            'action_id'   => 2,
            'op_id'       => $op_id,
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Hapus data Peminjaman ('.$siswa->nama_siswa.') dengan buku ('.$buku->nama_buku.')'
        ]);

        return redirect(route('peminjaman-buku'))->with('success', 'Hapus data telah berhasil');
    }
}
