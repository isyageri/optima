
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
  								<input type="text" class="form-control" id="form_control_1" readonly value="<?php echo strtoupper($this->session->userdata('username')); ?>">
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Petugas</label>
  							</div>
  						</div>
  						<div class="col-md-6">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly value="TELKOM">
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Lokasi</label>
  							</div>
  						</div>
  						<div class="col-md-4">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly value="NEW TRANSACTION">
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
                                          <label class="control-label col-md-3">Nipnas
                                             <span> * </span>
                                          </label>
                                          <div class="col-md-4">
                                            <div class="input-group">
                                               <input type="text" class="form-control required"  id="nipnas" name="nipnas" placeholder="Nipnas" />
                                               <span class="input-group-btn">
                                                 <button class="btn btn-success" type="button" id="btn-lov-nipnas">
                                                    <i class="fa fa-search"></i>
                                                 </button>
                                               </span>
                                            </div>
                                         </div>
                                         <div class="col-md-3">
                                            <input type="text" class="form-control" id="customer_name" readonly="" placeholder="Customer Name"  />
                                         </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="control-label col-md-3">Account Num
                                             <span> * </span>
                                          </label>
                                          <div class="col-md-4">
                                             <div class="input-group">
                                                 <input type="text" class="form-control required" id="account_num" name="account_num" placeholder="Account Number" />
                                                 <span class="input-group-btn">
                                                   <button class="btn btn-success" type="button" id="btn-lov-account">
                                                      <i class="fa fa-search"></i>
                                                   </button>
                                                 </span>
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                            <input type="text" class="form-control" id="account_name" readonly="" placeholder="Account Name"  />
                                         </div>
                                      </div>

                                 </div>
                                 <div class="tab-pane" id="tab2">
                                     <!--- TAB 2 -->

                                      <div class="input-group col-md-1">
                                         <input type="file" name="file_upload" />
                                         <span class="input-group-btn btn-right">
                                              <button class="btn green-haze"> Upload </button>
                                         </span>
                                      </div>
                                      <div class="space-4"></div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <table class="table">
                                                <tr>
                                                  <th>Fastel</th>
                                                  <th>Amount(IDR)</th>
                                                  <th>Location</th>
                                                  <th>Status</th>
                                                  <th>Action</th>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                              </table>
                                          </div>
                                      </div>

                                 </div>
                                 <div class="tab-pane" id="tab3">
                                      <div class="space-4"></div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                    <label class="col-md-3 control-label" for="trend">Trend:</label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="trend" id="trend" class="form-control">
                                                    </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                              <table class="table">
                                                  <tr>
                                                    <th>Keterangan</th>
                                                    <th>Maret</th>
                                                    <th>April</th>
                                                    <th>Mei</th>
                                                    <th>Juni</th>
                                                    <th>Juli</th>
                                                  </tr>
                                                  <tr>
                                                    <td>TOTAL TAGIHAN</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td>TELKOM_22</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td>TELKOM_L_K</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td>TELKOMSEL</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td>TAGIHAN ON NET</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td>TAGIHAN NON ON NET</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                              </table>
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
                                                              <input id="telkom_only" type="radio" checked="" value="telkom_only" name="operator">
                                                              Telkom Only
                                                              <span></span>
                                                            </label>

                                                            <label class="mt-radio">
                                                              <input id="multi_operator" type="radio" checked="" value="multi_operator" name="operator">
                                                              Multi Operator
                                                              <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                              </div>
                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                    <label class="col-md-3 control-label" for="trend">Kuadran:</label>
                                                      <div class="col-md-4">
                                                        <select class="form-control input-sm">
                                                          <option>Acquisition</option>
                                                          <option>Leverage</option>
                                                          <option>Win Back</option>
                                                          <option>Defend</option>
                                                        </select>
                                                      </div>

                                                      <div class="col-md-4">
                                                        <select class="form-control input-sm">
                                                          <option>Tiering Model</option>
                                                          <option>Volume Commitment</option>
                                                          <option>Cost Cap</option>
                                                        </select>
                                                      </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="space-4"></div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <h4>Skema Pembayaran</h4>
                                            <table class="table">
                                                <tr>
                                                  <th>Method</th>
                                                  <th>Model</th>
                                                  <th>Trafik Trend</th>
                                                  <th>Discount</th>
                                                  <th>Action</th>
                                                </tr>
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            </table>
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

<?php $this->load->view('lov/lov_nipnas2.php'); ?>
<?php $this->load->view('lov/lov_account.php'); ?>

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
      $('#btn-lov-nipnas').on('click',function() {
          modal_lov_nipnas_show('nipnas','customer_name');
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
  })

</script>
