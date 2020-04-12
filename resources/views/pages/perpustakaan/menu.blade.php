<ul>
    <li><a href="{{ route('dashboard-perpus') }}" class="{{ Request::is('perpustakaan/Dasboard/*') ? 'active' : null }}"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
    <li><a href="{{ route('walikelas-view') }}" class="{{ Request::is('perpustakaan/walikelas/*') ? 'active' : null }}"><i class="fa fa-users fa-fw"></i>Wali Kelas</a></li>
    <li><a href="{{ route('siswa-view') }}" class="{{ Request::is('perpustakaan/siswa/*') ? 'active' : null }}"><i class="fa fa-users fa-fw"></i>Siswa</a></li>
    <li><a href="{{ route('list_buku-view')}}" class="{{ Request::is('perpustakaan/list_buku/*') ? 'active' : null }}"><i class="fa fa-book fa-fw"></i>List Buku</a></li>
    <li><a href="{{ route('buku-hilang')}}" class="{{ Request::is('walikelas/Buku-Hilang/*') ? 'active' : null }}"><i class="fa fa-book fa-fw"></i>Buku Hilang</a></li>
    <li><a href="{{ route('logout')}}"><i class="fa fa-eject fa-fw"></i>Keluar</a></li>
</ul>  