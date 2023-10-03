@extends('layout.main')

@section('judul')
    Halaman Suppliers
@endsection

@section('isi')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Suppliers</h6>
            @if(session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
    <button type="button" class="close" data-dismiss="alert">X</button>
        {{ session('success') }}
    </div>
    @endif
            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambahModal">
                Tambah Data Supplier
            </button>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama supplier</th>
                    <th>Alamat supplier</th>
                    <th>No Telp supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                                    
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->nama_supplier }}</td>
                    <td>{{ $supplier->alamat_supplier }}</td>
                    <td>{{ $supplier->no_telp_supplier }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="#editModal{{ $supplier->id_supplier }}" class="btn btn-primary btn-sm" data-toggle="modal">Edit</a>
                        
                        <!-- Tombol Hapus -->
                        <form action="{{ route('suppliers.destroy', $supplier->id_supplier) }}" method="POST" style="display: inline-block">
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
   <!-- /.container-fluid -->

   </div>
   <!-- End of Main Content -->

@include('suppliers.tambah')
@include('suppliers.edit', ['supplier' => $supplier])

@endsection