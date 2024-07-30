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
                <p><strong>Nama :</strong> {{ $item->siswa->nama }}</p>
                <p><strong>Kelas :</strong> {{ $item->siswa->kelas }}</p>

                <form action="{{ route('posteditdatanilaisiswa', $item->id) }}" class="form-group"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group mt-3">
                            <label for="editNilai1{{ $item->id }}">Internalisasi dan Penerapan Soft Skills</label>
                            <input type="number" class="form-control" id="editNilai1{{ $item->id }}" name="nilai1"
                                value="{{ $item->nilai1 }}" required>
                            <div class="invalid-feedback" id="editNilai1{{ $item->id }}-feedback"></div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="editNilai2{{ $item->id }}">Penerapan Hard Skills</label>
                            <input type="number" class="form-control" id="editNilai2{{ $item->id }}"
                                name="nilai2" value="{{ $item->nilai2 }}" required>
                            <div class="invalid-feedback" id="editNilai2{{ $item->id }}-feedback"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group">
                            <label for="editNilai3{{ $item->id }}">Peningkatan dan Pengembangan Hard Skills</label>
                            <input type="number" class="form-control" id="editNilai3{{ $item->id }}"
                                name="nilai3" value="{{ $item->nilai3 }}" required>
                            <div class="invalid-feedback" id="editNilai3{{ $item->id }}-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="editNilai4{{ $item->id }}">Penyiapan Kemandirian Berwirausaha</label>
                            <input type="number" class="form-control" id="editNilai4{{ $item->id }}"
                                name="nilai4" value="{{ $item->nilai4 }}" required>
                            <div class="invalid-feedback" id="editNilai4{{ $item->id }}-feedback"></div>
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