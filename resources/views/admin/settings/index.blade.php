@extends('admin.layout.layout') 
@section('content')
<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="container">
            <h2>Pengaturan Absensi</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('attendance-settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="start_time" class="form-label">Jam Masuk</label>
                    <input type="time" name="start_time" id="start_time" class="form-control" 
                        value="{{ old('start_time', $setting->start_time) }}">
                </div>
                <div class="mb-5 ">
                    <label for="check_in_deadline" class="form-label">Batas Waktu Jam Masuk</label>
                    <input type="time" name="check_in_deadline" class="form-control" value="{{ old('check_in_deadline', $setting->check_in_deadline) }}" required>
                </div>
                <hr>
                <div class="mb-3 mt-4">
                    <label for="end_time" class="form-label">Jam Keluar</label>
                    <input type="time" name="end_time" id="end_time" class="form-control" 
                        value="{{ old('end_time', $setting->end_time) }}">
                </div>
                <div class="mb-5">
                    <label for="end_time" class="form-label"> Batas Waktu Jam Keluar</label>
                    <input type="time" name="check_out_deadline" class="form-control" value="{{ old('check_out_deadline', $setting->check_out_deadline) }}" required>
                </div>

                <hr>

                <!-- <div class="mb-3">
                    <label for="late_limit" class="form-label">Batas Keterlambatan (Menit)</label>
                    <input type="number" name="late_limit" id="late_limit" class="form-control" 
                        value="{{ old('late_limit', $setting->late_limit) }}">
                </div> -->

                <div class="mb-3 mt-4">
                        <label for="holidays" class="form-label">Tanggal Libur</label>
                        <input type="text" name="holidays" id="holidays" class="form-control" 
                            value="{{ old('holidays', implode(',', json_decode($setting->holidays ?? '[]'))) }}">
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="holiday_days">Hari Libur Tetap</label>
                            <input type="text" id="holidayDaysInput" name="holiday_days" class="hidden form-control mt-2"
                                value="{{ old('holiday_days', implode(',', json_decode($setting->holiday_days ?? '[]'))) }}" readonly required>

                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle w-100" type="button" id="dropdownHolidayButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pilih Hari Libur...
                                </button>
                                <div class="dropdown-menu w-100" aria-labelledby="dropdownHolidayButton">
                                    <a class="dropdown-item" href="#" data-value="none">Tidak Ada Hari Libur Tetap</a>
                                    <div class="dropdown-divider"></div> <!-- Garis pemisah -->
                                    <a class="dropdown-item" href="#" data-value="Sunday">Minggu</a>
                                    <a class="dropdown-item" href="#" data-value="Monday">Senin</a>
                                    <a class="dropdown-item" href="#" data-value="Tuesday">Selasa</a>
                                    <a class="dropdown-item" href="#" data-value="Wednesday">Rabu</a>
                                    <a class="dropdown-item" href="#" data-value="Thursday">Kamis</a>
                                    <a class="dropdown-item" href="#" data-value="Friday">Jumat</a>
                                    <a class="dropdown-item" href="#" data-value="Saturday">Sabtu</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>

document.addEventListener("DOMContentLoaded", function() {
    let holidayDaysInput = document.getElementById("holidayDaysInput");
    let dropdownItems = document.querySelectorAll(".dropdown-menu .dropdown-item");

    dropdownItems.forEach(item => {
        item.addEventListener("click", function(event) {
            event.preventDefault();
            let selectedValue = this.getAttribute("data-value");
            let currentValues = holidayDaysInput.value ? holidayDaysInput.value.split(",") : [];

            if (selectedValue === "none") {
                // Jika "Tidak Ada Hari Libur Tetap" dipilih, kosongkan semua
                holidayDaysInput.value = "";
            } else {
                // Jika memilih hari lain, hapus "none" dari daftar
                currentValues = currentValues.filter(value => value !== "none");

                if (!currentValues.includes(selectedValue)) {
                    currentValues.push(selectedValue);
                } else {
                    currentValues = currentValues.filter(value => value !== selectedValue);
                }

                holidayDaysInput.value = currentValues.join(",");
            }
        });
    });
});




document.addEventListener("DOMContentLoaded", function() {
    flatpickr("#holidays", {
        mode: "multiple", // Bisa pilih banyak tanggal
        dateFormat: "Y-m-d", // Format YYYY-MM-DD
        defaultDate: {!! json_encode(json_decode($setting->holidays ?? '[]')) !!} // Ambil dari database
    });
});
</script>
@endpush
