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

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Pengguna

    </h1>
    <p class="mb-4">Data berisikan admin-admin disetiap desa/kelurahan.
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
        <button type="button" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#formModalAdmin">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Admin</span>
        </button>
    </div>
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Username</th>
                                <th>Email </th>
                                <th>Role</th>
                                <th>KK</th>
                                <th>Anggota</th>
                                <th>Rumah</th>
                                <th>Air</th>
                                <th>Makanan</th>
                                <th>Kegiatan</th>



                                <th><i class="fas fa-cogs"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            foreach ($pengguna as $row) : ?>
                                <tr class="text-center">
                                    <td style="vertical-align: middle;text-align: center;"><?= $nomor++; ?></td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->username; ?></td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->email; ?> </td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->name; ?> </td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->jumlahkk; ?> </td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->jumlahanggota; ?> </td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->jumlahrumah; ?> </td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->jumlahair; ?> </td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->jumlahmakanan; ?> </td>
                                    <td style="vertical-align: middle;text-align: center;"><?= $row->jumlahkegiatan; ?> </td>





                                    <td>

                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modaleditUser<?= $row->userid; ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <?php if ($row->name == 'superadmin' || $row->name == 'admin') : ?>
                                            <button class="btn btn-danger btn-sm confirm_del_btn" value="<?= $row->userid; ?>"><i class="fas fa-trash"></i></button>
                                    </td>

                                <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>KK</th>
                                <th>Anggota</th>
                                <th>Rumah</th>
                                <th>Air</th>
                                <th>Makanan</th>
                                <th>Kegiatan</th>


                                <th><i class="fas fa-cogs"></i> Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="formModalAdmin" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="pengguna/save" method="post">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Desa / Kel</label>
                        <div class="col-sm-9">
                            <select name="id_desa" id="id_desa" class="form-control<?= ($validation->hasError('id_desa')) ? ' is-invalid' : '' ?>">
                                <option value="">-- Pilih Desa --</option>
                                <?php
                                foreach ($desa as $row) :
                                ?>
                                    <option value="<?= $row['id_desa']; ?>"><?= $row['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>" value="<?= old('email'); ?>" name="email" id="email" placeholder="Isi email Anda">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control<?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>" value="<?= old('username'); ?>" name="username" id="username" placeholder="Isi username Anda">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password" class="form-control active<?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="confirm_password">Ulangi password</label>
                            <input type="password" name="confirm_password" id="password" class="form-control<?= ($validation->hasError('confirm_password')) ? ' is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('confirm_password'); ?>
                            </div>
                        </div>
                        <div class="form-group col-sm-7 col-form-label">
                            <input type="checkbox" onclick="myFunction()"> Tampilkan Password
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
<?php foreach ($pengguna as $user) : ?>
    <div class="modal fade" id="modaleditUser<?= $user->userid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit <?= $user->username; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/pengguna/update/<?= $user->userid; ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control<?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>" value="<?= (old('username')) ? old('username') : $user->username; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control<?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>" value="<?= (old('email')) ? old('email') : $user->email; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Password Lama</label>
                            <input type="password" class="form-control" value="<?= (old('password_hash')) ? old('password_hash') : $user->password_hash; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control<?= ($validation->hasError('password')) ? ' is-invalid' : '' ?>" value="<?= (old('password')); ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Ulangi Password</label>
                            <input type="password" name="confirm_password" id="password" class="form-control<?= ($validation->hasError('confirm_password')) ? ' is-invalid' : '' ?>" value="<?= (old('confirm_password')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('confirm_password'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" onclick="myFunction()"> Tampilkan Password
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </form>
                </div>
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
    function myFunction() {
        var x = document.querySelectorAll("[id='password']");
        for (var i = 0; i < x.length; i++)
            if (x[i].type === "password") {
                x[i].type = "text";
            } else {
                x[i].type = "password";
            }
    }
</script>
<script>
    $(document).ready(function() {
        $('.dataTable').on("click", ".confirm_del_btn", function(e) {
            e.preventDefault();
            var id = $(this).val();
            swal.fire({
                    title: "Apakah Anda Yakin?",
                    text: "Data tidak dapat dipulihkan setelah dihapus",
                    icon: "warning",
                    button: true,
                    dangerMode: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Hapus!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "pengguna/confirmdelete/" + id,
                            success: function(response) {
                                swal.fire({
                                    title: response.status,
                                    text: response.status_text,
                                    icon: response.status_icon,
                                    button: "ok",
                                }).then(function() {
                                    window.location.reload();



                                });
                            }
                        });
                    } else {
                        swal.fire("data tidak jadi dihapus");
                    }
                });
        });
    });
</script>
<script>
    function myFunction() {
        var x = document.querySelectorAll("[id='password']");
        for (var i = 0; i < x.length; i++)
            if (x[i].type === "password") {
                x[i].type = "text";
            } else {
                x[i].type = "password";
            }
    }
</script>

</html>
<?= $this->endSection(); ?>