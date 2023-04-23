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

    <h1 class="h3 mb-2 text-gray-800">Laporan

    </h1>
    <p class="mb-4">Data berisikan laporan-laporan <br><small><a target="_blank" href="https://batangtoru.tapselkab.go.id/">Kecamatan Batangtoru Kabupaten Tapanuli Selatan.</a></small> <br> <a target="_blank" href="https://batangtoru.tapselkab.go.id/">Dokumen Tutorial</a>.
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
        <form action="" method="get" autocomplete="off">
            <div class="float-left">
                <?php $request = \config\services::request(); ?>
                <input type="text" name="keyword" value="<?= $request->getGet('keyword'); ?>" class="form-control">
            </div>
            <?php if (in_groups('superadmin')) : ?>
                <div class="float-left ml-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    <a href="<?= site_url('laporan/export'); ?>" class="btn btn-primary">
                        <i class="fas fa-file-download"></i>
                        Export Excel
                    </a>
                </div>
            <?php endif; ?>
            <?php if (in_groups('admin')) : ?>
                <div class="float-left ml-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    <a href="<?= site_url('laporan/export2'); ?>" class="btn btn-primary">
                        <i class="fas fa-file-download"></i>
                        Export Excel
                    </a>
                </div>
            <?php endif; ?>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">NO</th>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">NAMA KEPALA RUMAH TANGGA</th>
                        <th rowspan="3" style="vertical-align : middle;text-align:center;">JML KK</th>
                        <th colspan="11" style="text-align:center;">JUMLAH ANGGOTA KELUARGA</th>
                        <th colspan="6" style="text-align:center;">KRITERIA RUMAH</th>
                        <th colspan="3" style="text-align:center;">SUMBER AIR KELUARGA</th>
                        <th colspan="2" style="text-align:center;">MAKANAN POKOK</th>
                        <th colspan="4" style="text-align:center;">WARGA MENGIKUTI KEGIATAN</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">KET</th>
                    </tr>
                    <tr>
                        <th colspan="2" style="vertical-align : middle;text-align:center;">TOTAL</th>
                        <th colspan="2" style="vertical-align : middle;text-align:center;">BALITA</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">PUS</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">WUS</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">IBU HAMIL</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">IBU MENYUSUI</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">LANSIA</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">3 BUTA</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">BERKEBUTUHAN KHUSUS</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">SEHAT LAYAK HUNI</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">TIDAK SEHAT LAYAK HUNI</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">MEMILIKI TEMP. PEMB. SAMPAH</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">MEMILIKI SPAL</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">MEMILIKI JAMBAN KELUARGA</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">MENEMPEL STIKER PKK</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">PDAM</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">SUMUR</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">DLL</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">BERAS</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">NON BERAS</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">UP2K</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">PEMANFAAT TANAH PEKARANGAN</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">INDUSTRI RUMAH TANGGA</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">KERJA BAKTI</th>

                    </tr>
                    <tr>
                        <th style="text-align:center;">L</th>
                        <th style="text-align:center;">P</th>
                        <th style="text-align:center;">L</th>
                        <th style="text-align:center;">P</th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;"></th>
                    </tr>
                    <tr>
                        <th style="text-align:center;">1</th>
                        <th style="text-align:center;">2</th>
                        <th style="text-align:center;">3</th>
                        <th style="text-align:center;">4</th>
                        <th style="text-align:center;">5</th>
                        <th style="text-align:center;">6</th>
                        <th style="text-align:center;">7</th>
                        <th style="text-align:center;">8</th>
                        <th style="text-align:center;">9</th>
                        <th style="text-align:center;">10</th>
                        <th style="text-align:center;">11</th>
                        <th style="text-align:center;">12</th>
                        <th style="text-align:center;">13</th>
                        <th style="text-align:center;">14</th>
                        <th style="text-align:center;">15</th>
                        <th style="text-align:center;">16</th>
                        <th style="text-align:center;">17</th>
                        <th style="text-align:center;">18</th>
                        <th style="text-align:center;">19</th>
                        <th style="text-align:center;">20</th>
                        <th style="text-align:center;">21</th>
                        <th style="text-align:center;">22</th>
                        <th style="text-align:center;">23</th>
                        <th style="text-align:center;">24</th>
                        <th style="text-align:center;">25</th>
                        <th style="text-align:center;">26</th>
                        <th style="text-align:center;">27</th>
                        <th style="text-align:center;">28</th>
                        <th style="text-align:center;">29</th>
                        <th style="text-align:center;">30</th>
                    </tr>
                </thead>
                <?php if (in_groups('superadmin')) : ?>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($cetak as $row) :
                        ?>
                            <tr>
                                <td align="center"><?= $nomor++; ?></td>
                                <td align="center"><?= $row['nama']; ?></td>
                                <td>1</td>
                                <td align="center"><?= $row['jenis_kelaminkk1'] + $row['jenis_kelamin1']; ?></td>
                                <td align="center"><?= $row['jenis_kelaminkk2'] + $row['jenis_kelamin2']; ?></td>
                                <td align="center"><?= $row['balitalaki']; ?></td>
                                <td align="center"><?= $row['balitaperempuan']; ?></td>
                                <td align="center"><?= $row['psu'] + $row['psu2']; ?></td>
                                <td align="center"><?= $row['wus'] + $row['wus2']; ?></td>
                                <td align="center"><?= $row['ih'] + $row['ih2']; ?></td>
                                <td align="center"><?= $row['im'] + $row['im2']; ?></td>
                                <td align="center"><?= $row['lu'] + $row['lu2']; ?></td>
                                <td align="center"><?= $row['buta1'] + $row['buta2'] + $row['butah1'] + $row['butah2']; ?></td>
                                <td align="center"><?= $row['spesial1'] + $row['spesial2']; ?></td>
                                <td align="center">
                                    <?php if ($row['ket'] == "Sehat") {
                                        echo "1";
                                    } else if ($row['ket'] == "Tidak Sehat") {
                                        echo "0";
                                    } else {
                                        echo  "-";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <?php if ($row['ket'] == "Sehat") {
                                        echo "0";
                                    } else if ($row['ket'] == "Tidak Sehat") {
                                        echo "1";
                                    } else {
                                        echo  "-";
                                    }
                                    ?>
                                </td>
                                <td align="center"><?= $row['ps']; ?></td>
                                <td align="center"><?= $row['spal']; ?></td>
                                <td align="center"><?= $row['jk']; ?></td>
                                <td align="center"><?= $row['jk']; ?></td>
                                <td align="center"><?= $row['stikerpkk']; ?></td>
                                <td align="center"><?= $row['pdam']; ?></td>
                                <td align="center"><?= $row['sumur']; ?></td>
                                <td align="center"><?= $row['beras']; ?></td>
                                <td align="center"><?= $row['nonberas']; ?></td>
                                <td align="center"><?= $row['up2k']; ?></td>
                                <td align="center"><?= $row['plp']; ?></td>
                                <td align="center"><?= $row['irt']; ?></td>
                                <td align="center"><?= $row['kb']; ?></td>
                                <td align="center"><?= $row['namadesa']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
                <?php if (in_groups('admin')) : ?>
                    <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($cetakAdmin as $row) :
                        ?>
                            <tr>
                                <td align="center"><?= $nomor++; ?></td>
                                <td align="center"><?= $row['nama']; ?></td>
                                <td>1</td>
                                <td align="center"><?= $row['jenis_kelaminkk1'] + $row['jenis_kelamin1']; ?></td>
                                <td align="center"><?= $row['jenis_kelaminkk2'] + $row['jenis_kelamin2']; ?></td>
                                <td align="center"><?= $row['balitalaki']; ?></td>
                                <td align="center"><?= $row['balitaperempuan']; ?></td>
                                <td align="center"><?= $row['psu'] + $row['psu2']; ?></td>
                                <td align="center"><?= $row['wus'] + $row['wus2']; ?></td>
                                <td align="center"><?= $row['ih'] + $row['ih2']; ?></td>
                                <td align="center"><?= $row['im'] + $row['im2']; ?></td>
                                <td align="center"><?= $row['lu'] + $row['lu2']; ?></td>
                                <td align="center"><?= $row['buta1'] + $row['buta2'] + $row['butah1'] + $row['butah2']; ?></td>
                                <td align="center"><?= $row['spesial1'] + $row['spesial2']; ?></td>
                                <td align="center">
                                    <?php if ($row['ps'] == "1" && $row['spal'] == "1" && $row['jk'] == "1" && $row['stikerpkk'] == "1") {
                                        echo "1";
                                    } else {
                                        echo  "0";
                                    } ?>
                                </td>
                                <td align="center">
                                    <?php if ($row['ps'] == "0" || $row['spal'] == "0" || $row['jk'] == "0" || $row['stikerpkk'] == "0") {
                                        echo "1";
                                    } else {
                                        echo  "0";
                                    } ?>
                                </td>
                                <td align="center"><?= $row['ps']; ?></td>
                                <td align="center"><?= $row['spal']; ?></td>
                                <td align="center"><?= $row['jk']; ?></td>
                                <td align="center"><?= $row['stikerpkk']; ?></td>
                                <td align="center"><?= $row['pdam']; ?></td>
                                <td align="center"><?= $row['sumur']; ?></td>
                                <td align="center">0</td>
                                <td align="center"><?= $row['beras']; ?></td>
                                <td align="center"><?= $row['nonberas']; ?></td>
                                <td align="center"><?= $row['up2k']; ?></td>
                                <td align="center"><?= $row['plp']; ?></td>
                                <td align="center"><?= $row['irt']; ?></td>
                                <td align="center"><?= $row['kb']; ?></td>
                                <td align="center"><?= $row['namadesa']; ?></td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
                <tfoot>
                    <tr>
                        <th style="text-align:center;">1</th>
                        <th style="text-align:center;">2</th>
                        <th style="text-align:center;">3</th>
                        <th style="text-align:center;">4</th>
                        <th style="text-align:center;">5</th>
                        <th style="text-align:center;">6</th>
                        <th style="text-align:center;">7</th>
                        <th style="text-align:center;">8</th>
                        <th style="text-align:center;">9</th>
                        <th style="text-align:center;">10</th>
                        <th style="text-align:center;">11</th>
                        <th style="text-align:center;">12</th>
                        <th style="text-align:center;">13</th>
                        <th style="text-align:center;">14</th>
                        <th style="text-align:center;">15</th>
                        <th style="text-align:center;">16</th>
                        <th style="text-align:center;">17</th>
                        <th style="text-align:center;">18</th>
                        <th style="text-align:center;">19</th>
                        <th style="text-align:center;">20</th>
                        <th style="text-align:center;">21</th>
                        <th style="text-align:center;">22</th>
                        <th style="text-align:center;">23</th>
                        <th style="text-align:center;">24</th>
                        <th style="text-align:center;">25</th>
                        <th style="text-align:center;">26</th>
                        <th style="text-align:center;">27</th>
                        <th style="text-align:center;">28</th>
                        <th style="text-align:center;">29</th>
                        <th style="text-align:center;">30</th>
                    </tr>
                </tfoot>
            </table>
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
    $(document).ready(function() {
        $('#example1').DataTable({
            "scrollX": true
        });
        $('.dataTables_length').addClass('bs-select');
    });
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
    function hapus(id_kegiatan) {
        Swal.fire({
            title: 'hapus',
            text: `Yakin menghapus data kegiatan ini ?`,
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
                    url: "<?= site_url('kegiatan/hapus') ?>",
                    data: {
                        id_kegiatan: id_kegiatan
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