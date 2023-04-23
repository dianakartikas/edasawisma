<!DOCTYPE html>
<html lang="en">


<?= $this->extend('index'); ?>
<?= $this->section('dashboard'); ?>
<style>
    thead,
    tfoot {
        background-color: #3f87a6;
        color: #fff;
    }

    tbody {
        background-color: #f2f9fc;
        color: #000;
    }

    caption {
        padding: 10px;
        caption-side: bottom;
    }

    table {
        border-collapse: collapse;
        border: 2px solid rgb(200, 200, 200);
        letter-spacing: 1px;
        font-family: sans-serif;
        font-size: .8rem;
    }

    td,
    th {
        border: 1px solid rgb(190, 190, 190);
        padding: 5px 10px;
    }

    td {
        text-align: center;
    }
</style>

<!-- Topbar -->

<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Kepala Keluarga

    </h1>
    <p class="mb-4">Data berisikan kepala keluarga.
        <br><small><a target="_blank" href="https://batangtoru.tapselkab.go.id/">Kecamatan Batangtoru Kabupaten Tapanuli Selatan.</a></small> <br> <a target="_blank" href="https://batangtoru.tapselkab.go.id/">Dokumen Tutorial</a>.
        <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>
<?php if (session()->has('errors')) : ?>
    <ul class="alert alert-danger">
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?></p>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#formTambahKk">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Kepala Keluarga</span>
        </button>
    </div>
    <div class="card-body" style="display: inline-flex;">
        <label>Desa / Kelurahan: &nbsp;&nbsp;
            <select name="datadesa" id="datadesa" class="form-control custom-select custom-select-sm" style="width: 42rem;">
                <option value="">-- Pilih Desa / Kelurahan --</option>
                <?php
                foreach ($desa as $row) :
                ?>
                    <option value="<?= $row['id_desa']; ?>"><?= $row['nama']; ?></option>
                <?php endforeach; ?>

            </select>

        </label>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="kepalakeluarga" class="table table-striped table-bordered table-sm" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">No.</th>
                        <th style="text-align: center;">No. Kartu Keluarga</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Nama Desa</th>
                        <th style="text-align: center;">Jenis Kelamin</th>
                        <th style="text-align: center;">Tanggal Lahir</th>
                        <th style="text-align: center;">Umur</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Kebutaan</th>
                        <th style="text-align: center;">Berkebutuhan Khusus</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <?php if (in_groups('superadmin')) : ?>
                    <tbody>

                    </tbody>
                <?php endif; ?>

            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="formTambahKk" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kepala Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="kepalakeluarga/save" method="post">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">No. Kartu Keluarga</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control<?= ($validation->hasError('nik')) ? ' is-invalid' : '' ?>" value="<?= old('nik'); ?>" name="nik" id="nik" placeholder="Isi Nomor KK Anda">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Desa / Kel</label>
                        <div class="col-sm-8">
                            <select name="id_desa" id="id_desa" class="form-control<?= ($validation->hasError('id_desa')) ? ' is-invalid' : '' ?>">

                                <?php if (in_groups('superadmin')) : ?>

                                    <option value="">-- Pilih Desa --</option>
                                    <?php
                                    foreach ($desa as $row) :
                                    ?>
                                        <option value="<?= $row['id_desa']; ?>" <?php if (old('id_desa') == $row['id_desa']) { ?> selected="selected" <?php } ?>><?= $row['nama']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if (in_groups('admin')) : ?>
                                    <?php
                                    foreach ($desaAdmin as $row) :
                                    ?>
                                        <option value="<?= $row['id_desa']; ?>"><?= $row['nama']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control<?= ($validation->hasError('nama')) ? ' is-invalid' : '' ?>" value="<?= old('nama'); ?>" name="nama" id="nama" placeholder="Isi Nama Anda">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-8">
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control<?= ($validation->hasError('tanggal_lahir')) ? ' is-invalid' : '' ?>" value="<?= old('tanggal_lahir'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_lahir'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control<?= ($validation->hasError('jenis_kelamin')) ? ' is-invalid' : '' ?>">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki" <?php if (old('jenis_kelamin') == "laki-laki") { ?> selected="selected" <?php } ?>>L</option>
                                <option value="perempuan" <?php if (old('jenis_kelamin') == "perempuan") { ?> selected="selected" <?php } ?>>P</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select name="status" id="status" class="form-control<?= ($validation->hasError('status')) ? ' is-invalid' : '' ?>">
                                <option value="">-- Pilih Jenis status --</option>
                                <option value="Wanita Usia Subur" <?php if (old('status') == "Wanita Usia Subur") { ?> selected="selected" <?php } ?>>Wanita Usia Subur</option>
                                <option value="Pasangan Usia Subur" <?php if (old('status') == "Pasangan Usia Subur") { ?> selected="selected" <?php } ?>>Pasangan Usia Subur</option>
                                <option value="Ibu Hamil" <?php if (old('status') == "Ibu Hamil") { ?> selected="selected" <?php } ?>>Ibu Hamil</option>
                                <option value="Ibu Menyusui" <?php if (old('status') == "Ibu Menyusui") { ?> selected="selected" <?php } ?>>Ibu Menyusui</option>
                                <option value="Lanjut Usia" <?php if (old('status') == "Lanjut Usia") { ?> selected="selected" <?php } ?>>Lanjut Usia</option>
                                <option value="Tidak" style="color:blue; text-align:center" <?php if (old('status') == "Tidak") { ?> selected="selected" <?php } ?>>-- Tidak Termaksud Diatas --</option>
                            </select>
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-4 pt-0">Buta</legend>
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebutaan" id="kebutaan" value="Tidak Buta" checked>
                                    <label class="form-check-label" for="buta">
                                        Tidak Buta Huruf/Tunanetra
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebutaan" id="kebutaan" value="Buta Huruf">
                                    <label class="form-check-label" for="buta">
                                        Buta Huruf
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebutaan" id="kebutaan" value="Buta">
                                    <label class="form-check-label" for="buta">
                                        Buta
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-4 pt-0">Berkebutuhan Khusus?</legend>
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebutuhan" id="kebutuhan" value="Tidak" checked>
                                    <label class="form-check-label" for="buta">
                                        Tidak
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kebutuhan" id="kebutuhan" value="Iya">
                                    <label class="form-check-label" for="buta">
                                        Iya
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="viewmodalkk" style="display: none;"></div>


<script type="text/javascript">
    $(document).ready(function() {
        datakepala = $('#kepalakeluarga').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,

            ajax: {
                url: '<?= site_url('kepalakeluarga/listData') ?>',
                data: function(d) {
                    d.datadesa = $('#datadesa').val();
                }
            },
            order: [],

            columnDefs: [{
                width: 200,
                targets: 0
            }],

            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'nik'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'namadesa',

                },
                {
                    data: 'jenis_kelamin',

                },
                {
                    data: 'tanggal_lahir',

                },
                {
                    data: 'umur'
                },
                {
                    data: 'status'
                },

                {
                    data: 'kebutaan'
                },
                {
                    data: 'kebutuhan'
                },

                {
                    data: 'aksi',

                },

            ]
        });
        $('#datadesa').selectize({
            sortField: 'text'
        });
        $('#datadesa').change(function(e) {
            e.preventDefault();
            datakepala.ajax.reload();
        });
    });

    function hapus(id_kk) {
        Swal.fire({
            title: 'hapus',
            text: `Yakin menghapus kepala keluarga ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('kepalakeluarga/hapus') ?>",
                    data: {
                        id_kk: id_kk
                    },
                    dataType: "json",

                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.sukses,
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
            }
        })
    }

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('kepalakeluarga/edit') ?>",
            data: {
                id_kk: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodalkk').html(response.data).show();
                    $('#modaleditkk').on('shown.bs.modal').on('shown.bs.modal', function(event) {
                        $('#nama').focus();
                    });
                    $('#modaleditkk').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }
</script>

</html>
<?= $this->endSection(); ?>