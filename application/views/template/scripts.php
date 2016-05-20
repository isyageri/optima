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
<script src="<?php echo base_url(); ?>assets/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>

<!-- begin swal -->
<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/swal/sweetalert-dev.js"></script>
<!-- end swal -->

<script type="text/javascript">
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
        $.post( "<?php echo base_url().'home/load_content/'; ?>" + id,
            params,
            function( data ) {
                $( "#main-content" ).html( data );
            }
        );
    }

    $(".nav-item").click(function(event){
        event.stopPropagation();
        $(".nav-item").removeClass("active");

        $(this).addClass("active");
        $(this).parent("ul").parent("li").addClass("active");

        var menu_id = $(this).attr('data-source');
        if(menu_id == "") return;
        loadContentWithParams(menu_id,{});
    });


    $("#my-profile").click(function(event){
        event.stopPropagation();
        $(".nav-item").removeClass("active");
        loadContentWithParams('profile',{});
    });

    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
    jQuery.fn.center = function () {

        if(this.width() > $(window).width()) {
            this.css("width", $(window).width()-40);
        }
        this.css("top",($(window).height() - this.height() ) / 2+$(window).scrollTop() + "px");
        this.css("left",( $(window).width() - this.width() ) / 2+$(window).scrollLeft() + "px");

        return this;
    }


</script>