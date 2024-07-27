<!-- Edit Modal -->
<div class="custom-modal-backdrop" id="editModalBackdrop{{ $item->id }}" style="display: none;"></div>
<div class="custom-modal" id="editModal{{ $item->id }}" style="display: none;">
    <div class="custom-modal-header">
        <div class="row">
            <div class="col-6">
                <h5 class="custom-modal-title">Edit Nilai Siswa</h5>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <button type="button" class="custom-close-btn"
                        onclick="closeEditModal({{ $item->id }})">&times;</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <form action="{{ route('nilaisiswa.editnilaisiswa', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="siswa" class="mb-2">Nama Siswa</label>
            <select style="width: 99.7%" class="form-control form-control-lg mb-3" id="siswas" name="siswa_id" required>
                @foreach ($siswa as $siswaItem)
                    <option value="{{ $siswaItem->siswa->id }}"
                        {{ $siswaItem->siswa->id == $item->siswa->id ? 'selected' : '' }}>
                        {{ $siswaItem->siswa->nama }} - {{ $siswaItem->siswa->kelas }}
                    </option>
                @endforeach
            </select>

            <div class="row">
                <div class="form-group mt-3">
                    <label for="editNilai1{{ $item->id }}">Internalisasi dan Penerapan Soft Skills</label>
                    <input type="number" class="form-control" id="editNilai1{{ $item->id }}" name="nilai1"
                        value="{{ $item->nilai1 }}" required>
                    <div class="invalid-feedback" id="editNilai1{{ $item->id }}-feedback"></div>
                </div>
                <div class="form-group mt-3">
                    <label for="editNilai2{{ $item->id }}">Penerapan Hard Skills</label>
                    <input type="number" class="form-control" id="editNilai2{{ $item->id }}" name="nilai2"
                        value="{{ $item->nilai2 }}" required>
                    <div class="invalid-feedback" id="editNilai2{{ $item->id }}-feedback"></div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group">
                    <label for="editNilai3{{ $item->id }}">Peningkatan dan Pengembangan Hard Skills</label>
                    <input type="number" class="form-control" id="editNilai3{{ $item->id }}" name="nilai3"
                        value="{{ $item->nilai3 }}" required>
                    <div class="invalid-feedback" id="editNilai3{{ $item->id }}-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="editNilai4{{ $item->id }}">Penyiapan Kemandirian Berwirausaha</label>
                    <input type="number" class="form-control" id="editNilai4{{ $item->id }}" name="nilai4"
                        value="{{ $item->nilai4 }}" required>
                    <div class="invalid-feedback" id="editNilai4{{ $item->id }}-feedback"></div>
                </div>
            </div>
            <div class="custom-modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mx-1" id="submitButton{{ $item->id }}">Simpan</button>
                    <button type="button" class="btn btn-danger"
                        onclick="closeEditModal({{ $item->id }})">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk memeriksa nilai dan menampilkan pesan kesalahan
        function validateInput(id, min, max) {
            var input = document.getElementById(id);
            var feedback = document.getElementById(id + '-feedback');
            var submitButton = document.querySelector('#editModal{{ $item->id }} .btn-primary');
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
                    var allValid = Array.from(document.querySelectorAll('.form-control')).every(function(el) {
                        var value = parseInt(el.value, 10);
                        return !isNaN(value) && value >= min && value <= max;
                    });
                    submitButton.disabled = false;
                }
            });
        }

        // Terapkan validasi untuk semua input yang relevan
        validateInput('editNilai1{{ $item->id }}', 1, 100);
        validateInput('editNilai2{{ $item->id }}', 1, 100);
        validateInput('editNilai3{{ $item->id }}', 1, 100);
        validateInput('editNilai4{{ $item->id }}', 1, 100);
    });
</script>
