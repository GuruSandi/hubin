<!-- Modal Form Edit -->
<div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModal{{$item->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{$item->id}}Label">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit -->
                <form action="{{ route('posteditsiswa', $item->id) }}" class="form-group" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <label for="">NIS</label>
                    <input type="text" class="form-control" required name="nis" value="{{ $item->nis }}">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" required name="nama" value="{{ $item->nama }}">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenkel" required id="" class="form-control">
                        <option value="L" @if ($item->jenkel == 'L') selected @endif>Laki-laki</option>
                        <option value="P" @if ($item->jenkel == 'P') selected @endif>Perempuan</option>
                    </select>
                    
                    <label for="">Kelas</label>
                    <input type="text" class="form-control" required name="kelas" value="{{ $item->kelas }}">
                    <label for="">Tahun Ajar</label>
                    <input type="text" class="form-control" required name="tahun_ajar" value="{{ $item->tahun_ajar }}">
                    <label for="">Status</label>
                    <select name="status" required id="" class="form-control">
                        <option value="aktif" @if ($item->status == 'aktif') selected @endif>Aktif</option>
                        <option value="tidak_aktif" @if ($item->status == 'tidak_aktif') selected @endif>Tidak Aktif</option>
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

