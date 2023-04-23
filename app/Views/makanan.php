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

    <h1 class="h3 mb-2 text-gray-800">Makanan Pokok

    </h1>
    <p class="mb-4">Data berisikan makanan pokok Kepala Keluarga.
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
        <button type="button" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#formTambahMakanan">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Makanan</span>
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
            <table id="makanan" class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Makanan Pokok</th>
                        <th style="text-align: center;">Keterangan</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Makanan Pokok</th>
                        <th style="text-align: center;">Keterangan</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </tfoot>

                <?php if (in_groups('superadmin')) : ?>
                    <tbody>

                    </tbody>
                <?php endif; ?>

            </table>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="formTambahMakanan" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kepala Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="makanan/save" method="post">
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
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Makanan Pokok</label>
                        <div class="col-sm-8">
                            <select name="makanan_pokok" id="makanan_pokok" class="form-control<?= ($validation->hasError('makanan_pokok')) ? ' is-invalid' : '' ?>">
                                <option value="">-- Pilih Jenis Makanan --</option>
                                <option value="Nasi">Nasi</option>
                                <option value="Kentang">Kentang</option>
                                <option value="Ubi">Ubi</option>
                                <option value="Sagu">Sagu</option>
                                <option value="Singkong">Singkong</option>
                                <option value="Lainnya" style="color:blue; text-align:center">-- Tidak Termaksud Diatas --</option>
                            </select>
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
<div class="viewmodalmakanan" style="display: none;"></div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_kk').selectize({
            sortField: 'text'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        dataMakanan = $('#makanan').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,

            ajax: {
                url: '<?= site_url('makanan/listData') ?>',
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
                    data: 'makanan_pokok',

                },
                {
                    data: 'keterangan',

                },

                {
                    data: 'aksi'
                },


            ]
        });
        $('#datadesa').selectize({
            sortField: 'text'
        });
        $('#datadesa').change(function(e) {
            e.preventDefault();
            dataMakanan.ajax.reload();
        });
    });

    function hapus(id_makanan) {
        Swal.fire({
            title: 'hapus',
            text: `Yakin menghapus data makanan pokok ini ?`,
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
                    url: "<?= site_url('makanan/hapus') ?>",
                    data: {
                        id_makanan: id_makanan
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
            url: "<?= site_url('makanan/edit') ?>",
            data: {
                id_makanan: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodalmakanan').html(response.data).show();
                    $('#modaleditmakanan').on('shown.bs.modal').on('shown.bs.modal', function(event) {
                        $('#nama').focus();
                    });
                    $('#modaleditmakanan').modal('show');
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