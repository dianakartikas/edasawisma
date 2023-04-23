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

    <h1 class="h3 mb-2 text-gray-800">Anggota

    </h1>
    <p class="mb-4">Data berisikan anggota-anggota keluarga. Termaksud istri, anak, dan lainnya yang bukan termaksud sebagai Kepala Keluarga.
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
        <button type="button" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#formTambahAnggota">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Anggota Keluarga</span>
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="anggota" class="table table-striped table-bordered table-sm" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">No.</th>
                        <th style="text-align: center;">Kepala Keluarga</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Hubungan</th>
                        <th style="text-align: center;">Jenis Kelamin</th>
                        <th style="text-align: center;">Tanggal Lahir</th>
                        <th style="text-align: center;">Umur</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Kebutaan</th>
                        <th style="text-align: center;">Berkebutuhan Khusus</th>
                        <th style="text-align: center;">Desa / Kelurahan</th>

                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <?php if (in_groups('admin')) : ?>
                    <tbody>

                    </tbody>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        daTaanggota = $('#anggota').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,

            ajax: {
                url: '<?= site_url('anggota/listData2') ?>',

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
                    data: 'namakepala'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'status_hubungan',

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
                    data: 'namadesa'
                },
                {
                    data: 'aksi',

                },

            ]
        });
    });

    function hapus(id_anggota, nama) {
        Swal.fire({
            title: 'hapus',
            text: `Yakin menghapus anggota keluarga ${nama} ini ?`,
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
                    url: "<?= site_url('anggota/hapus') ?>",
                    data: {
                        id_anggota: id_anggota
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
    $(document).on('click', "#modaledit", function() {

        $('#edit-modal').modal('show');
    })

    // on modal hide
    $('#modaledit').on('hide.bs.modal', function() {
        $('.modaledit-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $('#edit-form').trigger('reset');
    })
</script>





</html>
<?= $this->endSection(); ?>