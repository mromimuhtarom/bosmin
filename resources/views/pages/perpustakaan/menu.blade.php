<ul>
    <li><a href="{{ route('dashboard-walikelas') }}" class="{{ Request::is('walikelas/Dasboard/*') ? 'active' : null }}"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
    <li><a href="{{ route('peminjaman-buku') }}" class="{{ Request::is('walikelas/Peminjaman/*') ? 'active' : null }}"><i class="fa fa-book fa-fw"></i>Peminjaman Buku</a></li>
    <li><a href="{{ route('pengembalian-buku') }}" class="{{ Request::is('walikelas/Pengembalian/*') ? 'active' : null }}"><i class="fa fa-book fa-fw"></i>Pengembalian Buku</a></li>
    <li><a href="{{ route('buku-hilang')}}" class="{{ Request::is('walikelas/Buku-Hilang/*') ? 'active' : null }}"><i class="fa fa-book fa-fw"></i>Buku Hilang</a></li>
    <li><a href="{{ route('logout')}}"><i class="fa fa-eject fa-fw"></i>Keluar</a></li>
</ul>  