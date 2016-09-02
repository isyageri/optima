<div id="modal_lov_rejectevent" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:1070px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Data Reject Event</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="modal_lov_rejectevent_grid_selection" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                         <th data-column-id="process_instance_id" data-sortable="false" data-visible="false">ID rejectevent</th>
                         <th data-column-id="event_source">Event Source</th>
                         <th data-column-id="reject_status">Status</th>
                         <th data-column-id="event_dtm">Event DTM</th>
                         <th data-column-id="reject_dtm">Reject DTM</th>
                         <th data-column-id="event_record">Error</th>
                      </tr>
                    </thead>
                    </table>
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


    function modal_lov_rejectevent_show() {
        $("#modal_lov_rejectevent").modal({backdrop: 'static'});
        modal_lov_rejectevent_prepare_table();
    }

    function modal_lov_rejectevent_prepare_table() {
        $("#modal_lov_rejectevent_grid_selection").bootgrid({
             // formatters: {
             //    "opt-edit" : function(col, row) {
             //        return '<a href="javascript:;" title="Set Value" onclick="modal_lov_rejectevent_set_value(\''+ row.id +'\', \''+ row.company_name +'\')" class="blue"><i class="fa fa-pencil-square-o bigger-130"></i></a>';
             //    }
             // },
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
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
                return response;
             },
             url: '<?php echo WS_URL."process.rerating_controller/readRejectLov"; ?>',
             selection: true,
             sorting:true
        });

        $('.bootgrid-header span.glyphicon-search').removeClass('glyphicon-search')
        .html('<i class="fa fa-search"></i>');
    }

</script>