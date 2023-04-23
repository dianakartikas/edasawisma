<?php

namespace App\Controllers;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;

use App\Models\rumahModel;
use App\Models\kepalakeluargaModel;
use App\Models\desaModel;


class Rumah extends BaseController
{
    protected $kepalakeluargaModel;
    protected $desaModel;
    protected $rumahModel;

    public function __construct()
    {
        $this->kepalakeluargaModel = new kepalakeluargaModel();
        $this->desaModel = new desaModel();
        $this->rumahModel = new rumahModel();
    }
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'rumah' => $this->rumahModel->semuaData(),
            'rumahAdmin' => $this->rumahModel->rumahAdmin(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'desa' => $this->desaModel->findAll()

        ];
        return view('rumah', $data);
    }
    public function tabeladmin()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'rumah' => $this->rumahModel->semuaData(),
            'rumahAdmin' => $this->rumahModel->rumahAdmin(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'desa' => $this->desaModel->findAll()

        ];
        return view('rumah1', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'id_kk' => [
                'label' => 'Kepala Keluarga',
                'rules' => 'required|is_unique[rumah.id_kk,id_rumah,{id_rumah}]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]
            ],
            'gambar_rumah' => [
                'rules' => 'is_image[gambar_rumah]|max_size[gambar_rumah,1024]|mime_in[gambar_rumah,image/jpg,image/jpeg,image/png,image/svg]',
                'errors' => [

                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gmbar'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $fileGambar = $this->request->getFile('gambar_rumah');
        if ($fileGambar->getError() == 4) {
            $namaGambar = 'default.svg';
        } else {

            $namaGambar = $fileGambar->getRandomName();
            // pindahkan file ke folder img fungsi move untuk langsung ke folder publik
            $fileGambar->move(FCPATH . '/img/rumah/', $namaGambar);
        }

        if ($this->request->getVar('pembuangan_sampah') == "Iya" && $this->request->getVar('jamban_keluarga') == "Iya" && ($this->request->getVar('spal') == "Iya" || $this->request->getVar('spal') == "Tidak") && ($this->request->getVar('stiker_pkk') == "Iya" || $this->request->getVar('stiker_pkk') == "Tidak")) {
            $keterangan = "Sehat";
        } else {
            $keterangan = "Tidak Sehat";
        }
        $save = [
            'id_kk' => $this->request->getVar('id_kk'),
            'pembuangan_sampah' => $this->request->getVar('pembuangan_sampah'),
            'spal' => $this->request->getVar('spal'),
            'jamban_keluarga' => $this->request->getVar('jamban_keluarga'),
            'keterangan' => $keterangan,
            'stiker_pkk' => $this->request->getVar('stiker_pkk'),
            'gambar_rumah' =>  $namaGambar,


        ];

        $rumah = new rumahModel();
        $rumah->insert($save);
        session()->setFlashdata('success', 'Data Kriteria Rumah Berhasil Ditambahkan.');
        return redirect()->to('/kriteria-rumah');
    }

    public function update1($id)
    {

        if (!$this->validate([
            'gambar_rumah' => [
                'rules' => 'is_image[gambar_rumah]|max_size[gambar_rumah,1024]|mime_in[gambar_rumah,image/jpg,image/jpeg,image/png,image/svg]',
                'errors' => [

                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gmbar'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $fileGambar = $this->request->getFile('gambar_rumah');
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            // generate nama foto
            $namaGambar = $fileGambar->getRandomName();
            // pindahkan ke folder
            $fileGambar->move('img/rumah', $namaGambar);
            // hapus foto

            if ($fileGambar != "") {
                if (file_exists('img/rumah/' .  $this->request->getVar('gambarLama') != 'default.svg')) {
                    unlink('img/rumah/' . $this->request->getVar('gambarLama'));
                }
            }
        }
        if ($this->request->getVar('pembuangan_sampah') == "Iya" && $this->request->getVar('jamban_keluarga') == "Iya" && ($this->request->getVar('spal') == "Iya" || $this->request->getVar('spal') == "Tidak") && ($this->request->getVar('stiker_pkk') == "Iya" || $this->request->getVar('stiker_pkk') == "Tidak")) {
            $keterangan = "Sehat";
        } else {
            $keterangan = "Tidak Sehat";
        }

        $this->rumahModel->save([
            'id_rumah' => $id,
            'pembuangan_sampah' => $this->request->getVar('pembuangan_sampah'),
            'spal' => $this->request->getVar('spal'),
            'jamban_keluarga' => $this->request->getVar('jamban_keluarga'),
            'stiker_pkk' => $this->request->getVar('stiker_pkk'),
            'gambar_rumah' =>  $namaGambar,
            'keterangan' => $keterangan,
        ]);
        session()->setFlashdata('success', 'data rumah telah diubah.');
        return redirect()->back();
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_rumah = $this->request->getVar('id_rumah');

            $rumah = new rumahModel();

            $rumah->delete($id_rumah);

            $msg = [
                'sukses' => "Data Rumah berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
    public function listData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('rumah')
            ->select('kepalakeluarga.nama as nama, id_rumah, stiker_pkk, pembuangan_sampah, spal, jamban_keluarga, gambar_rumah, keterangan, rumah.updated_at as updated_at')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = rumah.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa');

        return DataTable::of($builder)
            ->addNumbering('no')
            ->filter(function ($builder, $request) {
                if ($request->datadesa)
                    $builder->where('kepalakeluarga.id_desa', $request->datadesa);
            })
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_rumah')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_rumah','$row->nama')\">
                <span class=\"icon text-white-50\">
                    <i class=\"fa fa-trash\"></i>
                </span>
                <span class=\"text\">Hapus</span>
            </button>";
            })
            ->toJson(true);
    }
    public function listData2()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('rumah')
            ->select('kepalakeluarga.nama as nama, id_rumah, pembuangan_sampah,  stiker_pkk, spal, jamban_keluarga, gambar_rumah, keterangan, rumah.updated_at as updated_at')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = rumah.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id());
        return DataTable::of($builder)
            ->addNumbering('no')
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_rumah')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_rumah','$row->nama')\">
                <span class=\"icon text-white-50\">
                    <i class=\"fa fa-trash\"></i>
                </span>
                <span class=\"text\">Hapus</span>
            </button>";
            })
            ->toJson(true);
    }
    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_rumah');
            $ambilid = $this->rumahModel->find($id);
            $id_kk = $ambilid['id_kk'];
            $ambilkk = $this->kepalakeluargaModel->find($id_kk);
            $data = [
                'id_rumah' => $id,
                'nama' => $ambilkk['nama'],
                'pembuangan_sampah' => $ambilid['pembuangan_sampah'],
                'spal' => $ambilid['spal'],
                'jamban_keluarga' => $ambilid['jamban_keluarga'],
                'stiker_pkk' => $ambilid['stiker_pkk'],
                'gambar_rumah' => $ambilid['gambar_rumah'],

            ];
            $msg = [
                'data' => view('erumah', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_rumah');

            $pembuangan_sampah = $this->request->getVar('pembuangan_sampah');
            $spal = $this->request->getVar('spal');
            $jamban_keluarga = $this->request->getVar('jamban_keluarga');
            $stiker_pkk = $this->request->getVar('stiker_pkk');
            $gambar_lama = $this->request->getVar('gambar_lama');


            if (!$this->validate([
                'gambar_rumah' => [
                    'rules' => 'is_image[gambar_rumah]|max_size[gambar_rumah,1024]|mime_in[gambar_rumah,image/jpg,image/jpeg,image/png,image/svg]',
                    'errors' => [

                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gmbar'
                    ]
                ],
            ])) {
                $validation = $this->validator;
                $msg = [
                    'error' => [

                        'gambar_rumah' => $validation->getError('gambar_rumah'),

                    ]
                ];
            }
            $fileGambar = $this->request->getFile('gambar_rumah');
            if ($fileGambar->getError() == 4) {
                $namaGambar = $gambar_lama;
            } else {
                // generate nama foto
                $namaGambar = $fileGambar->getRandomName();
                // pindahkan ke folder
                $fileGambar->move('img/rumah', $namaGambar);
                // hapus foto

                if ($fileGambar != "") {
                    if (file_exists('img/rumah/' . $gambar_lama != 'default.svg')) {
                        unlink('img/rumah/' . $gambar_lama);
                    }
                }
            }
            if ($this->request->getVar('pembuangan_sampah') == "Iya" && $this->request->getVar('jamban_keluarga') == "Iya" && ($this->request->getVar('spal') == "Iya" || $this->request->getVar('spal') == "Tidak") && ($this->request->getVar('stiker_pkk') == "Iya" || $this->request->getVar('stiker_pkk') == "Tidak")) {
                $keterangan = "Sehat";
            } else {
                $keterangan = "Tidak Sehat";
            }


            $this->rumahModel->update($id, [
                'pembuangan_sampah' => $pembuangan_sampah,
                'spal' => $spal,
                'jamban_keluarga' => $jamban_keluarga,
                'stiker_pkk' => $stiker_pkk,
                'gambar_rumah' => $namaGambar,
                'keterangan' => $keterangan,

            ]);

            $msg = [
                'success' => 'Data Rumah berhasil diubah'
            ];

            echo json_encode($msg);
        }
    }
}
