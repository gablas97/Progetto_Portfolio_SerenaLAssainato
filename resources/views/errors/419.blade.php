<x-errors-layout>

    <section>

        <span class="error-code">419</span>

        <h1 class="error-message">{{ __('ui.errors.419.title') }}</h1>

        <p class="error-description">{!! __('ui.errors.419.message') !!}</p>

        <a href="{{ url()->current() }}" class="btn-underline">{{ __('ui.errors.419.button') }}</a>

    </section>

</x-errors-layout>