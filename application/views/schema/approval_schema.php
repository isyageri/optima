<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Skema</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Approval Skema</span>
        </li>
    </ul>
</div>

<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <form role="form" id="form-data-contract_schema" method="post" class="form-horizontal">
            <h4>Follow Up</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-6">
                             <button class="btn btn-success" type="submit" id="submit_form1" >
                               Submit
                             </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" type="submit" id="submit_form1" >
                               Submit
                             </button>
                        </div>
                    </div>
        </form>
    </div>
    </div>

    <div class="space-4"></div>
     <h4>Info Skema</h4>
     <hr>
    <div class="row">
    <div class="col-md-12">
    <div class="tabbable-custom ">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab"> Skema Diskon </a>
            </li>
            <li class="">
                <a href="#tab_1_2" data-toggle="tab"> Data Fastel </a>
            </li>
            <li class="">
                <a href="#tab_1_3" data-toggle="tab"> Contract </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
            <form role="form" id="form-data-contract_schema" method="post" class="form-horizontal">
            <h4>Info Skema</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Schema ID" name="schema_id" class="form-control " readonly>
                        </div>
                        <div class="col-md-6">
                           
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Account Number" name="account_num" class="form-control " readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Customer Name" name="customer_name" class="form-control " readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Start Date" name="start_dat" id="start_dat" class="form-control required" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="End Date" name="end_dat" id="end_dat" class="form-control required" required>
                        </div>
                    </div>
                    
                    <h4>Skema Diskon</h4>
                    <hr>
                        <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Skema Diskon" name="skema_disc" id="skema_disc" class="form-control required" required> 
                            <input type="hidden" placeholder="Skema Diskon" name="discount_code" id="discount_code" class="form-control required"> 
                        </div>
                        <div class="col-md-6">
                            <span class="input-group-btn">
                             <button class="btn btn-success" type="submit" id="submit_form1" >
                               Submit
                             </button>
                           </span>
                        </div>
                    </div>
                            <div class="row">
                          <div class="col-md-12" id="table-skema-pembayaran">

                          </div>
                      </div>
                    </form>

            </div>
            <div class="tab-pane " id="tab_1_3">
      <form role="form" id="form-data-contract" method="post" class="form-horizontal">
                    <input type="hidden" id="modal_lov_contract_schema_id" name="schema_id">
                    <input type="hidden" id="modal_lov_contract_discount_code" name="discount_code">
                    <input type="hidden" id="modal_lov_contract_p_business_schem_id" name="p_business_schem_id">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    
                    <h4>Data Kontrak</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Nomor" name="nomor1" class="form-control required" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Nomor" name="nomor2" class="form-control required" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Hari" name="hari" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Tanggal" name="tanggal" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Bulan" name="bulan" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Tahun" name="tahun" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Bertempat Di" name="lokasi" class="form-control">
                        </div>
                    </div>

                    <h4>PT.Telkom Indonesia</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Alamat" name="alamat_t" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Nama (Perwakilan)" name="nama_t" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Jabatan" name="jabatan_t" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Nomor Rekening" name="rek_no" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Atas Nama" name="rek_name" class="form-control">
                        </div>
                    </div>

                    <h4>Customer</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Nama Perusahaan" name="nama_pt" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Alamat" name="alamat_c" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" placeholder="Nama (Perwakilan)" name="nama_c" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="Jabatan" name="jabatan_c" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" placeholder="Alamat Pengiriman Invoice" name="alamat_inv" class="form-control">
                        </div>
                    </div>

                    <h4>Program</h4>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="number" placeholder="Program" name="program" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" id="save-contract" class="btn btn-success btn-block"> Simpan Kontrak & Sent to approver </button>
                        </div>
                    </div>
                        
                </form>
                </div>
                <div class="tab-pane " id="tab_1_2">
                         <div class="row">
                          <div class="col-md-12">
                              <table id="grid-table-fastel"></table>
                              <div id="grid-pager-fastel"></div>
                          </div>
                        </div>
                </div>
                </div>
</div>
</div>
</div>