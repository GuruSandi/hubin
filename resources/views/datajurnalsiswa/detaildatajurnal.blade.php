<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="detailModal{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal{{ $item->id }}Label">Data Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama :</strong> {{ $item->nama_siswa }}</p>
                <p><strong>Kelas :</strong> {{ $item->kelas_siswa }}</p>
                <p><strong>Tanggal :</strong> {{ $item->tanggal }}</p>
                <p><strong>Instansi :</strong> {{ $item->instansi }}</p>
                <p><strong>Deskripsi Jurnal :</strong> {{ $item->deskripsi_jurnal }}</p>
                <p><strong>Pembimbing :</strong> {{ $item->nama_pembimbing }}</p>
                <p><strong>Guru Mapel PKL :</strong> {{ $item->nama_gurumapel }}</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>
