<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class PerpusListBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku         = '';
        $kelas        = '';
        $tgl_min_pen  = '';
        $tgl_maks_pen = '';
        $tgl_min_msk  = Carbon::now('GMT+7')->toDateString();
        $tgl_maks_msk = Carbon::now('GMT+7')->toDateString();


        $api_url = 'http://192.168.1.3:3000/api/perpus/bukuview';
 
        $json_data = file_get_contents($api_url);
        
        $data_buku = json_decode($json_data);


        return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));
    }

    public function listbukusearch(Request $request)
    {
        $buku         = $request->buku;
        $kelas        = $request->kelas;
        $tgl_min_pen  = $request->tgl_min_pen;
        $tgl_maks_pen = $request->tgl_maks_pen;
        $tgl_min_msk  = $request->tgl_min_msk;
        $tgl_maks_msk = $request->tgl_maks_msk;


        if($buku != NULL && $kelas != NULL && $tgl_min_pen != NULL && $tgl_maks_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk != NULL): 
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?buku='.$buku.'&kelas='.$kelas.'&tglminpen='.$tgl_min_pen.'&tglmaxpen='.$tgl_maks_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));            
        elseif($buku != NULL && $kelas != NULL && $tgl_min_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL): 
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?buku='.$buku.'&kelas='.$kelas.'&tglminpen='.$tgl_min_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));
        elseif($buku != NULL && $kelas != NULL && $tgl_maks_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?buku='.$buku.'&kelas='.$kelas.'&tglmaxpen='.$tgl_maks_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));
        elseif($buku != NULL && $tgl_min_pen != NULL && $tgl_maks_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?buku='.$buku.'&tglminpen='.$tgl_min_pen.'&tglmaxpen='.$tgl_maks_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));

        elseif($kelas != NULL && $tgl_min_pen != NULL && $tgl_maks_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL): 
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?kelas='.$kelas.'&tglminpen='.$tgl_min_pen.'&tglmaxpen='.$tgl_maks_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));

        elseif($tgl_min_pen != NULL && $tgl_maks_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?tglminpen='.$tgl_min_pen.'&tglmaxpen='.$tgl_maks_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));

        elseif($buku != NULL && $kelas != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?buku='.$buku.'&kelas='.$kelas.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));

        elseif($buku != NULL && $tgl_maks_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?buku='.$buku.'&tglmaxpen='.$tgl_maks_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));

        elseif($buku != NULL && $tgl_min_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?buku='.$buku.'&tglminpen='.$tgl_min_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));

        elseif( $kelas != NULL && $tgl_maks_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?kelas='.$kelas.'&tglmaxpen='.$tgl_maks_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));

        elseif($kelas != NULL && $tgl_min_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?kelas='.$kelas.'&tglminpen='.$tgl_min_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));

        elseif($tgl_maks_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?tglmaxpen='.$tgl_maks_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));
        elseif($tgl_min_pen != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?tglminpen='.$tgl_min_pen.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));
        elseif($kelas != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?kelas='.$kelas.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));
        elseif($buku != NULL && $tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?buku='.$buku.'&tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));
        elseif($tgl_min_msk  != NULL && $tgl_maks_msk!= NULL):
            $api_url = 'http://192.168.1.3:3000/api/perpus/bukusearch?tglminmsk='.$tgl_min_msk.'&tglmaxmsk='.$tgl_maks_msk;
 
            $json_data = file_get_contents($api_url);
            
            $data_buku = json_decode($json_data);
            return view('pages.perpustakaan.listbuku', compact('data_buku', 'buku', 'kelas', 'tgl_min_pen', 'tgl_maks_pen', 'tgl_min_msk', 'tgl_maks_msk'));
        endif;

    }

    public function add()
    {
        return view('pages.perpustakaan.addlistbuku');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $buku         = $request->nama_buku;
        $tgl_terbit   = $request->tgl_terbit;
        $qty          = $request->qty;
        $kelas        = $request->kelas;
        $active       = $request->aktif;

        DB::table('buku')->insert([
            'nama_buku'       => $buku,
            'tanggal_terbit'  => $tgl_terbit,
            'timestamp'       => Carbon::now('GMT+7'),
            'harga_persatuan' => 0,
            'qty'             => $qty,
            'kelas'           => $kelas,
            'status'          => $active
        ]);

        DB::table('log_operator')->insert([
            'action_id'   => 1,
            'op_id'       => Session::get('userId'),
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Tambah data buku ('.$buku.')'
        ]);

        return  redirect(route('list_buku-view'))->with('success', 'input data telah berhasil');
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

        $buku = DB::table('buku')->where('buku_id', '=', $pk)->first();

        DB::table('buku')->where('buku_id', '=', $pk)->update([
            $name => $value
        ]);

        switch($name){
            case "nama_buku":
                $name         = "Nama Buku";
                $currentvalue = $buku->nama_buku;
                break;
            case "qty":
                $name         = "Kuantitas";
                $currentvalue = $buku->qty;
                break;
            case "kelas":
                $name         = "Kelas";
                $currentvalue = $buku->kelas;
                break;
            case "status":
                    $name         = "Status";
                    $currentvalue = $buku->status;
                    break;
            default:
                "";
        }

        DB::table('log_operator')->insert([
            'action_id'   => 3,
            'op_id'       => Session::get('userId'),
            'datetime'    => Carbon::now('GMT+7'),
            'description' => 'Edit '.$name.' data buku ('.$buku->nama_buku.').'.$currentvalue.' => '.$value
        ]);
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
