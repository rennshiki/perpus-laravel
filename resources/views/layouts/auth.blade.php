<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masuk') — LibraSystem</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink: #1a1208;
            --parchment: #faf6ef;
            --parchment-dark: #f0e9da;
            --gold: #c8923a;
            --gold-light: #e8b86d;
            --gold-pale: #f5e6cc;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--ink);
            min-height: 100vh;
            display: flex;
        }

        /* Left panel — decorative */
        .auth-panel-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .auth-panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(200,146,58,0.12) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(124,45,62,0.1) 0%, transparent 50%);
        }

        .auth-panel-left .book-art {
            font-size: 90px;
            margin-bottom: 32px;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 16px 40px rgba(200,146,58,0.3));
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .auth-panel-left .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            font-weight: 700;
            color: var(--gold-light);
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .auth-panel-left .brand-desc {
            font-size: 15px;
            color: rgba(200,146,58,0.5);
            text-align: center;
            max-width: 300px;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        .decorative-lines {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            border: 1px solid rgba(200,146,58,0.06);
            border-radius: 50%;
        }

        .decorative-lines::before {
            content: '';
            position: absolute;
            inset: 40px;
            border: 1px solid rgba(200,146,58,0.05);
            border-radius: 50%;
        }

        /* Right panel — form */
        .auth-panel-right {
            width: 460px;
            min-height: 100vh;
            background: var(--parchment);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 48px;
        }

        .auth-header {
            margin-bottom: 36px;
        }

        .auth-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 8px;
        }

        .auth-header p {
            font-size: 14px;
            color: #78716c;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #57534e;
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid rgba(26,18,8,0.12);
            border-radius: 9px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            background: white;
            color: var(--ink);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(200,146,58,0.12);
        }

        .form-control.is-invalid { border-color: #dc2626; }

        .invalid-feedback {
            font-size: 12px;
            color: #dc2626;
            margin-top: 5px;
        }

        .btn-auth {
            width: 100%;
            padding: 12px;
            background: var(--gold);
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 15px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 8px;
        }

        .btn-auth:hover {
            background: #b07828;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(200,146,58,0.3);
        }

        .auth-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 14px;
            color: #78716c;
        }

        .auth-footer a {
            color: var(--gold);
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover { text-decoration: underline; }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: rgba(26,18,8,0.1);
        }

        .divider-text {
            font-size: 12px;
            color: #a8a29e;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #78716c;
            cursor: pointer;
        }

        .checkbox-label input[type="checkbox"] { accent-color: var(--gold); }

        .demo-accounts {
            background: rgba(200,146,58,0.07);
            border: 1px solid rgba(200,146,58,0.2);
            border-radius: 9px;
            padding: 14px;
            margin-top: 20px;
        }

        .demo-accounts .demo-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #92400e;
            margin-bottom: 8px;
        }

        .demo-item {
            font-size: 12px;
            color: #78716c;
            margin-bottom: 3px;
        }

        .demo-item strong { color: var(--ink); }

        @media (max-width: 768px) {
            .auth-panel-left { display: none; }
            .auth-panel-right {
                width: 100%;
                padding: 40px 24px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-panel-left">
        <div class="decorative-lines"></div>
        <div class="book-art">📚</div>
        <div class="brand-name">LibraSystem</div>
        <div class="brand-desc">Sistem manajemen perpustakaan digital yang modern dan mudah digunakan.</div>
    </div>

    <div class="auth-panel-right">
        @yield('content')
    </div>
</body>
</html>