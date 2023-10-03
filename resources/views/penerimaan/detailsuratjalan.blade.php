@extends('layout.main')

@section('judul')
    Detail Penerimaan Surat Jalan
@endsection

@section('isi')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Surat Jalan</h6>
    </div>
    <div class="card-body">
        <h5>Kode Surat Jalan: {{ $suratJalan->kode_Suratjalan }}</h5>
        <p>Tanggal Kirim: {{ $suratJalan->tanggal_kirim }}</p>
        <p>Keterangan: {{ $suratJalan->keterangan ?: 'Tidak ada keterangan' }}</p>
    </div>
    
        
        <h6>Daftar Barang:</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode PO</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Quantity PO</th>
                        <th>Quantity Kirim</th>
                    </tr>
                </thead>
            <tbody>
            @foreach ($suratJalan->barangSuratJalan as $barang)
            <tr>
                <td>{{ $barang->suratpo->kode_po }}</td>
                <td>{{ $barang->barang->kode_barang }}</td>
                <td>{{ $barang->barang->nama_barang }}</td>
                <td>{{ $barang->quantity_po }}</td>
                <td>{{ $barang->quantity_kirim }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
        
    </div>
</div>
@endsection
