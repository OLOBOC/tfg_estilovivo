@extends('layouts.legal')

@section('title', 'Condiciones de uso')
@section('heading', 'Condiciones de uso')

@section('content')
    <section>
        <h2 class="font-serif text-2xl">Uso de la cuenta</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            La cuenta es personal. La persona usuaria debe facilitar datos correctos, mantener sus credenciales seguras y avisar al titular si detecta un uso no autorizado. El titular puede suspender cuentas ante indicios de fraude o uso ilícito, respetando la normativa aplicable.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Solicitudes de cita</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            La disponibilidad mostrada puede cambiar hasta que la solicitud quede registrada. Antes de publicar, el titular debe indicar claramente cómo se confirma una cita, los precios aplicables, los medios de pago y las condiciones y plazos de cancelación o modificación. No se debe considerar confirmada una cita hasta que la aplicación o el establecimiento lo indiquen expresamente.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Cambios y contacto</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            Las condiciones pueden actualizarse para reflejar cambios del servicio o de la normativa. Para consultas sobre una cita, utiliza los canales oficiales del establecimiento: <strong>[CORREO O TELÉFONO DE CONTACTO]</strong>.
        </p>
    </section>

    <section class="rounded-xl border border-amber-300 bg-amber-50 p-5">
        <h2 class="font-semibold text-amber-950">Pendiente antes de publicar</h2>
        <p class="mt-2 text-sm leading-6 text-amber-900">
            Sustituye el contacto y define el procedimiento real de confirmación, precios y cancelaciones. No se han inventado tarifas ni condiciones comerciales.
        </p>
    </section>
@endsection
