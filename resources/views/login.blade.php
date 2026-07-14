<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dioreal Dijital — Admin Girişi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css?v={{ time() }}">
    <style>
        :root {
            --primary: #c4a47c;
            --primary-hover: #b3936a;
            --bg-dark: #0d0c0b;
            --white: #ffffff;
            --text-light: #f8fafc;
            --text-muted: #94a3b8;
            --error: #ef4444;
            --radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Ambient background image with dark overlay */
        .background-container {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset("foto.img/hero_4k.jpg") }}');
            background-size: cover;
            background-position: center;
            filter: brightness(0.35);
            z-index: 1;
            transform: scale(1.05);
            animation: zoomBg 20s infinite alternate ease-in-out;
        }

        @keyframes zoomBg {
            0% { transform: scale(1.05); }
            100% { transform: scale(1.12); }
        }

        .background-overlay {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(15, 23, 42, 0.4) 0%, rgba(13, 12, 11, 0.8) 100%);
            z-index: 2;
        }

        /* Glassmorphic Login Container */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 1.5rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s forwards cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            padding: 3.5rem 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .logo-area {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            position: relative;
        }

        .logo-area span {
            color: var(--primary);
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
            font-weight: 400;
        }

        /* Form Controls */
        .form-group {
            position: relative;
            margin-bottom: 1.25rem;
            text-align: left;
        }

        .form-group i {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .form-group input {
            width: 100%;
            padding: 1.1rem 1rem 1.1rem 3.2rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius);
            outline: none;
            color: var(--white);
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-group input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(196, 164, 124, 0.15);
        }

        .form-group input:focus + i {
            color: var(--primary);
        }

        /* Error messages */
        .error-container {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: var(--radius);
            padding: 0.9rem 1.2rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #fca5a5;
            font-size: 0.9rem;
            text-align: left;
            animation: shake 0.4s linear;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 1.1rem;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .login-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(196, 164, 124, 0.25);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .back-link {
            display: inline-block;
            margin-top: 2rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .back-link i {
            margin-right: 0.4rem;
        }
    </style>
</head>
<body>

    <div class="background-container"></div>
    <div class="background-overlay"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="logo-area">DIOREAL<span>.</span></div>
            <p class="subtitle">Yönetim Paneline Giriş Yapın</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                @if ($errors->has('login_error'))
                    <div class="error-container">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first('login_error') }}</span>
                    </div>
                @endif

                <div class="form-group">
                    <input type="text" name="username" id="username" placeholder="Kullanıcı Adı" required autofocus value="{{ old('username') }}">
                    <i class="fas fa-user"></i>
                </div>

                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Şifre" required>
                    <i class="fas fa-lock"></i>
                </div>

                <button type="submit" class="login-btn">
                    Giriş Yap <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <a href="{{ route('home') }}" class="back-link">
                <i class="fas fa-chevron-left"></i> Web Sitesine Dön
            </a>
        </div>
    </div>

</body>
</html>
