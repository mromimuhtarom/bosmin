@extends('index')

@section('menuname')
@include('pages.walikelas.menu')
@endsection

@section('content')
@if (count($errors) > 0)
<div class="error-val">
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>  
      @endforeach
    </ul>
  </div>
</div>
@endif

@if (\Session::has('alert'))
    <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
    </div>        
@endif


@if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
    </div>
@endif

<div class="templatemo-content-container">
    <div class="templatemo-flex-row flex-content-row">
      <div class="templatemo-content-widget white-bg col-2">
          <form action="{{ route('peminjaman-buku-cari') }}" method="get">
            <input type="text" class="form-control" style="margin-bottom:1%;" name="nama_buku" placeholder="Nama Buku / ID Buku" value="{{ $nama_buku }}">
            <input type="text" class="form-control" style="margin-bottom:1%;" name="nama_siswa" placeholder="Nama Siswa / ID Siswa" value="{{ $nama_siswa }}">
            <table border="0" width="100%" style="margin-bottom:1%;">
                <tr>
                    <td style="padding-right:1%">
                        <input type="date" class="form-control" name="tgl_min" placeholder="Tanggal Minimal" value="{{ $tgl_min }}">
                    </td>
                    <td style="padding-left:1%">
                        <input type="date" class="form-control" name="tgl_maks" placeholder="Tanggal Maksimal" value="{{ $tgl_maks }}">
                    </td>
                </tr>
            </table>
            <button type="submit" class="myButton-search">Search</button>
          </form>
      </div>
    </div>        
</div>

<div class="templatemo-content-container">
    <div class="templatemo-flex-row flex-content-row">
        <div class="templatemo-content-widget white-bg col-2">
            <div align="center" style="font-size:25px;font-weight:bold">
                Data Peminjaman Buku
            </div>
            <div>
                <form action="{{ route('peminjaman-buku-tambah')}}">
                    <button type="submit" class="myButton-add" data-toggle="modal" data-target="#myModal">Tambah Peminjaman Buku</button>
                </form>
            </div>
        </div>
    </div>        
</div>

<div class="templatemo-content-widget no-padding">
    <div class="panel panel-default table-responsive">
      <table class="table table-striped table-bordered templatemo-user-table">
        <thead>
          <tr>
            <td>ID Peminjaman </td>
            <td>ID Siswa</td>
            <td>Nama Siswa</td>
            <td>Kelas Buku</td>
            <td>Nama Buku </td>
            <td>Tanggal Peminjaman </td>
            <td>Kelas </td>
            <td>Delete</td>
          </tr>
        </thead>
        <tbody>
          @foreach($peminjaman as $pmjn)
          <tr>
            <td>{{ $pmjn->peminjaman_id }}</td>
            <td>{{ $pmjn->id_siswa}}</td>
            <td>{{ $pmjn->nama_siswa}}</td>
            <td>{{ $pmjn->buku_id }}</td>
            <td>{{ $pmjn->nama_buku }}</td>
            <td>{{ $pmjn->tgl_peminjaman }}</td>
            <td>{{ $pmjn->kelas }}</td>
            <td>
              <form action="{{ route('peminjaman-buku-delete') }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="pk" value="{{ $pmjn->peminjaman_id }}">
                <button type="submit" class="templatemo-link">Delete </button>
              </form>
            </td>
          </tr> 
          @endforeach           
        </tbody>
      </table>    
    </div>                          
</div>      
@endsection