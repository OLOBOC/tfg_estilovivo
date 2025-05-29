// resources/js/components/guardarCorazon.js

// funcion que se ejecuta al hacer clic en el corazon
// cambia el color y hace peticion al backend para guardar o quitar
export function toggleHeart(button) {
    // obtener el svg del boton y el id de la publicacion
    const svg = button.querySelector('svg')
    const id = parseInt(button.getAttribute('data-id'))
    const isSaved = svg.classList.contains('text-red-500') // si ya esta guardado

    // si ya estaba guardado, lo desmarca
    if (isSaved) {
        svg.classList.remove('text-red-500')
        svg.classList.add('text-gray-300')
        console.log(`publicacion ${id} desguardada`)

        // quitarlo del array global
        if (window.publicacionesGuardadas) {
            window.publicacionesGuardadas = window.publicacionesGuardadas.filter(pid => pid !== id)
        }
    } else {
        // si no estaba guardado, lo marca en rojo
        svg.classList.remove('text-gray-300')
        svg.classList.add('text-red-500')
        console.log(`publicacion ${id} guardada`)

        // agregar al array global
        if (window.publicacionesGuardadas && !window.publicacionesGuardadas.includes(id)) {
            window.publicacionesGuardadas.push(id)
        }
    }

    // llamada al backend
    fetch(`/galeria/${id}/guardar`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest' // evita que laravel devuelva html
        },
        body: JSON.stringify({ guardar: !isSaved }) // enviar el estado nuevo
    })
    .then(async response => {
        // comprobar que la respuesta es json
        const contentType = response.headers.get("content-type") || ""
        if (!contentType.includes("application/json")) {
            throw new Error("respuesta no es json, puede ser redireccion o error")
        }

        // parsear y mostrar
        const data = await response.json()
        console.log("respuesta del servidor:", data)
    })
    .catch(error => {
        // mostrar errores en consola
        console.error("error al guardar/desguardar:", error.message)
    })
}
