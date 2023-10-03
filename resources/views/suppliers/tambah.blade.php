<!-- Modal Tambah Supplier -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form tambah supplier -->
                <form method="POST" action="{{ route('suppliers.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" placeholder="Masukkan Nama Supplier" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_supplier">Alamat Supplier</label>
                        <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" placeholder="Masukkan Alamat Supplier" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp_supplier">Nomor Telepon Supplier</label>
                        <input type="text" class="form-control" id="no_telp_supplier" name="no_telp_supplier" placeholder="Masukkan Nomor Telepon Supplier" maxlength="10" pattern="[0-9]{10}" required>
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
