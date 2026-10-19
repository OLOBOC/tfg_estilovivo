<footer class="bg-[#292722] text-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-6 py-12 sm:px-8 md:grid-cols-[1fr_auto]">
        <div>
            <a href="{{ route('home') }}" class="font-serif text-2xl font-semibold tracking-tight">Estilo Vivo</a>
            <p class="mt-3 max-w-sm text-sm leading-6 text-white/65">Un espacio para cuidar de ti y encontrar tu estilo en Gijón.</p>
        </div>

        <nav aria-label="Enlaces legales" class="flex flex-wrap content-start gap-x-6 gap-y-3 text-sm text-white/75">
            <a href="{{ route('legal.aviso') }}" class="hover:text-white">Aviso legal</a>
            <a href="{{ route('legal.privacidad') }}" class="hover:text-white">Privacidad</a>
            <a href="{{ route('legal.cookies') }}" class="hover:text-white">Cookies</a>
            <a href="{{ route('legal.condiciones') }}" class="hover:text-white">Condiciones</a>
            <button type="button" data-cookie-preferences class="text-left hover:text-white">Preferencias de cookies</button>
        </nav>
    </div>
    <div class="border-t border-white/10">
        <p class="mx-auto max-w-7xl px-6 py-4 text-xs text-white/55 sm:px-8">
            &copy; {{ date('Y') }} Estilo Vivo. Todos los derechos reservados.
        </p>
    </div>
</footer>

<aside id="cookie-notice" data-cookie-notice role="region" aria-label="Información sobre cookies" class="fixed inset-x-4 bottom-4 z-50 mx-auto max-w-3xl rounded-2xl border border-black/10 bg-white p-5 text-[#292722] shadow-2xl sm:inset-x-6 sm:p-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="max-w-xl">
            <h2 class="text-sm font-semibold">Tu privacidad importa</h2>
            <p class="mt-1 text-sm leading-6 text-[#625d54]">
                Usamos solo tecnologías técnicas necesarias para que funcione tu sesión. No activamos analítica ni publicidad.
                <a href="{{ route('legal.cookies') }}" class="font-medium text-[#914e33] underline underline-offset-2">Más información</a>
            </p>
        </div>
        <button type="button" data-cookie-notice-dismiss class="inline-flex min-h-11 shrink-0 items-center justify-center rounded-full bg-[#292722] px-6 text-sm font-semibold text-white hover:bg-[#a96242] focus:outline-none focus:ring-2 focus:ring-[#a96242] focus:ring-offset-2">
            Entendido
        </button>
    </div>
</aside>

<script>
    (() => {
        const notice = document.querySelector('[data-cookie-notice]');
        if (!notice) return;

        const storageKey = 'estiloVivoCookieNoticeDismissed';
        try {
            if (sessionStorage.getItem(storageKey) === 'true') notice.hidden = true;
        } catch (error) {
            console.error('No se pudo leer la preferencia temporal del aviso de cookies.', error);
        }

        notice.querySelector('[data-cookie-notice-dismiss]')?.addEventListener('click', () => {
            notice.hidden = true;
            try {
                sessionStorage.setItem(storageKey, 'true');
            } catch (error) {
                console.error('No se pudo guardar la preferencia temporal del aviso de cookies.', error);
            }
        });

        document.querySelector('[data-cookie-preferences]')?.addEventListener('click', () => {
            try {
                sessionStorage.removeItem(storageKey);
            } catch (error) {
                console.error('No se pudo restablecer la preferencia temporal del aviso de cookies.', error);
            }
            notice.hidden = false;
            notice.querySelector('[data-cookie-notice-dismiss]')?.focus();
        });
    })();
</script>
