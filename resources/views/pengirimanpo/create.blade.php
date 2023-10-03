<!-- Modal -->
<div class="modal fade" id="tambahSuratJalanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Surat Jalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suratjalan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_Suratjalan">Kode Surat Jalan:</label>
                        <input type="text" class="form-control" id="kode_Suratjalan" name="kode_Suratjalan" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kirim">Tanggal Kirim Barang:</label>
                        <input type="date" class="form-control" id="tanggal_kirim" name="tanggal_kirim" required>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Pilih Barang yang akan dikirim:</label>
                        @foreach($barangSuratPOs as $barangSuratPO)
                            @if($barangSuratPO->status_deliv === 'pending' || $barangSuratPO->status_deliv === 'proses')
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{ $barangSuratPO->id }}_barang_suratpo" name="id_barang_suratpo[]" value="{{ $barangSuratPO->id }}">
                                    <label class="form-check-label" for="{{ $barangSuratPO->id }}_barang_suratpo">
                                        {{ $barangSuratPO->id_suratpo }}
                                        {{ $barangSuratPO->barang->nama_barang }}
                                        {{ $barangSuratPO->barang->kode_barang }}
                                        (Quantity: {{ $barangSuratPO->quantity_kirim }}/{{ $barangSuratPO->quantity_po }})
                                    </label>
                                    <!-- Tambahkan input untuk quantity_kirim -->
                                    <input type="number" class="form-control" name="quantity_kirim[{{ $barangSuratPO->id }}]" placeholder="Quantity Kirim" min="1" max="{{ $barangSuratPO->quantity_po - $barangSuratPO->quantity_kirim }}">

                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    
                    
                    <button type="submit" class="btn btn-primary">Buat Surat Jalan</button>
                </form>
            </div>
        </div>
    </div>
</div>
