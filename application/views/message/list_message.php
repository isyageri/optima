<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Message</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<table id="grid-msg" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
         <th data-column-id="trx_id" data-sortable="false" data-visible="false">ID</th>
         <th data-column-id="code">Code</th>
         <th data-column-id="trx_name">Message</th>
         <th data-column-id="status_name">Status</th>
         <th data-header-align="center" data-align="center" data-sortable="false" data-width="150" data-formatter="action">Action</th>
      </tr>
    </thead>
</table>

<script>
    $("#grid-msg").bootgrid({
             formatters: {
                action : function(col, row) {
                    if(row.flag == 1){
                        return '<a class="btn default btn-xs black" href="javascript:;" onclick="msg('+ row.trx_id +',\''+ row.code +'\',\''+ row.status_name +'\',\''+ row.trx_name +'\',\''+ row.flag +'\')"> Sudah Dibaca </a>';
                    }else{
                        return '<a class="btn primary btn-xs blue" href="javascript:;" onclick="msg('+ row.trx_id +',\''+ row.code +'\',\''+ row.status_name +'\',\''+ row.trx_name +'\',\''+ row.flag +'\')"> Belum Dibaca </a>';
                    }
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
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
                return response;
             },
             url: '<?php echo WS_URL."message.message_controller/read"; ?>',
             selection: true,
             sorting:true
        });

        $('.bootgrid-header span.glyphicon-search').removeClass('glyphicon-search')
        .html('<i class="fa fa-search"></i>');

        // function viewMsg(id){
        //     alert(id);
        // }

  
</script>