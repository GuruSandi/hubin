<!-- Modal Form Edit -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModal{{ $item->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal{{ $item->id }}Label">Edit Data Absensi Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit -->
                <p><strong>Nama :</strong> {{ $item->nama_siswa }}</p>
                <p><strong>Kelas :</strong> {{ $item->kelas_siswa }}</p>

                <form action="{{ route('posteditdataabsensisiswaperhari', $item->id) }}" class="form-group"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required name="tanggal"
                                value="{{ $item->tanggal }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Latitude</label>
                            <input type="number" class="form-control" required name="latitude"
                                value="{{ $item->latitude }}">
                            <label for="">Jam Masuk</label>
                            <input type="time" class="form-control" required name="jam_masuk"
                                value="{{ $item->jam_masuk }}">
                            <label for="">Jarak Absen</label>
                            <input type="text" class="form-control" required name="jarak"
                                value="{{ number_format($item->jarak, 0, ',', '.') }}">
                        </div>
                        <div class="col-6">
                            <label for="">Longitude</label>
                            <input type="number" class="form-control" required name="longitude"
                                value="{{ $item->longitude }}">
                            <label for="">Jam Pulang</label>
                            <input type="time" class="form-control" required name="jam_pulang"
                                value="{{ $item->jam_pulang }}">
                            <label for="">Keterangan</label>
                            <select name="keterangan" class="form-control" required>
                                <option value="hadir" @if ($item->keterangan == 'hadir') selected @endif>Hadir</option>
                                <option value="libur" @if ($item->keterangan == 'libur') selected @endif>Libur</option>
                                <option value="tidak_hadir_pkl" @if ($item->keterangan == 'tidak_hadir_pkl') selected @endif>Tidak
                                    Hadir PKL</option>
                                <option value="absen" @if ($item->keterangan == 'absen') selected @endif>Alpa</option>
                            </select>
                        </div>
                    </div>








                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
