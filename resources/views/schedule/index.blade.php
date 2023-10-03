@extends('layout.main')

@section('judul')
    Halaman Schedule
@endsection

@section('isi')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jadwal Surat PO</h6>
            @if(session()->has('success'))
                <div class="alert alert-success col-lg-8" role="alert">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('schedule.index') }}" method="GET">
                <div class="form-group">
                    <label for="suratpo">Pilih Surat PO:</label>
                    <select class="form-control" name="suratpo" id="suratpo">
                        <option value="">-- Pilih Surat PO --</option>
                        @foreach ($suratPOs as $suratPO)
                            @php
                                // Mengganti karakter '/' dengan '_'
                                $modalId = str_replace('/', '_', $suratPO->kode_po);
                                $barangSuratPo = \App\Models\BarangSuratPo::where('id_suratpo', $suratPO->kode_po)
                                    ->whereNull('jadwal_barang')
                                    ->exists();
                            @endphp
                            @if ($barangSuratPo)
                                <option value="{{ $modalId }}">{{ $suratPO->kode_po }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </form>
        </div>

        @if ($selectedSuratPO)
            <h6 class="mt-4">Detail Surat PO:</h6>
            <form action="{{ route('schedule.update', ['suratpo' => str_replace('/', '_', $selectedSuratPO->kode_po)]) }}" method="POST">
                @csrf
                @method('PUT')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Kode PO</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Quantity PO</th>
                        <th>Jadwal Barang</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($selectedSuratPO->barangs as $barang)
                        <tr>
                            <td>{{ $selectedSuratPO->kode_po }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->pivot->quantity_po }}</td>
                            <td>
                                <input type="date" class="form-control" name="jadwal_barang[{{ str_replace([' ', '-'], '_', $barang->kode_barang) }}]" value="{{ $barang->pivot->jadwal_barang }}">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </form>
        @endif

    </div>
@endsection
