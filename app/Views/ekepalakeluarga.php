<div class="modal fade" id="modaleditkk" tabindex="-1" aria-labelledby="modaleditLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditLabel">Edit <?= $nama; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('kepalakeluarga/update', ['class' => 'formsimpankk']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id_kk" id="id_kk" value="<?= $id_kk; ?>">

            <div class="modal-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $nama; ?>">
                        <div class="invalid-feedback errornama">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">No. Kartu Keluarga</label>
                    <div class="col-sm-9">
                        <input type="text" name="nik" id="nik" class="form-control" value="<?= $nik; ?>">
                        <div class="invalid-feedback errornik">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Desa</label>
                    <div class="col-sm-9">
                        <select name="id_desa" id="id_desa" class="form-control">

                            <?php if (in_groups('superadmin')) : ?>
                                <?php
                                foreach ($desa as $y) :
                                ?>

                                    <option value="<?= $y['id_desa']; ?>" <?php if ($id_desa == $y['id_desa']) { ?> selected="selected" <?php } ?>><?= $y['nama']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (in_groups('admin')) : ?>
                                <option value="<?= $id_desa; ?>"><?= $namadesa; ?></option>
                            <?php endif; ?>
                        </select>
                        <div class="invalid-feedback errorid_desa">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $tanggal_lahir; ?>">
                        <div class="invalid-feedback errortanggal_lahir">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" value="<?= $jenis_kelamin; ?>">
                            <option value="laki-laki" <?php if ($jenis_kelamin == 'laki-laki') { ?> selected="selected" <?php } ?>>L</option>
                            <option value="perempuan" <?php if ($jenis_kelamin == 'perempuan') { ?> selected="selected" <?php } ?>>P</option>
                        </select>
                        <div class="invalid-feedback errorjenis_kelamin">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-control" value="<?= $status; ?>">
                            <option value="Wanita Usia Subur" <?php if ($status == 'Wanita Usia Subur') { ?> selected="selected" <?php } ?>>Wanita Usia Subur</option>
                            <option value="Pasangan Usia Subur" <?php if ($status == 'Pasangan Usia Subur') { ?> selected="selected" <?php } ?>>Pasangan Usia Subur</option>
                            <option value="Ibu Hamil" <?php if ($status == 'Ibu Hamil') { ?> selected="selected" <?php } ?>>Ibu Hamil</option>
                            <option value="Ibu Menyusui" <?php if ($status == 'Ibu Menyusui') { ?> selected="selected" <?php } ?>>Ibu Menyusui</option>
                            <option value="Lanjut Usia" <?php if ($status == 'Lanjut Usia') { ?> selected="selected" <?php } ?>>Lanjut Usia</option>
                            <option value="Tidak" style="color:blue; text-align:center" <?php if ($status == 'Tidak') { ?> selected="selected" <?php } ?>>-- Tidak Termaksud Diatas --</option>
                        </select>
                        <div class="invalid-feedback errorstatus">
                        </div>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Buta</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kebutaan" id="kebutaan" value="Tidak Buta" <?php if ($kebutaan == 'Tidak Buta') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Tidak Buta Huruf/Tunanetra
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kebutaan" id="kebutaan" value="Buta Huruf" <?php if ($kebutaan == 'Buta Huruf') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Buta Huruf
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kebutaan" id="kebutaan" value="Buta" <?php if ($kebutaan == 'Buta') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Buta
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Berkebutuhan Khusus?</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kebutuhan" id="kebutuhan" value="Iya" <?php if ($kebutuhan == 'Iya') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Iya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kebutuhan" id="kebutuhan" value="Tidak" <?php if ($kebutuhan == 'Tidak') { ?> checked="checked" <?php } ?>>
                                <label class="form-check-label" for="buta">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary tombolkk">Perbarui</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script>
    $(document).ready(function() {
        $('.formsimpankk').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.tombolkk').prop('disabled', true);
                    $('.tombolkk').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function(e) {
                    $('.tombolkk').prop('disabled', false);
                    $('.tombolkk').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {


                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errornama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('#nama').addClass('is-valid');
                            $('.errornama').html('');
                        }
                        if (response.error.nik) {
                            $('#nik').addClass('is-invalid');
                            $('.errornik').html(response.error.nik);
                        } else {
                            $('#nik').removeClass('is-invalid');
                            $('#nik').addClass('is-valid');
                            $('.errornik').html('');
                        }
                        if (response.error.id_desa) {
                            $('#id_desa').addClass('is-invalid');
                            $('.errorid_desa').html(response.error.id_desa);
                        } else {
                            $('#id_desa').removeClass('is-invalid');
                            $('#id_desa').addClass('is-valid');
                            $('.errorid_desa').html('');
                        }
                        if (response.error.tanggal_lahir) {
                            $('#tanggal_lahir').addClass('is-invalid');
                            $('.errortanggal_lahir').html(response.error.tanggal_lahir);
                        } else {
                            $('#tanggal_lahir').removeClass('is-invalid');
                            $('#tanggal_lahir').addClass('is-valid');
                            $('.errortanggal_lahir').html('');
                        }
                        if (response.error.jenis_kelamin) {
                            $('#jenis_kelamin').addClass('is-invalid');
                            $('.errorjenis_kelamin').html(response.error.jenis_kelamin);
                        } else {
                            $('#jenis_kelamin').removeClass('is-invalid');
                            $('#jenis_kelamin').addClass('is-valid');
                            $('.errorjenis_kelamin').html('');
                        }
                        if (response.error.status) {
                            $('#status').addClass('is-invalid');
                            $('.errorstatus').html(response.error.status);
                        } else {
                            $('#status').removeClass('is-invalid');
                            $('#status').addClass('is-valid');
                            $('.errorstatus').html('');
                        }
                        if (response.error.kebutaan) {
                            $('#kebutaan').addClass('is-invalid');
                            $('.errorkebutaan').html(response.error.kebutaan);
                        } else {
                            $('#kebutaan').removeClass('is-invalid');
                            $('#kebutaan').addClass('is-valid');
                            $('.errorkebutaan').html('');
                        }
                        if (response.error.kebutuhan) {
                            $('#kebutuhan').addClass('is-invalid');
                            $('.errorkebutuhan').html(response.error.kebutuhan);
                        } else {
                            $('#kebutuhan').removeClass('is-invalid');
                            $('#kebutuhan').addClass('is-valid');
                            $('.errorkebutuhan').html('');
                        }
                    } else {
                        $('#nama').removeClass('is-invalid').addClass('is-valid');
                        $('#nik').removeClass('is-invalid').addClass('is-valid');
                        $('#id_desa').removeClass('is-invalid').addClass('is-valid');
                        $('#tanggal_lahir').removeClass('is-invalid').addClass('is-valid');
                        $('#jenis_kelamin').removeClass('is-invalid').addClass('is-valid');
                        $('#status').removeClass('is-invalid').addClass('is-valid');
                        $('#kebutaan').removeClass('is-invalid').addClass('is-valid');
                        $('#kebutuhan').removeClass('is-invalid').addClass('is-valid');



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