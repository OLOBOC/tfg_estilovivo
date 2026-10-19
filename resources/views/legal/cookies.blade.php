@extends('layouts.legal')

@section('title', 'Política de cookies')
@section('heading', 'Política de cookies')

@section('content')
    <section>
        <h2 class="font-serif text-2xl">Tecnologías necesarias</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            El área privada necesita una cookie técnica de sesión para mantener el inicio de sesión y proteger los formularios. Su nombre y duración dependen de la configuración de Laravel en producción. No se usan cookies de analítica, publicidad ni redes sociales en la web.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Aviso de cookies</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            El aviso informativo recuerda el uso de tecnologías necesarias. Si pulsas «Entendido», el navegador guarda durante la pestaña actual la preferencia <code class="rounded bg-[#f3f0eb] px-1.5 py-0.5 text-sm">estiloVivoCookieNoticeDismissed</code> en sessionStorage para no mostrarlo de nuevo en cada página. No es una cookie y desaparece al cerrar la pestaña. Puedes volver a mostrar el aviso desde «Preferencias de cookies» en el pie de página.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Servicios externos</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            El mapa se abre en Google Maps únicamente cuando eliges el enlace de indicaciones; en ese momento se aplican las condiciones y la política de privacidad de Google. El titular debe actualizar esta política antes de añadir analítica, publicidad, vídeos, mapas incrustados u otros servicios que almacenen o consulten información en el dispositivo, y pedir consentimiento previo cuando sea necesario.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Cómo gestionar cookies</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            Puedes bloquear o eliminar cookies desde la configuración del navegador. Si bloqueas las cookies técnicas de sesión, el inicio de sesión y la reserva de citas pueden dejar de funcionar.
        </p>
    </section>

    <section class="rounded-xl border border-amber-300 bg-amber-50 p-5">
        <h2 class="font-semibold text-amber-950">Revisión antes de publicar</h2>
        <p class="mt-2 text-sm leading-6 text-amber-900">
            Revisa esta página con las cookies y servicios que realmente se activen en producción. Si incorporas tecnologías no necesarias, intégralas detrás de una elección previa, libre y revocable; actualizar únicamente el texto no basta.
        </p>
    </section>
@endsection
