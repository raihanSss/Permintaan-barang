@extends('layout.main')

@section('judul')
    Halaman Users
@endsection

@section('isi')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
            @if(session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
    <button type="button" class="close" data-dismiss="alert">X</button>
        {{ session('success') }}
    </div>
    @endif

    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambahModalUser">
        Tambah Data User
    </button>
</div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email}}</td>
            <td>{{ $user->username}}</td>
            <td>{{ $user->role }}</td>
            <td>
                <!-- Tombol Edit -->
                <a href="#editModal{{ $user->id }}" class="btn btn-primary btn-sm" data-toggle="modal">Edit</a>
                
                <!-- Tombol Hapus -->
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
</div>

</div>

</div>
@include('users.tambah')
@include('users.edit', ['user' => $user])
@endsection

