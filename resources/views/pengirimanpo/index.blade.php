@extends('layout.main')

@section('judul')
    Halaman Penerimaan Surat PO
@endsection

@section('isi')
<style>
   
    .progress-container {
        width: 100%;
        position: relative;
    }

    .progress {
        width: 100%;
        height: 20px;
        border: 1px solid #007bff;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
    }

    .progress-bar {
        width: 0;
        height: 100%;
        background-color: #007bff;
        color: rgb(24, 0, 111);
        text-align: center;
        line-height: 20px;
        transition: width 0.3s ease-in-out;
    }

    .progress-text {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        text-align: center;
        line-height: 20px;
    }

   
    .badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .badge-danger {
        background-color: #f00;
        color: #fff;
    }

    .badge-warning {
        background-color: #ff8c00;
        color: #fff;
    }

    .badge-success {
        background-color: #008000;
        color: #fff;
    }
</style>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Penerimaan PO</h6>
        @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                <button type="button" class="close" data-dismiss="alert">X</button>
                {{ session('success') }}
            </div>
        @endif
        <br>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahSuratJalanModal">
            Buat Surat Jalan
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode PO</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Quantity PO</th>
                        <th>Jadwal Delivery</th>
                        <th>Status Deliv</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangDenganJadwal as $barang)
                        <tr>
                            <td>{{ $barang->id_suratpo }}</td>
                            <td>{{ $barang->barang->kode_barang }}</td>
                            <td>{{ $barang->barang->nama_barang }}</td>
                            <td>{{ $barang->quantity_po }}</td>
                            <td>{{ $barang->jadwal_barang }}</td>
                            <td>
                                @if($barang->status_deliv === 'pending')
                                    <span class="badge badge-danger">Belum Dikirim</span>
                                @elseif($barang->status_deliv === 'proses')
                                <div class="progress-container">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($barang->quantity_kirim / $barang->quantity_po) * 100 }}%" aria-valuenow="{{ $barang->quantity_kirim }}" aria-valuemin="0" aria-valuemax="{{ $barang->quantity_po }}">
                                            {{ $barang->quantity_kirim }}/{{ $barang->quantity_po }}</div>
                                    </div>
                                </div>
                                @else
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>               
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@include('pengirimanpo.create')
@endsection
