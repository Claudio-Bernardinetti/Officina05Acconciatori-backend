<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Officina 05') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Jost:wght@300;400;500&display=swap"
        rel="stylesheet">

    @vite(['resources/js/app.js'])

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            /* ✅ Sfondo leggermente più chiaro per migliore leggibilità */
            background-color: #1a1a1a;
            color: #ede8e0;
            font-family: 'Jost', sans-serif;
            font-weight: 300;
            min-height: 100vh;
        }

        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ─── NAVBAR ─────────────────────────────────── */
        .top-navbar {
            background: #111;
            border-bottom: 1px solid rgba(200, 180, 140, 0.12);
            padding: 0 2rem;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand-wrap {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            text-decoration: none;
        }

        .navbar-brand-wrap img {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            opacity: 0.9;
            object-fit: cover;
        }

        .navbar-brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 400;
            color: #c8b48c;
            letter-spacing: 0.06em;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-links a {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.9rem;
            font-size: 0.75rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(237, 232, 224, 0.55);
            text-decoration: none;
            border-radius: 2px;
            border: 1px solid transparent;
            transition: all 0.18s ease;
        }

        .navbar-links a:hover {
            color: #ede8e0;
            background: rgba(200, 180, 140, 0.07);
            border-color: rgba(200, 180, 140, 0.12);
        }

        .navbar-links a.active {
            color: #c8b48c;
            background: rgba(200, 180, 140, 0.08);
            border-color: rgba(200, 180, 140, 0.18);
        }

        /* Divider tra link nav */
        .nav-divider {
            width: 1px;
            height: 16px;
            background: rgba(200, 180, 140, 0.15);
            margin: 0 0.4rem;
        }

        /* Dropdown utente */
        .nav-user {
            position: relative;
        }

        .nav-user-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 0.9rem;
            font-size: 0.75rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(200, 180, 140, 0.7);
            background: transparent;
            border: 1px solid rgba(200, 180, 140, 0.2);
            border-radius: 2px;
            cursor: pointer;
            transition: all 0.18s ease;
        }

        .nav-user-btn:hover {
            color: #c8b48c;
            border-color: rgba(200, 180, 140, 0.4);
            background: rgba(200, 180, 140, 0.06);
        }

        .nav-user-btn svg {
            transition: transform 0.2s ease;
        }

        .nav-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #161616;
            border: 1px solid rgba(200, 180, 140, 0.15);
            border-radius: 3px;
            min-width: 180px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            z-index: 200;
        }

        .nav-dropdown.open {
            display: block;
        }

        .nav-dropdown a,
        .nav-dropdown button {
            display: block;
            width: 100%;
            padding: 0.7rem 1.2rem;
            font-family: 'Jost', sans-serif;
            font-size: 0.78rem;
            font-weight: 300;
            letter-spacing: 0.06em;
            color: rgba(237, 232, 224, 0.65);
            text-decoration: none;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            transition: all 0.15s ease;
            border-bottom: 1px solid rgba(200, 180, 140, 0.06);
        }

        .nav-dropdown a:last-child,
        .nav-dropdown button:last-child {
            border-bottom: none;
        }

        .nav-dropdown a:hover,
        .nav-dropdown button:hover {
            background: rgba(200, 180, 140, 0.07);
            color: #ede8e0;
        }

        .nav-dropdown .logout-btn {
            color: rgba(192, 82, 74, 0.6);
        }

        .nav-dropdown .logout-btn:hover {
            color: #c0524a;
            background: rgba(192, 82, 74, 0.06);
        }

        /* ─── MAIN ───────────────────────────────────── */
        main {
            flex: 1;
            display: flex;
        }

        /* ─── GLOBAL TEXT IMPROVEMENTS ───────────────── */
        /* ✅ Testo più chiaro e leggibile ovunque */
        p,
        li,
        span,
        div,
        td,
        th,
        label {
            color: inherit;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 400;
            color: #c8b48c;
        }

        /* Migliora leggibilità testi secondari */
        .text-muted {
            color: rgba(237, 232, 224, 0.45) !important;
        }

        /* Form inputs globali */
        .form-control,
        .form-select {
            background: #1e1e1e !important;
            border: 1px solid rgba(200, 180, 140, 0.18) !important;
            color: #ede8e0 !important;
            font-family: 'Jost', sans-serif !important;
        }

        .form-control:focus,
        .form-select:focus {
            background: #222 !important;
            border-color: rgba(200, 180, 140, 0.45) !important;
            box-shadow: none !important;
            color: #ede8e0 !important;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(200, 180, 140, 0.2);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(200, 180, 140, 0.35);
        }
    </style>
</head>

<body>
    <div id="app">

        <!-- ─── TOP NAVBAR ─────────────────────────────── -->
        <nav class="top-navbar">
            <!-- Brand -->
            <a class="navbar-brand-wrap" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/o05a-logo.jpg') }}" alt="Officina 05">
                <span class="navbar-brand-name">Officina 05</span>
            </a>

            <!-- Links -->
            <ul class="navbar-links">
                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                @guest
                    <li>
                        <div class="nav-divider"></div>
                    </li>
                    <li>
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">Registrati</a>
                        </li>
                    @endif
                @else
                    <li>
                        <div class="nav-divider"></div>
                    </li>
                    <!-- User dropdown -->
                    <li class="nav-user">
                        <button class="nav-user-btn" onclick="toggleDropdown()" id="userBtn">
                            {{ Auth::user()->name }}
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M2 4l3 3 3-3" />
                            </svg>
                        </button>
                        <div class="nav-dropdown" id="userDropdown">
                            <a href="{{ url('dashboard') }}">Dashboard</a>
                            <a href="{{ url('profile') }}">Profilo</a>
                            <button class="logout-btn" onclick="document.getElementById('logout-form').submit()">
                                Logout
                            </button>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>

        <!-- ─── MAIN CONTENT ──────────────────────────── -->
        <main>
            @yield('content')
        </main>

    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('open');
        }

        // Chiudi dropdown cliccando fuori
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('userBtn');
            const dropdown = document.getElementById('userDropdown');
            if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('open');
            }
        });
    </script>
</body>

</html>
