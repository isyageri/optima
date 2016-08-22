<div id="modal_lov_trendinfodetail" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:1070px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Data Detail</span>
                </div>
            </div>
            <input type="hidden" id="modal_lov_trendinfodetail_schema_id" value="" />
            <input type="hidden" id="modal_lov_trendinfodetail_an_fact" value="" />
            <input type="hidden" id="modal_lov_trendinfodetail_per_fact" value="" />
            <!-- modal body -->
            <div class="modal-body">
                <div>
                  <button type="button" class="btn btn-sm btn-success" id="modal_lov_trendinfodetail_btn_excel">
                    <span class="fa fa-file-excel-o" aria-hidden="true"></span> Download Excel
                  </button>
                </div>

                <table id="modal_lov_trendinfodetail_grid_selection" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                     <!-- <th data-column-id="id" data-sortable="false" data-visible="false">ID trendinfodetail</th>
                     <th data-column-id="ncli">NCLI</th>
                     <th data-column-id="nd">ND</th>
                     <th data-column-id="nfact">NFACT</th>
                     <th data-column-id="neltfact">NELTFACT</th>
                     <th data-column-id="no_cpta">NO_CPTA</th>
                     <th data-column-id="batch_id">BATCH ID</th>
                     <th data-column-id="leltfact">LELTFACT</th> -->
                     <th data-column-id="id" data-sortable="false" data-visible="false">ID trendinfodetail</th>
                     <th data-column-id="nd">ND</th>
                     <th data-column-id="periode">PERIODE</th>
                     <th data-column-id="telkom_jj">TELKOM JJ</th>
                     <th data-column-id="telkom_lk">TELKOM LK</th>
                     <th data-column-id="telkomsel">TELKOMSEL/th>
                     <th data-column-id="lainnya">LAINNYA</th>
                     <th data-column-id="on_net">ON NET</th>
                     <th data-column-id="non_on_net">NON ON NET</th>
                     <th data-column-id="total_aamount">TOTAL</th>
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
        $("#modal_lov_trendinfodetail_btn_excel").on('click', function() {
            var url = "<?php echo WS_JQGRID.'schema.tagihan_agregate_controller/excelDetailTableTrendInfo?schema_id='; ?>" + $("#modal_lov_trendinfodetail_schema_id").val() + '&';
            url += "an_fact="+ $("#modal_lov_trendinfodetail_an_fact").val() +'&';
            url += "per_fact="+ $("#modal_lov_trendinfodetail_per_fact").val() +'&';
            url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";

            window.location = url;
        });
    });

    function modal_lov_trendinfodetail_show(schema_id, an_fact, per_fact) {
        modal_lov_trendinfodetail_set_field_value(schema_id, an_fact, per_fact);
        $("#modal_lov_trendinfodetail").modal({backdrop: 'static'});
        modal_lov_trendinfodetail_prepare_table(schema_id, an_fact, per_fact);
    }

    function modal_lov_trendinfodetail_set_field_value(schema_id, an_fact, per_fact) {
         $("#modal_lov_trendinfodetail_schema_id").val(schema_id);
         $("#modal_lov_trendinfodetail_an_fact").val(an_fact);
         $("#modal_lov_trendinfodetail_per_fact").val(per_fact);
    }

    function modal_lov_trendinfodetail_prepare_table(schema_id, an_fact, per_fact) {

        $("#modal_lov_trendinfodetail_grid_selection").bootgrid("destroy");
        $("#modal_lov_trendinfodetail_grid_selection").bootgrid({
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
             url: '<?php echo WS_URL."schema.tagihan_agregate_controller/readLov"; ?>',
             post: function(){
                return {
                    schema_id: schema_id,
                    an_fact: an_fact,
                    per_fact: per_fact
                };
             },
             selection: true,
             sorting:true
        });

        $('.bootgrid-header span.glyphicon-search').removeClass('glyphicon-search')
        .html('<i class="fa fa-search"></i>');
    }


</script>