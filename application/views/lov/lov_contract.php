<div id="modal_lov_contract" class="modal fade" tabindex="-1" style="z-index:10900;">
    <div class="modal-dialog" style="width:800px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Data Kontrak </span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body" style="overflow-y: scroll; height:400px;" >
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
                            <button type="submit" id="save-contract" class="btn btn-success btn-block"> Simpan Kontrak </button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-danger btn-xs radius-4" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>
    function modal_lov_contract_show(schema_id, discount_code, p_business_schem_id) {
        $('#form-data-contract').find("input[type=text], input[type=number], textarea").val("");

        $("#modal_lov_contract_schema_id").val(schema_id);
        $("#modal_lov_contract_discount_code").val(discount_code);
        $("#modal_lov_contract_p_business_schem_id").val(p_business_schem_id);
        $("#modal_lov_contract").modal({backdrop: 'static'});
    }

    function modal_lov_contract_hide() {
        $("#modal_lov_contract").modal('hide');
    }
</script>