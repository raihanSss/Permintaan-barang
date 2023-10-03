@extends('layout.main')

@section('judul')
   Halaman Detail Surat Jalan
@endsection

@section('isi')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                @if ($authuser->role == "ppic")
                <div>
                    <button class="btn btn-primary btn-sm mr-2" onclick="printTable()">Print</button>
                </div>
                @endif
                <h3 class="mb-3">Detail Surat Jalan</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Kode PO</th>
                        <td>{{ $suratJalan->id_suratpo }}</td>
                    </tr>
                    <tr>
                        <th>Nama Supplier</th>
                        <td>{{ $suratJalan->suratpo->supplier->nama_supplier }}</td>
                    </tr>
                    <tr>
                        <th>Kode Surat Jalan</th>
                        <td>{{ $suratJalan->kode_surat_jalan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Delivery</th>
                        <td>{{ $suratJalan->tanggal_deliv }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $suratJalan->keterangan }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Data Barang</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suratJalan->suratpo->barangs as $barang)
                            <tr>
                                <td>{{ $barang->kode_barang }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->pivot->quantity_po }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script>
    function printTable() {
        var printContents = document.getElementById('print-section').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>


