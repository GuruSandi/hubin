<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="detailModal{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal{{ $item->id }}Label">Data Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Instansi :</strong> {{ $item->instansi }}</p>
                <p><strong>Alamat :</strong> {{ $item->alamat }}</p>
                <p><strong>Domisili:</strong> {{ $item->domisili }}</p>
                <p><strong>Latitude :</strong> {{ $item->latitude }}</p>
                <p><strong>Longitude :</strong> {{ $item->longitude }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>
