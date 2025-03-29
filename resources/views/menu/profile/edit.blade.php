@extends('layout.app')

@section('content')
<div class="min-h-screen">
    <div class="py-2 flex justify-between mx-2 bg-white ">
        <div class="ms-1">
        <a href="/profile">
            <i class=" text-xl bi bi-arrow-left "></i>
        </a>
        </div>
        <div>
            <p class="font-bold">EDIT PROFILE</p>
        </div>
        <div class="">
            <a href="/home">
                <i class="text-xl bi bi-house"></i>
            </a>
        </div>
    </div>
     <!-- Alert Pesan -->
     @if(session('success'))
            <div class="p-3 mb-4 text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-3 mb-4 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif
    <div class="flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    
        <form id="passwordForm" action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Upload Foto Profil -->
            <div class="mb-4 flex flex-col items-center">
                <label class="relative w-24 h-24 rounded-full overflow-hidden shadow-md cursor-pointer">
                    @if(auth()->user()->profile_picture == null)
                    <img src="{{ asset('images/default.jpeg') }}" alt="" class="rounded-full h-full w-full object-cover">
                    @endif
                    @if(auth()->user()->profile_picture != null)
                    <img src="{{ asset(auth()->user()->profile_picture ? 'storage/photos/' . auth()->user()->profile_picture : 'images/default.jpeg') }}" alt="" class="rounded-full h-full w-full object-cover">
                    @endif
                    <input type="file" name="profile_picture" class="hidden" onchange="previewImage(event)">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition">
                        <i class="bi bi-camera text-white text-lg"></i>
                    </div>
                </label>
                <p class="text-sm text-gray-500 mt-2">Klik untuk mengganti foto</p>
            </div>

            <!-- Input Nama -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{auth()->user()->name}}"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Input Nama -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-600">No Telepon</label>
                <input type="text" id="phone" name="phone" value="{{auth()->user()->phone}}"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Pilih Divisi Magang -->
            <!-- <div class="mb-4">
                <label for="division" class="block text-sm font-medium text-gray-600">Divisi Magang</label>
                <select id="division" name="division"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Divisi</option>
                    @foreach ($devisi as $division)
                        <option value="{{ $division->id }}" {{ $user->division_id == $division->id ? 'selected' : '' }}>
                            {{ $division->name_divisions }}
                        </option>
                    @endforeach
                </select>
            </div> -->


            <!-- Tombol Simpan -->
            <label for="modal_edit_user"
                class="btn w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Simpan Perubahan
            </label>
                    <!-- modal simpan perubahan -->
                    <input type="checkbox" id="modal_edit_user" class="modal-toggle" />
                    <div class="modal" role="dialog">
                    <div class="modal-box">
                        <p class="py-4">apakah anda yakin dengan Perubahan yang anda lakuan</p>
                        <div class="modal-action text-sm">
                        <label for="modal_edit_user" class="btn">batal</label>
                        <button id="submitBtn" type="submit" class="btn bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">Ya</button>
                        </div>
                    </div>
                    </div>
                    <!-- modal simpan perubahan end-->
        </form>

        <!-- Kembali -->
        <div class="text-center mt-4">
            <a href="/info-profile" class="text-blue-600 hover:underline text-sm">Kembali ke Profil</a>
        </div>
    </div>
</div>

<script>
        document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("passwordForm");
        form.addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Mencegah submit saat Enter ditekan
            }
        });

        // Tangani submit hanya lewat tombol modal
        document.getElementById("submitBtn").addEventListener("click", function () {
            form.submit();
        });
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var img = document.querySelector('img');
            img.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
