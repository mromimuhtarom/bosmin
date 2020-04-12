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
          <form action="{{ route('siswa-cari') }}" method="get">
            <input type="text" class="form-control" style="margin-bottom:1%;" name="siswa" placeholder="NIS / Nama Siswa" value="{{ $siswa }}">
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
                Data Siswa
            </div>
            <div>
                <form action="{{ route('siswa-tambah')}}">
                    <button type="submit" class="myButton-add" data-toggle="modal" data-target="#myModal">Tambah Siswa</button>
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
            <td>NIS </td>
            <td>Nama Siswa</td>
            <td>Kelas</td>
            <td>No. Kontak orang Tua</td>
            <td>Alamat</td>
            <td>Delete</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($data_siswa as $sw)
          <tr>
            <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $sw->id_siswa }}" data-name="id_siswa" data-placement="right" data-url="{{ route('siswa-update') }}">{{ $sw->id_siswa }}</a></td>
            <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $sw->id_siswa }}" data-name="nama_siswa" data-placement="right" data-url="{{ route('siswa-update') }}">{{ $sw->nama_siswa }}</a></td>
            <td><a href="#" class="kelastxt" data-type="select" data-pk="{{ $sw->id_siswa }}" data-name="id_kelas" data-placement="right" data-url="{{ route('siswa-update') }}">{{ $sw->nama_kelas }}</a></td>
            <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $sw->id_siswa }}" data-name="no_kontak_ortu" data-placement="right" data-url="{{ route('siswa-update') }}">{{ $sw->no_kontak_ortu }}</a></td>
            <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $sw->id_siswa }}" data-name="alamat" data-placement="right" data-url="{{ route('siswa-update') }}">{{ $sw->alamat }}</a></td>
            <td>
              <form action="{{ route('siswa-delete') }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="pk" value="{{ $sw->id_siswa }}">
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