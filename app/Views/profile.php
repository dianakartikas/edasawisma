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

    <h1 class="h3 mb-2 text-gray-800">Data Profil
    </h1>
    <p class="mb-4">Data berisikan profile-profile pengguna.
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
    <div class="card-header py-3"> <i class="fas fa-user-circle"></i> My Profile
    </div>
    <div class="card-body">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?= base_url('img/user/' . user()->user_image); ?>" class="card-img" alt="<?= user()->username; ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Profile Saya</h5>
                        <p class="card-text" style="text-align: justify;">Informasi mengenai data Admin Sistem Informasi E-Dasawisma, ganti edit profile gambar profile dengan tombol "upload gambar" jika dibutuhkan.</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h4><?= user()->username; ?></h4>
                            </li>
                            <?php if (user()->fullname) : ?>
                                <li class="list-group-item"><?= user()->fullname; ?></li>
                            <?php endif; ?>

                            <li class="list-group-item"><?= user()->email; ?> </li>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modaleditMyProfile<?= user()->userid; ?>">Edit Profile</button>
                            <br>
                            <button class="btn btn-success" data-toggle="modal" data-target="#modaleditPass<?= user()->userid; ?>">Ganti Password</button>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="modaleditMyProfile<?= user()->userid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit <?= user()->username; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/home/updateprofile" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <input type="hidden" name="gambarLama" value="<?= user()->user_image; ?>">
                            <div class="col-md-4">
                                <img src="<?= base_url('img/user/' . user()->user_image); ?>" class="card-img" alt="<?= user()->username; ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control<?= ($validation->hasError('username')) ? ' is-invalid' : '' ?>" value="<?= (old('username')) ? old('username') : user()->username; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control<?= ($validation->hasError('email')) ? ' is-invalid' : '' ?>" value="<?= (old('email')) ? old('email') : user()->email; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email'); ?>
                                        </div>
                                    </div>
                                    <label for="user_image">Foto</label>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <img src="/img/user/<?= user()->user_image; ?>" class="img-thumbnail img-preview">
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input <?= ($validation->hasError('user_image')) ? 'is-invalid' : ''; ?>" id="user_image" name="user_image" onchange="previewImg()">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('user_image'); ?>
                                                </div>
                                                <label class="custom-file-label" for="user_image"><?= user()->user_image; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Perbarui</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaleditPass<?= user()->userid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit <?= user()->username; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/home/updatepassword" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <input type="hidden" name="gambarLama" value="<?= user()->user_image; ?>">
                            <div class="col-md-4">
                                <img src="<?= base_url('img/user/' . user()->user_image); ?>" class="card-img" alt="<?= user()->username; ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="nama">Password Lama</label>
                                        <input type="password" class="form-control" value="<?= (old('password_hash')) ? old('password_hash') : $password->password_hash; ?>" readonly>
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
                                    <div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Perbarui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
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

</html>




<script>
    function previewImg() {

        const gambar = document.querySelector('#user_image');
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