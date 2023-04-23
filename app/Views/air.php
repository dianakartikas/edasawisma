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

    <h1 class="h3 mb-2 text-gray-800">Sumber Air

    </h1>
    <p class="mb-4">Data berisikan sumber air yang ada di rumah masing-masing Kepala Keluarga berupa PDAM, Sumur, atau lainnya.
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
        <button type="button" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#formTambahAir">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Air</span>
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
            <table id="air" class="table table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;text-align: center;">No</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Nama Kepala Keluarga</th>
                        <th colspan="2" style="text-align:center;">Sumber Air</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Keterangan</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Aksi</th>
                    </tr>


                    <tr>

                        <th style="text-align:center;">PDAM</th>
                        <th style="text-align:center;">Sumur</th>

                    </tr>
                </thead>

                <?php if (in_groups('superadmin')) : ?>
                    <tbody>

                    </tbody>
                <?php endif; ?>

                <tfoot>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">NIK</th>
                        <th style="text-align:center;">PDAM</th>
                        <th style="text-align:center;">Sumur</th>
                        <th style="text-align:center;">Keterangan</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="formTambahAir" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kepala Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="air/save" method="post">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Kepala Keluarga</label>
                        <div class="col-sm-8">
                            <select name="id_kk" id="id_kk" class="form-control<?= ($validation->hasError('id_kk')) ? ' is-invalid' : '' ?>">

                                <?php if (in_groups('superadmin')) : ?>
                                    <option value="">-- Pilih Kepala Keluarga --</option>
                                    <?php
                                    foreach ($kepalaKeluarga as $row) :
                                    ?>
                                        <option value="<?= $row['id_kk']; ?>"><?= $row['nama']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if (in_groups('admin')) : ?>
                                    <option value="">-- Pilih Kepala Keluarga --</option>
                                    <?php
                                    foreach ($kepalaKeluargaAdmin as $row) :
                                    ?>
                                        <option value="<?= $row['id_kk']; ?>"><?= $row['nama']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-9 pt-0">Apakah Menggunakan Sumber Air PDAM?</legend>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pdam" id="pdam" value="Iya" checked>
                                    <label class="form-check-label" for="Iya">
                                        Iya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pdam" id="pdam" value="Tidak">
                                    <label class="form-check-label" for="Tidak">
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
                                    <input class="form-check-input" type="radio" name="sumur" id="sumur" value="Iya" checked>
                                    <label class="form-check-label" for="Iya">
                                        Iya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sumur" id="sumur" value="Tidak">
                                    <label class="form-check-label" for="Tidak">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea name="keterangan" id="keterangan" class="form-control">
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="viewmodalair" style="display: none;"></div>

<script type="text/javascript">
    $(document).ready(function() {
        dataAir = $('#air').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,

            ajax: {
                url: '<?= site_url('air/listData') ?>',
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
                    data: 'nama'
                },
                {
                    data: 'pdam',

                },
                {
                    data: 'sumur',

                },

                {
                    data: 'keterangan'
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
            dataAir.ajax.reload();
        });
    });

    function hapus(id_air) {
        Swal.fire({
            title: 'hapus',
            text: `Yakin menghapus data air ini ?`,
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
                    url: "<?= site_url('air/hapus') ?>",
                    data: {
                        id_air: id_air
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
    $(document).ready(function() {
        $('#id_kk').selectize({
            sortField: 'text'
        });
    });

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('air/edit') ?>",
            data: {
                id_air: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodalair').html(response.data).show();
                    $('#modaleditair').on('shown.bs.modal').on('shown.bs.modal', function(event) {
                        $('#nama').focus();
                    });
                    $('#modaleditair').modal('show');
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