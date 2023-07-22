
$(document).ready(function () {
    // Selector para el checkbox principal que activará/desactivará todos los checkboxes secundarios
    $('#selectAllBoxes').on('click', function () {
        // Verificar si el checkbox principal está marcado
        var isChecked = $(this).prop('checked');

        // Activar/desactivar todos los checkboxes secundarios con la clase checkBoxes
        $('.checkBoxes').prop('checked', isChecked);
    });
});
