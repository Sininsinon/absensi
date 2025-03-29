<form action="{{ route('password.verify') }}" method="POST">
    @csrf
    <input type="text" name="code" placeholder="Masukkan Kode OTP" required>
    <button type="submit">Verifikasi</button>
</form>
