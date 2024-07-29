<div class="modal fade" id="tambahgurumapelModal" tabindex="-1" aria-labelledby="tambahgurumapelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahgurumapelModalLabel">Tambah Data Guru Mapel PKL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('posttambahgurumapel') }}" class="form-group" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <label for="">Nama Guru</label>
                    <input type="text" class="form-control" required name="nama">
                    <label for="">No HP</label>
                    <input type="text" class="form-control" required name="no_hp">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" accept="img/fotoguru*" required name="foto">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>






