<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="detailModal{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal{{ $item->id }}Label">Data Instansi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama :</strong> {{ $item->siswa->nama }}</p>
                <p><strong>Kelas :</strong> {{ $item->siswa->kelas }}</p>
                <p><strong>Internalisasi dan Penerapan Soft Skills :</strong> {{ $item->nilai1 }}</p>
                <p><strong>Penerapan Hard Skills :</strong> {{ $item->nilai2 }}</p>
                <p><strong>Peningkatan dan Pengembangan Hard Skills :</strong> {{ $item->nilai3 }}</p>
                <p><strong>Penyiapan Kemandirian Berwirausaha :</strong> {{ $item->nilai4 }}</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>
