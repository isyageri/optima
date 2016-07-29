<div id="modal_lov_trx_skema" class="modal fade" tabindex="-1" style="overflow-y: scroll;z-index:10900;">
    <div class="modal-dialog" style="width:900px;">
        <div class="modal-content"> 
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Terminate Skema </span>
                </div>
            </div>

<!-- modal body -->
<div class="modal-body">
          <div class="tab-pane active" id="tab_5_1">
            <div class="row">
            

            <div class="col-md-6 ">
               <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="schema_id_ter" readonly>
                    <label for="form_control_1">Schema ID</label>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="nipnas_lov_ter" readonly>
                    <label for="form_control_1">NIPNAS</label>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="account_num_lov_ter" readonly>
                    <label for="form_control_1">Account Num</label>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="customer_name_lov_ter" readonly>
                    <label for="form_control_1">Customer Name</label>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="created_by_ter" readonly>
                    <label for="form_control_1">Created By</label>
                </div>
            </div>

             <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="created_date_lov_ter" readonly>
                    <label for="form_control_1">Created Date</label>
                </div>
            </div>
                <div class="col-md-6 ">
                <div class="form-group">
                    <label class="col-md-3 control-label">Catatan </label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" required id="notes_terminate"></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6 ">
                <div class="form-group ">
                    <button type="button" class="form-control btn-danger" id="terminate_submit" >Terminate</button>
                </div>
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
 </div>
 </div>
 </div>


<script>

    function modal_lov_detail_terminate_skema_show(account_num_lov,customer_ref,account_name,created_date_lov,schema_id) {
        //modal_lov_detail_info_skema_load_data(schema_id);
        $('#customer_name_lov_ter').val(account_name);
        $('#nipnas_lov_ter').val(customer_ref);
        $('#account_num_lov_ter').val(account_num_lov);
        $('#created_date_lov_ter').val(created_date_lov);
        //$('#created_by_ter').val(created_by_lov);
        $('#schema_id_ter').val(schema_id);


        $("#modal_lov_trx_skema").modal({backdrop: 'static'});
    }


    function modal_lov_detail_info_skema_load_data(discount_code) {
        $.ajax({
            url: "<?php echo WS_JQGRID.'schema.sc_schema/get_data_schema'; ?>",
            type: "POST",
            data: { schema_id  : schema_id },
            success: function (data) {
                $('#detail-skema-content').html(data);

                $('#grid-table-fastel_lov').jqGrid('setGridParam', {
                    postData: {schema_id: schema_id}
                });
                $('#grid-table-fastel_lov').trigger("reloadGrid");
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                return false;
            }
        });
    }
    //modal_lov_detail_info_skema_show(account_num_lov,customer_ref,account_name,created_date_lov,schema_id)
 $(document).ready(function(){


     $("#terminate_submit").on('click', function(e) {
            var notes = $('#notes_terminate').val();
            var schema_id = $("#schema_id_ter").val();

        if(notes.length > 0){

            var url = "<?php echo WS_JQGRID.'schema.sc_schema_controller/terminate_schema?schema_id='; ?>" + $("#schema_id_ter").val() + '&notes='+notes+'&';
              url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";

            
            swal({   title: "Anda Yakin Melakukan Proses Ini ? ",   text: "",   type: "info",   showCancelButton: true,   closeOnConfirm: false,   showLoaderOnConfirm: true, }, function(){   setTimeout(function(){

              $.ajax({
                type: 'get',
                dataType: "json",
                url: url,
                timeout: 10000,
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function(response) {
                  if(response.success) {

                      swal({title: 'Info', text: response.message, html: true, type: "info"});
                      $('#terminate_submit').prop('disabled','disabled');
                      $('#notes_terminate').prop('readonly','readonly');

                  }else{
                      swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                  }
                }

              });
          }, 2000); });
        }else{
            swal({title: 'Info', text:'Harap Isi Kolom Catatan !', html: true, type: "info"});
        }
         
      });

      
});


</script>