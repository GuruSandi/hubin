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
                <form action="{{ route('posteditinstansi', $item->id) }}" class="form-group" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <label for="">Nama Instansi</label>
                    <input type="text" class="form-control" required name="instansi" value="{{ $item->instansi }}">
                    <label for="">alamat</label>
                    <input type="text" class="form-control" required name="alamat" value="{{ $item->alamat }}">
                    <label for="">Domisili</label>
                    <input type="text" class="form-control" required name="domisili" value="{{ $item->domisili }}">
                    <label for="">Latitude</label>
                    <input type="text" class="form-control" required name="latitude" value="{{ $item->latitude }}">
                    <label for="">Longitude</label>
                    <input type="text" class="form-control" required name="longitude" value="{{ $item->longitude }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>
</div>
