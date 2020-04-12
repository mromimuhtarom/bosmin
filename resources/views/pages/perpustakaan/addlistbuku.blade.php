@extends('index')

@section('menuname')
@include('pages.perpustakaan.menu')
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


<div class="templatemo-content-widget white-bg">
    <h2 class="margin-bottom-10">List Buku</h2>
    <p>Silahkan Diisi</p>
    <form action="{{ route('list_buku-insert') }}" class="templatemo-login-form" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row form-group">
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">Nama Buku / Judul Buku</label>
            <input type="text" class="form-control" name="nama_buku" id="inputNis" placeholder="Nama Buku" required>
          </div>
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputEmail">Tanggal Terbit</label>
            <input type="date" class="form-control" name="tgl_terbit" id="inputEmail" placeholder="Tanggal Terbit">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputEmail">Kuantitas</label>
            <input type="text" class="form-control" name="qty" id="inputEmail" placeholder="Kuantitas">
          </div>
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">kelas</label>
            <select class="form-control" name="kelas">
              <option value="">Pilih Kelas</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
          </select>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">Status</label>
            <select class="form-control" name="aktif">
                <option value="">Pilih Status</option>
                <option value="1">Aktif</option>
                <option value="2">Tidak Aktif</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group text-right">
        <button type="submit" class="templatemo-blue-button">Tambah</button>
        <a href="{{ route('siswa-view') }}" class="templatemo-white-button">cancel</a>
    </form>
      </div>
</div>
@endsection