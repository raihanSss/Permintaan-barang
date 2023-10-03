@extends('layout.main')

@section('judul')
    Purchase Order Request
@endsection

@section('isi')
    @if(session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{ session('success') }}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger col-lg-8" role="alert">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('suratpo.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kode_po" class="form-label">Kode PO:</label>
                        <input type="text" name="kode_po" id="kode_po" class="form-control" value="{{ $PRID }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="id_supplier" class="form-label">Supplier:</label>
                        <select name="id_supplier" id="id_supplier" class="form-control" required>
                            <option value="">== PILIH ==</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id_supplier }}">{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="periode" class="form-label">Periode:</label>
                        <input type="text" name="periode" id="periode" class="form-control" value="{{ $monthNow }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_po" class="form-label">Tanggal PO:</label>
                        <input type="date" name="tanggal_po" id="tanggal_po" class="form-control" required>
                    </div>
                </div>
            
                <h3>Data Barang</h3>
            
                <table class="table" id="barang-table">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Quantity PO</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="barang-table-body">
                        <tr class="barang-row" style="display: none;">
                            <td>
                                <select name="barang[id_barang][]" class="form-control kodebarang-select">
                                    <option value="">== PILIH ==</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id_barang }}" data-nama-barang="{{ $barang->nama_barang }}">{{ $barang->kode_barang }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="barang[nama_barang][]" class="form-control nama-barang-input" readonly>
                            </td>
                            
                            <td>
                                <input type="number" name="barang[quantity_po][]" class="form-control quantity-po">
                            </td>
                            <td>
                                <input type="number" name="barang[price][]" class="form-control price">
                            </td>
                            <td>
                                <input type="number" name="barang[total_price][]" class="form-control total-price" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger hapus-barang">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            
                <button type="button" class="btn btn-primary tambah-barang">Tambah Barang</button>
                <br>
                <br>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Create Purchase Order</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script_suratpo')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const barangTableBody = document.getElementById('barang-table-body');
            const tambahBarangButton = document.querySelector('.tambah-barang');

            tambahBarangButton.addEventListener('click', function() {
                const newRow = document.querySelector('.barang-row').cloneNode(true);
                newRow.style.display = 'table-row';

                const kodeBarangSelect = newRow.querySelector('.kodebarang-select');
                const namaBarangInput = newRow.querySelector('.nama-barang-input');
                const quantityPoInput = newRow.querySelector('.quantity-po');
                const priceInput = newRow.querySelector('.price');
                const totalPriceInput = newRow.querySelector('.total-price');
                const hapusBarangButton = newRow.querySelector('.hapus-barang');

                kodeBarangSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    namaBarangInput.value = selectedOption.dataset.namaBarang;
                });

                quantityPoInput.addEventListener('input', function() {
                    const quantityPo = parseFloat(this.value);
                    const price = parseFloat(priceInput.value);
                    const totalPrice = quantityPo * price;

                    if (!isNaN(totalPrice)) {
                        totalPriceInput.value = totalPrice;
                    } else {
                        totalPriceInput.value = '';
                    }
                });

                priceInput.addEventListener('input', function() {
                    const quantityPo = parseFloat(quantityPoInput.value);
                    const price = parseFloat(this.value);
                    const totalPrice = quantityPo * price;

                    if (!isNaN(totalPrice)) {
                        totalPriceInput.value = totalPrice;
                    } else {
                        totalPriceInput.value = '';
                    }
                });

                hapusBarangButton.addEventListener('click', function() {
                    barangTableBody.removeChild(newRow);
                });

                barangTableBody.appendChild(newRow);

                // Reset input values
                kodeBarangSelect.value = '';
                namaBarangInput.value = '';
                quantityPoInput.value = '';
                priceInput.value = '';
                totalPriceInput.value = '';
            });
        });
    </script>
@endpush
