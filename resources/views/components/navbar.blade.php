@props(['textColor' => 'text-s'])

<nav class="container pt-5">
    <div class="row justify-content-center align-items-center mb-3">
        <div class="col-12 text-center">
            <a href="{{ route('homepage') }}">
                <h1 class="{{ $textColor }} fs-2 title-1 mb-0">.Serena</h1>
                <h1 class="{{ $textColor }} fs-2 title-2">L’Assainato</h1>
            </a>
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="col-8 text-center">
            <ul class="d-flex justify-content-evenly align-items-center list-unstyled {{ $textColor }} px-5 pt-4">
                <li class="mx-2"><a href="{{ route('project.index') }}" class="t-05">PROJECTS</a></li>
                <li class="mx-2"><a href="{{ route('insight.index') }}" class="t-05">NEWS & INSIGHTS</a></li>
                <li class="mx-2"><a href="{{ route('about') }}" class="t-05">ABOUT</a></li>
                <li class="mx-2"><a href="{{ route('contacts') }}" class="t-05">CONTACTS</a></li>
            </ul>
        </div>
    </div>
</nav>