@extends('layouts.landing')

@section('content')
<div class="container my-5 py-5">
    <h2 class="mb-4">Pengaturan Profil</h2>

    {{-- SECTION 1: Konfirmasi Email --}}
    <div class="mb-5">
        <h4>Konfirmasi Email</h4>
        @if (auth()->user()->email_verified_at)
        <div class="alert alert-success">Email Anda sudah terverifikasi.</div>
        @else
        <div class="alert alert-warning">
            <form action="{{ route('profile.verificationMail.send') }}" method="POST" class="d-inline">
                <p>
                    Email Anda belum terverifikasi.
                </p>
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">Kirim Email Verifikasi</button>
            </form>
        </div>
        @endif
    </div>

    {{-- SECTION 2: Informasi Profil --}}
    <div class="mb-5">
        <h4>Informasi Profil</h4>
        <form action="#" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address"
                    rows="3">{{ auth()->user()->address ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ auth()->user()->phone ?? '' }}">
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>

    {{-- SECTION 3: Ganti Password --}}
    <div class="mb-5">
        <h4>Ganti Password</h4>
        <form action="#" method="POST">
            @csrf
            <div class="mb-3">
                <label for="current_password" class="form-label">Password Saat Ini</label>
                <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password">
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="new_password" name="new_password"
                    oninput="checkPasswordStrength()" autocomplete="new-password">
                <small id="password-strength-text" class="form-text text-muted"></small>
                <div class="progress mt-2" style="height: 5px;">
                    <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                </div>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="new-password">
            </div>
            <button type="submit" class="btn btn-warning">Ubah Password</button>
        </form>
    </div>

    {{-- SECTION 4: Hapus Akun --}}
    <div class="mb-5">
        <h4 class="text-danger">Hapus Akun</h4>
        <p class="text-muted">Akun Anda akan dihapus secara permanen dan tidak bisa dikembalikan.</p>
        <form action="#" method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun Anda secara permanen?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus Akun</button>
        </form>
    </div>
</div>

{{-- Script Password Strength --}}
@push('scripts')
<script>
    function checkPasswordStrength() {
        const password = document.getElementById("new_password").value;
        const strengthBar = document.getElementById("password-strength-bar");
        const strengthText = document.getElementById("password-strength-text");

        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        let barClass = "bg-danger";
        let width = "25%";
        let text = "Lemah";

        if (strength >= 3) {
            barClass = "bg-warning";
            width = "50%";
            text = "Sedang";
        }
        if (strength === 4) {
            barClass = "bg-success";
            width = "100%";
            text = "Kuat";
        }

        strengthBar.style.width = width;
        strengthBar.className = "progress-bar " + barClass;
        strengthText.innerText = "Kekuatan password: " + text;
    }
</script>
@endpush
@endsection