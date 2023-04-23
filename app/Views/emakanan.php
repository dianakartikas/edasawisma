<div class="modal fade" id="modaleditmakanan" tabindex="-1" aria-labelledby="modaleditLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditLabel">Edit <?= $nama; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('makanan/update', ['class' => 'formsimpanmakanan']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_makanan" id="id_makanan" value="<?= $id_makanan; ?>">

            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Makanan Pokok</label>
                    <div class="col-sm-8">
                        <select name="makanan_pokok" id="makanan_pokok" class="form-control" value="<?= $makanan_pokok; ?>">
                            <option value="Nasi" <?php if ($makanan_pokok == 'Nasi') { ?> selected="selected" <?php } ?>>Nasi</option>
                            <option value="Kentang" <?php if ($makanan_pokok == 'Kentang') { ?> selected="selected" <?php } ?>>Kentang</option>
                            <option value="Ubi" <?php if ($makanan_pokok == 'Ubi') { ?> selected="selected" <?php } ?>>Ubi</option>
                            <option value="Sagu" <?php if ($makanan_pokok == 'Sagu') { ?> selected="selected" <?php } ?>>Sagu</option>
                            <option value="Singkong" <?php if ($makanan_pokok == 'Singkong') { ?> selected="selected" <?php } ?>>Singkong</option>
                            <option value="Lainnya" style="color:blue; text-align:center" <?php if ($makanan_pokok == 'Lainnya') { ?> selected="selected" <?php } ?>>-- Tidak Termaksud Diatas --</option>
                        </select>
                        <div class="invalid-feedback errormakananpokok">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary tombolmakanan">Perbarui</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script>
    $(document).ready(function() {
        $('.formsimpanmakanan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.tombolmakanan').prop('disabled', true);
                    $('.tombolmakanan').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function(e) {
                    $('.tombolmakanan').prop('disabled', false);
                    $('.tombolmakanan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.makanan_pokok) {
                            $('#makanan_pokok').addClass('is-invalid');
                            $('.errormakanan_pokok').html(response.error.makanan_pokok);
                        } else {
                            $('#makanan_pokok').removeClass('is-invalid');
                            $('#makanan_pokok').addClass('is-valid');
                            $('.errormakanan_pokok').html('');
                        }
                    } else {
                        $('#makanan_pokok').removeClass('is-invalid').addClass('is-valid');

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