@extends('layout.main')

@section('judul')
    Halaman Surat Jalan
@endsection

@section('isi')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Surat Jalan</h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="30">
            <thead  style="width: 100px;">
                <tr>
                    <th style="width: 200px;">Surat Jalan</th>
                    <th style="width: 100px;">Detail Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suratJalans as $suratJalan)
                    <tr>
                        <td>{{ $suratJalan->suratjalan }}</td>
                        <td>
                            <a href="{{ route('penerimaan.detailsuratjalan', ['suratjalan' => $suratJalan->suratjalan]) }}" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
