<link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/css/wizard.css" rel="stylesheet">

<link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Rumah

    </h1>
    <p class="mb-4">Data berisikan kriteria rumah sehat layak huni dengan kategori tempat pembuangan sampah, SPAL, dan jamban keluarga.
        <br><small><a target="_blank" href="https://batangtoru.tapselkab.go.id/">Kecamatan Batangtoru Kabupaten Tapanuli Selatan.</a></small> <br> <a target="_blank" href="https://batangtoru.tapselkab.go.id/">Dokumen Tutorial</a>.
    </p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Kriteria Rumah</span>
            </a>
        </div>
        <div class="container">
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Step 1</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Step 2</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>Step 3</p>
                    </div>
                </div>
            </div>
            <form role="form">
                <div class="row setup-content" id="step-1">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <h3> Step 1</h3>
                            <div class="form-group">
                                <label class="control-label">NIK</label>
                                <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama</label>
                                <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <select required="required" name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="laki-laki">L</option>
                                    <option value="perempuan">P</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <select required="required" name="status" id="status" class="form-control">
                                <option value="">-- Pilih Jenis status --</option>
                                <option value="Wanita Usia Subur">Wanita Usia Subur</option>
                                <option value="Pasangan Usia Subur">Pasangan Usia Subur</option>
                                <option value="Ibu Hamil">Ibu Hamil</option>
                                <option value="Ibu Menyusui">Ibu Menyusui</option>
                                <option value="Lanjut Usia">Lanjut Usia</option>
                                <option value="Tidak" style="color:blue; text-align:center">-- Tidak Termaksud Diatas --</option>
                            </select>
                            </div>
                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <h3> Step 2</h3>
                            <div class="form-group">
                                <label class="control-label">NIK</label>
                                <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama</label>
                                <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                            </div>
                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <h3> Step 3</h3>
                            <button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function(e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function() {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                curSelect = curStep.find("select,option"),

                isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");

                    if (!curSelect[i].validity.valid) {
                        isValid = false;
                        $(curSelect[i]).closest(".form-group").addClass("has-error");
                    }
                }
         
            }
            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });
</script>