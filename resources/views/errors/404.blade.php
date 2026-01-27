<x-errors-layout>

    <section>

        <span class="error-code">404</span>

        <h1 class="error-message">Pagina non trovata</h1>

        <p class="error-description">
            Spiacenti, la pagina che stai cercando non esiste oppure è stata spostata.
        </p>

        <a href="{{ route('homepage') }}" class="btn-underline">Torna alla homepage</a>

    </section>

</x-errors-layout>