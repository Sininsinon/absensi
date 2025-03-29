@extends('layout.app')

@section('content')
<div>
<div class="py-2 bg-white flex justify-between mx-2">
        <div>
            <a href="/profile">
                <i class=" text-xl bi bi-arrow-left "></i>
            </a>
        </div>
        <div>
            <p class="font-bold">RIWAYAT KEHADIRAN</p>
        </div>
        <div class="">
            <a href="/home">
                <i class="text-xl bi bi-house"></i>
            </a>
        </div>
    </div>

    <div class="flex justify-between items-center mx-2 mt-4">
            <label for="modal_print"  class="btn btn-sm btn-warning"> <i class="bi bi-printer text-xl"></i></label for="modal_print">
            <!-- modal print -->
            <input type="checkbox" id="modal_print" class="modal-toggle relative" />
                <div class="modal" role="dialog">
                    <div class="modal-box">
                        <p class="py-1">Unduh Sekarang untuk Mendapatkan File Anda!</p>
                        <div class="modal-action text-sm">
                        <label for="modal_print" class="bg-transparent  border-none hover:bg-transparent px-3 cursor-pointer absolute top-0 right-0"><i class="bi bi-x text-2xl"></i></label>
                        <a class="w-full" href="{{ route('attendance.pdf') }}"><button class="btn btn-success w-full text-white" >Download</button></a>
                        </div>
                    </div>
                </div>
                 <!-- modal print end-->
        <div x-data="{ open: false }" class="relative flex items-center">
            <!-- Form Input -->
            <div x-show="open" x-transition:enter="transition transform ease-out duration-300"
                x-transition:enter-start="-translate-x-40 opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition transform ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="-translate-x-40 opacity-0"
                class="absolute right-full mr-2 bg-white shadow-lg rounded-lg flex items-center px-4 py-2">
                <input id="searchInput" type="text" class="border-none focus:ring-0 outline-none px-2 w-45" placeholder="Cari...">
            </div>

            <!-- Tombol Search -->
            <button @click="open = !open" class="btn bg-white border-none btn-sm text-white rounded-xl focus:outline-none">
                <i class="bi bi-search text-xl text-blue-900"></i>
            </button>
        </div>
    </div>
    <div class="w-[100%]">
    <div class="overflow-x-hidden relative mx-1  mt-4 ">
        <table id="attendanceTable" class="w-full bg-[#ededed] shadow-md overflow-hidden text-xs overflow-y-auto">
            <thead class="bg-blue-500 text-white text-md sticky top-0">
                    <tr>
                        <th class="px-7 py-3 text-center">Tanggal</th>
                        <th class="px-7 py-3 text-center">Jam Masuk / Keluar</th>
                    </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($attendances as $attendance)
                    <tr class="hover:bg-gray-100 text-xs">
                        <td class="px-7 py-3 text-center">{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                        <td class="px-7 py-3 text-center">
                        @if ($attendance->is_cancelled)
                            <span class="text-red-900">Absen dibatalkan oleh sistem</span>
                        @else
                            {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') : '🙂' }} - {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') : '🙂' }}
                        @endif
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $('#attendanceTable').DataTable({
            "paging": true,  // Aktifkan pagination (Next/Previous)
            "lengthMenu": [5, 10, 25, 50], // Opsi jumlah data per halaman
            "pageLength": 10, // Default menampilkan 10 data per halaman
            "ordering": true, // Tidak perlu sorting otomatis
            "info": false, // Menampilkan info jumlah data
            "searching": false,
            "language": {
            "paginate": {
                "next": "next",
                "previous": "prev"
            }
        }

        });
    });



document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll("#attendanceTable tbody tr");

    searchInput.addEventListener("keyup", function () {
        const searchTerm = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const dateColumn = row.children[0].textContent.toLowerCase(); // Kolom Tanggal
            const timeColumn = row.children[1].textContent.toLowerCase(); // Kolom Jam Masuk/Keluar

            if (dateColumn.includes(searchTerm) || timeColumn.includes(searchTerm)) {
                row.style.display = ""; // Tampilkan baris
            } else {
                row.style.display = "none"; // Sembunyikan baris
            }
        });
    });
});
</script>
@endsection
