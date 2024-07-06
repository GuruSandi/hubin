<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="detailModal{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal{{ $item->id }}Label">Data Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <!-- Display Details -->

                    <p> <img src="{{ asset($item->foto) }}" alt="Foto Sarana" width="100" height="100"></p>
                    <p><strong>Nama Pembimbing:</strong> {{ $item->nama }}</p>

                    <p><strong>No.HP:</strong> {{ $item->no_hp }}</p>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>


            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
