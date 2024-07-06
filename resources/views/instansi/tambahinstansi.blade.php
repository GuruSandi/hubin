<div class="modal fade" id="tambahInstansiModal" tabindex="-1" aria-labelledby="tambahInstansiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahInstansiModalLabel">Tambah Data Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('posttambahinstansi') }}" class="form-group" enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="">Nama Instansi</label>
                    <input type="text" class="form-control" required name="instansi">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" required name="alamat">
                    <label for="">Domisili</label>
                    <input type="text" class="form-control" required name="domisili">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
               
            </div>
            
        </div>
    </div>
</div>
