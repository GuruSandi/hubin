<div class="modal fade" id="tambahakunadminModal" tabindex="-1" aria-labelledby="tambahakunadminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahakunadminModalLabel">Tambah Akun Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('posttambahakunadmin') }}" class="form-group" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-lg mb-3" required name="username">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-lg mb-3" required name="password">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>






