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
		<div class="form-group">
            <div class="row">
				<label class="control-label col-md-2">Name</label>
				<div class="col-md-3">
					<input class="form-control">
				</div>
			</div>
			<div class="row">
				<label class="control-label col-md-2">Address</label>
				<div class="col-md-3">
					<textarea class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Email</label>
				<div class="col-md-3">
					<input class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Daytime Tel</label>
				<div class="col-md-3">
					<input class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Evening Tel</label>
				<div class="col-md-3">
					<input class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Mobile</label>
				<div class="col-md-3">
					<input class="form-control">
			</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Fax</label>
				<div class="col-md-3">
					<input class="form-control">
				</div>
			</div>			
        </div>
    </div>
	<div>
	
	</div>
</div>

<script>
$(function($) {
        $("#tab-2").on( "click", function() { 
            var grid = $('#grid-table-prebill');
            selRowId = grid.jqGrid ('getGridParam', 'selrow');

            var idd = grid.jqGrid ('getCell', selRowId, 'p_finance_period_id');
            var code = grid.jqGrid ('getCell', selRowId, 'finance_period_code');

            if(selRowId == null) {
                swal("Informasi", "Silahkan Pilih Salah Satu Baris Data", "info");
                return false;
            }

            loadContentWithParams("customer.customer_details_2", {
            });
        });

        $("#tab-3").on( "click", function() { 
            return false;
        });
    });
	

</script>