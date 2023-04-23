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

    <h1 class="h3 mb-2 text-gray-800">Desa/Kelurahan

    </h1>
    <p class="mb-4">Data berisikan nama-nama desa atau kelurahan di Batangtoru
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
        <button type="button" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#formTambahDesa">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Desa / Kelurahan</span>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table table-striped mb-0 mt-0" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center;">No</th>
                        <th width="80%" style="text-align:center;">Nama Desa / Kelurahan</th>
                        <th width="15%" style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Nama Desa</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $nomor = 1;
                    foreach ($desa as $row) :
                    ?>
                        <tr>
                            <td style="vertical-align: middle;text-align: center;"><?= $nomor++; ?></td>
                            <td style="vertical-align: middle;text-align: center;"><?= $row['nama']; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#modaledit<?= $row['id_desa']; ?>">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id_desa'] ?>','<?= $row['nama'] ?>')">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                    <span class="text">Hapus</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="formTambahDesa" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Desa / Kelurahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="desa/save" method="post">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control<?= ($validation->hasError('nama')) ? ' is-invalid' : '' ?>" value="<?= old('nama'); ?>" name="nama" id="nama" placeholder="Isi Nama Desa / Kelurahan">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
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
<?php foreach ($desa as $row) : ?>
    <div class="modal fade" id="modaledit<?= $row['id_desa']; ?>" tabindex="-1" aria-labelledby="modaleditLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaleditLabel">Edit <?= $row['nama']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= csrf_field(); ?>
                <form action="desa/update/<?= $row['id_desa']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control<?= ($validation->hasError('nama')) ? ' is-invalid' : '' ?>" value="<?= (old('nama')) ? old('nama') : $row['nama']; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>/js/demo/datatables-demo.js"></script>
<script>
    $(function() {

        <?php if (session()->getFlashdata("success")) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session("success") ?>'
            })
        <?php } ?>
    });

    $(function() {

        <?php if (session()->has("errors")) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '<?= session("error") ?>'
            })
        <?php } ?>
    });
</script>
<script>
    $(function() {

        <?php if (session()->getFlashdata("warning")) { ?>
            Swal.fire({
                icon: 'warning',
                title: 'Periksa Data!',
                text: '<?= session("warning") ?>'
            })
        <?php } ?>
    });
</script>
<script>
    $(function() {
        <?php if (session()->getFlashData('status')) { ?>
            swall({
                tittle: "<?= session()->getFlashData('status'); ?>",
                text: "<?= session()->getFlashData('status_text'); ?>",
                icon: "<?= session()->getFlashData('status_icon'); ?>",
                button: "OK",

            });
        <?php } ?>
    });
</script>
<script>
    function hapus(id_desa) {
        Swal.fire({
            title: 'hapus',
            text: `Yakin menghapus data desa/kelurahan ini ?`,
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
                    url: "<?= site_url('desa/hapus') ?>",
                    data: {
                        id_desa: id_desa
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
</script>

</html>
<?= $this->endSection(); ?>