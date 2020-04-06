<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class WalikelasDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $op_id = Session::get('userId');
        $kelas = Session::get('kelas');


        $role = DB::table('role')->where('role_id', '=', Session::get('roleId'))->first();
        $peminjaman = DB::table('peminjaman')->where('op_id', '=', $op_id)->get();
        $pengembalian = DB::table('pengembalian')->where('op_id', '=', $op_id)->get();
        $buku_hilang = DB::table('buku_hilang')->where('op_id', '=', $op_id)->get();
        // --------- Kelas ---------//
        $peminjaman_kelas = DB::table('peminjaman')->join('siswa', 'siswa.id_siswa', '=', 'peminjaman.id_siswa')->where('op_id', '=', $op_id)->where('siswa.kelas', '=', $kelas)->get();
        $pengembalian_kelas = DB::table('pengembalian')->join('siswa', 'siswa.id_siswa', '=', 'pengembalian.id_siswa')->where('op_id', '=', $op_id)->where('siswa.kelas', '=', $kelas)->get();
        $buku_hilang_kelas = DB::table('buku_hilang')->join('siswa', 'siswa.id_siswa', '=', 'buku_hilang.id_siswa')->where('op_id', '=', $op_id)->where('siswa.kelas', '=', $kelas)->get();
        // --------- end Kelas ---------//
        return view('pages.walikelas.dashboard', compact('role', 'peminjaman', 'pengembalian', 'buku_hilang', 'peminjaman_kelas', 'pengembalian_kelas', 'buku_hilang_kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
