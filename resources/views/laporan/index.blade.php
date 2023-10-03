@extends('layout.main')

@section('judul')
    Halaman Laporan
@endsection

@section('isi')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Surat PO dan Surat Jalan</h6>
    </div>
    <div class="card-body">
        <h4>Surat PO</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode PO</th>
                    <th>Nama Supplier</th>
                    <th>Tanggal PO</th>
                    <th>Periode</th>
                    <th>Detail Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratpo as $po)
                <tr>
                    <td>{{ $po->kode_po }}</td>
                    <td>{{ $po->supplier->nama_supplier }}</td>
                    <td>{{ $po->tanggal_po }}</td>
                    <td>{{ $po->periode }}</td>
                    <td>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Quantity PO</th>
                                    <th>Tanggal Kirim Barang</th>
                                    <th>Status Pengiriman</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($po->barangs as $barang)
                                    <tr>
                                        <td>{{ $barang->kode_barang }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->pivot->quantity_po }}</td>
                                        <td>{{ $barang->pivot->jadwal_barang }}</td>
                                        <td>{{ $barang->pivot->status_deliv }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Surat Jalan (Status: Diterima)</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Surat Jalan</th>
                    <th>Tanggal Kirim</th>
                    <th>Keterangan</th>
                    <th>Detail Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratjalan as $sj)
                <tr>
                    <td>{{ $sj->kode_Suratjalan }}</td>
                    <td>{{ $sj->tanggal_kirim }}</td>
                    <td>{{ $sj->keterangan ?: 'Tidak ada keterangan' }}</td>
                    <td>
                        @if ($sj->barangSuratJalan)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode PO</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Quantity Kirim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sj->barangSuratJalan as $barang)
                                <tr>
                                    <td>{{ $barang->suratpo->kode_po }}</td>
                                    <td>{{ $barang->barang->kode_barang }}</td>
                                    <td>{{ $barang->barang->nama_barang }}</td>
                                    <td>{{ $barang->quantity_kirim }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Tidak ada detail barang.</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</div>
@endsection
