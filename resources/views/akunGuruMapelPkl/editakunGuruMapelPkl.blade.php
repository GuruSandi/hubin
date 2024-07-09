<!-- Modal Form Edit -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModal{{ $item->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{ $item->id }}Label">Edit Akun Guru Mapel PKL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit -->
                <form action="{{ route('posteditakunGuruMapelPkl', $item->user->id) }}" class="form-group"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-lg mb-3" required name="username"
                        value="{{ $item->user->username }}">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-lg mb-3" required name="password"
                        value="{{ $item->user->password }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

