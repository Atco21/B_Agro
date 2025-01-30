document.addEventListener('DOMContentLoaded', function () {
    // Mostrar el segundo modal y ocultar el primero
    $('#crearparcela').on('show.bs.modal', function () {
        $('#crearexplotacion').modal('hide');
    });

    // Restaurar el primer modal al cerrar el segundo
    $('#crearparcela').on('hidden.bs.modal', function () {
        $('#crearexplotacion').modal('show');
    });
});