<div id="modal_lov_document_type" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
	<div class="modal-dialog">
		<div class="modal-content">
		    <!-- modal title -->
			<div class="modal-header no-padding">
				<div class="table-header">
					<span class="form-add-edit-title"> Jenis Dokumen </span>
				</div>
			</div>
            <input type="hidden" id="modal_lov_document_type_id_val" value="" />
            <input type="hidden" id="modal_lov_document_type_code_val" value="" />

			<!-- modal body -->
			<div class="modal-body">
			    <p>
                  <button type="button" class="btn btn-sm btn-success" id="modal_lov_document_type_btn_blank">
  	                <span class="fa fa-pencil-square-o" aria-hidden="true"></span> BLANK
                  </button>
                 </p>

				<table id="modal_lov_document_type_grid_selection" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                     <th data-column-id="P_DOCUMENT_TYPE_ID" data-sortable="false" data-visible="false"> ID</th>
                     <th data-header-align="center" data-align="center" data-formatter="opt-edit" data-sortable="false" data-width="100">Options</th>
                     <th data-column-id="DOCUMENT_TYPE_CODE">Nama Dokumen</th>
                     <th data-column-id="DISPLAY_NAME">Nama Dokumen Tercetak</th>
                  </tr>
                </thead>
                </table>
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

    jQuery(function($) {
        $("#modal_lov_document_type_btn_blank").on(ace.click_event, function() {
            $("#"+ $("#modal_lov_document_type_id_val").val()).val("");
            $("#"+ $("#modal_lov_document_type_code_val").val()).val("");
            $("#modal_lov_document_type").modal("toggle");
        });
    });

    function modal_lov_document_type_show(the_id_field, the_code_field) {
        modal_lov_document_type_set_field_value(the_id_field, the_code_field);
        $("#modal_lov_document_type").modal({backdrop: 'static'});
        modal_lov_document_type_prepare_table();
    }


    function modal_lov_document_type_set_field_value(the_id_field, the_code_field) {
         $("#modal_lov_document_type_id_val").val(the_id_field);
         $("#modal_lov_document_type_code_val").val(the_code_field);
    }

    function modal_lov_document_type_set_value(the_id_val, the_code_val) {
         $("#"+ $("#modal_lov_document_type_id_val").val()).val(the_id_val);
         $("#"+ $("#modal_lov_document_type_code_val").val()).val(the_code_val);
         $("#modal_lov_document_type").modal("toggle");
         
         $("#"+ $("#modal_lov_document_type_id_val").val()).change();
    }

    function modal_lov_document_type_prepare_table() {
        $("#modal_lov_document_type_grid_selection").bootgrid({
    	     formatters: {
                "opt-edit" : function(col, row) {
                    return '<a href="#'+ $("#modal_lov_document_type_code_val").val() +'" title="Set Value" onclick="modal_lov_document_type_set_value(\''+ row.p_document_type_id +'\', \''+ row.document_type_code +'\')" class="blue"><i class="ace-icon fa 	fa-pencil-square-o bigger-130"></i></a>';
                }
             },
    	     rowCount:[5,10],
    		 ajax: true,
    	     requestHandler:function(request) {
    	        if(request.sort) {
    	            var sortby = Object.keys(request.sort)[0];
    	            request.dir = request.sort[sortby];

    	            delete request.sort;
    	            request.sort = sortby;
    	        }
    	        return request;
    	     },
    	     responseHandler:function (response) {
    	        if(response.success == false) {
    	            showBootDialog(true, BootstrapDialog.TYPE_WARNING, 'Attention', response.message);
    	        }
    	        return response;
    	     },
       	     url: "<?php echo WS_URL."workflow.document_type_controller/readLov"; ?>",
    	     selection: true,
    	     sorting:true
    	});
    }

</script>