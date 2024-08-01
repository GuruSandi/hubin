<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="detailModal{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal{{ $item->id }}Label">Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p><strong>NIS :</strong> {{ $item->nis }}</p>
                <p><strong>Nama :</strong> {{ $item->nama }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $item->jenkel }}</p>
                <p><strong>Kelas :</strong> {{ $item->kelas }}</p>
                <p><strong>Tahun Ajar :</strong> {{ $item->tahun_ajar }}</p>
                <p><strong>Status :</strong> 
                    @if ($item->status == 'aktif')
                        Aktif
                    @elseif($item->status == 'tidak_aktif')
                        Tidak Aktif
                    @endif
                </p>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>
