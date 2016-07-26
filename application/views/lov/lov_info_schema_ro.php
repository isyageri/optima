<div id="modal_lov_detail_skema" class="modal fade" tabindex="-1" style="overflow-y: scroll;z-index:10900;">
    <div class="modal-dialog" style="width:900px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Info Pembuatan Skema </span>
                </div>
            </div>

<!-- modal body -->
<div class="modal-body">
        

        <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_5_1" data-toggle="tab"> Info Account </a>
            </li>
            <li>
                <a href="#tab_5_2" data-toggle="tab"> Fastel </a>
            </li>
            <li>
                <a href="#tab_5_3" data-toggle="tab"> Trend & Tagihan</a>
            </li>
            <li>
                <a href="#tab_5_4" data-toggle="tab"> Skema Diskon</a>
            </li>
            <li>
                <a href="#tab_5_5" data-toggle="tab"> Contract</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_5_1">
            <div class="row">
            

            <div class="col-md-6 ">
               <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="schema_id" readonly>
                    <label for="form_control_1">Schema ID</label>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="nipnas_lov" readonly>
                    <label for="form_control_1">nipnas_lov</label>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="account_num_lov" readonly>
                    <label for="form_control_1">Account Num</label>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="customer_name_lov" readonly>
                    <label for="form_control_1">Customer Name</label>
                </div>
            </div>

            <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="created_by" readonly>
                    <label for="form_control_1">Created By</label>
                </div>
            </div>

             <div class="col-md-6 ">
                <div class="form-group form-md-line-input has-info">
                    <input type="text" class="form-control" id="created_date_lov" readonly>
                    <label for="form_control_1">Created Date</label>
                </div>
            </div>

            </div>
                
            </div>
            <div class="tab-pane" id="tab_5_2">
                <div class="row">
                  <div class="col-md-12">
                      <table id="grid-table-fastel_lov"></table>
                      <div id="grid-pager-fastel_lov"></div>
                  </div>
              </div>
            </div>
            <div class="tab-pane" id="tab_5_3">
             <div class="row">
                  <div class="col-md-12">
                      <h4> Trend & Tagihan </h4>
                  </div>
                  <div class="col-md-12" id="table-trend-info2">
                </div>
              </div>
               
              
            </div>
            <div class="tab-pane" id="tab_5_4">
                <div class="row">
                  <div class="col-md-12">
                      <h4> Skema Pembayaran </h4>
                  </div>
                  <div class="col-md-12" id="table-skema-pembayaran2">

                  </div>
              </div>
            </div>
            <div class="tab-pane" id="tab_5_5">
                <div class="row">
                  <div class="col-md-12">
                      <h4> Download Data Kontrak </h4>
                  </div>
                  <div class="col-md-12" >
                        <button class="btn btn-info btn-xs radius-4" id="download_kontrak">
                                                   
                                                    Download Kontrak
                                                </button>
                  </div>
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

    function modal_lov_detail_info_skema_show(account_num_lov,customer_ref,account_name,created_date_lov,schema_id) {
        //modal_lov_detail_info_skema_load_data(schema_id);
        $('#customer_name_lov').val(account_name);
        $('#nipnas_lov').val(customer_ref);
        $('#account_num_lov').val(account_num_lov);
        $('#created_date_lov').val(created_date_lov);
        $('#schema_id').val(schema_id);

        // reload grid 
        $('#grid-table-fastel_lov').jqGrid('setGridParam', {
                    postData: {schema_id: schema_id}
                });
                $('#grid-table-fastel_lov').trigger("reloadGrid");

        loadTableTrendInfo();

        $("#modal_lov_detail_skema").modal({backdrop: 'static'});
    }

    function loadTableTrendInfo() {
      var schema_id = $("#schema_id").val();

      $.ajax({
          url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/getTableTrendInfo'; ?>",
          type: "POST",
          data: { schema_id: schema_id },
          success: function (data) {
              $('#table-trend-info2').html(data);
              loadTableSkemaPembayaran_lov($('#trend-name').val());
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
  }

function loadTableSkemaPembayaran_lov(trend) {
      var schema_id = $("#schema_id").val();

      $.ajax({
          url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/getTableSkemaPembayaran2'; ?>",
          type: "POST",
          data: { schema_id: schema_id, trend:trend},
          success: function (data) {
              $('#table-skema-pembayaran2').html(data);
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
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

$(document).ready(function(){

        $("#download_kontrak").click(function() {
            var discount_code = $('#disc_code_lov').val();
            var schema_id = $("#schema_id").val();
            var customer_name = $("#customer_name_lov").val();

            location.href = '<?php echo WS_JQGRID.'schema.sc_schema_controller/downloadContract?discount_code='; ?>'+discount_code+"&schema_id="+schema_id+"&customer_name="+customer_name;
        });

});

jQuery(function($) {
        var grid_selector = "#grid-table-fastel_lov";
        var pager_selector = "#grid-pager-fastel_lov";

        jQuery("#grid-table-fastel_lov").jqGrid({
            url: '<?php echo WS_JQGRID."schema.fastel_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'fastel_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Batch ID', name: 'batch_id', width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Nomor Fastel',name: 'p_notel',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Amount(IDR)',name: 'amount',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Location',name: 'location',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Status',name: 'status',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                }
            ],
            height: '100%',
            autowidth: false,
            width:850,
            viewrecords: true,
            rowNum: 10,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager-fastel_lov',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
                // responsive_jqgrid('#grid-table-fastel_lov', '#grid-pager-fastel_lov');
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."schema.fastel_controller/crud"; ?>',
            caption: "Fastel"

        });

        jQuery('#grid-table-fastel_lov').jqGrid('navGrid', '#grid-pager-fastel_lov',
            {   //navbar options
                edit: false,
                editicon: 'fa fa-pencil blue bigger-120',
                add: false,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: false,
                delicon: 'fa fa-trash-o red bigger-120',
                search: true,
                searchicon: 'fa fa-search orange bigger-120',
                refresh: true,
                afterRefresh: function () {
                    // some code here

                },

                refreshicon: 'fa fa-refresh green bigger-120',
                view: false,
                viewicon: 'fa fa-search-plus grey bigger-120'
            },

            {
                // options for the Edit Dialog
                closeAfterEdit: true,
                closeOnEscape:true,
                recreateForm: true,
                serializeEditData: serializeJSON,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //new record form
                closeAfterAdd: false,
                clearAfterAdd : true,
                closeOnEscape:true,
                recreateForm: true,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                serializeEditData: serializeJSON,
                viewPagerButtons: false,
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }

                    $(".tinfo").html('<div class="ui-state-success">' + response.message + '</div>');
                    var tinfoel = $(".tinfo").show();
                    tinfoel.delay(3000).fadeOut();


                    return [true,"",response.responseText];
                }
            },
            {
                //delete record form
                serializeDelData: serializeJSON,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    style_delete_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                onClick: function (e) {
                    //alert(1);
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //search form
                closeAfterSearch: false,
                recreateForm: true,
                afterShowSearch: function (e) {
                    var form = $(e[0]);
                    style_search_form(form);
                    form.closest('.ui-jqdialog').center();
                },
                afterRedraw: function () {
                    style_search_filters($(this));
                }
            },
            {
                //view record form
                serializeDelData: serializeJSON,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                }
            }
        );

    });

    function serializeJSON(postdata) {
        var items;
        if(postdata.oper != 'del') {
            items = JSON.stringify(postdata, function(key,value){
                if (typeof value === 'function') {
                    return value();
                } else {
                  return value;
                }
            });
        }else {
            items = postdata.id;
        }

        var jsondata = {items:items, oper:postdata.oper, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'};
        return jsondata;
    }

    function style_edit_form(form) {
        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary');
        buttons.eq(1).addClass('btn-danger');
    }

    function style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger');
        buttons.eq(1).addClass('btn-default');
    }

    function style_search_filters(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-group').addClass('btn btn-xs btn-danger');
    }

    function style_search_form(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable')
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-success').find('.ui-icon').attr('class', 'fa fa-search');
    }

    function responsive_jqgrid(grid_selector, pager_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".tab-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );
    }
</script>