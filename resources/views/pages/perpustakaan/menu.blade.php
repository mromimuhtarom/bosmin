<ul>
    <li><a href="{{ route('dashboard-perpus') }}" class="{{ Request::is('perpustakaan/Dasboard/*') ? 'active' : null }}"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
    <li><a href="{{ route('walikelas-view') }}" class="{{ Request::is('perpustakaan/walikelas/*') ? 'active' : null }}"><i class="fa fa-users fa-fw"></i>Wali Kelas</a></li>
    <li><a href="{{ route('pengembalian-buku') }}" class="{{ Request::is('walikelas/Pengembalian/*') ? 'active' : null }}"><i class="fa fa-book fa-fw"></i>Pengembalian Buku</a></li>
    <li><a href="{{ route('buku-hilang')}}" class="{{ Request::is('walikelas/Buku-Hilang/*') ? 'active' : null }}"><i class="fa fa-book fa-fw"></i>Buku Hilang</a></li>
    <li><a href="{{ route('logout')}}"><i class="fa fa-eject fa-fw"></i>Keluar</a></li>
</ul>  