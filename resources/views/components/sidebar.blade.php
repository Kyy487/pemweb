<div class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo"><i class="bi bi-mortarboard"></i> E-Rapor</div>
        <div class="sidebar-subtitle">Sistem Rapor Digital</div>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
        
        @if(Auth::user()->role === 'admin')
            <li><a href="{{ route('classes.index') }}"><i class="bi bi-building"></i> Kelas</a></li>
            <li><a href="{{ route('subjects.index') }}"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
            <li><a href="{{ route('users.index') }}"><i class="bi bi-people"></i> Pengguna</a></li>
            <li><a href="{{ route('grades.index') }}"><i class="bi bi-graph-up"></i> Nilai</a></li>
        @elseif(Auth::user()->role === 'teacher')
            <li><a href="{{ route('grades.input.form') }}"><i class="bi bi-pencil-square"></i> Input Nilai</a></li>
            <li><a href="{{ route('grades.index') }}"><i class="bi bi-graph-up"></i> Data Nilai</a></li>
        @else
            <li><a href="{{ route('grades.index') }}"><i class="bi bi-graph-up"></i> Nilai Saya</a></li>
        @endif
    </ul>
    <form method="POST" action="{{ route('logout') }}" style="display: contents;">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</div>
