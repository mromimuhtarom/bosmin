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
    <h2 class="margin-bottom-10">Wali Kelas</h2>
    <p>Silahkan Diisi</p>
    <form action="{{ route('walikelas-insert') }}" class="templatemo-login-form" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row form-group">
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">Nama Pengguna</label>
            <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Nama Pengguna">
          </div>
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputEmail">NIP</label>
            <input type="number" class="form-control" name="nip" id="inputEmail" placeholder="Nomor Induk Pegawai">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">Nama Lengkap</label>
            <input type="text" class="form-control" name="fullname" id="inputUsername" placeholder="Nama Lengkap">
          </div>
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputEmail">kelas</label>
            <input type="text" class="form-control" name="kelas" id="inputEmail" placeholder="Kelas">
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6 col-md-6 form-group">
            <label for="inputUsername">Password</label>
            <input type="password" class="form-control" name="password" id="inputUsername" placeholder="Password">
          </div>
        </div>
      </div>
      <div class="form-group text-right">
        <button type="submit" class="templatemo-blue-button">Tambah</button>
        <a href="{{ route('walikelas-view') }}" class="templatemo-white-button">cancel</a>
    </form>
      </div>
</div>
@endsection