$('#form').submit(function (event) {
    var formData = $('#form').serialize();

    $.ajax({
        type: 'POST',
        url: '../controller/ajax/saveVote.php',
        data: formData,
        dataType: 'json',
        encode: true,
    }).done(function (data) {
        console.log(data);

        if (!data.success) {
            if (data.errors.nombre) {
                $('#error_nombre').text(data.errors.nombre);
            } else {
                $('#error_nombre').text('');
            }
            if (data.errors.alias) {
                $('#error_alias').text(data.errors.alias);
            } else {
                $('#error_alias').text('');
            }
            if (data.errors.rut) {
                $('#error_rut').text(data.errors.rut);
            } else {
                $('#error_rut').text('');
            }
            if (data.errors.correo) {
                $('#error_correo').text(data.errors.correo);
            } else {
                $('#error_correo').text('');
            }
            if (data.errors.region) {
                $('#error_region').text(data.errors.region);
            } else {
                $('#error_region').text('');
            }
            if (data.errors.comuna) {
                $('#error_comuna').text(data.errors.comuna);
            } else {
                $('#error_comuna').text('');
            }
            if (data.errors.conocer) {
                $('#error_conocer').text(data.errors.conocer);
            } else {
                $('#error_conocer').text('');
            }
        } else {
            $('#error_nombre').text('');
            $('#error_alias').text('');
            $('#error_rut').text('');
            $('#error_correo').text('');
            $('#error_region').text('');
            $('#error_comuna').text('');
            $('#error_conocer').text('');
            $('#success').text(data.message);
        }
    });

    event.preventDefault();
});