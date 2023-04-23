<div class="modal fade" id="modaleditkegiatan" tabindex="-1" aria-labelledby="modaleditLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditLabel">Edit <?= $nama; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('kegiatan/update', ['class' => 'formsimpankegiatan']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="<?= $id_kegiatan; ?>">

            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama; ?>" readonly>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-9 pt-0">Apakah Mengikuti Kegiatan UP2K?</legend>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="up2k" id="up2k" value="Iya" <?php if ($up2k == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="up2k">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="up2k" id="up2k" value="Tidak" <?php if ($up2k == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="up2k">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-9 pt-0">Apakah Mengikuti Kegiatan Pemanfaat Tanah Pekarangan?</legend>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="plp" id="plp" value="Iya" <?php if ($plp == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="plp">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="plp" id="plp" value="Tidak" <?php if ($plp == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="plp">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-9 pt-0">Apakah Mengikuti Kegiatan Industri Rumah Tangga?</legend>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="irt" id="irt" value="Iya" <?php if ($irt == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="irt">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="irt" id="irt" value="Tidak" <?php if ($irt == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="irt">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-9 pt-0">Apakah Mengikuti Kegiatan Kerja Bakti?</legend>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kb" id="kb" value="Iya" <?php if ($kb == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="kb">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kb" id="kb" value="Tidak" <?php if ($kb == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="kb">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary tombolkegiatan">Perbarui</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script>
    $(document).ready(function() {
        $('.formsimpankegiatan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.tombolkegiatan').prop('disabled', true);
                    $('.tombolkegiatan').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function(e) {
                    $('.tombolkegiatan').prop('disabled', false);
                    $('.tombolkegiatan').html('Simpan');
                },
                success: function(response) {

                    $('#up2k').removeClass('is-invalid').addClass('is-valid');
                    $('#plp').removeClass('is-invalid').addClass('is-valid');
                    $('#irt').removeClass('is-invalid').addClass('is-valid');
                    $('#kb').removeClass('is-invalid').addClass('is-valid');

                    Swal.fire({
                            toast: true,
                            class: 'bg-info',
                            position: 'top-right',
                            showConfirmButton: false,
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                            timer: 1000
                        })
                        .then(function() {
                            window.location.reload();
                        })
                },
            });

        });
    });
</script>