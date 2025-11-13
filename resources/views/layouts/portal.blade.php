<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('page-title', 'Smart Tuition Class Management System')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <style>
            :root {
                --canvas: #ebf9f4;
                --shell-gradient: radial-gradient(circle at 80% 10%, #ffffff 0%, #f1fbf5 45%, #dcf3e8 95%);
                --sidebar-top: #def5eb;
                --sidebar-bottom: #f5fffb;
                --sidebar-border: rgba(101, 162, 142, 0.25);
                --text-primary: #0f3429;
                --text-muted: #6a7f78;
                --active-bg: #0a4a39;
                --card-shadow: 0 28px 90px rgba(12, 58, 45, 0.14);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
                background: var(--shell-gradient);
                color: var(--text-primary);
                padding: 0;
            }

            .layout {
                width: 100%;
                min-height: 100vh;
                display: grid;
                grid-template-columns: 300px 1fr;
                gap: clamp(1.25rem, 2vw, 2.5rem);
                padding: clamp(1rem, 2vw, 2.25rem);
                align-items: stretch;
                transition: grid-template-columns 0.3s ease;
            }

            .layout.sidebar-collapsed {
                grid-template-columns: 0px 1fr;
            }

            .sidebar {
                background: linear-gradient(165deg, var(--sidebar-top), var(--sidebar-bottom));
                border-radius: 36px;
                padding: 2.1rem 1.9rem;
                display: flex;
                flex-direction: column;
                border: 1px solid var(--sidebar-border);
                box-shadow: 0 22px 60px rgba(12, 58, 45, 0.12);
                transition: transform 0.3s ease, opacity 0.3s ease;
                will-change: transform;
                position: relative;
                z-index: 2;
            }

            .layout.sidebar-collapsed .sidebar {
                transform: translateX(-120%);
                opacity: 0;
                pointer-events: none;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 2.4rem;
            }

            .brand-mark {
                width: 58px;
                height: 58px;
                border-radius: 18px;
                background: rgba(10, 74, 57, 0.12);
                color: #0d5340;
                font-size: 1.2rem;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .brand-copy {
                font-weight: 600;
                line-height: 1.25;
            }

            .menu {
                display: flex;
                flex-direction: column;
                gap: 0.45rem;
                flex: 1;
            }

            .menu-link {
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 0.85rem;
                padding: 0.9rem 1rem;
                border-radius: 20px;
                color: var(--text-muted);
                font-weight: 500;
                transition: background 0.2s ease, box-shadow 0.2s ease, color 0.2s ease;
            }

            .menu-link:focus-visible {
                outline: 2px solid #0a4a39;
                outline-offset: 2px;
            }

            .menu-link:hover {
                background: rgba(10, 74, 57, 0.08);
                color: var(--text-primary);
            }

            .menu-link.active {
                background: var(--active-bg);
                color: #fff;
                box-shadow: 0 18px 40px rgba(10, 74, 57, 0.4);
            }

            .menu-icon {
                width: 44px;
                height: 44px;
                border-radius: 16px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: rgba(12, 58, 45, 0.08);
                color: #0e3c2f;
            }

            .menu-link[data-accent='sun'] .menu-icon {
                background: rgba(255, 191, 134, 0.28);
                color: #d77721;
            }

            .menu-link[data-accent='berry'] .menu-icon {
                background: rgba(228, 176, 235, 0.3);
                color: #8c3f9a;
            }

            .menu-link[data-accent='sky'] .menu-icon {
                background: rgba(150, 205, 255, 0.26);
                color: #1f79d5;
            }

            .menu-link[data-accent='leaf'] .menu-icon {
                background: rgba(144, 219, 185, 0.3);
                color: #1a7e5e;
            }

            .menu-link[data-accent='amber'] .menu-icon {
                background: rgba(254, 216, 144, 0.3);
                color: #b86a07;
            }

            .menu-link[data-accent='slate'] .menu-icon {
                background: rgba(170, 184, 200, 0.32);
                color: #516071;
            }

            .menu-link[data-accent='navy'] .menu-icon {
                background: rgba(158, 182, 255, 0.32);
                color: #3f51b5;
            }

            .menu-link.active .menu-icon {
                background: rgba(255, 255, 255, 0.15);
                color: #fff;
            }

            .menu-icon svg {
                width: 20px;
                height: 20px;
                stroke: currentColor;
                stroke-width: 1.5;
                fill: none;
            }

            .menu-meta {
                margin-top: 1.9rem;
                border-top: 1px solid rgba(101, 162, 142, 0.25);
                padding-top: 1.2rem;
                display: flex;
                flex-direction: column;
                gap: 0.45rem;
            }

            .dashboard-card {
                background: #ffffff;
                border-radius: 48px;
                padding: clamp(2.75rem, 5vw, 4.25rem);
                box-shadow: var(--card-shadow);
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: stretch;
                position: relative;
                overflow: hidden;
            }

            .layout.sidebar-collapsed .dashboard-card {
                padding-left: clamp(3rem, 6vw, 5.5rem);
            }

            .dashboard-card::after {
                content: '';
                position: absolute;
                inset: auto -15% -60% auto;
                width: 460px;
                height: 460px;
                background: radial-gradient(circle, rgba(16, 168, 134, 0.18), transparent 70%);
                pointer-events: none;
            }

            .eyebrow {
                text-transform: uppercase;
                letter-spacing: 0.28em;
                font-size: 0.84rem;
                color: var(--text-muted);
                margin-bottom: 1.35rem;
            }

            h1 {
                margin: 0 0 1rem;
                font-size: clamp(2.5rem, 4vw, 3.3rem);
            }

            .lede {
                margin: 0;
                font-size: 1.15rem;
                color: #4f6660;
                line-height: 1.75;
                max-width: 640px;
            }

            .page-header {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
            }

            .page-content {
                margin-top: 0;
                display: flex;
                flex-direction: column;
                gap: 1rem;
                width: 100%;
            }

            .page-content.has-intro {
                margin-top: 2.2rem;
            }

            .pill {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.35rem 0.85rem;
                border-radius: 999px;
                background: rgba(10, 74, 57, 0.08);
                color: #0b4d3b;
                font-size: 0.85rem;
                font-weight: 600;
            }


            @media (max-width: 980px) {
                .layout {
                    grid-template-columns: 1fr;
                }

                .sidebar {
                    flex-direction: row;
                    flex-wrap: wrap;
                    gap: 1.2rem;
                }

                .menu {
                    flex-direction: row;
                    flex-wrap: wrap;
                }

                .menu-link {
                    flex: 1 1 45%;
                }

                .menu-meta {
                    width: 100%;
                    border-top: none;
                    padding-top: 0;
                    flex-direction: row;
                    flex-wrap: wrap;
                }
            }
        </style>
    </head>
    <body class="antialiased">
        @php($active = $active ?? 'dashboard')
        <div class="layout">
            <aside class="sidebar">
                <div class="brand">
                    <div class="brand-mark">ST</div>
                    <div class="brand-copy">
                        Smart Tuition<br />
                        Class Management System
                    </div>
                </div>

                <nav class="menu" aria-label="Primary">
                    <a href="{{ route('dashboard') }}" class="menu-link {{ $active === 'dashboard' ? 'active' : '' }}" @if ($active === 'dashboard') aria-current="page" @endif>
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 11L12 4L20 11V21H4V11Z" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9.5 21V13.5H14.5V21" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('courses') }}" class="menu-link {{ $active === 'courses' ? 'active' : '' }}" data-accent="sun" @if ($active === 'courses') aria-current="page" @endif>
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M6 5.5H18V19H6V5.5Z" stroke-linejoin="round" />
                                <path d="M9 3V8" stroke-linecap="round" />
                                <path d="M15 3V8" stroke-linecap="round" />
                            </svg>
                        </span>
                        <span>Courses</span>
                    </a>
                    <a href="{{ route('assignments') }}" class="menu-link {{ $active === 'assignments' ? 'active' : '' }}" data-accent="berry" @if ($active === 'assignments') aria-current="page" @endif>
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="4" y="5.5" width="16" height="13.5" rx="2" />
                                <path d="M8 10H16" stroke-linecap="round" />
                                <path d="M8 14H12" stroke-linecap="round" />
                            </svg>
                        </span>
                        <span>Assignment</span>
                    </a>
                    <a href="{{ route('exams') }}" class="menu-link {{ $active === 'exams' ? 'active' : '' }}" data-accent="sky" @if ($active === 'exams') aria-current="page" @endif>
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="1.6" fill="currentColor" />
                                <path d="M12 12V18" stroke-linecap="round" />
                                <path d="M7 20H17L21 9L12 4L3 9L7 20Z" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span>Exams</span>
                    </a>
                    <a href="{{ route('progress') }}" class="menu-link {{ $active === 'progress' ? 'active' : '' }}" data-accent="leaf" @if ($active === 'progress') aria-current="page" @endif>
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M5 18L10 13L14 17L19 12" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M13 7H19V13" stroke-linecap="round" />
                            </svg>
                        </span>
                        <span>Progress</span>
                    </a>
                    <a href="{{ route('calendar') }}" class="menu-link {{ $active === 'calendar' ? 'active' : '' }}" data-accent="amber" @if ($active === 'calendar') aria-current="page" @endif>
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="4" y="4.5" width="16" height="15" rx="2" />
                                <path d="M4 9.5H20" stroke-linecap="round" />
                                <path d="M9 9.5V19.5" stroke-linecap="round" />
                            </svg>
                        </span>
                        <span>Calendar</span>
                    </a>
                    <a href="{{ route('downloads') }}" class="menu-link {{ $active === 'downloads' ? 'active' : '' }}" data-accent="slate" @if ($active === 'downloads') aria-current="page" @endif>
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M7 7.5H17V17.5H7V7.5Z" stroke-linejoin="round" />
                                <path d="M10 7.5V5.5H14V7.5" stroke-linecap="round" />
                                <path d="M10 17.5V19.5H14V17.5" stroke-linecap="round" />
                            </svg>
                        </span>
                        <span>Downloads</span>
                    </a>
                    <a href="{{ route('inbox') }}" class="menu-link {{ $active === 'inbox' ? 'active' : '' }}" data-accent="navy" @if ($active === 'inbox') aria-current="page" @endif>
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 12C21 16.971 16.971 21 12 21C10.522 21 9.119 20.643 7.885 20C7.885 20 5 21 3 21C3 21 4 18.5 4 17C2.762 15.768 2 14.006 2 12C2 7.029 6.029 3 11 3C15.971 3 21 7.029 21 12Z" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="9" cy="11" r="1" fill="currentColor" />
                                <circle cx="13.5" cy="11" r="1" fill="currentColor" />
                            </svg>
                        </span>
                        <span>Inbox</span>
                    </a>
                </nav>

                <div class="menu-meta">
                    <a href="{{ route('settings') }}" class="menu-link {{ $active === 'settings' ? 'active' : '' }}">
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 15V12" stroke-linecap="round" />
                                <circle cx="12" cy="17.5" r="0.8" fill="currentColor" />
                                <path d="M9 3H15L16 7H8L9 3Z" stroke-linejoin="round" />
                                <path d="M5 7H19V21H5V7Z" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <span>System Settings</span>
                    </a>
                    <a href="{{ route('help') }}" class="menu-link {{ $active === 'help' ? 'active' : '' }}">
                        <span class="menu-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 16.5V12" stroke-linecap="round" />
                                <circle cx="12" cy="8.5" r="1" fill="currentColor" />
                            </svg>
                        </span>
                        <span>Help &amp; Support</span>
                    </a>
                </div>
            </aside>

            <main class="dashboard-card">
                @php($hasIntro = $__env->hasSection('eyebrow') || $__env->hasSection('heading') || $__env->hasSection('lede'))

                @if ($hasIntro)
                    <header class="page-header">
                        @hasSection('eyebrow')
                            <p class="eyebrow">@yield('eyebrow')</p>
                        @endif

                        @hasSection('heading')
                            <h1>@yield('heading')</h1>
                        @endif

                        @hasSection('lede')
                            <p class="lede">@yield('lede')</p>
                        @endif
                    </header>
                @endif

                @hasSection('content')
                    <div class="page-content{{ $hasIntro ? ' has-intro' : '' }}">
                        @yield('content')
                    </div>
                @endif
            </main>
        </div>
    </body>
</html>
