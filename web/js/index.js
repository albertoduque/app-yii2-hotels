$(document.body).on('click', '.modals', function() {
    let form = $(this);
    $.get(
        form.data('value'),
        function(data) {
            $("#modal").modal('show').find('#modalHeader').html(form.data('title'));
            $("#modal").modal('show').find('#modalContent').html(data);
        }
    );
});

$(document.body).on('beforeSubmit', '#empresa-form', function() {
    console.log('empresa')
    var form = $(this);
    var form_data = form.serialize();
    var action_url = form.attr("action");
    if (form.find('.has-error').length) {
        $.alert({
            icon: 'glyphicon glyphicon-info-sign',
            title: 'Advertencia',
            theme: 'material',
            content: 'Error debe llenar todos los campos',
            confirmButtonClass: 'btn-info',
            confirmButton: 'Aceptar',

        });
        return false;
    }
    $.ajax({
        method: "POST",
        url: action_url,
        data: form_data
    }).done(function(result) {
        $.each(result, function(index, option) {
            if (option.respuesta == 1) {
                $(document).find('#modal').modal('hide');
                $.alert({
                    icon: 'glyphicon glyphicon-info-sign',
                    title: 'Advertencia',
                    theme: 'material',
                    content: 'Registro Exitoso',
                    confirmButtonClass: 'btn-info',
                    confirmButton: 'Aceptar',

                });
                window.location.href = urlGlobal + "empresa";
                // btn-empresa 
            } else if (option.respuesta == 0) {
                $.alert({
                    icon: 'glyphicon glyphicon-info-sign',
                    title: 'Advertencia',
                    theme: 'material',
                    content: 'Error debe llenar todos los campos___',
                    confirmButtonClass: 'btn-info',
                    confirmButton: 'Aceptar',

                });
            }

        });
    });
    return false;
});