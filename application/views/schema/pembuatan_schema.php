
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Schema</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pembuatan Schema Offering</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
   <!-- <div class="col-md-12">

  		<div class="portlet light bordered" >
  			<div class="portlet-title">
  				<div class="caption">
  					<i class=" icon-info font-blue"></i>
  					<span class="caption-subject font-blue bold uppercase"> Informasi Schema
  					</span>
  				</div>
  			</div>
  			<form role="form">
  				<div class="row">
  					<div class="col-md-3">
  						<div class="col-md-12">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="h_created_date" readonly value="<?php echo date('d-m-Y');?>">
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Tanggal Transaksi</label>
  							</div>
  						</div>
  					</div>
  					<div class="col-md-1">
  					</div>
  					<div class="col-md-8">

  						<div class="col-md-4">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="h_status" readonly value="NEW TRANSACTION">
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Status</label>
  							</div>
  						</div>
  					</div>
  				</div>

  			</form>
  		</div> 

    </div> -->

    <div class="col-md-12">
      <div class="portlet light bordered" id="form_wizard_1">
             <div class="portlet-title">
                 <div class="caption">
                     <i class=" icon-layers font-red"></i>
                     <span class="caption-subject font-red bold uppercase"> Pembuatan Schema -
                         <span class="step-title"> Step 1 of 4 </span>
                     </span>
                 </div>
             </div>
             <div class="portlet-body form">
                 <form class="form-horizontal" action="#" id="submit_form" method="POST">
                     <div class="form-wizard">
                         <div class="form-body">
                             <ul class="nav nav-pills nav-justified steps">
                                 <li>
                                     <a href="#tab1" data-toggle="tab" class="step">
                                         <span class="number"> 1 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Account Number </span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#tab2" data-toggle="tab" class="step">
                                         <span class="number"> 2 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Fastel </span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#tab3" data-toggle="tab" class="step active">
                                         <span class="number"> 3 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Trend & Info </span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#tab4" data-toggle="tab" class="step">
                                         <span class="number"> 4 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Scheme </span>
                                     </a>
                                 </li>
                             </ul>
                             <div id="bar" class="progress progress-striped active" role="progressbar">
                                 <div class="progress-bar progress-bar-success"> </div>
                             </div>
                             <div class="tab-content">
                                 <div class="alert alert-danger display-none">
                                     <button class="close" data-dismiss="alert"></button> Harap isi data yang dibutuhkan. </div>
                                 <div class="alert alert-success display-none">
                                     <button class="close" data-dismiss="alert"></button> Validasi Data Berhasil  </div>
                                 <div class="tab-pane active" id="tab1">
                                      <!--- TAB 1 -->
                                      <div class="form-group">
                                          <label class="control-label col-md-2">Nipnas
                                             <span> * </span>
                                          </label>
                                          <div class="col-md-3">
                                            <div class="input-group">
                                               <input type="hidden" class="form-control required"  id="schema_id" name="schema_id" placeholder="Nipnas" />
                                               <input type="text" class="form-control required"  id="nipnas" name="nipnas" placeholder="Nipnas" />
                                               <span class="input-group-btn">
                                                 <button class="btn btn-success" type="button" id="btn-lov-nipnas">
                                                    <i class="fa fa-search"></i>
                                                 </button>
                                               </span>
                                            </div>
                                         </div>
                                         <div class="col-md-5">
                                            <input type="text" class="form-control" id="customer_name" readonly="" placeholder="Customer Name"  />
                                         </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="control-label col-md-2">Account Num
                                             <span> * </span>
                                          </label>
                                          <div class="col-md-3">
                                             <div class="input-group">
                                                 <input type="text" class="form-control required" id="account_num" name="account_num" placeholder="Account Number" />
                                                 <span class="input-group-btn">
                                                   <button class="btn btn-success" type="button" id="btn-lov-account">
                                                      <i class="fa fa-search"></i>
                                                   </button>
                                                 </span>
                                             </div>
                                         </div>
                                         <div class="col-md-5">
                                            <input type="text" class="form-control" id="account_name" readonly="" placeholder="Account Name"  />
                                         </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-md-2">Location
                                          </label>
                                          <div class="col-md-3">
                                             <div class="input-group">
                                                 <input type="text" class="form-control" readonly id="location" name="location" placeholder="Location" value="<?php  echo $this->session->location_name;?>" />
                                             </div>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-md-2">Created By
                                          </label>
                                          <div class="col-md-3">
                                             <div class="input-group">
                                                 <input type="text" class="form-control" readonly id="created_by" name="created_by" placeholder="Created by" value="<?php echo $this->ion_auth->user()->row()->username;?>" />
                                             </div>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label col-md-2">Created Date
                                          </label>
                                          <div class="col-md-3">
                                             <div class="input-group">
                                                 <input type="text" class="form-control" readonly id="created_date" name="created_date" placeholder="Created date" value="<?php echo date('d-m-Y');?>" />
                                             </div>
                                         </div>
                                      </div>
                                      <!-- <a type="button" id="send_email" class="btn blue-haze" value="send_email">send_mail </a> -->

                                     <!--  <div class="form-group">
                                          <label class="control-label col-md-3">Start Date
                                             <span> * </span>
                                          </label>
                                          <div class="col-md-4">
                                             <div class="input-group">
                                                 <input type="text" class="form-control required" id="start_dat" name="start_dat" placeholder="Start Date" />
                                             </div>
                                         </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="control-label col-md-3">End Date
                                             <span>  </span>
                                          </label>
                                          <div class="col-md-4">
                                             <div class="input-group">
                                                 <input type="text" class="form-control" id="end_dat" name="end_dat" placeholder="End Date" />
                                             </div>
                                         </div>
                                      </div> -->
                                 </div>
                                 <div class="tab-pane" id="tab2">
                                     <!--- TAB 2 -->
                                      <input type="hidden" id="schema_id" name="schema_id">
                                      <input type="hidden" id="batch_id" name="batch_id">
                                      <input type="button" id="add_fastel" class="btn green-haze" value="Tambah Fastel">
                                      <input type="button" id="proses_fastel" class="btn blue-haze" value="Proses">
                                      <input type="button" id="hapus_fastel" class="btn red-haze" onclick="delete_fastel($('#batch_id').val(),0,1)" value="Hapus Semua Fastel">
                                      <div class="space-4"></div>
                                       <div class="space-4"></div>
                                       <div class="row" id="msg_proses_fastel">
                                          <div class="col-md-12">
                                          <p><i><b>Proses Pengambilan data history dan validasi fastel sedang berjalan, email pemberitahuan akan dikirim ketika proses sudah selesai.</b></i></p>
                                          <input type="button" id="check_proses_fastel" class="btn blue-haze" value="Check Proses" onclick="is_process_finished()">
                                          </div>
                                      </div>
                                        <div class="space-4"></div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <table id="grid-table-fastel"></table>
                                              <div id="grid-pager-fastel"></div>
                                          </div>
                                      </div>
                                 </div>
                                 <div class="tab-pane" id="tab3">
                                      <div class="space-4"></div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn green" id="btn-excel-trend-info">
                                                Download Excel
                                                <i class="fa fa-file-excel-o"></i>
                                            </button>
                                            <div class="space-4"></div>
                                        </div>

                                        <div class="col-md-12" id="table-trend-info">

                                        </div>
                                      </div>
                                 </div>
                                 <div class="tab-pane" id="tab4">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                    <label class="col-md-3 control-label" for="trend">Trend:</label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="trend" id="trend" class="form-control">
                                                    </div>
                                              </div>
                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                    <label class="col-md-3 control-label" for="trend">Operator:</label>
                                                    <div class="col-md-9">
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                              <input id="telkom_only"  class="operator" type="radio" checked=false value="TELKOM ONLY" name="operator">
                                                              Telkom Only
                                                              <span></span>
                                                            </label>

                                                            <label class="mt-radio">
                                                              <input id="temp_operator" type="hidden" required>
                                                              <input id="multi_operator" class="operator" type="radio" checked=false value="MULTI OPERATOR" name="operator">
                                                              Multi Operator
                                                              <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                              </div>
                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                    <label class="col-md-3 control-label" for="trend">Kuadran:</label>
                                                      <div class="col-md-4">
                                                        <select class="form-control input-sm" id="select_kuadran" required>
                                                         
                                                        </select>
                                                      </div>

                                                      <div class="col-md-4">
                                                        <select class="form-control input-sm" id="select_model">
                                                         
                                                        </select>
                                                      </div>
                                              </div>
                                              
                                               
                                              <!-- <input type="button" id="filter_diskon" class="btn blue-haze" value="Submit"> -->
                                          </div>
                                           <div class="col-md-12">
                                              <div class="form-group form-md-line-input form-md-floating-label">
                                               <label class="col-md-3 control-label" for="trend"></label>
                                                    <div class="col-md-4">
                                                      <button type ="button" class="btn btn-sm btn-info" id="simulasi_diskon" onclick="showSimulasi()"> Simulasi </button>
                                                    </div>
                                                     <div class="col-md-4">
                                                       
                                                      </div>
                                                   
                                              </div>
                                      </div>
                                      <div class="space-4"></div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <h4> Skema Pembayaran </h4>
                                          </div>
                                          <div class="col-md-12" id="table-skema-pembayaran">

                                          </div>
                                      </div>
                                 </div>
                             </div>
                         </div>
                         <div class="form-actions">
                             <div class="row">
                                 <div class="col-md-offset-3 col-md-9">
                                     <a href="javascript:;" class="btn default button-previous">
                                         <i class="fa fa-angle-left"></i> Back </a>
                                     <a href="javascript:;" class="btn btn-outline green button-next" id="continue_btn"> Continue
                                         <i class="fa fa-angle-right"></i>
                                     </a>
                                     <a href="javascript:;" class="btn green button-submit" id="submit_finale"> Submit
                                         <i class="fa fa-check"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
    </div>
</div>

<?php $this->load->view('lov/lov_nipnas2.php'); ?>
<?php $this->load->view('lov/lov_account.php'); ?>
<?php $this->load->view('lov/lov_upload_fastel.php'); ?>
<?php $this->load->view('lov/lov_trendinfo_detail.php'); ?>
<?php $this->load->view('lov/lov_simulasi.php'); ?>
<?php $this->load->view('lov/lov_contract.php'); ?>

<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


<script>

    var FormWizard = function () {

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                width: 'auto',
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {

                },

                messages: { // custom messages for radio buttons and checkboxes
                    'payment[]': {
                        required: "Please select at least one option",
                        minlength: jQuery.validator.format("Please select at least one option")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                //App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;

                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }
                    result = onNextTab(tab, navigation, index);
                    if(result == false) return false;
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    if(index == 1) {
                      responsive_jqgrid('#grid-table-fastel', '#grid-pager-fastel');
                    }
                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {
                

                trend = $('#trend').val();
                operator = $('#temp_operator').val();
                kuadran = $('#select_kuadran').val();
                model = $('#select_model').val();
                schema_id = $('#schema_id').val();
                
                if(trend != '' && operator != '' && kuadran != '' && model != '' && model != '-' && schema_id != ''){
                  $.ajax({
                    type: "POST",
                    url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/finished'; ?>",
                    data: { operator:operator, trend:trend, kuadran:kuadran, model:model, schema_id:schema_id },
                    success: function (data) {
                       swal({title: 'Info', text: 'Selesai, Step selanjutnya adalah mengisi data kontrak !', html: true, type: "info"});
                        loadContentWithParams('schema.index', {});
                        }
                     });
                }else{
                  swal({title: 'Warinig', text: 'Harap Lengkapi Data !', html: true, type: "warning"});
                }

                

            }).hide();

            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('#country_list', form).change(function () {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        }

    };

}();
</script>

<script>
    function showDetailTrend(an_fact, per_fact) {
        var schema_id = $("#schema_id").val();

        modal_lov_trendinfodetail_show(schema_id, an_fact,per_fact);
    }

    function showSimulasi(discount_code) {
                trend = $('#trend').val();
                operator = $('#temp_operator').val();
                kuadran = $('#select_kuadran').val();
                model = $('#select_model').val();
                schema_id = $('#schema_id').val();
                
                if(trend != '' && operator != '' && kuadran != '' && model != '' && model != '-' && schema_id != ''){
                  modal_lov_simulasi_show(discount_code);
                }else{
                 swal({title: "Warning!", text: 'Harap Lengkapi Data', html: true, type: "warning"});
                }
        
    }

    function pilihSimulasi(discount_code, p_business_schem_id) {

        var schema_id = $("#schema_id").val();
        modal_lov_contract_show(schema_id, discount_code, p_business_schem_id);

        /*swal({
            title: "Konfirmasi",
            text: "Apakah Anda yakin memilih skema pembayaran?",
            type: "info",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya, Pilih",
            confirmButtonColor: "#27a4b0",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true,
            html: true
        },
        function(isConfirm){
            if(isConfirm) {
                $.ajax({
                    url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/pilihSimulasiPembayaran'; ?>",
                    type: "POST",
                    dataType: "json",
                    data: { schema_id: schema_id,
                            discount_code: discount_code,
                            p_business_schem_id : p_business_schem_id },
                    success: function (data) {
                        if(data.success) {
                            loadTableSkemaPembayaran();
                            swal('Berhasil',data.message,'success');
                        }else {
                            swal('Info',data.message,'info');
                        }
                    },
                    error: function (xhr, status, error) {
                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    }
                });
            }else {
                return false;
            }
        });*/
    }
</script>

<script>
  $(document).ready(function(){

      $('#msg_proses_fastel').hide();
       $('#submit_finale').hide();
      // initial edit schema | add by umar 27/6/16
      var edit_schm_id = '<?php echo getVarClean('schema_id','str','0'); ?>';
      //alert(edit_schm_id);
      if(edit_schm_id.length > 1){

        init_edit_schema(edit_schm_id);
        $("#schema_id").val(edit_schm_id);

      }
      // end initiate 

      $('#btn-lov-nipnas').on('click',function() {
          modal_lov_nipnas_show('nipnas','customer_name');
      });


      $('#account_num').on('change', function() {
          if(0 == $('#schema_id').val().length){
            if(0 != $(this).val()){
            find_exist_schema($(this).val());
            }
          }
      });

      $('#nipnas').on('change', function() {
          $('#account_num').val('');
          $('#account_name').val('');
      });

      $('#btn-lov-account').on('click',function() {
          if($('#nipnas').val().length == 0) {
              swal("Info","NIPNAS harus diisi","info");
              return false;
          }

          modal_lov_account_show('account_num','account_name', $('#nipnas').val());
      });

      $('#start_dat').datepicker({
        format: 'yyyy-mm-dd'
      });
      $('#end_dat').datepicker({
        format: 'yyyy-mm-dd'
      });

      FormWizard.init();

      $("#add_fastel").on('click', function(e) {
          modal_lov_upload_fastel_show( $("#schema_id").val(), $("#nipnas").val(), $("#account_num").val() );
      });

      $("#proses_fastel").on('click', function(e) {

        schema_id = $('#schema_id').val();
        batch_id = $('#batch_id').val();

        var url = "<?php echo WS_JQGRID.'schema.sc_schema_controller/proses_get_history?schema_id='; ?>" + $("#schema_id").val() + '&batch_id='+batch_id+'&';
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
                   loadContentWithParams('schema.index', {});

              }else{
                  swal({title: 'Attention', text: response.message, html: true, type: "warning"});
              }
            }

          });
      }, 2000); });

         
      });

      $("#form-upload-fastel").on('submit', (function (e) {
          e.preventDefault();
          var data = new FormData(this);

          $.ajax({
            type: 'POST',
            dataType: "json",
            url: '<?php echo WS_JQGRID."schema.fastel_controller/uploadFastel"; ?>',
            data: data,
            timeout: 10000,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(response) {
              if(response.success) {

                  $('#file_upload_fastel').val('');

                  swal({title: 'Info', text: response.message, html: true, type: "info"});
                  modal_lov_upload_fastel_hide();
                  $('#grid-table-fastel').trigger("reloadGrid");

              }else{
                  swal({title: 'Attention', text: response.message, html: true, type: "warning"});
              }
            }

          });

          return false;
      }));

 $(".operator").on('click', function(e) {
      
       $('#temp_operator').val( $(this).val() );
       trend = $('#trend').val();
      
        $.ajax({
                type: "POST",
                url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/get_select_option'; ?>",
                data: { operator:$(this).val(), trend:trend },
                success: function (data) {
                  ret = data.split('|');
                  $('#select_kuadran').html(ret[0]);
                  $('#select_model').html(ret[1]);
                 /* $('#simulasi_diskon').show();*/

            }
         });
  
  });

 $('#select_model').change(function() {

      trend = $('#trend').val();
      operator = $('#temp_operator').val();
      kuadran = $('#select_kuadran').val();
      model = $(this).val();
      
      loadTableSkemaPembayaran(trend, kuadran, operator, model);

    });

  $("#form-upload-fastelsatuan").on('submit', (function (e) {
          e.preventDefault();

           var data = new FormData(this);
        
             $.ajax({
              type: 'POST',
              dataType: "json",
              url: '<?php echo WS_JQGRID."schema.fastel_controller/addFastelSatuan"; ?>',
              data: data,
              timeout: 10000,
              contentType: false, // The content type used when sending data to the server.
              cache: false, // To unable request pages to be cached
              processData: false,
              success: function(response) {
                if(response.success) {
                    swal({title: 'Info', text:response.message, html: true, type: "info"});
                    $('#fastelsatuan').val('');
                    $('#grid-table-fastel').trigger("reloadGrid");

                }else{
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
              }

            });

              return false;
          }
      ));

      $('#btn-excel-trend-info').on('click',function(e) {
          var url = "<?php echo WS_JQGRID.'schema.sc_schema_controller/excelTableTrendInfo?schema_id='; ?>" + $("#schema_id").val() + '&';
          url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
          window.location = url;
      });

      $('#send_email').on('click',function(e) {
          var url = "<?php echo WS_JQGRID.'schema.sc_schema_controller/test_email?schema_id='; ?>" + $("#schema_id").val() + '&';
          url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
          window.location = url;
      });

      $('#form-data-contract').on('submit', (function (e) {
        // Stop form from submitting normally
        e.preventDefault();

        trend = $('#trend').val();
        operator = $('#temp_operator').val();
        kuadran = $('#select_kuadran').val();
        model = $('#select_model').val();
        
        var postData = $('#form-data-contract').serializeArray(),
        url = "<?php echo WS_JQGRID.'schema.sc_schema_controller/createDataContract'; ?>";

        // Send the data using post
        $.ajax({
          url: url,
          type: "POST",
          dataType: "json",
          data: postData,
          success: function (response) {
              if(response.success) {
                swal({title: 'Info', text: response.message, html: true, type: "info"});
                modal_lov_contract_hide();
                // loadTableSkemaPembayaran();
                 loadTableSkemaPembayaran(trend, kuadran, operator, model);
              }else{
                  swal({title: 'Attention', text: response.message, html: true, type: "warning"});
              }
          }
        });

      }));
  })


  var skemaAdded = false;
  var is_finished_fastel = false;
  var del_fastel = true;

  function onNextTab(tab, navigation, index) {
	  
    if(index == 1 && !skemaAdded) {
        return addSkema(tab, navigation, index);
        return true;
    }

    if(index == 1) {

        is_process_finished();
        responsive_jqgrid('#grid-table-fastel', '#grid-pager-fastel');
        $('#grid-table-fastel').jqGrid('setGridParam', {
                  postData: {schema_id: $("#schema_id").val()}
              });
        $('#grid-table-fastel').trigger("reloadGrid");
    }

    if(index == 2) {
      loadTableTrendInfo();
    }

	if(index == 3) {
	/* var operator = $('#trend-name').val() ;
		kuadran = $('#trend-name').val() ;
		trend = $('#trend-name').val() ;*/
    
    $('#submit_finale').hide();
    /* $('#simulasi_diskon').hide();*/
		var trend  = $('#trend').val();
		operator  = $('#temp_operator').val();
		kuadran  = $('#select_kuadran').val();
		model  = $('#select_model').val();

		// loadTableSkemaPembayaran();
		loadTableSkemaPembayaran(trend, kuadran, operator, model);
	}
    if(index == 4) {

  }
  }

function cek_fastel(){

}

function is_process_finished(){
    schema_id = $('#schema_id').val();
     $.ajax({
          url: "<?php echo WS_JQGRID.'schema.fastel_controller/is_finished'; ?>",
          type: "POST",
		      dataType : 'json',
          data: { schema_id:schema_id },
          success: function (data) {

            if(data.check == 1){
    			         //swal({title: "Warning!", text: data.message, html: true, type: "warning"});
                        $('#continue_btn').show();
    				            $('#msg_proses_fastel').hide();
                        $('#add_fastel').show();
                        $('#proses_fastel').show();
                        $('#hapus_fastel').show();
                        del_fastel = false;
    			 }else if( data.check < 0 ){
                        $('#msg_proses_fastel').hide();
                        $('#continue_btn').hide();
                        $('#add_fastel').show();
                        $('#proses_fastel').show();
                        $('#hapus_fastel').show();
                        del_fastel = true;
    			   }else{
                        $('#continue_btn').hide();
                        $('#msg_proses_fastel').show();
                        $('#add_fastel').hide();
                        $('#proses_fastel').hide();
                        //$('#hapus_fastel').hide();
                        del_fastel = false;
             }

          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
	  return is_finished_fastel;
  }
  
 function del_all(){
    schema_id = $('#schema_id').val();
     $.ajax({
          url: "<?php echo WS_JQGRID.'schema.fastel_controller/del_fastel'; ?>",
          type: "POST",
          data: { all:1, schema_id:schema_id },
          success: function (data) {
           $('#grid-table-fastel').trigger("reloadGrid");
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
  }
  function delete_fastel(batch_id, notel, is_all){

     $.ajax({
          url: "<?php echo WS_JQGRID.'schema.fastel_controller/del_fastel'; ?>",
          type: "POST",
          data: { batch_id: batch_id, notel:notel, is_all:is_all },
          success: function (data) {
           $('#grid-table-fastel').trigger("reloadGrid");
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
  }

  function get_schema_disount(tren, kuadram, operator){

  }

  function init_edit_schema(schema_id){
    
     $.ajax({
          url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/getInfoSchema'; ?>",
          type: "POST",
          data: { schema_id: schema_id },
          success: function (data) {
            if(data != 'nodata'){
                data = JSON.parse(data);
                // $('#h_created_by').val(data[0].created_by);
                // $('#h_created_date').val(data[0].created_date);
                // $('#h_location').val(data[0].location_id);
                // $('#h_status').val(data[0].status);
                /*$('#start_dat').val(data[0].start_dat);
                $('#end_dat').val(data[0].end_dat);*/
                $('#batch_id').val(data[0].batch_id);
                $('#account_num').val(data[0].account_num);
                $('#account_name').val(data[0].account_name);
                $('#nipnas').val(data[0].customer_ref);
                $('#customer_name').val(data[0].account_name);
                $('#created_by').val(data[0].created_by);
                $('#created_date').val(data[0].created_date);
                $('#location').val(data[0].location_name);
                $('#btn-lov-nipnas').prop('disabled',true);
                $('#btn-lov-account').prop('disabled',true);

                skemaAdded = true;
            }
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });


  }

  function loadTableTrendInfo() {
      var schema_id = $("#schema_id").val();

      $.ajax({
          url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/getTableTrendInfo'; ?>",
          type: "POST",
          data: { schema_id: schema_id },
          success: function (data) {
              $('#table-trend-info').html(data);
              $('#trend').val($('#trend-name').val());
              $('#trend').prop('readonly','readonly');

              $('#r_simulasi_avg_on_net').val($('#trend-avg-usage-onnet').val());
              // $('#r_simulasi_on_net').val($('#trend-avg-usage-onnet').val());
              // $('#r_simulasi_non_on_net').val($('#trend-avg-usage-nononnet').val());
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
  }


  function loadTableSkemaPembayaran(trend, kuadran, operator, model) {
      var schema_id = $("#schema_id").val();

      $.ajax({
          url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/getTableSkemaPembayaran'; ?>",
          type: "POST",
          data: { schema_id: schema_id , trend: trend, operator:operator , kuadran:kuadran , model:model},
          success: function (data) {
              $('#table-skema-pembayaran').html(data);
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
  }

  function find_exist_schema(account_num) {

      $.ajax({
          url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/find_exist_schema'; ?>",
          type: "POST",
          dataType : 'json',
          data: { account_num:account_num},
          success: function (data) {
            if(!data.success){
              swal({title: "Error!", text: data.message, html: true, type: "error"});
              $('#account_num').val('');
              $('#account_name').val('');
            }
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
  }


  function addSkema(tab, navigation, index) {

      var nipnas = $('#nipnas').val();
      var account_num = $('#account_num').val();
     /* var start_dat = $('#start_dat').val();
      var end_dat = $('#end_dat').val();*/

      var items = {};
      items.customer_ref = nipnas;
      items.account_num = account_num;
      items.created_by = '<?php echo $this->ion_auth->user()->row()->username; ?>';
      items.created_date = '<?php echo date('Y-m-d'); ?>';
      items.step = 1;
      items.status = 'Inisialisasi Pembuatan Skema';
      /*items.start_dat = start_dat;
      items.end_dat = end_dat;*/

      $.ajax({
          url: "<?php echo WS_JQGRID.'schema.sc_schema_controller/addSkema'; ?>",
          type: "POST",
          dataType : 'json',
          data: { items: JSON.stringify(items) },
          success: function (data) {
              if(data.success) {
                skemaAdded = true;
                $("#schema_id").val(data.schema_id);
                $("#batch_id").val(data.batch_id);

                $('#grid-table-fastel').jqGrid('setGridParam', {
                    postData: {schema_id: $("#schema_id").val()}
                });
                $('#grid-table-fastel').trigger("reloadGrid");
              }else {
                 return false;
              }
          },
          error: function (xhr, status, error) {
              swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
              return false;
          }
      });
  }


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
                 {label: 'Info',name: 'error_msg',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Action',name: 'action',width: 100, align: "center",editable: true,
                    formatter:  function(cellvalue, options, rowobject){
                      if(del_fastel){
                          return '<a title="delete" class="btn btn-xs btn-danger" onclick="delete_fastel('+cellvalue+')" href="javascript:;"><i title="info" class="icon-trash"></i></a>';
                          //'| <a class="btn btn-xs btn-info" onclick="" href="javascript:;"><i class="icon-info"></i></a>';
                      }else{
                        //return '<a title="info" class="btn btn-xs btn-info" onclick="" href="javascript:;"><i class="icon-info"></i></a>';
                        return '-';
                      }
                     
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
        $(grid_selector).jqGrid( 'setGridWidth', $(".tab-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );
    }
</script>
