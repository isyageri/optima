<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Skema</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Info Skema</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <table id="grid-table"></table>
        <div id="grid-pager"></div>
    </div>
</div>

<?php //$this->load->view('lov/lov_detail_skema.php'); ?>
<?php //$this->load->view('lov/lov_info_fastel.php'); ?>
<?php //$this->load->view('lov/lov_info_billing.php'); ?> 
<?php $this->load->view('lov/lov_info_schema_ro.php'); ?>

<script>
    function showDetailSkema(discount_code) {
        modal_lov_detail_skema_show(discount_code);
    }

    function showDetailFastel(schema_id) {
        modal_lov_info_fastel_show(schema_id);
    }

    function showDetailBilling(account_num) {
        modal_lov_info_billing_show(account_num);
    }
    function download_contract(schema_id, is_active){

            var url = "<?php echo WS_JQGRID.'schema.input_data_contract_controller/word_contract?schema_id='; ?>" + schema_id+ '&';
          url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";

        if(is_active!='ACTIVE'){
            swal({title: 'Attention', text: 'Schema belum aktif !', html: true, type: "warning"});
            return false;
        }else{
          window.location = url;
        }
    }

    function showDiskon(account_num,customer_ref,account_name,created_date,schema_id) {
     
       modal_lov_detail_info_skema_show(account_num,customer_ref,account_name,created_date,schema_id);
    }


</script>

<script>
    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."schema.info_schema_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'schema_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},

                {label: 'NIPNAS',name: 'customer_ref',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Nama Customer',name: 'customer_name',width: 220, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Nomor Account',name: 'account_num',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Nama Account',name: 'account_name',width: 250, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Nama schema',name: 'schema_id',width: 250, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Jenis schema',name: 'jenis_skema',width: 300, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Tgl Pembuatan Skema', name: 'created_date', width: 150, align: "center", editable: false},
                {label: 'Tgl Berlaku Skema', name: 'start_dat', width: 150, align: "center", editable: false},
                {label: 'Tgl Berakhir Skema', name: 'end_dat', width: 150, align: "center", editable: false},
                {label: 'Status', name: 'status', width: 150, align: "center", editable: false},
                {label: 'Data Contract', name: 'schema_id', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        //console.log(rowObject.status);
                        return '<button type="button" class="btn btn-xs btn-default" onclick="download_contract(\''+cellvalue+'\',\''+rowObject.status+'\')"> Download Contract</button>';
                    }
                },
                {label: 'Detail Skema', name: 'schema_id', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        //console.log(rowObject.status);
                        return '<button type="button" class="btn btn-xs btn-default" onclick="showDiskon(\''+rowObject.account_num+'\',\''+rowObject.customer_ref+'\',\''+rowObject.account_name+'\',\''+rowObject.created_date+'\',\''+rowObject.schema_id+'\')"> Detail Schema </button>';
                    }
                }
               /* {label: 'Fastel', name: 'schema_id', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        return '<button type="button" class="btn btn-xs btn-success" onclick="showDetailFastel(\''+cellvalue+'\')"> Fastel </button>';
                    }
                },
                {label: 'Diskon Skema', name: 'schema_id', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        return '<button type="button" class="btn btn-xs btn-warning"> Diskon Skema </button>';
                    }
                },
                {label: 'Info Billing', name: 'account_num', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        return '<button type="button" class="btn btn-xs purple" onclick="showDetailBilling(\''+cellvalue+'\')"> Info Billing </button>';
                    }
                }*/
            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: 10,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: false,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."schema.info_schema_controller/crud"; ?>',
            caption: "Info Skema"

        });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
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
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }

</script>