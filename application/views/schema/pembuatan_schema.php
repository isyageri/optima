
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
            <span>Pembuatan Schema</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">

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
  								<input type="text" class="form-control" id="form_control_1" readonly value="SCHM-001">
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Schema ID</label>
  							</div>
  						</div>
  						<div class="col-md-12">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly value="<?php echo date('d-m-Y');?>">
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Tanggal Transaksi</label>
  							</div>
  						</div>
  					</div>
  					<div class="col-md-1">
  					</div>
  					<div class="col-md-8">
  						<div class="col-md-6">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly>
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Petugas</label>
  							</div>
  						</div>
  						<div class="col-md-6">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly>
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Lokasi</label>
  							</div>
  						</div>
  						<div class="col-md-4">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly>
  								<div class="form-control-focus"> </div>
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
                                             <i class="fa fa-check"></i> Tren & Info </span>
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
                                     <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                 <div class="alert alert-success display-none">
                                     <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                 <div class="tab-pane active" id="tab1">
                                      <!--- TAB 1 -->
                                      <div class="form-group">
                                          <label class="control-label col-md-3">Nipnos
                                             <span> * </span>
                                          </label>

                                          <div class="col-md-5">
                                            <div class="input-group">
                                               <input type="text" class="form-control required" id="nipsos" name="nipnos" placeholder="Nipnos" />
                                               <span class="input-group-btn">
                                                 <button class="btn btn-success" type="button" id="btn-lov-nipsos">
                                                    <i class="fa fa-search"></i>
                                                 </button>
                                               </span>
                                               <input type="text" class="form-control" id="customer_name" readonly="" placeholder="Customer Name"  />
                                            </div>
                                         </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="control-label col-md-3">Account Num
                                             <span> * </span>
                                          </label>
                                          <div class="col-md-5">
                                             <div class="input-group">
                                                 <input type="text" class="form-control required" name="account_number" placeholder="Account Number" />
                                                 <span class="input-group-btn">
                                                   <button class="btn btn-success" type="button">
                                                      <i class="fa fa-search"></i>
                                                   </button>
                                                 </span>
                                                 <input type="text" class="form-control" readonly="" placeholder="Customer Name"  />
                                             </div>
                                         </div>
                                      </div>


                                 </div>
                                 <div class="tab-pane" id="tab2">
                                     <h3 class="block">Provide your profile details</h3>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Fullname
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <input type="text" class="form-control" name="fullname" />
                                             <span class="help-block"> Provide your fullname </span>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Phone Number
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <input type="text" class="form-control" name="phone" />
                                             <span class="help-block"> Provide your phone number </span>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Gender
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <div class="radio-list">
                                                 <label>
                                                     <input type="radio" name="gender" value="M" data-title="Male" /> Male </label>
                                                 <label>
                                                     <input type="radio" name="gender" value="F" data-title="Female" /> Female </label>
                                             </div>
                                             <div id="form_gender_error"> </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Address
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <input type="text" class="form-control" name="address" />
                                             <span class="help-block"> Provide your street address </span>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">City/Town
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <input type="text" class="form-control" name="city" />
                                             <span class="help-block"> Provide your city or town </span>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Country</label>
                                         <div class="col-md-4">
                                             <select name="country" id="country_list" class="form-control">
                                                 <option value=""></option>
                                                 <option value="ZW">Zimbabwe</option>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Remarks</label>
                                         <div class="col-md-4">
                                             <textarea class="form-control" rows="3" name="remarks"></textarea>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="tab-pane" id="tab3">
                                     <h3 class="block">Provide your billing and credit card details</h3>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Card Holder Name
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <input type="text" class="form-control" name="card_name" />
                                             <span class="help-block"> </span>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Card Number
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <input type="text" class="form-control" name="card_number" />
                                             <span class="help-block"> </span>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">CVC
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <input type="text" placeholder="" class="form-control" name="card_cvc" />
                                             <span class="help-block"> </span>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Expiration(MM/YYYY)
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <input type="text" placeholder="MM/YYYY" maxlength="7" class="form-control" name="card_expiry_date" />
                                             <span class="help-block"> e.g 11/2020 </span>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Payment Options
                                             <span class="required"> * </span>
                                         </label>
                                         <div class="col-md-4">
                                             <div class="checkbox-list">
                                                 <label>
                                                     <input type="checkbox" name="payment[]" value="1" data-title="Auto-Pay with this Credit Card." /> Auto-Pay with this Credit Card </label>
                                                 <label>
                                                     <input type="checkbox" name="payment[]" value="2" data-title="Email me monthly billing." /> Email me monthly billing </label>
                                             </div>
                                             <div id="form_payment_error"> </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="tab-pane" id="tab4">
                                     <h3 class="block">Confirm your account</h3>
                                     <h4 class="form-section">Account</h4>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Username:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="username"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Email:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="email"> </p>
                                         </div>
                                     </div>
                                     <h4 class="form-section">Profile</h4>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Fullname:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="fullname"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Gender:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="gender"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Phone:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="phone"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Address:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="address"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">City/Town:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="city"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Country:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="country"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Remarks:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="remarks"> </p>
                                         </div>
                                     </div>
                                     <h4 class="form-section">Billing</h4>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Card Holder Name:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="card_name"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Card Number:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="card_number"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">CVC:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="card_cvc"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Expiration:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="card_expiry_date"> </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3">Payment Options:</label>
                                         <div class="col-md-4">
                                             <p class="form-control-static" data-display="payment[]"> </p>
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

<?php $this->load->view('schema/lov_nipsos2.php'); ?>

<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
  $(document).ready(function(){
      $('#btn-lov-nipsos').on('click',function() {
          modal_lov_nipsos_show('nipsos','customer_name');
      });
  })
</script>
