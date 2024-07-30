<!-- Modal Form Edit -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModal{{ $item->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{ $item->id }}Label">Edit Data Absensi Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit -->
                <p><strong>Nama :</strong> {{ $item->nama_siswa }}</p>
                <p><strong>Kelas :</strong> {{ $item->kelas_siswa }}</p>

                <form action="{{ route('posteditdatajurnalsiswa', $item->id) }}" class="form-group"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" required name="tanggal" value="{{ $item->tanggal }}">
                    <label for="">Deskripsi Jurnal</label>
                    <div class="form-floating">
                        <textarea id="floatingTextarea" style="height: 150px; padding-top: 10px" name="deskripsi_jurnal"
                            class="form-control mb-3">{{ old('deskripsi_jurnal', $item->deskripsi_jurnal) }}</textarea>
                    </div>
                    <label for="">Validasi</label>
                    <select name="validasi" class="form-control" required>
                        <option value="tervalidasi" @if ($item->validasi == 'tervalidasi') selected @endif>Sudah di validasi
                        </option>
                        <option value="ditolak" @if ($item->validasi == 'ditolak') selected @endif>Ditolak</option>
                        <option value="belum_tervalidasi" @if ($item->validasi == 'belum_tervalidasi') selected @endif>Belum
                            divalidasi</option>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
