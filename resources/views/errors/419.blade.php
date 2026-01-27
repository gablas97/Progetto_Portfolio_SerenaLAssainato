<x-errors-layout>

    <section>

        <span class="error-code">419</span>

        <h1 class="error-message">Sessione scaduta</h1>

        <p class="error-description">
            Spiacenti, la pagina è scaduta per motivi di sicurezza.<br>
            Ricarica la pagina o riprova.
        </p>

        <a href="{{ url()->current() }}" class="btn-underline">Ricarica la pagina</a>

    </section>

</x-errors-layout>