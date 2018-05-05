<div class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <div id="title"></div>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div id='progress' class="progress m-b-20">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                </div>
                <div id="dynamic-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Fechar
                </button>
                <button style='display: none' type="button" id='btnModal' class="btn btn-primary"><i
                            class="fa fa-save"></i> Salvar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('click', '#getModal', function (e) {
            e.preventDefault();
            var dataId = $(this).data('id'); // get id of clicked row
            var dataUrl = $(this).data('url');
            var dataType = $(this).data('type');
            var dataTitle = $(this).data('title');

            $('#progress').show(); // blank before load.
            $('#title').html(dataTitle); // blank before load.

            if (dataId > 0) {
                var req = dataUrl + '/' + dataId;
            } else {
                var req = dataUrl;
            }


            if (dataType == 'view') {
                $('#btnModal').hide();
            } else {
                $('#btnModal').show();
            }

            $.ajax({
                url: req,
                dataType: 'html',
                type: 'GET',
                success: function (data) {
                    //console.log(data);
                    $('#dynamic-content').html(''); // blank before load.
                    $('#dynamic-content').html(data); // load here
                    $('#progress').hide(); // blank before load.

                },
            })
        });
    });

    $("#btnModal").click(function () {

        var action = $("#formModal").attr('action');

        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: action,
            data: $("form").serialize(),

            success: function (response) {

                if (response.status == 200) {
                    // Mensagem Toastr
                    toastr.success(response.msg, response.title, {
                        showDuration: 1000,
                        timeOut: 5000
                    });

                    // Depois de salvar fecha modal
//                    $('.modal').modal('hide');
                    $( '.modal' ).modal( 'hide' ).data( 'bs.modal', null );
                    $('#dynamic-content').html('');
                    $('#btnModal').hide();
                    $('#title').html('');

                    // Atualiza tabela Datatables
                    if ($("table").attr('id')) {
                        $("#" + $("table").attr('id')).DataTable().ajax.reload();
                    }
                }
                else {
                    // Mensagem Toastr
                    toastr.warning(response.msg, response.title, {
                        showDuration: 1000,
                        timeOut: 5000

                    });
                }
            },
            error: function (response) {
                // Mensagem Toastr
                toastr.error('Ocorreu uma falha', 'Ops', {
                    showDuration: 1000,
                    timeOut: 5000

                });
            }
        });
    });

    $('html').bind('keypress', function(e) {
        if(e.keyCode == 13) {
            return false;
        }
    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $('#dynamic-content').html('');
        $('#btnModal').hide();
        $('#title').html('');

    });

</script>