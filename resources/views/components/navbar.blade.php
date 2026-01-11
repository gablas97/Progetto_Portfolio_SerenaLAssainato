<nav class="container pt-5 {{ $attributes->get('class') }}">
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col-12 text-center">
            <a href="{{ route('homepage') }}">
                <h1 class="text-s fs-2 title-1 mb-0">.Serena</h1>
                <h1 class="text-s fs-2 title-2">L’Assainato</h1>
            </a>
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="col-8 text-center">
            <ul class="d-flex justify-content-evenly align-items-center list-unstyled text-s px-5 pt-4">
                <li class="mx-2 text-uppercase"><a href="{{ route('project.index') }}" class="t-05 {{ !request()->routeIs('project.*') && !request()->routeIs('homepage') ? 'inactive' : 'active' }}">{{ __('ui.projects')}}</a></li>
                <li class="mx-2 text-uppercase"><a href="{{ route('insight.index') }}" class="t-05 {{ !request()->routeIs('insight.*') && !request()->routeIs('homepage') ? 'inactive' : 'active' }}">{{ __('ui.news') }}</a></li>
                <li class="mx-2 text-uppercase"><a href="{{ route('about') }}" class="t-05 {{ !request()->routeIs('about') && !request()->routeIs('homepage') ? 'inactive' : 'active' }}">{{ __('ui.about') }}</a></li>
                <li class="mx-2 text-uppercase"><a href="{{ route('contacts') }}" class="t-05 {{ !request()->routeIs('contacts') && !request()->routeIs('homepage') ? 'inactive' : 'active' }}">{{ __('ui.contacts') }}</a></li>
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