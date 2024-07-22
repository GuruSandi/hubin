<!-- Modal Form Edit -->
<div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" aria-labelledby="editModal{{$item->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{$item->id}}Label">Validasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit -->
                <form action="{{ route('validasi', $item->id) }}" class="form-group" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                 
                    <label for="">Validasi</label>
                    <select name="validasi" required id="" class="form-control">
                        <option value="tervalidasi" @if ($item->validasi == 'tervalidasi') selected @endif>Setujui</option>
                        <option value="ditolak" @if ($item->validasi == 'ditolak') selected @endif>Tolak</option>
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

