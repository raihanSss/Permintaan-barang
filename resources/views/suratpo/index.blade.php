@extends('layout.main')

@section('judul')
    Purchase Order New
@endsection

@section('isi')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Surat Purchase Order New</h6>
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
                            <th>Kode PO</th>
                            <th>Nama Supplier</th>
                            <th>Tanggal PO</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suratPOs as $kodePo => $suratPOGroup)
                        @php
                            // Mengganti karakter '/' dengan '_'
                            $modalId = str_replace('/', '_', $kodePo);
                        @endphp
                            <tr>
                                <td>{{ $kodePo }}</td>
                                <td>{{ $suratPOGroup[0]->supplier->nama_supplier }}</td>
                                <td>{{ $suratPOGroup[0]->tanggal_po }}</td>
                                <td>{{ $suratPOGroup[0]->status }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal{{ $modalId }}">Details</button>
                                    <form action="{{ route('suratpo.delete', $modalId) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Details -->
    @foreach($suratPOs as $kodePo => $suratPOGroup)
        @php
            // Mengganti karakter '/' dengan '_'
            $modalId = str_replace('/', '_', $kodePo);
        @endphp

        <div class="modal fade" id="detailModal{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Barang Surat PO {{ $kodePo }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Quantity PO</th>
                                    <!-- Tambahkan kolom detail lainnya jika diperlukan -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratPOGroup as $suratPO)
                                    @foreach ($suratPO->barangs as $barang)
                                        <tr>
                                            <td>{{ $barang->kode_barang }}</td>
                                            <td>{{ $barang->nama_barang }}</td>
                                            <td>{{ $barang->pivot->quantity_po }}</td>
                                            <!-- Tambahkan detail lainnya jika diperlukan -->
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
