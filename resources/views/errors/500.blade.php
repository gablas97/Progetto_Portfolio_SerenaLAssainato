<x-errors-layout>

    <section>

        <span class="error-code">500</span>

        <h1 class="error-message">{{ __('ui.errors.500.title') }}</h1>

        <p class="error-description">{!! __('ui.errors.500.message') !!}</p>

        <a href="{{ route('homepage') }}" class="btn-underline">{{ __('ui.errors.500.button') }}</a>

    </section>

</x-errors-layout>