<div id="modal_lov_info_fastel" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:1070px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Data Fastel</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <table id="modal_lov_info_fastel_grid_selection" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                     <th data-column-id="p_notel">Fastel</th>
                     <th data-column-id="keterangan">Keterangan</th>
                     <th data-column-id="abonemen">Abonemen</th>
                     <th data-column-id="lokal">Lokal</th>
                     <th data-column-id="sljj">SLJJ</th>
                     <th data-column-id="seluler">Seluler</th>
                     <th data-column-id="sli">SLI</th>
                     <th data-column-id="other">Others</th>
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

    function modal_lov_info_fastel_show(schema_id) {
        $("#modal_lov_info_fastel").modal({backdrop: 'static'});
        modal_lov_info_fastel_prepare_table(schema_id);
    }


    function modal_lov_info_fastel_prepare_table(schema_id) {
        $("#modal_lov_info_fastel_grid_selection").bootgrid("destroy");
        $("#modal_lov_info_fastel_grid_selection").bootgrid({
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
             url: '<?php echo WS_URL."schema.info_schema_controller/readLovFastel"; ?>',
             post: function(){
                return {
                    schema_id:schema_id
                };
             },
             selection: true,
             sorting:true
        });

        $('.bootgrid-header span.glyphicon-search').removeClass('glyphicon-search')
        .html('<i class="fa fa-search"></i>');
    }

</script>