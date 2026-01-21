<nav class="navbar navbar-expand-md pt-5 {{ $attributes->get('class') }}">
    <div class="container flex-column">

        <!-- LOGO -->
        <div class="text-center mb-3">
            <a href="{{ route('homepage') }}" class="navbar-brand m-0">
                <h1 class="text-s fs-2 title-1 mb-0">.Serena</h1>
                <h1 class="text-s fs-2 title-2">L’Assainato</h1>
            </a>
        </div>

        <!-- HAMBURGER BUTTON (mobile & ipad) -->
        <button class="navbar-toggler custom-toggler mb-3"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
            <ul class="navbar-nav align-items-center gap-lg-4 text-s pt-lg-4">

                <li class="nav-item text-uppercase">
                    <a href="{{ route('project.index') }}"
                       class="nav-link t-05 {{ !request()->routeIs('project.*') && !request()->routeIs('homepage') ? 'inactive' : 'active' }}">
                        {{ __('ui.projects') }}
                    </a>
                </li>

                <li class="nav-item text-uppercase">
                    <a href="{{ route('insight.index') }}"
                       class="nav-link t-05 {{ !request()->routeIs('insight.*') && !request()->routeIs('homepage') ? 'inactive' : 'active' }}">
                        {{ __('ui.news') }}
                    </a>
                </li>

                <li class="nav-item text-uppercase">
                    <a href="{{ route('about') }}"
                       class="nav-link t-05 {{ !request()->routeIs('about') && !request()->routeIs('homepage') ? 'inactive' : 'active' }}">
                        {{ __('ui.about') }}
                    </a>
                </li>

                <li class="nav-item text-uppercase">
                    <a href="{{ route('contacts') }}"
                       class="nav-link t-05 {{ !request()->routeIs('contacts') && !request()->routeIs('homepage') ? 'inactive' : 'active' }}">
                        {{ __('ui.contacts') }}
                    </a>
                </li>

                <!-- LANGUAGE DROPDOWN -->
                <li class="nav-item dropdown language-dropdown">
                    <button
                        class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                        id="languageDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <span class="lang-label text-uppercase">
                            {{ app()->getLocale() }}
                        </span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm animate-dropdown">
                        <li>
                            <form action="{{ route('language.set', 'it') }}" method="POST">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center gap-2">
                                    🇮🇹 <span>Italiano</span>
                                </button>
                            </form>
                        </li>

                        <li>
                            <form action="{{ route('language.set', 'en') }}" method="POST">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center gap-2">
                                    🇬🇧 <span>English</span>
                                </button>
                            </form>
                        </li>

                        <li>
                            <form action="{{ route('language.set', 'fr') }}" method="POST">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center gap-2">
                                    🇫🇷 <span>Français</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>