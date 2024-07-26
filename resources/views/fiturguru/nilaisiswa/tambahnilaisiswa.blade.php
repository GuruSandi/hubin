<div class="custom-modal-backdrop" id="modalBackdrop" style="display: none;"></div>
<div class="custom-modal custom-modal-tambah" id="modal" style="display: none;">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <div class="row">
                <div class="col-6">
                    <h5 class="custom-modal-title">Tambah Nilai Siswa</h5>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="custom-close-btn" onclick="closeModal()">&times;</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="formTambahNilai">
                @csrf
                <label for="" class="mb-2 fw-bold" style="color: rgb(19, 19, 59)">Pilih Siswa</label>
                <select style="width: 99.7%" class="form-control form-control-lg mb-3 " id="siswas"
                    name="siswa_ids[]" multiple="multiple">
                    @foreach ($siswa_tersedia as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <div class="form-group">
                    <label for="nilai1">Nilai 1</label>
                    <input type="number" class="form-control" id="nilai1" name="nilai1" required>
                </div>
                <div class="form-group">
                    <label for="nilai2">Nilai 2</label>
                    <input type="number" class="form-control" id="nilai2" name="nilai2" required>
                </div>
                <div class="form-group">
                    <label for="nilai3">Nilai 3</label>
                    <input type="number" class="form-control" id="nilai3" name="nilai3" required>
                </div>
                <div class="form-group">
                    <label for="nilai4">Nilai 4</label>
                    <input type="number" class="form-control" id="nilai4" name="nilai4" required>
                </div>
                <div class="custom-modal-footer">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-1">Simpan</button>

                        <button type="button" class="btn btn-danger" onclick="closeModal()">Batal</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
{{-- @foreach ($nilaisiswa as $item)
            <div class="custom-modal-backdrop" id="modalBackdrop{{ $item->id }}" style="display: none;"></div>
            <div class="custom-modal" id="modal{{ $item->id }}" style="display: none;">
                <div class="custom-modal-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="custom-modal-title">Detail Nilai Siswa</h5>

                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="custom-close-btn"
                                    onclick="closeModal({{ $item->id }})">&times;</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-body">
                    
                </div>
                <div class="custom-modal-footer">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary"
                            onclick="closeModal({{ $item->id }})">Close</button>
                    </div>

                </div>
            </div>
        @endforeach --}}
