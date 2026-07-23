<!DOCTYPE html>
<html lang="{{ get_active_locale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sayfa Bulunamadı - 404 | Dioreal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Jost:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <style>
        body {
            background-color: var(--near-black);
            color: var(--white);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: space-between;
            font-family: var(--font-body);
        }
        .error-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 6rem 2rem;
        }
        .error-code {
            font-family: var(--font-display);
            font-size: clamp(6rem, 15vw, 12rem);
            font-weight: 300;
            color: var(--accent);
            line-height: 1;
            letter-spacing: .05em;
        }
        .error-title {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 300;
            margin: 1.5rem 0;
        }
        .error-desc {
            color: rgba(255, 255, 255, 0.7);
            max-width: 500px;
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 2.5rem;
        }
        .error-btns {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn-gold {
            background: var(--accent);
            color: var(--near-black);
            padding: .9rem 2.5rem;
            text-transform: uppercase;
            letter-spacing: .2em;
            font-size: .8rem;
            text-decoration: none;
            border-radius: 30px;
            transition: all .3s;
        }
        .btn-gold:hover {
            background: var(--white);
        }
    </style>
</head>
<body>
    <nav id="mainNav" style="background: transparent;">
        <div class="nav-logo-wrapper">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="logo-text" style="color: var(--white);">DIOREAL</span>
            </a>
        </div>
    </nav>

    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-title">
            <span class="lang-text-tr">Aradığınız Sayfa Bulunamadı</span>
            <span class="lang-text-en">Page Not Found</span>
        </h1>
        <p class="error-desc">
            <span class="lang-text-tr">Aradığınız içerik kaldırılmış, adı değiştirilmiş veya geçici olarak erişilemiyor olabilir.</span>
            <span class="lang-text-en">The content you are looking for might have been removed, renamed, or is temporarily unavailable.</span>
        </p>
        <div class="error-btns">
            <a href="{{ route('home') }}" class="btn-gold">
                <span class="lang-text-tr">Ana Sayfaya Dön</span>
                <span class="lang-text-en">Back to Home</span>
            </a>
            <a href="{{ route('journal') }}" class="btn btn-outline" style="border-color: var(--white); color: var(--white);">
                <span class="lang-text-tr">Journal'a Git</span>
                <span class="lang-text-en">Go to Journal</span>
            </a>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
