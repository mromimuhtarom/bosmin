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
</div>
@endsection