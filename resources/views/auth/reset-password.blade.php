<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="password" name="password" placeholder="Password Baru" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <button type="submit">Ubah Password</button>
</form>
