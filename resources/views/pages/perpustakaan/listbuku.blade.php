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
          <form action="{{ route('list_buku-cari') }}" method="get">
            <input type="text" class="form-control" style="margin-bottom:1%;" name="buku" placeholder="ID Buku / Judul Buku" value="{{ $buku }}">
            <input type="text" class="form-control" style="margin-bottom:1%;" name="kelas" placeholder="Kelas" value="{{ $kelas }}">
            <table border="0" width="100%" style="margin-bottom:1%;">
                <tr>
                    <td colspan="2"><b>Tanggal Penerbit Buku</b></td>
                </tr>
                <tr>
                    <td style="padding-right:1%">
                        <input type="date" class="form-control" name="tgl_min_pen" placeholder="Tanggal Minimal Penerbit" value="{{ $tgl_min_pen }}">
                    </td>
                    <td style="padding-left:1%">
                        <input type="date" class="form-control" name="tgl_maks_pen" placeholder="Tanggal Maksimal  Penerbit" value="{{ $tgl_maks_pen }}">
                    </td>
                </tr>
            </table>
            <table border="0" width="100%" style="margin-bottom:1%;">
                <tr>
                    <td colspan="2"><b>Tanggal Masuk Buku</b></td>
                </tr>
                <tr>
                    <td style="padding-right:1%">
                        <input type="date" class="form-control" name="tgl_min_msk" placeholder="Tanggal Minimal Buku Masuk" value="{{ $tgl_min_msk }}">
                    </td>
                    <td style="padding-left:1%">
                        <input type="date" class="form-control" name="tgl_maks_msk" placeholder="Tanggal Maksimal Buku Masuk" value="{{ $tgl_maks_msk }}">
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
                Data Siswa
            </div>
            <div>
                <form action="{{ route('list_buku-tambah')}}">
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
            <td>ID Buku </td>
            <td>Nama Buku</td>
            <td>Tanggal Terbit</td>
            <td>Tanggal Buku masuk</td>
            <td>Kuantitas</td>
            <td>Kelas</td>
            <td>Status</td>
          </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $bk)
            <tr>
                <td>{{ $bk->buku_id }}</td>
                <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $bk->buku_id }}" data-name="nama_buku" data-placement="right" data-url="{{ route('list_buku-update') }}">{{ $bk->nama_buku }}</a></td>
                <td>{{ $bk->tanggal_terbit }}</td>
                <td>{{ $bk->timestamp }}</td>
                <td><a href="#" class="txtbxt" data-type="text" data-pk="{{ $bk->buku_id  }}" data-name="qty" data-placement="right" data-url="{{ route('list_buku-update') }}">{{ $bk->qty }}</a></td>
                <td><a href="#" class="kelastxt" data-type="select" data-pk="{{ $bk->buku_id  }}" data-name="kelas" data-placement="right" data-url="{{ route('list_buku-update') }}">{{ $bk->kelas }}</a></td>
                <td><a href="#" class="activestat" data-type="select" data-pk="{{ $bk->buku_id  }}" data-name="status" data-placement="right" data-url="{{ route('list_buku-update') }}">{{ statactive($bk->status) }}</a></td>
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
                {value: 1, text: '1'},
                {value: 2, text: '2'},
                {value: 3, text: '3'},
                {value: 4, text: '4'},
                {value: 5, text: '5'},
                {value: 6, text: '6'},
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