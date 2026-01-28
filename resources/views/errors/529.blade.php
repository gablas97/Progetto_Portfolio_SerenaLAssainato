<x-errors-layout>

    <section>

        <span class="error-code">529</span>

        <h1 class="error-message">{{ __('ui.errors.529.title') }}</h1>

        <p class="error-description">{!! __('ui.errors.529.message') !!}</p>

        <a href="{{ route('homepage') }}" class="btn-underline">{{ __('ui.errors.529.button') }}</a>

    </section>

</x-errors-layout>