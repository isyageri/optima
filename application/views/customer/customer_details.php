<div>
	<div>
	Customer Details
	</div>
	<div class="tabbable tabbable-tabdrop">
		<ul class="nav nav-tabs">
			<li class="active">
				<a data-toggle="tab"> Account </a>
			</li>
			<li id="tab-2">
				<a data-toggle="tab"> Finance dan Billing </a>
			</li>
			<li id="tab-3">
				<a data-toggle="tab"> Contact </a>
			</li>
			<li id="tab-3">
                <a data-toggle="tab"> Additional Info </a>
            </li>
        </ul>
	</div>
	<div class="form-body">
		<div class="tab-pane">
			<div class="row">
				<form class="form-horizontal">
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Customer</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Account Number</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Account Name</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Account Status</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Go live date and time</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Invoicing Company</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Contracted Point of Supply</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Tax Status</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Tax Status</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Last Bill Date</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Termination Date</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="col-md-3 control-label">Termination Reason</label>
						<div class="col-md-8">
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
    </div>
</div>

<script>
$(function($) {
        $("#tab-2").on( "click", function() {             
            loadContentWithParams("customer.customer_details_finance", {
            });
        });

        $("#tab-3").on( "click", function() { 
            return false;
        });
    });
</script>