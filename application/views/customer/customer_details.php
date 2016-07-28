<div>
	<div>
	Customer Details
	</div>
	<div class="tabbable tabbable-tabdrop">
		<ul class="nav nav-tabs">
			<li class="active">
				<a data-toggle="tab"> Informasi </a>
			</li>
			<li id="tab-2">
				<a data-toggle="tab"> Threshold </a>
			</li>
			<li id="tab-3">
				<a data-toggle="tab"> Fastel </a>
			</li>
        </ul>
	</div>
	<div class="form-body">
		<div class="tab-pane">
			<div class="portlet light bordered">
				<div class="row">
					<form class="form-horizontal">
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label">Nama Skema</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nmschem">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label">Customer Ref</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="custref">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label">Nomor Account</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="noacc">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label">Tanggal Mulai</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="tgmulai">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label">Tanggal Berakhir</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="tgakhir">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label">Customer Name</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="custname">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label">Nama Account</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="nmacc">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label">Email</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="email">
							</div>
						</div>						
						<div class="form-group">
							<div class="col-md-1"></div>
							<label class="col-md-3 control-label" >NPWP</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="npwp">
							</div>
						</div>
						<div id="tariff_id" style="display: none;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

$(document).ready(function(){
			 // alert(celval);
			// var varc = celval;
			$.ajax({
				async: false,
				url: "<?php echo WS_JQGRID."customer.search_customer_controller/viewInformasiSchema"; ?>",
				type: "POST",
				datatype: "json",
				data: {	celval: "<?php echo $this->input->post('celval') ?>",
						celprodseq: "<?php echo $this->input->post('celprodseq') ?>"
					},
					success: function (data) {
					var items = jQuery.parseJSON(data);
					
					$('#nmschem').val(items[0].txt_namaSchema);
					$('#custref').val(items[0].txt_custref);
					$('#noacc').val(items[0].txt_accountNum);
					$('#tgmulai').val(items[0].startDat);
					$('#tgakhir').val(items[0].txt_endDat);
					$('#custname').val(items[0].txt_custName);
					$('#nmacc').val(items[0].txt_accName);
					$('#email').val(items[0].txt_email);
					$('#npwp').val(items[0].txt_npwp);
					$('#tariff_id').val(items[0].tariffId);
				}
			});
	});
	
        $("#tab-2").on( "click", function() {             
            loadContentWithParams("customer.customer_details_finance", {
				celval:"<?php echo $this->input->post('celval') ?>",
				celprodseq:"<?php echo $this->input->post('celprodseq') ?>",
				tariff_id: $('#tariff_id').val(),
				accountNum: $('#noacc').val()
            });
        });

        $("#tab-3").on( "click", function() { 
            return false;
        });
</script>