@extends('layouts.legal')

@section('title', 'Política de privacidad')
@section('heading', 'Política de privacidad')

@section('content')
    <section>
        <h2 class="font-serif text-2xl">Responsable del tratamiento</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            Responsable: <strong>[NOMBRE O RAZÓN SOCIAL]</strong>. NIF/CIF: <strong>[NIF/CIF]</strong>.<br>
            Dirección: <strong>[DOMICILIO SOCIAL COMPLETO]</strong>.<br>
            Contacto para privacidad y ejercicio de derechos: <strong>[CORREO ELECTRÓNICO DE CONTACTO]</strong>.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Qué datos tratamos y para qué</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            Para crear y gestionar una cuenta se utilizan el nombre, el correo electrónico y la contraseña (que se guarda protegida, no en texto legible). Si se solicita una cita, se tratan además la fecha, la hora, los servicios solicitados y el profesional elegido. Estos datos se usan para mantener la cuenta, gestionar la solicitud de cita y prestar las funciones del sitio.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Base jurídica y conservación</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            La gestión de una cuenta y de las citas se basa en la ejecución de la solicitud de la persona usuaria y, cuando corresponda, en medidas precontractuales. Las obligaciones legales que resulten aplicables pueden justificar la conservación de determinados datos durante los plazos exigidos. El titular debe definir y publicar los plazos concretos de conservación, así como el proceso para eliminar o anonimizar cuentas y citas.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Destinatarios y transferencias</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            El titular debe identificar aquí a los proveedores reales de alojamiento, base de datos, correo y otros servicios que puedan acceder a datos por cuenta del responsable, y describir las transferencias internacionales y garantías aplicables, si las hubiera. No se deben publicar datos reales de clientes en entornos de prueba.
        </p>
    </section>

    <section>
        <h2 class="font-serif text-2xl">Tus derechos</h2>
        <p class="mt-3 leading-7 text-[#625d54]">
            Puedes solicitar acceso, rectificación, supresión, oposición, limitación o portabilidad cuando proceda, escribiendo a <strong>[CORREO ELECTRÓNICO DE CONTACTO]</strong> e indicando el derecho que deseas ejercer. También puedes presentar una reclamación ante la Agencia Española de Protección de Datos (AEPD). El titular debe habilitar un procedimiento para verificar y atender estas solicitudes.
        </p>
    </section>

    <section class="rounded-xl border border-amber-300 bg-amber-50 p-5">
        <h2 class="font-semibold text-amber-950">Pendiente antes de publicar</h2>
        <p class="mt-2 text-sm leading-6 text-amber-900">
            Completa los datos del responsable, los proveedores y plazos reales de conservación; comprueba la base jurídica y el flujo de derechos con la configuración de producción. Esta plantilla no sustituye una revisión legal ni confirma por sí sola el cumplimiento normativo.
        </p>
    </section>
@endsection
