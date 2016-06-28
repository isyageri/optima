<div id="modal_lov_detail_skema" class="modal fade" tabindex="-1" style="overflow-y: scroll;z-index:10900;">
    <div class="modal-dialog" style="width:900px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Data Detail Skema</span>
                </div>
            </div>
            <!-- modal body -->
            <div class="modal-body" id="detail-skema-content">

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

    function modal_lov_detail_skema_show(discount_code) {
        modal_lov_detail_skema_load_data(discount_code);
        $("#modal_lov_detail_skema").modal({backdrop: 'static'});
    }

    function modal_lov_detail_skema_load_data(discount_code) {
        $.ajax({
            url: "<?php echo WS_JQGRID.'schema.info_schema_controller/getDetailSkema'; ?>",
            type: "POST",
            data: { discount_code  : discount_code },
            success: function (data) {
                $('#detail-skema-content').html(data);
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                return false;
            }
        });
    }

</script>