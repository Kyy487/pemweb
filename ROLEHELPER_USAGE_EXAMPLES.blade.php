<!-- CONTOH PENGGUNAAN ROLEHELPER DI BLADE TEMPLATE -->

<!-- ===============================================
     1. CHECK SINGLE ROLE - SIMPLE WAY
     =============================================== -->

<!-- Menggunakan helper langsung di blade -->
@if(\App\Helpers\RoleHelper::isAdmin())
    <div class="alert alert-info">
        Anda adalah Admin
    </div>
@endif

@if(\App\Helpers\RoleHelper::isTeacher())
    <div class="alert alert-info">
        Anda adalah Guru
    </div>
@endif

@if(\App\Helpers\RoleHelper::isStudent())
    <div class="alert alert-info">
        Anda adalah Siswa
    </div>
@endif

<!-- ===============================================
     2. CHECK MULTIPLE ROLES
     =============================================== -->

@if(\App\Helpers\RoleHelper::hasAnyRole('admin', 'teacher'))
    <div class="alert alert-warning">
        Anda adalah Admin atau Guru
    </div>
@endif

<!-- ===============================================
     3. SHOW ELEMENT BASED ON ROLE
     =============================================== -->

<nav class="navbar">
    <div class="nav-items">
        <!-- Link untuk semua user authenticated -->
        <a href="/dashboard">Dashboard</a>

        <!-- Link khusus Admin -->
        @if(\App\Helpers\RoleHelper::isAdmin())
            <a href="/users">Kelola Pengguna</a>
            <a href="/admin/settings">Pengaturan</a>
        @endif

        <!-- Link khusus Guru -->
        @if(\App\Helpers\RoleHelper::isTeacher())
            <a href="/teacher/classes">Kelas Saya</a>
            <a href="/teacher/grades">Nilai Siswa</a>
        @endif

        <!-- Link khusus Siswa -->
        @if(\App\Helpers\RoleHelper::isStudent())
            <a href="/student/grades">Nilai Saya</a>
            <a href="/student/schedule">Jadwal</a>
        @endif

        <!-- Logout untuk semua -->
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</nav>

<!-- ===============================================
     4. CONDITIONAL TABLE COLUMNS
     =============================================== -->

<table class="users-table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>

            <!-- Kolom Action hanya untuk Admin -->
            @if(\App\Helpers\RoleHelper::isAdmin())
                <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge badge-{{ $user->role }}">
                        {{ \App\Helpers\RoleHelper::getRoleName($user->role) }}
                    </span>
                </td>

                @if(\App\Helpers\RoleHelper::isAdmin())
                    <td>
                        <a href="/users/{{ $user->id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }})">Delete</button>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

<!-- ===============================================
     5. DISPLAY ROLE NAME IN BAHASA INDONESIA
     =============================================== -->

<div class="user-profile">
    <p>Nama: {{ auth()->user()->name }}</p>
    <p>Email: {{ auth()->user()->email }}</p>
    <p>Peran: <strong>{{ \App\Helpers\RoleHelper::getRoleName() }}</strong></p>
</div>

<!-- ===============================================
     6. REDIRECT TO APPROPRIATE DASHBOARD
     =============================================== -->

<script>
    // Redirect ke dashboard sesuai role
    function goToDashboard() {
        const dashboardUrl = "{{ \App\Helpers\RoleHelper::getDashboardUrl() }}";
        window.location.href = dashboardUrl;
    }
</script>

<!-- ===============================================
     7. FORM FIELD DENGAN ROLE OPTIONS
     =============================================== -->

<form method="POST" action="/users/store">
    @csrf

    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="role">Peran</label>
        <select id="role" name="role" required>
            <option value="">-- Pilih Peran --</option>
            @foreach(\App\Helpers\RoleHelper::getRoleOptions() as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Buat User</button>
</form>

<!-- ===============================================
     8. ADVANCED: PERMISSION CHECK
     =============================================== -->

@if(\App\Helpers\RoleHelper::canEditUser($targetUser))
    <a href="/users/{{ $targetUser->id }}/edit" class="btn btn-primary">Edit User</a>
@else
    <span class="text-danger">Anda tidak bisa edit user ini</span>
@endif

<!-- ===============================================
     TIPS PENTING
     ===============================================

1. Import Helper di Blade:
   \App\Helpers\RoleHelper::methodName()

2. Atau, register di AppServiceProvider untuk short syntax:
   use App\Helpers\RoleHelper;
   
   Di blade bisa langsung: {{ RoleHelper::isAdmin() }}

3. Untuk performa lebih baik di AppServiceProvider:
   public function boot()
   {
       \Blade::macro('isAdmin', function() {
           return \App\Helpers\RoleHelper::isAdmin();
       });
   }
   
   Gunakan: @isAdmin ... @endisAdmin

4. Cache role checks jika perlu performa tinggi:
   @if(cache()->remember('user.'.auth()->id().'.is_admin', 60, function() {
       return \App\Helpers\RoleHelper::isAdmin();
   }))
       ...
   @endif
-->
