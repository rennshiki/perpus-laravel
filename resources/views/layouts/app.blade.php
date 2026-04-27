<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan Digital') — LibraSystem</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink: #1a1208;
            --ink-light: #4a3f2f;
            --parchment: #faf6ef;
            --parchment-dark: #f0e9da;
            --gold: #c8923a;
            --gold-light: #e8b86d;
            --gold-pale: #f5e6cc;
            --burgundy: #7c2d3e;
            --sage: #4a7c59;
            --sidebar-w: 260px;
            --radius: 12px;
            --shadow: 0 4px 24px rgba(26,18,8,0.10);
            --shadow-lg: 0 8px 40px rgba(26,18,8,0.15);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--parchment);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--ink);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0;
            z-index: 100;
            padding: 0;
            box-shadow: 4px 0 32px rgba(26,18,8,0.18);
        }

        .sidebar-brand {
            padding: 28px 24px 24px;
            border-bottom: 1px solid rgba(200,146,58,0.2);
        }

        .sidebar-brand .logo-mark {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--gold-light);
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand .logo-mark .icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }

        .sidebar-brand .tagline {
            font-size: 11px;
            color: rgba(200,146,58,0.5);
            margin-top: 4px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 12px;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(200,146,58,0.4);
            padding: 4px 12px 8px;
            margin-top: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 9px;
            color: rgba(250,246,239,0.65);
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(200,146,58,0.12);
            color: var(--gold-light);
        }

        .nav-link.active {
            background: rgba(200,146,58,0.18);
            color: var(--gold-light);
            font-weight: 500;
        }

        .nav-link .nav-icon {
            width: 20px;
            text-align: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 16px 12px 20px;
            border-top: 1px solid rgba(200,146,58,0.1);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(200,146,58,0.07);
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--gold), var(--burgundy));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            font-weight: 600;
            color: white;
            flex-shrink: 0;
        }

        .user-info .user-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--parchment);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 130px;
        }

        .user-info .user-role {
            font-size: 11px;
            color: var(--gold-light);
            opacity: 0.7;
        }

        .logout-btn {
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 8px;
            color: rgba(250,246,239,0.4);
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
        }

        .logout-btn:hover {
            color: #e57373;
            background: rgba(229,115,115,0.08);
        }

        /* ─── MAIN CONTENT ─── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            height: 64px;
            background: var(--parchment);
            border-bottom: 1px solid rgba(26,18,8,0.07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--ink);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .main-content {
            flex: 1;
            padding: 32px;
        }

        /* ─── CARDS ─── */
        .card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(26,18,8,0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid rgba(26,18,8,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 600;
        }

        .card-body {
            padding: 24px;
        }

        /* ─── STAT CARDS ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(26,18,8,0.05);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }

        .stat-card.gold::before { background: linear-gradient(90deg, var(--gold), var(--gold-light)); }
        .stat-card.burgundy::before { background: linear-gradient(90deg, var(--burgundy), #b05070); }
        .stat-card.sage::before { background: linear-gradient(90deg, var(--sage), #6aaa7a); }
        .stat-card.ink::before { background: linear-gradient(90deg, var(--ink), var(--ink-light)); }

        .stat-icon {
            font-size: 28px;
            margin-bottom: 12px;
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--ink-light);
            font-weight: 400;
        }

        /* ─── BUTTONS ─── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-primary {
            background: var(--gold);
            color: white;
        }

        .btn-primary:hover {
            background: #b07828;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(200,146,58,0.3);
        }

        .btn-secondary {
            background: var(--parchment-dark);
            color: var(--ink);
            border: 1px solid rgba(26,18,8,0.1);
        }

        .btn-secondary:hover {
            background: var(--parchment);
        }

        .btn-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-danger:hover {
            background: #fecaca;
        }

        .btn-success {
            background: #d1fae5;
            color: #059669;
        }

        .btn-success:hover {
            background: #a7f3d0;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 6px;
        }

        /* ─── TABLE ─── */
        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead th {
            background: var(--parchment);
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: var(--ink-light);
            border-bottom: 2px solid rgba(26,18,8,0.08);
        }

        tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(26,18,8,0.05);
            color: var(--ink);
            vertical-align: middle;
        }

        tbody tr:hover td {
            background: var(--parchment);
        }

        tbody tr:last-child td { border-bottom: none; }

        /* ─── BADGE ─── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-gold { background: var(--gold-pale); color: #8a5e1a; }
        .badge-sage { background: #d1fae5; color: #065f46; }
        .badge-burgundy { background: #fce7f3; color: #7c2d3e; }
        .badge-gray { background: #f3f4f6; color: #4b5563; }

        /* ─── FORMS ─── */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-light);
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid rgba(26,18,8,0.12);
            border-radius: 8px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            background: white;
            color: var(--ink);
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(200,146,58,0.1);
        }

        .form-control.is-invalid {
            border-color: #dc2626;
        }

        .invalid-feedback {
            font-size: 12px;
            color: #dc2626;
            margin-top: 5px;
        }

        /* ─── ALERTS ─── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .alert-warning { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }

        /* ─── BOOK COVER ─── */
        .book-cover {
            width: 50px; height: 68px;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.15);
        }

        .book-cover-placeholder {
            width: 50px; height: 68px;
            background: linear-gradient(135deg, var(--gold-pale), var(--parchment-dark));
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.10);
        }

        /* ─── SEARCH BAR ─── */
        .search-wrap {
            position: relative;
            max-width: 320px;
        }

        .search-icon {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--ink-light);
            opacity: 0.5;
        }

        .search-input {
            width: 100%;
            padding: 9px 14px 9px 38px;
            border: 1.5px solid rgba(26,18,8,0.12);
            border-radius: 8px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            background: white;
            color: var(--ink);
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--gold);
        }

        /* ─── PAGINATION ─── */
        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid rgba(26,18,8,0.06);
        }

        .pagination-wrap .pagination {
            display: flex;
            gap: 6px;
            list-style: none;
        }

        .pagination .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border: 1.5px solid rgba(26,18,8,0.1);
            border-radius: 7px;
            color: var(--ink);
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
        }

        .pagination .page-item.active .page-link {
            background: var(--gold);
            border-color: var(--gold);
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.4;
            pointer-events: none;
        }

        .pagination .page-item .page-link:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* ─── PAGE HEADER ─── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.2;
        }

        .page-header .subtitle {
            font-size: 14px;
            color: var(--ink-light);
            margin-top: 4px;
        }

        /* ─── RESPONSIVE ─── */
        .hamburger { display: none; }

        @media (max-width: 768px) {
            :root { --sidebar-w: 0px; }

            .sidebar {
                transform: translateX(-260px);
                transition: transform 0.3s ease;
                width: 260px;
            }

            .sidebar.open { transform: translateX(0); }

            .main-wrap { margin-left: 0; }

            .hamburger {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px; height: 40px;
                border: none; background: none;
                cursor: pointer;
                color: var(--ink);
                font-size: 20px;
            }

            .main-content { padding: 20px 16px; }
            .topbar { padding: 0 16px; }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .main-content > * { animation: fadeIn 0.3s ease both; }

        /* Divider ornament */
        .ornament {
            text-align: center;
            color: var(--gold);
            opacity: 0.3;
            font-size: 16px;
            letter-spacing: 6px;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="logo-mark">
                <div class="icon">📚</div>
                LibraSystem
            </div>
            <div class="tagline">Sistem Perpustakaan Digital</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>

            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">🏠</span> Dashboard
            </a>

            <a href="{{ route('books.index') }}"
               class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                <span class="nav-icon">📖</span> Koleksi Buku
            </a>

            @if(auth()->user()->isAdmin())
                <div class="nav-section-label">Administrasi</div>

                <a href="{{ route('books.create') }}"
                   class="nav-link {{ request()->routeIs('books.create') ? 'active' : '' }}">
                    <span class="nav-icon">➕</span> Tambah Buku
                </a>

                <a href="{{ route('loans.index') }}"
                   class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span> Semua Peminjaman
                </a>
            @else
                <div class="nav-section-label">Peminjaman Saya</div>
                <a href="{{ route('loans.my') }}"
                   class="nav-link {{ request()->routeIs('loans.my') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span> Peminjaman Saya
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ auth()->user()->isAdmin() ? '🔑 Admin' : '👤 Anggota' }}</div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <span>🚪</span> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="main-wrap">
        <header class="topbar">
            <button class="hamburger" onclick="document.getElementById('sidebar').classList.toggle('open')">☰</button>
            <span class="topbar-title">@yield('title', 'Dashboard')</span>
            <div class="topbar-actions">
                <span style="font-size:13px; color:var(--ink-light);">
                    Selamat datang, <strong>{{ auth()->user()->name }}</strong>
                </span>
            </div>
        </header>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning">⚠️ {{ session('warning') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>