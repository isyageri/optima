<div id="modal_lov_simulasi" class="modal fade" tabindex="-1" style="overflow-y: scroll;z-index:10900;">
    <div class="modal-dialog" style="width:1070px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Data Simulasi</span>
                </div>
            </div>
            <input type="hidden" id="modal_lov_simulasi_discount_code" value="" />
            <!-- modal body -->
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="simulasi_avg_on_net">Average On Net</label>
                        <div class="col-md-4">
                            <input type="text" id="simulasi_avg_on_net" name="simulasi_avg_on_net" class="form-control input-inline">
                            <span class="help-inline" id="r_simulasi_avg_on_net"> </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="simulasi_on_net">On Net</label>
                        <div class="col-md-4">
                            <input type="text" id="simulasi_on_net" name="simulasi_on_net" class="form-control input-inline">
                            <!-- <span class="help-inline" id="r_simulasi_on_net"> </span> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="simulasi_non_on_net">Non On Net</label>
                        <div class="col-md-4">
                            <input type="text" id="simulasi_non_on_net" name="simulasi_non_on_net"  class="form-control input-inline">
                            <!-- <span class="help-inline" id="r_simulasi_non_on_net"> </span> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-12">
                            <button type="button" id="simulasi_generate" class="btn btn-success"> Generate</button>
                            <button type="button" class="btn btn-success" id="modal_lov_simulasi_btn_excel">
                                <span class="fa fa-file-excel-o" aria-hidden="true"></span> Download Excel
                            </button>
                        </div>
                    </div>
                </form>

                <div id="table-simulasi">

                </div>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-danger btn-xs radius-4" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>

    $(function(e) {

        $('#simulasi_generate').on('click', function(e) {
            
            trend = $('#trend').val();
            operator = $('#temp_operator').val();
            kuadran = $('#select_kuadran').val();
            model = $('#select_model').val();

            if( $('#simulasi_avg_on_net').val() == "" ||
                $('#simulasi_on_net').val() == "" ||
                $('#simulasi_non_on_net').val() == "" ) {

                swal('Info','Semua field harus diisi','info');
                return false;
            }

            var schema_id = $("#schema_id").val();

            $.ajax({
                url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/getSimulasiTable'; ?>",
                type: "POST",
                data: { schema_id  : schema_id ,
                        avg_on_net : $('#simulasi_avg_on_net').val(),
                        on_net     : $('#simulasi_on_net').val(),
                        non_on_net : $('#simulasi_non_on_net').val(),
                        trend : trend,
                        operator : operator,
                        kuadran : kuadran,
                        model : model,
                        discount_code : $('#modal_lov_simulasi_discount_code').val()
                      },
                success: function (data) {
                    $('#table-simulasi').html(data);
                },
                error: function (xhr, status, error) {
                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    return false;
                }
            });
        });


        $('#modal_lov_simulasi_btn_excel').on('click', function(e) {

            if( $('#simulasi_avg_on_net').val() == "" ||
                $('#simulasi_on_net').val() == "" ||
                $('#simulasi_non_on_net').val() == "" ) {

                swal('Info','Semua field harus diisi','info');
                return false;
            }

            var url = "<?php echo WS_JQGRID.'schema.sc_schema_controller/excelSimulasiTable?schema_id='; ?>" + $("#schema_id").val() + '&';
            url += "avg_on_net="+$('#simulasi_avg_on_net').val()+"&";
            url += "on_net="+$('#simulasi_on_net').val()+"&";
            url += "non_on_net="+$('#simulasi_non_on_net').val()+"&";
            url += "discount_code="+$('#modal_lov_simulasi_discount_code').val()+"&";
            url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            window.location = url;

        });

    });

    function modal_lov_simulasi_show(discount_code) {
        $('#table-simulasi').html('');
        $('#simulasi_avg_on_net').val('');
        $('#simulasi_on_net').val('');
        $('#simulasi_non_on_net').val('');

        modal_lov_simulasi_set_field_value(discount_code);
        $("#modal_lov_simulasi").modal({backdrop: 'static'});
    }

    function modal_lov_simulasi_set_field_value(discount_code) {
         $("#modal_lov_simulasi_discount_code").val(discount_code);
    }

</script>