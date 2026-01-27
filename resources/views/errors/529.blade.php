<x-errors-layout>

    <section>

        <span class="error-code">529</span>

        <h1 class="error-message">Servizio non disponibile</h1>

        <p class="error-description">
            Il servizio è momentaneamente non disponibile.<br>
            Riprova più tardi.
        </p>

        <a href="{{ url()->current() }}" class="btn-underline">Ricarica la pagina</a>

    </section>

</x-errors-layout>