<x-errors-layout>

    <section>

        <span class="error-code">403</span>

        <h1 class="error-message">Accesso negato</h1>

        <p class="error-description">
            Spiacenti, non hai i permessi necessari per accedere a questa pagina.
        </p>
        
        <a href="{{ route('homepage') }}" class="btn-underline">Torna alla homepage</a>

    </section>

</x-errors-layout>