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

<div class="templatemo-content-container">
    <div class="templatemo-flex-row flex-content-row">
      <div class="templatemo-content-widget white-bg col-2">
          <form action="{{ route('walikelas-cari') }}" method="get">
            <input type="text" class="form-control" style="margin-bottom:1%;" name="username" placeholder="ID Pengguna / Nama Pengguna" value="{{ $username }}">
            <input type="text" class="form-control" style="margin-bottom:1%;" name="fullname" placeholder="Nama Lengkap" value="{{ $fullname }}">
            <input type="text" class="form-control" style="margin-bottom:1%;" name="kelas" placeholder="Kelas" value="{{ $kelas }}">
            <button type="submit" class="myButton-search">Search</button>
          </form>
      </div>
    </div>        
</div>

<div class="templatemo-content-container">
    <div class="templatemo-flex-row flex-content-row">
        <div class="templatemo-content-widget white-bg col-2">
            <div align="center" style="font-size:25px;font-weight:bold">
                Data Wali Kelas
            </div>
            <div>
                <form action="{{ route('walikelas-tambah')}}">
                    <button type="submit" class="myButton-add" data-toggle="modal" data-target="#myModal">Tambah Wali Kelas</button>
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
            <td>ID Pengguna </td>
            <td>Nama Pengguna</td>
            <td>NIP</td>
            <td>Nama Lengkap</td>
            <td>Kelas </td>
            <td>Password </td>
            <td>Delete</td>
          </tr>
        </thead>
        <tbody>
            @foreach ($data_walikelas as $wkl)
            <tr>
                <td><a href="#" class="txtbxt" data-type="text" data-placement="right" data-title="Enter username">{{ $wkl->op_id }}</a></td>
                <td>{{ $wkl->username }}</td>
                <td>{{ $wkl->id_wali_kelas }}</td>
                <td>{{ $wkl->fullname }}</td>
                <td>{{ $wkl->kelas }}</td>
                <td></td>
                <td></td>
            </tr>          
            @endforeach
        </tbody>
      </table>    
    </div>                          
</div>   

<script>
$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';     
    
    //make username editable
    $('#username').editable();
    
    //make status editable
    $('#status').editable({
      mode :'inline'
    });
});
</script>
@endsection