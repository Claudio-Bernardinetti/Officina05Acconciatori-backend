<style>
    .sidebar {
        width: 240px;
        min-width: 240px;
        background: #111;
        border-right: 1px solid rgba(200, 180, 140, 0.12);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding: 0;
        font-family: 'Jost', sans-serif;
    }

    .sidebar-logo {
        padding: 2rem 1.8rem 1.5rem;
        border-bottom: 1px solid rgba(200, 180, 140, 0.1);
        margin-bottom: 0.5rem;
    }

    .sidebar-logo-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.4rem;
        font-weight: 400;
        color: #c8b48c;
        letter-spacing: 0.08em;
        line-height: 1;
    }

    .sidebar-logo-sub {
        font-size: 0.62rem;
        font-weight: 400;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(200, 180, 140, 0.35);
        margin-top: 0.3rem;
    }

    .sidebar-section-label {
        font-size: 0.58rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(200, 180, 140, 0.3);
        padding: 1.2rem 1.8rem 0.5rem;
    }

    .sidebar-nav {
        list-style: none;
        padding: 0 0.8rem;
        margin: 0;
    }

    .sidebar-nav li {
        margin-bottom: 2px;
    }

    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.75rem 1rem;
        border-radius: 3px;
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 300;
        color: rgba(232, 224, 213, 0.6);
        letter-spacing: 0.03em;
        transition: all 0.18s ease;
        border: 1px solid transparent;
    }

    .sidebar-nav a:hover {
        background: rgba(200, 180, 140, 0.07);
        border-color: rgba(200, 180, 140, 0.12);
        color: #e8e0d5;
    }

    .sidebar-nav a.active {
        background: rgba(200, 180, 140, 0.1);
        border-color: rgba(200, 180, 140, 0.2);
        color: #c8b48c;
    }

    .sidebar-icon {
        width: 16px;
        height: 16px;
        opacity: 0.6;
        flex-shrink: 0;
    }

    .sidebar-nav a:hover .sidebar-icon,
    .sidebar-nav a.active .sidebar-icon {
        opacity: 1;
    }

    .sidebar-divider {
        height: 1px;
        background: rgba(200, 180, 140, 0.08);
        margin: 0.8rem 1.8rem;
    }

    .sidebar-footer {
        margin-top: auto;
        padding: 1.5rem 1.8rem;
        border-top: 1px solid rgba(200, 180, 140, 0.08);
    }

    .sidebar-footer a {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        font-size: 0.75rem;
        font-weight: 300;
        letter-spacing: 0.08em;
        color: rgba(200, 180, 140, 0.4);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .sidebar-footer a:hover {
        color: #c8b48c;
    }
</style>

<div class="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <div class="sidebar-logo-title">Officina 05</div>
        <div class="sidebar-logo-sub">Backoffice</div>
    </div>

    <!-- Appuntamenti -->
    <div class="sidebar-section-label">Appuntamenti</div>
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('appointments.index') }}"
                class="{{ request()->routeIs('appointments.index') ? 'active' : '' }}">
                <svg class="sidebar-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="1" y="2" width="14" height="13" rx="2" />
                    <path d="M1 6h14M5 1v2M11 1v2" />
                </svg>
                Calendario
            </a>
        </li>
        <li>
            <a href="{{ route('appointments.create') }}"
                class="{{ request()->routeIs('appointments.create') ? 'active' : '' }}">
                <svg class="sidebar-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="8" cy="8" r="7" />
                    <path d="M8 5v6M5 8h6" />
                </svg>
                Nuovo Appuntamento
            </a>
        </li>
    </ul>

    <div class="sidebar-divider"></div>

    <!-- Prodotti -->
    <div class="sidebar-section-label">Prodotti</div>
    <ul class="sidebar-nav">
        <li>
            <a href="">
                <svg class="sidebar-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M2 2h2l2 7h6l1-4H5" />
                    <circle cx="7" cy="13" r="1" />
                    <circle cx="12" cy="13" r="1" />
                </svg>
                Prodotti
            </a>
        </li>
        <li>
            <a href="">
                <svg class="sidebar-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="2" width="12" height="12" rx="2" />
                    <path d="M8 5v6M5 8h6" />
                </svg>
                Aggiungi Prodotto
            </a>
        </li>
    </ul>

    <div class="sidebar-divider"></div>

    <!-- Negozio -->
    <ul class="sidebar-nav">
        <li>
            <a href="">
                <svg class="sidebar-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M1 6l1-4h12l1 4" />
                    <path d="M1 6v8h14V6" />
                    <path d="M6 14V9h4v5" />
                </svg>
                Vai al Negozio
            </a>
        </li>
    </ul>

    <!-- Footer -->
    <div class="sidebar-footer">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('sidebar-logout').submit();">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor"
                stroke-width="1.5">
                <path d="M6 2H3a1 1 0 00-1 1v10a1 1 0 001 1h3M10 11l3-3-3-3M13 8H6" />
            </svg>
            Logout
        </a>
        <form id="sidebar-logout" action="{{ route('logout') }}" method="POST" style="display:none">
            @csrf
        </form>
    </div>
</div>
