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


<div class="templatemo-content-widget white-bg">
    <h2 class="margin-bottom-10">Peminjaman Buku</h2>
    <p>Silahkan Diisi</p>
    <form action="{{ route('peminjaman-buku-insert') }}" class="templatemo-login-form" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row form-group">
        <div class="col-lg-6 col-md-6 form-group">
          <label for="inputFirstName">Nama Siswa</label>
          <select class="form-control" name="id_siswa" required>
            @foreach ($siswa_peminjaman as $siswa)
              <option value="{{ $siswa->id_siswa }}">{{ $siswa->nama_siswa }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-6 col-md-6 form-group">
          <label for="inputLastName">Judul Buku</label>
          <select class="form-control" name="buku_id" required>
            @foreach ($buku_peminjaman as $buku)
              <option value="{{ $buku->buku_id }}">{{ $buku->nama_buku }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group text-right">
        <button type="submit" class="templatemo-blue-button">Tambah</button>
        <a href="{{ route('peminjaman-buku') }}" class="templatemo-white-button">cancel</a>
    </form>
      </div>
</div>
@endsection