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
    <h2 class="margin-bottom-10">Siswa</h2>
    <p>Silahkan Diisi</p>
    <form action="{{ route('siswa-insert') }}" class="templatemo-login-form" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row form-group">
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">Nomor Induk Siswa</label>
            <input type="number" class="form-control" name="nis" id="inputNis" placeholder="Nomor Induk Siswa" required>
          </div>
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputEmail">Nama Siswa</label>
            <input type="text" class="form-control" name="nama_siswa" id="inputEmail" placeholder="Nama Siswa">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">Kelas</label>
            <select class="form-control" name="kelas">
              <option value="">Pilih Kelas</option>
              @foreach ($data_kelas as $kelas)
              <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
              @endforeach
          </select>
          </div>
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputEmail">No Kontak Orang Tua</label>
            <input type="text" class="form-control" name="no_ortu" id="inputEmail" placeholder="No Kontak Orang Tua">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">Alamat</label>
            <input type="alamat" class="form-control" name="alamat" id="inputUsername" placeholder="Alamat">
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