<!-- BEGIN SIDEBAR MENU -->
<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
    <li class="sidebar-toggler-wrapper hide">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler">
            <span></span>
        </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
    </li>
    <li class="nav-item active" data-source="dashboard">
        <a href="#" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>
    <?php
        echo $this->menu;
    ?>
</ul>
<!-- END SIDEBAR MENU -->