// Script para el contador de visitas
document.addEventListener("DOMContentLoaded", function() {
    // Obtener el contador actual de visitas desde el localStorage
    let visitas = localStorage.getItem('contadorVisitas');

    // Si no existe el contador en el localStorage, iniciarlo en 0
    if (!visitas) {
        visitas = 0;
    }

    // Incrementar el contador en 1
    visitas++;

    // Guardar el nuevo valor en el localStorage
    localStorage.setItem('contadorVisitas', visitas);

    // Mostrar el número de visitas en el HTML
    document.getElementById('contador-visitas').textContent = visitas;
});