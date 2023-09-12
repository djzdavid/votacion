$(document).ready(function () {
    $(function () {
        $.ajax({
            type: 'GET',
            url: '../controller/ajax/getListaCandidatos.php',
            success: function (data) {
                var $select = $('#ipt_candidato');
                $select.find('option').remove();
                $.each(JSON.parse(data), function (key, value) {
                    $select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            }
        });
        $.ajax({
            type: 'GET',
            url: '../controller/ajax/getListaRegiones.php',
            success: function (data) {
                var $select = $('#ipt_region');
                $select.find('option').remove();
                $.each(JSON.parse(data), function (key, value) {
                    $select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            }
        });

        updateComunas(1);
    });

    function updateComunas(region_id) {
        $.ajax({
            type: 'GET',
            url: '../controller/ajax/getListaComunas.php?region_id=' + region_id,
            success: function (data) {
                var $select = $('#ipt_comuna');
                $select.find('option').remove();
                $.each(JSON.parse(data), function (key, value) {
                    $select.append('<option value=' + value.id + '>' + value.name + '</option>');
                });
            }
        });
    }

    $('#ipt_region').on('change', function () {
        updateComunas(this.value);
    });
});