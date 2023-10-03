@foreach ($suppliers as $supplier)
    <!-- Modal Edit Supplier -->
<div class="modal fade" id="editModal{{ $supplier->id_supplier }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $supplier->id_supplier }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $supplier->id_supplier }}">Edit Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form edit supplier -->
                <form method="POST" action="{{ route('suppliers.update', $supplier->id_supplier) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" placeholder="Masukkan Nama Supplier" value="{{ $supplier->nama_supplier }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat_supplier">Alamat Supplier</label>
                        <textarea class="form-control" id="alamat_supplier" name="alamat_supplier" rows="3" placeholder="Masukkan Alamat Supplier">{{ $supplier->alamat_supplier }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_telp_supplier">Nomor Telepon Supplier</label>
                        <input type="text" class="form-control" id="no_telp_supplier" name="no_telp_supplier" pattern="[0-9]+" placeholder="Masukkan Nomor Telepon Supplier" maxlength="10" pattern="[0-9]{10}" value="{{ $supplier->no_telp_supplier }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

