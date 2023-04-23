<div class="modal fade" id="modaleditrumah" tabindex="-1" aria-labelledby="modaleditLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditLabel">Edit <?= $nama; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('rumah/update', ['class' => 'formsimpanrumah']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_rumah" id="id_rumah" value="<?= $id_rumah; ?>">
            <input type="hidden" name="gambar_lama" value="<?= $gambar_rumah; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama; ?>" readonly>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Pembuangan Sampah?</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pembuangan_sampah" id="pembuangan_sampah" value="Iya" <?php if ($pembuangan_sampah == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pembuangan_sampah" id="pembuangan_sampah" value="Tidak" <?php if ($pembuangan_sampah == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">SPAL?</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="spal" id="spal" value="Iya" <?php if ($spal == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="spal" id="spal" value="Tidak" <?php if ($spal == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Jamban Keluarga?</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jamban_keluarga" id="jamban_keluarga" value="Iya" <?php if ($jamban_keluarga == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jamban_keluarga" id="jamban_keluarga" value="Tidak" <?php if ($jamban_keluarga == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Stiker PKK?</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stiker_pkk" id="stiker_pkk" value="Iya" <?php if ($stiker_pkk == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="stiker_pkk" id="stiker_pkk" value="Tidak" <?php if ($stiker_pkk == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <label for="gambar_rumah">Foto</label>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <img src="/img/rumah/<?= $gambar_rumah; ?>" width="50px" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-2">
                        <img id="frame" width="50px" class="img-thumbnail">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar_rumah" name="gambar_rumah" onchange="loadImg()">
                            <div class=" invalid-feedback errorgambar_rumah">
                            </div>
                            <label class="custom-file-label" for="gambar_rumah"><?= $gambar_rumah; ?></label>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary tombolrumah">Perbarui</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= form_close(); ?>

<script>
    function loadImg() {
        $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
    }
    $(document).ready(function() {
        $('.formsimpanrumah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $('.tombolrumah').prop('disabled', true);
                    $('.tombolrumah').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function(e) {
                    $('.tombolrumah').prop('disabled', false);
                    $('.tombolrumah').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.gambar_rumah) {
                            $('#gambar_rumah').addClass('is-invalid');
                            $('.errorgambar_rumah').html(response.error.gambar_rumah);
                        } else {
                            $('#gambar_rumah').removeClass('is-invalid');
                            $('#gambar_rumah').addClass('is-valid');
                            $('.errorgambar_rumah').html('');
                        }
                    } else {
                        $('#gambar_rumah').removeClass('is-invalid').addClass('is-valid');

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
                    }

                },
                error: function(xhr, ajaxOptios, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" +
                        thrownError);
                }
            });
            return false;
        });
    });
</script>