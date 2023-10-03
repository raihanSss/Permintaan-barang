<!-- Modal Tambah Supplier -->
<div class="modal fade" id="tambahModalUser" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form tambah supplier -->
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama User</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="togglePasswordVisibility()">Tampilkan Password</button>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="">-- Pilih --</option>
                            <option value="purchasing">Purchasing</option>
                            <option value="ppic">PPIC</option>
                            <option value="direktur">Direktur</option>
                            <option value="supplier">Supplier</option>
                        </select>
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

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById('password');
        var visibilityButton = document.querySelector('button.btn');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            visibilityButton.textContent = 'Sembunyikan Password';
        } else {
            passwordInput.type = 'password';
            visibilityButton.textContent = 'Tampilkan Password';
        }
    }
</script>
