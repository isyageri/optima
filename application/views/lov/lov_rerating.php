<div id="modal_lov_rerating" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Re Rating-Billing </span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <form role="form" id="form_rerating" name="form_rerating" method="post" enctype="multipart/form-data"
                  accept-charset="utf-8">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label>Filter</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <select class="form-control" name="filter" id="filter">
                                            <option value="1"> Rating </option>
                                            <option value="2"> Billing </option>
                                        </select>
                                    </div>
                                    <div class="col-xs-2">
                                        <button type="button" class="btn btn-sm btn-primary" id="list-all">List</button>
                                    </div>
                                </div>
                            </div>
                            <div class="space-1"></div> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label>Account type</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <select class="form-control" name="account" id="account">
                                            <option value="1"> Single Account </option>
                                            <option value="2"> All Account </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="space-1"></div> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label id='lbl-period'>Period</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="text" name="period" class="form-control" id="date-picker" /> 
                                    </div>
                                </div>
                            </div>
                            <div class="space-1"></div> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label id='lbl-input'>Account Name</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="text" name="account_name" id="account_name" class="form-control" /> 
                                    </div>
                                </div>
                            </div>
                            
                    <!-- modal footer -->
                    <div class="modal-footer no-margin-top">
                        <div class="bootstrap-dialog-footer">

                            <div class="bootstrap-dialog-footer-buttons col-xs-7">                    
                                <br>
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            
            
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>    
    $('#date-picker').datepicker({
        autoclose: true,
        format: 'yyyymm',
    });

    $('#account').on('change', function(){        
        if($('#account').val() == '1'){
            $('#date-picker').val('');
            $('#account_name').val('');
            $('#account_name').show(150);
            $('#lbl-input').show(150);
            $('#date-picker').show(150);
            $('#lbl-period').show(150);
        }else{
            $('#account_name').hide(150);
            $('#lbl-input').hide(150);
            $('#date-picker').show(150);
            $('#lbl-period').show(150);
        }
    });

    $('#list-all').on('click', function(){
        if($('#filter').val() == '1'){
            modal_lov_rejectevent_show();
        }else{
            modal_lov_billingerrorlog_show();
        }
        
    });

    $(function() {
        /* submit */
        $("#form_rerating").on('submit', (function (e) {
            e.preventDefault();   
            // var data = new FormData(this);
            // console.log(data);
            var ipn, inc, acn;
            if($('#account').val() == '1'){
                ipn = 'ACCOUNT_'+ $('#date-picker').val();
                inc = 2;
                acn = $('#account_name').val();
            }else{
                var d = new Date();
                ipn = 'ALL_ACCOUNT';
                inc = 3;
                acn = '-';
            }

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: '<?php echo WS_JQGRID."process.rerating_controller/create"; ?>',
                data: {
                    "<?php echo $this->security->get_csrf_token_name(); ?>" : "<?php echo $this->security->get_csrf_hash(); ?>",
                    p_finance_period_id : $('#date-picker').val(),
                    input_file_name : ipn,
                    input_data_class_id : inc,
                    account_name : acn

                },
                timeout: 10000,
                success: function(data) {
                    if(data.success) {
                        $('#grid-table-prebill').trigger("reloadGrid");
                        $('#modal_lov_rerating').modal('hide');
                    }else{
                        swal("", data.message, "warning");
                    }
                   
                }
            });
            return false;
        }));
        
    });

    function modal_lov_rerating_show() {
        modal_lov_rerating_init();
        $("#modal_lov_rerating").modal({backdrop: 'static'});
    }

    function modal_lov_rerating_init() {
        $('#date-picker').val('');
        $('#account_name').val('');
    }


    
</script>