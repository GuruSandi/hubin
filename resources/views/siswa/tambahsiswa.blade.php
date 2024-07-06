<div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-labelledby="tambahSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSiswaModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('posttambahsiswa') }}" class="form-group" enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="">NIS</label>
                    <input type="text" class="form-control" required name="nis">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" required name="nama">
                    <label for="">Jenis Kelamin</label>
                    <select name="jenkel" required id="" class="form-control">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <label for="">Kelas</label>
                    <input type="text" class="form-control" required name="kelas">
                    <label for="">Tahun Ajar</label>
                    <input type="text" class="form-control" required name="tahun_ajar">
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>