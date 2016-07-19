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
            <span>Input Data Contract</span>
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

    <div class="space-4"></div>
    <div class="row">
    <div class="col-md-12">
    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab"> Skema Diskon </a>
            </li>
            <li class="">
                <a href="#tab_1_2" data-toggle="tab"> Data Fastel </a>
            </li>
            <li class="">
                <a href="#tab_1_3" data-toggle="tab"> Contract </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
            <form role="form" id="form-data-contract_schema" method="post" class="form-horizontal">
            <h4>Info Skema</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Schema ID" name="schema_id" class="form-control " readonly>
                        </div>
                        <div class="col-md-6">
                           
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Account Number" name="account_num" class="form-control " readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Customer Name" name="customer_name" class="form-control " readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Start Date" name="start_dat" id="start_dat" class="form-control required" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="End Date" name="end_dat" id="end_dat" class="form-control required" required>
                        </div>
                    </div>
                    
                    <h4>Skema Diskon</h4>
                    <hr>
                        <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Skema Diskon" name="skema_disc" id="skema_disc" class="form-control required" required> 
                            <input type="hidden" placeholder="Skema Diskon" name="discount_code" id="discount_code" class="form-control required"> 
                        </div>
                        <div class="col-md-6">
                            <span class="input-group-btn">
                             <button class="btn btn-success" type="submit" id="submit_form1" >
                               Submit
                             </button>
                           </span>
                        </div>
                    </div>
                            <div class="row">
                          <div class="col-md-12" id="table-skema-pembayaran">

                          </div>
                      </div>
                    </form>

            </div>
            <div class="tab-pane " id="tab_1_3">
      <form role="form" id="form-data-contract" method="post" class="form-horizontal">
                    <input type="hidden" id="modal_lov_contract_schema_id" name="schema_id">
                    <input type="hidden" id="modal_lov_contract_discount_code" name="discount_code">
                    <input type="hidden" id="modal_lov_contract_p_business_schem_id" name="p_business_schem_id">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    
                    <h4>Data Kontrak</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Nomor" name="nomor1" class="form-control required" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Nomor" name="nomor2" class="form-control required" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Hari" name="hari" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Tanggal" name="tanggal" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Bulan" name="bulan" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Tahun" name="tahun" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Bertempat Di" name="lokasi" class="form-control">
                        </div>
                    </div>

                    <h4>PT.Telkom Indonesia</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Alamat" name="alamat_t" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Nama (Perwakilan)" name="nama_t" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Jabatan" name="jabatan_t" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Nomor Rekening" name="rek_no" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Atas Nama" name="rek_name" class="form-control">
                        </div>
                    </div>

                    <h4>Customer</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Nama Perusahaan" name="nama_pt" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Alamat" name="alamat_c" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Nama (Perwakilan)" name="nama_c" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Jabatan" name="jabatan_c" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Alamat Pengiriman Invoice" name="alamat_inv" class="form-control">
                        </div>
                    </div>

                    <h4>Program</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="number" placeholder="Program" name="program" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" id="save-contract" class="btn btn-success btn-block"> Simpan Kontrak & Sent to approver </button>
                        </div>
                    </div>
                        
                </form>
                </div>
                <div class="tab-pane " id="tab_1_2">
                         <div class="row">
                          <div class="col-md-12">
                              <table id="grid-table-fastel"></table>
                              <div id="grid-pager-fastel"></div>
                          </div>
                        </div>
                </div>
                </div>
</div>
</div>
</div>

<?php $this->load->view('lov/lov_info_schema.php'); ?>

<script>

    function load_mode_edit(editable){

        var grid = jQuery('#grid-table');
        var sel_id = grid.jqGrid('getGridParam', 'selrow'); 
        var account_num = grid.jqGrid('getCell', sel_id, 'account_num');
        var customer_ref = grid.jqGrid('getCell', sel_id, 'customer_ref');
        var account_name = grid.jqGrid('getCell', sel_id, 'account_name');
        var created_date = grid.jqGrid('getCell', sel_id, 'created_date');
        var schema_id = grid.jqGrid('getCell', sel_id, 'schema_id');
        
        $('[name="customer_name"]').val(account_name);
        $('[name="nipnas"]').val(customer_ref);
        $('[name="account_num"]').val(account_num);
        $('[name="schema_id"]').val(schema_id);

        // reload grid 
        $('#grid-table-fastel').jqGrid('setGridParam', {
                    postData: {schema_id: schema_id}
                });
                $('#grid-table-fastel').trigger("reloadGrid");
                trend = 'POSITIVE';

        loadTableSkemaPembayaran(trend);
    }
  
    function loadTableSkemaPembayaran(trend) {
      var schema_id = $('[name="schema_id"]').val();

      $.ajax({
          url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/getTableSkemaPembayaran2'; ?>",
          type: "POST",
          data: { schema_id: schema_id, trend:trend, form:'contract'},
          success: function (data) {
              $('#table-skema-pembayaran').html(data);
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
    }

    function pilih_diskon(code,name){
        $('#discount_code').val(code);
        $('#skema_disc').val(name);
    }


    function load_mode_read(editable){

    }

    function load_data(editable){
        load_mode_edit();

        load_mode_read();
    }

    function showDetailSkema(discount_code) {
        //modal_lov_detail_skema_show(discount_code);
    }

    function showDetailFastel(schema_id) {
        //modal_lov_info_fastel_show(schema_id);
    }

    function showDetailBilling(account_num) {
        //modal_lov_info_billing_show(account_num);
    }
    function showDiskon(account_num) {
        var grid = jQuery('#grid-table');
        var sel_id = grid.jqGrid('getGridParam', 'selrow'); 
        var account_num = grid.jqGrid('getCell', sel_id, 'account_num');
        var customer_ref = grid.jqGrid('getCell', sel_id, 'customer_ref');
        var account_name = grid.jqGrid('getCell', sel_id, 'account_name');
        var created_date = grid.jqGrid('getCell', sel_id, 'created_date');
        var schema_id = grid.jqGrid('getCell', sel_id, 'schema_id');
     
         modal_lov_detail_info_skema_show(account_num,customer_ref,account_name,created_date,schema_id);
    }
</script>

<script>
$(document).ready(function(){

    $('#form-data-contract_schema').submit(function(){

        start_dat = $('#start_dat').val();
        end_dat = $('#end_dat').val();
        discount_code = $('#discount_code').val();
        schema_id = $('#schema_id').val();

         $.ajax({
                type: "POST",
                url: "<?php echo WS_JQGRID.'schema.input_data_contract_controller/submit_skema_diskon'; ?>",
                data: { start_dat:start_dat,end_dat:end_dat,discount_code:discount_code, schema_id:schema_id  },
                success: function (data) {


            }
         });

    });


    $('#start_dat').datepicker({
        format: 'yyyy-mm-dd'
      });
      $('#end_dat').datepicker({
        format: 'yyyy-mm-dd'
      });
    
})


    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."schema.input_data_contract_controller/crud"; ?>',
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
                {label: 'Step',name: 'step',width: 150, align: "left",editable: true,
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
                {label: 'Detail Skema', name: 'discount_id', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        return '<button type="button" class="btn btn-xs btn-default" onclick="showDetailSkema(\''+cellvalue+'\')"> Detail Skema </button>';
                    }
                },
                {label: 'Fastel', name: 'schema_id', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        return '<button type="button" class="btn btn-xs btn-success" onclick="showDetailFastel(\''+cellvalue+'\')"> Fastel </button>';
                    }
                },
                {label: 'Diskon Skema', name: 'schema_id', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        return '<button type="button" class="btn btn-xs btn-warning" onclick="showDiskon(\''+cellvalue+'\')" > Diskon Skema </button>';
                    }
                },
                {label: 'Info Billing', name: 'account_num', width: 150,  sortable:false, search:false, align:"center", editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        //var  theID = rowObject['role_permissions_id'];
                        return '<button type="button" class="btn btn-xs purple" onclick="showDetailBilling(\''+cellvalue+'\')"> Info Billing </button>';
                    }
                }
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
                load_mode_edit();

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

jQuery(function($) {
        var grid_selector = "#grid-table-fastel";
        var pager_selector = "#grid-pager-fastel";

        jQuery("#grid-table-fastel").jqGrid({
            url: '<?php echo WS_JQGRID."schema.fastel_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'fastel_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
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
                },
                {label: 'Action',name: 'action',width: 150, align: "left",editable: true,
                    formatter:  function(cellvalue, options, rowobject){
                      return '<a class="btn btn-xs btn-danger" onclick="delete_fastel('+cellvalue+')" href="javascript:;"><i class="icon-trash"></i></a>';
                      // return '<i class="btn red btn-xs fa fa-trash-o fa-1x" onclick="delete_fastel('+cellvalue+')"></i>';
                    }
                },
            ],
            height: '100%',
            autowidth: false,
            width:600,
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
            pager: '#grid-pager-fastel',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
                responsive_jqgrid('#grid-table-fastel', '#grid-pager-fastel');
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."schema.fastel_controller/crud"; ?>',
            caption: "Fastel"

        });

        jQuery('#grid-table-fastel').jqGrid('navGrid', '#grid-pager-fastel',
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
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }

</script>