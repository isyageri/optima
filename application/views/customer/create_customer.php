<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Customer</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Create Customer</span>
        </li>
    </ul>
</div>
<?php //print_r($this->session->all_userdata());?>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-info font-blue"></i>
  					<span class="caption-subject font-blue bold uppercase"> Data Transaksi
  					</span>
                </div>
            </div>
            <form role="form">
                <div class="row">
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="txt_noTransaction" value=""
                                       disabled>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Nomor Transaksi</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" readonly
                                       value="" id="txt_trxDate">
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Tanggal Transaksi</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-8">
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="txt_petugas"
                                       value="" readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Petugas</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="txt_lokasi" value="" readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Lokasi</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="form_control_1" value="NEW TRANSACTION"
                                       readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Status</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <span style="color:#ff0000" id="txt_cusReff"></span>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

    <div class="col-md-12">
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                     <span class="caption-subject font-red bold uppercase"> Create Customer -
                         <span class="step-title"> Step 1 of 3 </span>
                     </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" action="#" id="submit_form" method="post">
                    <div class="form-wizard">
                        <div class="form-body">
                            <ul class="nav nav-pills nav-justified steps">
                                <li>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                        <span class="number"> 1 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Customer </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Contact Detail </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab" class="step active">
                                        <span class="number"> 3 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Additional Information </span>
                                    </a>
                                </li>

                            </ul>
                            <div id="bar" class="progress progress-striped active" role="progressbar">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <div class="tab-content">
                                <div class="alert alert-danger display-none">
                                    <button class="close" data-dismiss="alert"></button>
                                    You have some form errors. Please check below.
                                </div>
                                <div class="alert alert-success display-none">
                                    <button class="close" data-dismiss="alert"></button>
                                    Your form validation is successful!
                                </div>
                                <div class="tab-pane active" id="tab1">
                                    <!--- TAB 1 -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Customer Ref
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="nipnas" id="nipnas" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Customer Type
                                                    <span class="required">  * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <?php echo buatcombo('in_CustomerType',
                                                        'in_CustomerType',
                                                        'gparams',
                                                        'name',
                                                        'rfid',
                                                        array('rfen' => 'CUSTOMERTYPE'),
                                                        'Y',
                                                        '- Pilih Customer Type -'
                                                    ); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Market Segment
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <?php echo buatcombo('in_MarketSegment',
                                                        'in_MarketSegment',
                                                        'gparams',
                                                        'name',
                                                        'rfid',
                                                        array('rfen' => 'MARKETSEGMENT'),
                                                        'Y',
                                                        '- Pilih Market Segment -'
                                                    ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="">
                                         <input type="hidden" value="22" name="groupId" id="groupId">
                                         <input type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>"
                                                name="userId" id="userId">
                                         <input type="hidden"
                                                value="<?php echo $this->session->userdata('location_id'); ?>" name="locId"
                                                id="locId">
                                         <input type="hidden" value="" name="idTD" id="idTD">
                                         <input type="hidden" value="" name="idTH" id="idTH">
                                         <br>
                                     </span>
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                           value="<?php echo
                                           $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" id="custReff" name="custReff" value="">
                                    <input type="hidden" id="prefix" name="prefix"
                                           value="<?php echo $this->session->userdata('location'); ?>">
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Title
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_Title"/>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">First Name
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_FirstName"/>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Initials
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_Initials"/>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Last Name
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_LastName"/>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Address Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="in_AddressName"
                                                           required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Salutation Name

                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_SalutationName"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Contact Type
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <?php echo buatcombo('in_ContactType',
                                                        'in_ContactType',
                                                        'gparams',
                                                        'name',
                                                        'rfid',
                                                        array('rfen' => 'CONTACTTYPE'),
                                                        'Y',
                                                        '- Pilih Contact Type -'
                                                    ); ?>
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="in_Email"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Street Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="in_StreetName"
                                                           required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Block Name
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_BlockName"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">District Name
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_DistrictName"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">City
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_City"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Province

                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_Province"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">ZIP Code
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="in_ZipCode"
                                                           required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Mobile Number
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_Phone"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Contact Start Date (mm/dd/yyyy)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input class="form-control datepicker required" type="text" value=""
                                                           id="datepicker" name="in_ContactStartDate" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tab3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Customer Category
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_CustomerCategory">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Market Group
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_MarketGroup">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">REG ID
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_RegID">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">CC Cluster
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="in_CCCluster">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Referensi NIPNAS
                                                    <span class="required"> * </span>
                                                </label>

                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="in_RefNipnas"
                                                           required>
                                                </div>
                                            </div>
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
                                    <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <button type="submit" class="btn green button-submit"> Submit
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#btn-lov-nipsos').on('click', function () {
            modal_lov_nipsos_show('nipsos', 'customer_name');
        });
    });

    var FormWizard = function () {
        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().bootstrapWizard) {
                    return;
                }


                var form = $('#submit_form');
                var error = $('.alert-danger', form);
                var success = $('.alert-success', form);

                form.validate({
                    doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    rules: {},

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
                        /*if (form.valid() == true) {
                            alert('tes');
                            return false;
                            form.submit();
                        }*/


                        //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax

                    }

                });


                var handleTitle = function (tab, navigation, index) {
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
                    } else {
                        $('#form_wizard_1').find('.button-next').show();
                        $('#form_wizard_1').find('.button-submit').hide();

                        var custReff = $('#custReff').val();
                        var prefix = $('#prefix').val();
                        var userId = $('#userId').val();
                        var idTD = $('#idTD').val();
                        var idTH = $('#idTH').val();
                        var groupId = $('#groupId').val();

                        if (!idTH) {
                            $.ajax({
                                url: "<?php echo site_url('customer_cont/initTransaksi'); ?>",
                                type: "POST",
                                dataType: "json",
                                data: {
                                    custReff: custReff,
                                    prefix: prefix
                                },
                                success: function (data) {
                                    $("#trx_no").val(data.txt_noTransaksi);
                                    $("#idTD").val(data.idTD);
                                    $("#idTH").val(data.idTH);
                                },
                                error: function (xhr, status, error) {
                                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                                }
                            });
                        }

                        if (!custReff) {
                            $.ajax({
                                url: "<?php echo site_url('customer_cont/genCustRef'); ?>",
                                type: "POST",
                                dataType: "json",
                                data: {
                                    custReff: custReff,
                                    prefix: prefix
                                },
                                success: function (data) {
                                    $("#txt_cusReff").html(data.strMessage);
                                    $("#custReff").val(data.txt_custRef);
                                    setval('nipnas',data.txt_custRef);
                                },
                                error: function (xhr, status, error) {
                                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                                }
                            });

                        }

                    }
                    //App.scrollTo($('.page-title'));
                };

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

                        handleTitle(tab, navigation, index);
                    },
                    onPrevious: function (tab, navigation, index) {
                        success.hide();
                        error.hide();

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
                    /* if(form.valid() == true){
                     form.submit();
                     }*/
                }).hide();


            }

        };

    }();

    jQuery(document).ready(function () {
        FormWizard.init();

        /* Init Transaction*/
        setval('txt_noTransaction',loc_code+'-CUST/'+dt_tgl3+'-???');
        setval('txt_trxDate',dt_tgl2);
        setval('txt_lokasi',loc_name);
        setval('txt_petugas',username);
        /* End Init Transaction */

        $('#submit_form').on('submit', (function (e) {
            // Stop form from submitting normally
            e.preventDefault();

            var postData = $('#submit_form').serialize(),
                url = "<?php echo site_url('Customer_cont/createCustomer');?>";

            // Send the data using post
            $.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                data: postData,
                success: function (data) {
                    if(data.statusCode == "T"){
                        swal('',data.strMessage);
                        $('#submit_form')[0].reset();
                        // Redirect
                    }else{
                        swal('',data.strMessage);
                    }

                },
                error: function (xhr, status, error) {
                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                }
            });
        }));

    });

    $('.datepicker').datepicker({
        todayHighlight: true,
        format: "mm/dd/yyyy",
        autoclose: true
    });
</script>
