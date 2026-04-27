@extends('layouts.auth')

@section('title', 'Masuk ke Sistem')

@section('content')
    <div class="auth-header">
        <h1>Selamat Datang</h1>
        <p>Masuk ke sistem perpustakaan untuk melanjutkan</p>
    </div>

    @if($errors->any())
        <div style="background:#fee2e2;border:1px solid #fecaca;color:#991b1b;padding:12px 16px;border-radius:8px;font-size:14px;margin-bottom:20px;">
            ❌ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label" for="email">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email') }}"
                   placeholder="nama@email.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Kata Sandi</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" placeholder="••••••••" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="remember-row">
            <label class="checkbox-label">
                <input type="checkbox" name="remember">
                Ingat saya
            </label>
        </div>

        <button type="submit" class="btn-auth">
            🔑 Masuk ke Sistem
        </button>
    </form>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>

    <div class="demo-accounts">
        <div class="demo-title">🧪 Akun Demo</div>
        <div class="demo-item"><strong>Admin:</strong> admin@library.com / password</div>
        <div class="demo-item"><strong>User:</strong> user@library.com / password</div>
    </div>
@endsection