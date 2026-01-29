<x-errors-layout>

    <section>

        <span class="error-code">429</span>

        <h1 class="error-message">{{ __('ui.errors.429.title') }}</h1>

        <p class="error-description">{!! __('ui.errors.429.message') !!}</p>

        <a href="{{ route('homepage') }}" class="btn-underline">{{ __('ui.errors.429.button') }}</a>

    </section>

</x-errors-layout>