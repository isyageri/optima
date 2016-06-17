<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Detail Message</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
    <div class="row">
        <div class="col-md-12">
                <!-- END SAMPLE FORM PORTLET-->
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-envelope"></i> Message
                        </div>
                        <div class="tools">
                            <a class="collapse" href="" data-original-title="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="#" class="form-horizontal">
                            <input type="hidden" id="trx_id" name="trx_id">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Code</label>
                                    <div class="col-md-3">
                                        <input type="text" id="code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status</label>
                                    <div class="col-md-2">
                                        <input type="text" id="status_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Message</label>
                                    <div class="col-md-5">
                                        <!-- <input type="text" class="form-control"> -->
                                        <textarea rows="4" cols="50" class="form-control" id="trx_name"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
<script>
    $("#trx_id").val("<?php echo $this->input->post('trx_id');?>");
    $("#code").val("<?php echo $this->input->post('code');?>");
    $("#status_name").val("<?php echo $this->input->post('status_name');?>");
    $("#trx_name").val("<?php echo $this->input->post('trx_name');?>");
</script>