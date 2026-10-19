@extends('layouts.legal')

@section('title', 'Aviso legal')
@section('heading', 'Aviso legal')

@section('content')
    <section>
        <h2 class="font-serif text-2xl">Titular del sitio</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            Titular: <strong>[NOMBRE O RAZÓN SOCIAL]</strong><br>
            NIF/CIF: <strong>[NIF/CIF]</strong><br>
            Domicilio: <strong>[DOMICILIO SOCIAL COMPLETO]</strong><br>
            Correo electrónico: <strong>[CORREO ELECTRÓNICO DE CONTACTO]</strong><br>
            Datos registrales: <strong>[DATOS REGISTRALES, SI PROCEDE]</strong>
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Objeto y condiciones de uso</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            Este sitio ofrece información sobre Estilo Vivo y herramientas de registro, acceso y solicitud de citas. Al utilizarlo, la persona usuaria se compromete a facilitar información veraz, custodiar sus credenciales y no utilizar el servicio de forma ilícita o que perjudique a terceros.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Propiedad intelectual y responsabilidad</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            Los contenidos del sitio pertenecen a sus respectivos titulares y no pueden reutilizarse sin autorización cuando esta sea necesaria. La información de servicios, horarios, disponibilidad y precios debe ser revisada y mantenida actualizada por el titular antes de ofrecer el sitio al público.
        </p>
    </section>

    <section class="rounded-xl border border-amber-300 bg-amber-50 p-5">
        <h2 class="font-semibold text-amber-950">Pendiente antes de publicar</h2>
        <p class="mt-2 text-sm leading-6 text-amber-900">
            Sustituye todos los campos entre corchetes por los datos reales del titular y valida este aviso con asesoramiento adecuado. La dirección del establecimiento no sustituye al domicilio legal del titular.
        </p>
    </section>
@endsection
