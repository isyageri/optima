<!--Init Transaction-->
<script language="javascript" type="text/javascript">
    <?php
    $blnRomawi = array("I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
    $blnIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    echo "var dt_tgl1 = '".date("d/m/Y")."';";
    echo "var dt_tgl2 = '".date("M d, Y")."';";
    echo "var dt_tgl3 = '".$blnRomawi[date("m")-1]."/".date("d/y")."';";
    echo "var dt_tgl4 = '".date("d")." ".$blnIndo[date("m")-1]." ".date("y")."';";
    ?>
    var loc_code = "<?php echo strtoupper($this->session->userdata('location_code')); ?>";
    var loc_name = "<?php echo strtoupper($this->session->userdata('location_name')); ?>";
    var username = "<?php echo strtoupper($this->session->userdata('username')); ?>";
</script>
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- begin jqgrid -->
<script src="<?php echo base_url(); ?>assets/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jqgrid/src/jquery.jqGrid.js" type="text/javascript"></script>

<!-- begin swal -->
<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/swal/sweetalert-dev.js"></script>

<!-- end swal -->

<script src="<?php echo base_url(); ?>assets/bootgrid/jquery.bootgrid.min.js"></script>


<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>


<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js/optimal.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.simplePagination.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
	
	// google.charts.load('current', {'packages':['corechart']});
    $(document).ready(function () {
        // Ajax setup csrf token.
        var csfrData = {};
        csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajaxSetup({
            data: csfrData,
            cache: false
        });
   });

    $(document).ajaxStart(function () {
        $(document).ajaxStart($.blockUI({
            message:  'Loading...',
            css: {
                border: 'none',
                padding: '5px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .6,
                color: '#fff'
            }

        })).ajaxStop($.unblockUI);
    });

    function loadContentWithParams(id, params) {
        $.ajax({
            url: "<?php echo base_url().'home/load_content/'; ?>" + id,
            type: "POST",
            data: params,
            success: function (data) {
                $( "#main-content" ).html( data );
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
            }
        });
        return false;
    }

    $(".nav-item").on('click', function(){
        var nav = $(this).attr('data-source');

        if(!nav){

        }else{
            $(".nav-item").removeClass("active");

            $(this).addClass("active");
            $(this).parent("ul").parent("li").addClass("active");

            loadContentWithParams(nav,{});
        }

    });


    $("#my-profile").click(function(event){
        event.stopPropagation();
        $(".nav-item").removeClass("active");
        loadContentWithParams('profile',{});
    });

    $("#wf-inbox").click(function(event){
        event.stopPropagation();
        $(".nav-item").removeClass("active");
        loadContentWithParams('workflow.inbox',{});
    });

    $.jgrid.defaults.responsive = false;
    $.jgrid.defaults.styleUI = 'Bootstrap';
    jQuery.fn.center = function () {

        if(this.width() > $(window).width()) {
            this.css("width", $(window).width()-40);
        }
        this.css("top",($(window).height() - this.height() ) / 2+$(window).scrollTop() + "px");
        this.css("left",( $(window).width() - this.width() ) / 2+$(window).scrollLeft() + "px");

        return this;
    }


    $('#search-menu').keyup(function() {
        var filter = $(this).val();
        if( filter.length == 0 ) {
            $("li.nav-item").show();
            $("ul.sub-menu").hide();
            $('.active').parent('ul.sub-menu').show();
            return;
        }

        if( filter.length < 2 ) return;
        var regex = new RegExp(filter,"i");
        $("li.nav-item").each(function() {
            if($(this).text().search(regex) < 0) {
                $(this).hide();
            }
            else {
                $(this).parent().show();
                $(this).show();
            }
        });
    });

    // $.ajax({
    //     url: "<?php echo base_url().'home/message/'; ?>",
    //     type: "POST",
    //     data: {
    //         '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
    //     },
    //     global: false,
    //     success: function (data) {
    //         $( "#header_inbox_bar" ).html( data );
    //     },
    //     error: function (xhr, status, error) {
    //         swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
    //     }
    // });

     //setInterval(function() {
        // $.ajax({
        //         url: "<?php echo base_url().'home/message/'; ?>",
        //         type: "POST",
        //         data: {
        //             '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
        //         },
        //         global: false,
        //         success: function (data) {
        //             $( "#header_inbox_bar" ).html( data );
        //         },
        //         error: function (xhr, status, error) {
        //             swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        //         }
        //     });
    // }, 60000); //10 detik

    // function viewAllMsg(){
    //     loadContentWithParams('message.list_message',{});
    // }

    // function msg(id, cd, sts, trx, flag){

    //     if(flag == '0'){
    //         $.ajax({
    //                 url: '<?php echo WS_JQGRID."message.message_controller/update_flag"; ?>',
    //                 type: "POST",
    //                 data: {
    //                     trx_id: id
    //                 },
    //                 global: false
    //             });
    //     }

    //     loadContentWithParams('message.form_message',{trx_id : id, code : cd, status_name : sts, trx_name: trx});

    //      $.ajax({
    //             url: "<?php echo base_url().'home/message/'; ?>",
    //             type: "POST",
    //             data: {
    //                 '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
    //             },
    //             global: false,
    //             success: function (data) {
    //                 $( "#header_inbox_bar" ).html( data );
    //             },
    //             error: function (xhr, status, error) {
    //                 swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
    //             }
    //         });
    // }


</script>
