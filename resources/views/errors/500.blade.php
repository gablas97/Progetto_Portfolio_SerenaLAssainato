<x-errors-layout>

    <section>

        <span class="error-code">500</span>

        <h1 class="error-message">Servizio non disponibile</h1>

        <p class="error-description">
            Il servizio è momentaneamente non disponibile.<br>
            Riprova più tardi.
        </p>

        <a href="{{ route('homepage') }}" class="btn-underline">Torna alla homepage</a>

    </section>

</x-errors-layout>