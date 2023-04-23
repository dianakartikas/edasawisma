<div class="modal fade" id="modaleditair" tabindex="-1" aria-labelledby="modaleditLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditLabel">Edit <?= $nama; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('air/update', ['class' => 'formsimpanair']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_air" id="id_air" value="<?= $id_air; ?>">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama; ?>" readonly>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-9 pt-0">Apakah Menggunakan Sumber Air PDAM?</legend>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pdam" id="pdam" value="Iya" <?php if ($pdam == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="pdam">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pdam" id="pdam" value="Tidak" <?php if ($pdam == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="pdam">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-9 pt-0">Apakah Menggunakan Sumber Air Sumur?</legend>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sumur" id="sumur" value="Iya" <?php if ($sumur == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="sumur">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sumur" id="sumur" value="Tidak" <?php if ($sumur == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="sumur">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary tombolair">Perbarui</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script>
    $(document).ready(function() {
        $('.formsimpanair').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.tombolair').prop('disabled', true);
                    $('.tombolair').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function(e) {
                    $('.tombolair').prop('disabled', false);
                    $('.tombolair').html('Simpan');
                },
                success: function(response) {

                    $('#pdam').removeClass('is-invalid').addClass('is-valid');
                    $('#sumur').removeClass('is-invalid').addClass('is-valid');

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