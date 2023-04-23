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
        vertical-align: center;

    }
</style>
<!-- Topbar -->

<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Rumah</h1>
    <p class="mb-4">Data berisikan kriteria rumah sehat layak huni dengan kategori tempat pembuangan sampah, SPAL, dan jamban keluarga.
        <br><small><a target="_blank" href="https://batangtoru.tapselkab.go.id/">Kecamatan Batangtoru Kabupaten Tapanuli Selatan.</a></small> <br> <a target="_blank" href="https://batangtoru.tapselkab.go.id/">Dokumen Tutorial</a>.
    </p>
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#formTambahRumah">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Kriteria Rumah</span>
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
                <table id="rumah" class="table table-striped table-bordered table-sm" width="100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Gambar</th>
                            <th style="text-align: center;">Nama Kepala Keluarga</th>
                            <th style="text-align: center;">Pembuangan Sampah</th>
                            <th style="text-align: center;">SPAL</th>
                            <th style="text-align: center;">Jamban Keluarga</th>
                            <th style="text-align: center;">Stiker PKK</th>
                            <th style="text-align: center;">Keterangan</th>

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
</div>


<div class="modal fade" id="formTambahRumah" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria Rumah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="rumah/save" method="post" enctype="multipart/form-data">
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
                            <legend class="col-form-label col-sm-9 pt-0">Apakah Tersedia Pembuangan Sampah?</legend>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pembuangan_sampah" id="pembuangan_sampah" value="Iya" checked>
                                    <label class="form-check-label" for="Iya">
                                        Iya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pembuangan_sampah" id="pembuangan_sampah" value="Tidak">
                                    <label class="form-check-label" for="Tidak">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-9 pt-0">Apakah Tersedia SPAL?</legend>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="spal" id="spal" value="Iya" checked>
                                    <label class="form-check-label" for="Iya">
                                        Iya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="spal" id="spal" value="Tidak">
                                    <label class="form-check-label" for="Tidak">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-9 pt-0">Apakah Tersedia Jamban Keluarga?</legend>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jamban_keluarga" id="jamban_keluarga" value="Iya" checked>
                                    <label class="form-check-label" for="Iya">
                                        Iya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jamban_keluarga" id="jamban_keluarga" value="Tidak">
                                    <label class="form-check-label" for="Tidak">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-9 pt-0">Apakah menempel stiker PKK?</legend>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="stiker_pkk" id="stiker_pkk" value="Iya" checked>
                                    <label class="form-check-label" for="Iya">
                                        Iya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="stiker_pkk" id="stiker_pkk" value="Tidak">
                                    <label class="form-check-label" for="Tidak">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label">Gambar Rumah</label>
                        <div class="col-sm-8">
                            <input type="file" name="gambar_rumah" id="gambar_rumah" class="form-control<?= ($validation->hasError('gambar_rumah')) ? ' is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar_rumah'); ?>
                            </div>
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

<div class="viewmodalrumah" style="display: none;"></div>

<script type="text/javascript">
    $(document).ready(function() {
        daTaRumah = $('#rumah').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,

            ajax: {
                url: '<?= site_url('rumah/listData') ?>',
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
                    data: 'gambar_rumah',
                    "render": function(data) {
                        return '<img src="/img/rumah/' + data + '" width="50px">';

                    },

                },
                {
                    data: 'nama'
                },
                {
                    data: 'pembuangan_sampah',

                },
                {
                    data: 'spal',

                },
                {
                    data: 'jamban_keluarga',

                },
                {
                    data: 'stiker_pkk'
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
            daTaRumah.ajax.reload();
        });
    });

    function hapus(id_rumah, nama) {
        Swal.fire({
            title: 'hapus',
            text: `Yakin menghapus kriteria rumah "${nama}" ini ?`,
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
                    url: "<?= site_url('rumah/hapus') ?>",
                    data: {
                        id_rumah: id_rumah
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
            url: "<?= site_url('rumah/edit') ?>",
            data: {
                id_rumah: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodalrumah').html(response.data).show();
                    $('#modaleditrumah').on('shown.bs.modal').on('shown.bs.modal', function(event) {
                        $('#gambar_rumah').focus();
                    });
                    $('#modaleditrumah').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    function previewImg() {

        const gambar = document.querySelector('#gambar_rumah');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;
        const filegambar = new FileReader();
        filegambar.readAsDataURL(gambar.files[0]);

        filegambar.onload = function(e) {

            imgPreview.src = e.target.result;

        }
    }
</script>


<?= $this->endSection(); ?>