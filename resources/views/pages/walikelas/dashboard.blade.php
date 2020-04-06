@extends('index')

@section('menuname')
@include('pages.walikelas.menu')
@endsection

@section('content')
<div class="templatemo-content-container">
    <div class="templatemo-flex-row flex-content-row">
      <div class="templatemo-content-widget white-bg col-2">
        <img class="center" src="/img/salam_arabic.png" style="width:80%;height:auto;  margin-left: auto;margin-right: auto;" alt="">
        <h2>Assalamualaikum Warahmatullah Wabarakatuh</h2><hr>
        <marquee><h2>Selamat Datang {{ Session::get('username' )}} sebagai {{ $role->role_name }}</h2></marquee><marquee behavior="" direction=""><h2>Ahlan Wa Sahlan {{ Session::get('username' )}}</h2></marquee>
      </div>
    </div> 
  
    <div class="templatemo-flex-row flex-content-row">
      <div class="col-1">  
        <div class="templatemo-content-widget white-bg">
          <div class="media">
            <div class="media-left">
              <i class="fa fa-book" style="color:black;font-size:10rem;"></i>
            </div>
            <div class="media-body">
              <h2 class="media-heading text-uppercase">Peminjaman Buku <b>{{ number_format(count($peminjaman)) }}</b></h2>
            </div>
          </div>                
        </div>           
        <div class="templatemo-content-widget green-bg">
          <div class="media">
            <div class="media-left">
              <i class="fa fa-check-circle" style="color:green;font-size:10rem;"></i>
            </div>
            <div class="media-body">
              <h2 class="media-heading text-uppercase">Pengembalian Buku <b>{{ number_format(count($pengembalian)) }}</b></h2>
            </div>
          </div>                
        </div>             
        <div class="templatemo-content-widget orange-bg">               
          <div class="media">
            <div class="media-left">
              <i class="fa fa-times-circle" style="color:red;font-size:10rem;"></i>
            </div>
            <div class="media-body">
              <h2 class="media-heading text-uppercase">Buku Hilang <b>{{ number_format(count($buku_hilang)) }}</b></h2>  
            </div>        
          </div>                
        </div>            
      </div>   
      <div class="col-1">
        <div class="templatemo-content-widget white-bg">
          <div class="media">
            <div class="media-left">
              <i class="fa fa-book" style="color:black;font-size:10rem;"></i>
            </div>
            <div class="media-body">
              <h2 class="media-heading text-uppercase">Peminjaman Buku kelas {{ Session::get('kelas') }} <b>{{ number_format(count($peminjaman_kelas)) }}</b></h2>
            </div>
          </div>                
        </div>           
        <div class="templatemo-content-widget green-bg">
          <div class="media">
            <div class="media-left">
              <i class="fa fa-check-circle" style="color:green;font-size:10rem;"></i>
            </div>
            <div class="media-body">
              <h2 class="media-heading text-uppercase">Pengembalian Buku kelas {{ Session::get('kelas') }} <b>{{ number_format(count($pengembalian_kelas)) }}</b></h2>
            </div>
          </div>                
        </div>             
        <div class="templatemo-content-widget orange-bg">               
          <div class="media">
            <div class="media-left">
              <i class="fa fa-times-circle" style="color:red;font-size:10rem;"></i>
            </div>
            <div class="media-body">
              <h2 class="media-heading text-uppercase">Buku Hilang kelas {{ Session::get('kelas') }} <b>{{ number_format(count($buku_hilang_kelas)) }}</b></h2>  
            </div>        
          </div>                
        </div>  
      </div>   
    </div> <!-- Second row ends -->
</div>
@endsection