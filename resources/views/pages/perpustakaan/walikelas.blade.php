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
                <td>{{ $wkl->op_id }}</td>
                <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $wkl->op_id }}" data-name="username" data-placement="right" data-title="Enter username" data-url="{{ route('walikelas-update') }}">{{ $wkl->username }}</a></td>
                <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $wkl->id_wali_kelas }}" data-name="id_wali_kelas" data-placement="right" data-title="Enter username" data-url="{{ route('walikelas-update') }}">{{ $wkl->id_wali_kelas }}</a></td>
                <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $wkl->id_wali_kelas }}" data-name="fullname" data-placement="right" data-title="Enter username" data-url="{{ route('walikelas-update') }}">{{ $wkl->fullname }}</a></td>
                <td><a href="#" class="kelastxt" data-type="select" data-pk="{{ $wkl->id_wali_kelas }}" data-name="id_kelas" data-placement="right" data-title="Enter username" data-url="{{ route('walikelas-update') }}">{{ $wkl->nama_kelas }}</a></td>
                <td><a href="#" class="txtbxt" data-type="password" data-pk="{{ $wkl->op_id }}" data-name="password" data-placement="right" data-title="Enter username" data-url="{{ route('walikelas-update') }}">***</a></td>
                <td>
                  <form action="{{ route('walikelas-delete') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="pk" value="{{ $wkl->id_wali_kelas }}">
                    <button type="submit" class="templatemo-link">Delete </button>
                  </form>
                </td>
            </tr>          
            @endforeach
        </tbody>
      </table>    
    </div>                          
</div>   


<script type="text/javascript">
  $(document).ready(function() { 
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('.kelastxt').editable({
        mode:'inline',
        source: [
              {value: '', text: 'Pilih Kelas'},
              @foreach($data_kelas as $kelas) 
              {value: {{ $kelas->id_kelas }}, text: '{{ $kelas->nama_kelas }}'},
              @endforeach
        ],
        validate: function(value) {
          if($.trim(value) == '') {
            return 'This field is required';
          }
        }
      });


  });
  </script>

@endsection