@extends('index')

@section('menuname')
@include('pages.walikelas.menu')
@endsection

@section('content')
<div class="templatemo-content-widget white-bg">
    <h2 class="margin-bottom-10">Preferences</h2>
    <p>Here goes another form and form controls.</p>
    <form action="{{ route('buku-hilang-cari-add') }}" class="templatemo-login-form">
      <div class="row form-group">
        <div class="col-lg-6 col-md-6 form-group">
          <label for="inputFirstName">Nama Siswa</label>
          <select class="form-control" name="id_siswa">
            @foreach ($data_siswa_pengembalian as $siswa)
              <option @if($siswa === $siswa->id_siswa) selected @endif value="{{ $siswa->id_siswa }}">{{ $siswa->nama_siswa }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-6 col-md-6 form-group">
          <label for="inputLastName">Judul Buku</label>
          <select class="form-control" name="buku_id">
            @foreach ($buku_all as $buku)
              <option @if($buku === $buku->buku_id) selected @endif value="{{ $buku->buku_id }}">{{ $buku->nama_buku}}</option>  
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group text-right">
        <button type="submit" class="templatemo-blue-button">Cari</button>
        <a href="{{ route('buku-hilang') }}" class="templatemo-white-button">Cancel</a>
      </div>
    </form>
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
          <td>Input</td>
        </tr>
      </thead>
      @if ($data_peminjaman != NULL)
      <tbody>
        @foreach($data_peminjaman as $pmjn)
        <tr>
          <td>{{ $pmjn->peminjaman_id }}</td>
          <td>{{ $pmjn->id_siswa}}</td>
          <td>{{ $pmjn->nama_siswa}}</td>
          <td>{{ $pmjn->buku_id }}</td>
          <td>{{ $pmjn->nama_buku }}</td>
          <td>{{ $pmjn->tgl_peminjaman }}</td>
          <td>{{ $pmjn->kelas }}</td>
          <td>
            <form action="{{ route('buku-hilang-add') }}" method="post">
              @csrf
              <input type="hidden" name="peminjaman_id" value="{{ $pmjn->peminjaman_id }}">
              <input type="hidden" name="buku_id" value="{{ $pmjn->buku_id }}">
              <input type="hidden" name="id_siswa" value="{{ $pmjn->id_siswa}}">
              <button type="submit" class="templatemo-link">Input </button>
            </form>
          </td>
        </tr> 
        @endforeach           
      </tbody>
      @endif
    </table>    
  </div>                          
</div> 
@endsection