<!-- Modal Backdrop -->
<div class="custom-modal-backdrop" id="modalBackdropAdd" style="display: none;"></div>

<!-- Modal Content -->
<div class="custom-modal custom-modal-tambah" id="tambah-nilai" style="display: none;">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <div class="row">
                <div class="col-6">
                    <h5 class="custom-modal-title">Tambah Nilai Siswa</h5>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="custom-close-btn" onclick="closeAddModal()">&times;</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <form action="{{ route('nilaisiswa.tambahnilaisiswa') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Select Siswa -->
                <label for="siswa" class="mb-2">Nama Siswa</label>
                <select style="width: 99.7%" class="form-control form-control-lg mb-3" id="siswa" name="siswa_ids" required>
                    @foreach ($siswa_tersedia as $item)
                        <option value="{{ $item->siswa->id }}">{{ $item->siswa->nama }} - {{ $item->siswa->kelas }}</option>
                    @endforeach
                </select>
                
                <!-- Hidden Input for guru_mapel_pkl_id -->
                <input type="hidden" class="form-control" value="{{ $item->guru_mapel_pkl_id }}" id="guru_mapel_pkl_id" name="guru_mapel_pkl_id" required>

                <!-- Input Fields for Scores -->
                <div class="row">
                    <div class="form-group mt-3">
                        <label for="nilai1">Internalisasi dan Penerapan Soft Skills</label>
                        <input type="number" class="form-control" id="nilai1" name="nilai1" required>
                        <div class="invalid-feedback" id="nilai1-feedback"></div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="nilai2">Penerapan Hard Skills</label>
                        <input type="number" class="form-control" id="nilai2" name="nilai2" required>
                        <div class="invalid-feedback" id="nilai2-feedback"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group">
                        <label for="nilai3">Peningkatan dan Pengembangan Hard Skills</label>
                        <input type="number" class="form-control" id="nilai3" name="nilai3" required>
                        <div class="invalid-feedback" id="nilai3-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="nilai4">Penyiapan Kemandirian Berwirausaha</label>
                        <input type="number" class="form-control" id="nilai4" name="nilai4" required>
                        <div class="invalid-feedback" id="nilai4-feedback"></div>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="custom-modal-footer">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-1">Simpan</button>
                        <button type="button" class="btn btn-danger" onclick="closeAddModal()">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk memeriksa nilai dan menampilkan pesan kesalahan
        function validateInput(id, min, max) {
            var input = document.getElementById(id);
            var feedback = document.getElementById(id + '-feedback');
            var submitButton = document.querySelector('#tambah-nilai .btn-primary');
            
            input.addEventListener('input', function() {
                var value = parseInt(input.value, 10);
                
                if (isNaN(value) || value < min || value > max) {
                    feedback.textContent = `Nilai harus berada dalam rentang ${min} hingga ${max}.`;
                    feedback.style.display = 'block';
                    input.classList.add('is-invalid');
                    submitButton.disabled = true; // Disable submit button
                } else {
                    feedback.textContent = '';
                    feedback.style.display = 'none';
                    input.classList.remove('is-invalid');
                    
                    // Check if all inputs are valid to enable the submit button
                    var allValid = Array.from(document.querySelectorAll('#tambah-nilai .form-control')).every(function(el) {
                        var value = parseInt(el.value, 10);
                        return !isNaN(value) && value >= min && value <= max;
                    });
                    submitButton.disabled = false;
                }
            });
        }

        // Terapkan validasi untuk semua input yang relevan
        validateInput('nilai1', 1, 100);
        validateInput('nilai2', 1, 100);
        validateInput('nilai3', 1, 100);
        validateInput('nilai4', 1, 100);

        
    });
</script>
