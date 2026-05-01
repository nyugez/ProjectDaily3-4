<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Data Alumni</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a237e 0%, #3f51b5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            padding: 40px 36px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-logo .icon {
            font-size: 48px;
        }

        .login-logo h1 {
            font-size: 22px;
            color: #1a237e;
            font-weight: 700;
            margin-top: 8px;
        }

        .login-logo p {
            font-size: 13px;
            color: #888;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3f51b5;
            box-shadow: 0 0 0 3px rgba(63,81,181,0.1);
        }

        .error-msg {
            color: #c62828;
            font-size: 12px;
            margin-top: 4px;
        }

        .alert-error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }

        .btn-login {
            width: 100%;
            background: #1a237e;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            background: #283593;
        }

        .info-box {
            margin-top: 24px;
            padding: 12px 14px;
            background: #e8eaf6;
            border-radius: 8px;
            font-size: 12px;
            color: #3f51b5;
            text-align: center;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-logo">
        <div class="icon">🎓</div>
        <h1>Sistem Data Alumni</h1>
        <p>Silakan login untuk melanjutkan</p>
    </div>

    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="contoh@email.com"
                required
                autofocus
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
            >
        </div>

        <div class="remember">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="btn-login">🔐 Login</button>
    </form>

    <div class="info-box">
        <strong>Akun Default Admin:</strong><br>
        Email: admin@alumni.ac.id<br>
        Password: password123
    </div>
</div>

</body>
</html>
