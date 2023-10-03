@extends('layout.main')

@section('judul')
    Halaman Penerimaan
@endsection

@section('isi')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Penerimaan Surat Jalan</h6>
        @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                <button type="button" class="close" data-dismiss="alert">X</button>
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Surat Jalan</th>
                        <th>Tanggal Kirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratJalan as $sj)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sj->kode_Suratjalan }}</td>
                            <td>{{ $sj->tanggal_kirim }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('penerimaan.detailsuratjalan', ['id' => $sj->id_suratjalan]) }}" class="btn btn-info btn-sm mr-2">Details</a>
                                    
                                    @if ($sj->status === 'diterima')
                                        <span class="badge badge-success">Sudah Diterima</span>
                                    @else
                                        <form action="{{ route('penerimaan.setuju', ['id' => $sj->id_suratjalan]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm ml-2">Setuju</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function setujuSuratJalan(id) {
        // Lakukan aksi setuju untuk surat jalan dengan ID tertentu
        // Anda dapat menambahkan logika di sini sesuai dengan kebutuhan Anda
        alert('Anda telah menyetujui Surat Jalan dengan ID ' + id);
    }
</script>
@endsection
