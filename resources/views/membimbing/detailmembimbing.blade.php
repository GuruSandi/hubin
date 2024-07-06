<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="detailModal{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal{{ $item->id }}Label">Data Membimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <!-- Display Details -->

                    <p><strong>NIS:</strong> {{ $item->siswa->nis }}</p>
                    <p><strong>Nama Siswa:</strong> {{ $item->siswa->nama }}</p>
                    <p><strong>Guru Mapel PKL:</strong> {{ $item->guru_mapel_pkl->nama }}</p>
                    <p><strong>Pembimbing:</strong> {{ $item->pembimbing->nama }}</p>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                
            </div>
        </div>
    </div>
</div>
