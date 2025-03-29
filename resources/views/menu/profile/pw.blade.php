@extends('layout.app')

@section('content')
<div class="h-screen">
    <div class="py-2 bg-white flex justify-between mx-2">
        <div>
            <a href="/profile">
                <i class=" text-xl bi bi-arrow-left "></i>
            </a>
        </div>
        <div>
            <p class="font-bold">GANTI SANDI</p>
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
    <div class=" flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 mt-12">
        
        <form id="passwordForm" action="{{ route('password.update') }}" method="POST">
            @csrf
            
            <!-- Sandi Baru -->
            <div class="mb-4 relative" x-data="{ show: false }">
                <label for="new_password" class="block text-sm font-medium text-gray-600">Sandi Baru</label>
                <input :type="show ? 'text' : 'password'" id="new_password" name="new_password"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" required>
                    <p id="length-error" class="text-red-500 text-sm mt-1 hidden">Minimal 6 karakter!</p>
                <button type="button" class="absolute top-9 right-3 text-gray-600" 
                    @click="show = !show">
                    <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                </button>
            </div>

            <!-- Konfirmasi Sandi Baru -->
            <div class="mb-4 relative" x-data="{ show: false }">
                <label for="confirm_password" class="block text-sm font-medium text-gray-600">Konfirmasi Sandi Baru</label>
                <input :type="show ? 'text' : 'password'" id="confirm_password" name="confirm_password"
                    class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" required>
                    <p id="match-error" class="text-red-500 text-sm mt-1 hidden">Sandi tidak cocok!</p>
                <button type="button" class="absolute top-9 right-3 text-gray-600" 
                    @click="show = !show">
                    <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                </button>
            </div>


            <label for="modal_edit_user"
                class="btn btn-md bg-[#537FE7] border-none hover:bg-[#537FE7] text-[#ededed]  shadow-lg shadow-blue-500/50 w-full">
                Simpan Perubahan
            </label>
            <!-- modal simpan perubahan -->
            <input type="checkbox" id="modal_edit_user" class="modal-toggle" />
                    <div class="modal" role="dialog">
                    <div class="modal-box">
                        <p class="py-4"> <strong>Apakah Anda yakin ingin mengubah kata sandi?</strong> Pastikan Anda mengingat kata sandi baru untuk menghindari kesulitan saat login.</p>
                        <div class="modal-action text-sm">
                        <label for="modal_edit_user" class="btn">batal</label>
                        <button  id="submitBtn"  type="submit" class="btn bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">Ya</button>
                        </div>
                    </div>
                    </div>
                    <!-- modal simpan perubahan end-->
        </form>
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
    
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("passwordForm");
    const newPassword = document.getElementById("new_password");
    const confirmPassword = document.getElementById("confirm_password");
    const lengthError = document.getElementById("length-error");
    const matchError = document.getElementById("match-error");
    const submitBtn = document.getElementById("submitBtn");

    function validatePassword() {
        let isValid = true;

        // Validasi panjang password minimal 6 karakter
        if (newPassword.value.length < 6) {
            lengthError.classList.remove("hidden");
            isValid = false;
        } else {
            lengthError.classList.add("hidden");
        }

        // Validasi kecocokan password baru dan konfirmasi
        if (newPassword.value !== confirmPassword.value) {
            matchError.classList.remove("hidden");
            isValid = false;
        } else {
            matchError.classList.add("hidden");
        }

        // Enable atau disable tombol submit
        submitBtn.disabled = !isValid;
    }

    newPassword.addEventListener("input", validatePassword);
    confirmPassword.addEventListener("input", validatePassword);

    form.addEventListener("submit", function(event) {
        validatePassword();

        if (submitBtn.disabled) {
            event.preventDefault(); // Mencegah submit jika validasi gagal
        }
    });
});
</script>
@endsection