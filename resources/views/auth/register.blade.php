@extends('layouts.auth')

@section('title', 'Daftar Akun')

@section('content')
    <div class="auth-header">
        <h1>Buat Akun Baru</h1>
        <p>Daftar untuk mulai menggunakan sistem perpustakaan</p>
    </div>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label" for="name">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}"
                   placeholder="Nama lengkap Anda" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email') }}"
                   placeholder="nama@email.com" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Kata Sandi</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" placeholder="Minimal 8 karakter" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
            <input type="password" class="form-control"
                   id="password_confirmation" name="password_confirmation"
                   placeholder="Ulangi kata sandi" required>
        </div>

        <button type="submit" class="btn-auth">
            📝 Daftar Sekarang
        </button>
    </form>

    <div class="auth-footer">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
@endsection