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
                                <input type="text" class="form-control" value="TELKOM-CUST/VI/02/16-???" disabled>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Nomor Transaksi</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="form_control_1" readonly
                                       value="<?php echo date('d-m-Y'); ?>">
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
                                <input type="text" class="form-control" id="form_control_1"
                                       value="<?php echo strtoupper($this->session->userdata('username')); ?>" readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Petugas</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="form_control_1" value="TELKOM" readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Lokasi</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="form_control_1" value="NEW TRANSACTION"
                                       readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Status</label>
                            </div>
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
                <form class="form-horizontal" action="#" id="submit_form" method="POST">
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
                                    <div class="form-group">
                                        <label class="control-label col-md-3">NIPNAS
                                        </label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="nipnas" readonly>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="control-label col-md-3">NIPNAS
                                        </label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control required" id="nipsos" name="nipnos" placeholder="Nipnos" />
                                              <span class="input-group-btn">
                                                <button class="btn btn-success" type="button" id="btn-lov-nipsos">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                              </span>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Customer Type
                                            <span class="required">  * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <select class="form-control required" required>
                                                <option>- Pilih Customer -</option>
                                                <option>Customer : Coorporate 1</option>
                                                <option>Customer : Private</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Market Segment
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-4">
                                            <select class="form-control required" required>
                                                <option>- Pilih Market Segment -</option>
                                                <option>DES</option>
                                                <option>DBS</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Title
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="title"/>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">First Name
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="firstname"/>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Inititals
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="initials"/>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Last Name
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="lastname"/>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Address Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="address"
                                                           required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Salutation Name

                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="salutation_name"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Contact Type
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <select class="form-control required" required>
                                                        <option>- Pilih Market Segment -</option>
                                                        <option>DES</option>
                                                        <option>DBS</option>
                                                    </select>
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="email"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Street Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="street"
                                                           required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Block Name
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="block_name"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">District Name
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="district"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">City
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="city"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Province

                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="province"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">ZIP Code
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required" name="zip_code" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Mobile Number
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="phone"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Contact Start Date
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input class="form-control date-picker" type="text" value="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tab3">
                                    <h4 class="form-section">Account</h4>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Username:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="username"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="email"></p>
                                        </div>
                                    </div>
                                    <h4 class="form-section">Profile</h4>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fullname:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="fullname"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Gender:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="gender"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Phone:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="phone"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Address:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="address"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">City/Town:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="city"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Country:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="country"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Remarks:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="remarks"></p>
                                        </div>
                                    </div>
                                    <h4 class="form-section">Billing</h4>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Card Holder Name:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="card_name"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Card Number:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="card_number"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">CVC:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="card_cvc"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Expiration:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="card_expiry_date"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Payment Options:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="payment[]"></p>
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
                                    <a href="javascript:;" class="btn green button-submit"> Submit
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

<script>
    $(document).ready(function () {
        $('#btn-lov-nipsos').on('click', function () {
            modal_lov_nipsos_show('nipsos', 'customer_name');
        });
    })

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
                        //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                    }

                });

                var displayConfirm = function () {
                    $('#tab4 .form-control-static', form).each(function () {
                        var input = $('[name="' + $(this).attr("data-display") + '"]', form);
                        if (input.is(":radio")) {
                            input = $('[name="' + $(this).attr("data-display") + '"]:checked', form);
                        }
                        if (input.is(":text") || input.is("textarea")) {
                            $(this).html(input.val());
                        } else if (input.is("select")) {
                            $(this).html(input.find('option:selected').text());
                        } else if (input.is(":radio") && input.is(":checked")) {
                            $(this).html(input.attr("data-title"));
                        } else if ($(this).attr("data-display") == 'payment[]') {
                            var payment = [];
                            $('[name="payment[]"]:checked', form).each(function () {
                                payment.push($(this).attr('data-title'));
                            });
                            $(this).html(payment.join("<br>"));
                        }
                    });
                }

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
                        displayConfirm();
                    } else {
                        $('#form_wizard_1').find('.button-next').show();
                        $('#form_wizard_1').find('.button-submit').hide();
                    }
                    App.scrollTo($('.page-title'));
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
                    alert('Finished! Hope you like it :)');
                }).hide();

                //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
                $('#country_list', form).change(function () {
                    form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
                });
            }

        };

    }();

    jQuery(document).ready(function () {
        FormWizard.init();
    });
</script>
