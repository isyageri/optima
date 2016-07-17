<div id="modal_lov_upload_fastel" class="modal fade" tabindex="-1" style="overflow-y: scroll;z-index:10900;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Upload Data Fastel</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
            <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_5_1" data-toggle="tab"> Upload Fastel </a>
                        </li>
                        <li>
                            <a href="#tab_5_2" data-toggle="tab"> Tambah Fastel </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                             <form role="form" id="form-upload-fastel" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            <input type="hidden" id="modal_lov_upload_fastel_schema_id" name="schema_id">
                            <input type="hidden" id="modal_lov_upload_fastel_p_cust_id" name="p_cust_id">
                            <input type="hidden" id="modal_lov_upload_fastel_p_cust_account" name="p_cust_account">
                            <div class="input-group col-md-1">
                               <input type="file" name="file_upload_fastel" id="file_upload_fastel" />
                               <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                               <span class="input-group-btn btn-right">
                                    <input type="submit" id="submit_fastel" class="btn green-haze" value="Upload">
                               </span>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane" id="tab_5_2">
                        <form role="form" id="form-upload-fastelsatuan" method="post"  accept-charset="utf-8">
                           <div class="form-group">
                            <label>Input Fastel</label>
                            <input type="text" id="fastelsatuan" name="fastelsatuan" class="form-control">
                            <input type="hidden" id="modal_lov_upload_fastel_p_cust_account2" name="p_cust_account">
                            <input type="hidden" id="modal_lov_upload_fastel_schema_id2" name="schema_id">
                            <input type="hidden" id="modal_lov_upload_fastel_p_cust_id2" name="p_cust_id">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                         </div>
                         <span class="input-group-btn btn-right">
                              <input type="submit" id="submit_fastelsatuan" class="btn green-haze" value="Submit">
                            </span>
                        </form>
                        </div>
                    </div>
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
    function modal_lov_upload_fastel_show(schema_id, p_cust_id, p_cust_account) {
        $("#modal_lov_upload_fastel_schema_id").val(schema_id);
        $("#modal_lov_upload_fastel_schema_id2").val(schema_id);
        $("#modal_lov_upload_fastel_p_cust_id").val(p_cust_id);
        $("#modal_lov_upload_fastel_p_cust_id2").val(p_cust_id);
        $("#modal_lov_upload_fastel_p_cust_account").val(p_cust_account);
        $("#modal_lov_upload_fastel_p_cust_account2").val(p_cust_account);
        $("#modal_lov_upload_fastel").modal({backdrop: 'static'});
    }

    function modal_lov_upload_fastel_hide() {
        $("#modal_lov_upload_fastel").modal('hide');
    }
</script>