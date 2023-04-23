<?php

namespace App\Controllers;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\anggotaModel;
use App\Models\kepalakeluargaModel;
use App\Models\desaModel;


class Anggota extends BaseController
{
    protected $kepalakeluargaModel;
    protected $anggotaModel;
    protected $desaModel;

    public function __construct()
    {
        $this->kepalakeluargaModel = new kepalakeluargaModel();
        $this->anggotaModel = new anggotaModel();
        $this->desaModel = new desaModel();
    }
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'anggota' => $this->anggotaModel->semuaData(),
            'anggotaAdmin' => $this->anggotaModel->anggotaAdmin(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'datadesa' => $this->desaModel->findAll(),
            'tes' => $this->anggotaModel->tes1()


        ];
        return view('anggota', $data);
    }

    public function tabeladmin()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'anggota' => $this->anggotaModel->semuaData(),
            'anggotaAdmin' => $this->anggotaModel->anggotaAdmin(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'datadesa' => $this->desaModel->findAll(),
            'tes' => $this->anggotaModel->tes1()


        ];
        return view('anggota1', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'id_kk' => [
                'label' => 'Kepala Keluarga',
                'rules' => 'required|greater_than[0]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'greater_than' => '{field} sudah terdaftar',

                ]
            ],
            'nama' => [
                'label' => 'Nama Anggota Keluarga',
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[anggota.id_kk=' . $this->request->getVar('id_kk') . ' AND ' . 'nama=]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} nama terlalu pendek',
                    'max_length' => '{field} nama terlalu panjang',
                    'is_unique' => '{field} sudah terdaftar',

                ]
            ],
            'tanggal_lahir' => [
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]
            ],
            'status_hubungan' => [
                'label' => 'Status hubungan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $umur = (strtotime(date('d-m-Y')) - strtotime($this->request->getVar('tanggal_lahir'))) / (31536000);
        $umur_bulat = floor($umur);
        $save = [
            'id_kk' => $this->request->getVar('id_kk'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'status' => $this->request->getVar('status'),
            'status_hubungan' => $this->request->getVar('status_hubungan'),
            'kebutaan' => $this->request->getVar('kebutaan'),
            'kebutuhan' => $this->request->getVar('kebutuhan'),
            'umur' => $umur_bulat,
        ];
        $anggota = new anggotaModel();
        $anggota->insert($save);
        session()->setFlashdata('success', 'Data Anggota Berhasil Ditambahkan.');
        return redirect()->to('/anggota');
    }

    // public function update($id)
    // {
    //     if (!$this->validate([

    //         'nama' => [
    //             'label' => 'Nama Anggota Keluarga',
    //             'rules' => 'required|min_length[3]|max_length[50]|is_unique[anggota.id_anggota!=' . $id . ' AND ' . 'nama=]',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',
    //                 'min_length' => '{field} nama terlalu pendek',
    //                 'max_length' => '{field} nama terlalu panjang',

    //             ]
    //         ],
    //         'tanggal_lahir' => [
    //             'label' => 'Tanggal Lahir',
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',

    //             ]
    //         ],
    //         'jenis_kelamin' => [
    //             'label' => 'Jenis Kelamin',
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',

    //             ]
    //         ],
    //         'status' => [
    //             'label' => 'Status',
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',

    //             ]
    //         ],
    //         'status_hubungan' => [
    //             'label' => 'Status hubungan',
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',

    //             ]
    //         ],
    //     ])) {

    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }
    //     $umur = (strtotime(date('d-m-Y')) - strtotime($this->request->getVar('tanggal_lahir'))) / (31536000);
    //     $umur_bulat = floor($umur);
    //     $this->anggotaModel->save([
    //         'id_anggota' => $id,
    //         'nama' => $this->request->getVar('nama'),
    //         'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
    //         'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
    //         'status' => $this->request->getVar('status'),
    //         'status_hubungan' => $this->request->getVar('status_hubungan'),
    //         'kebutaan' => $this->request->getVar('kebutaan'),
    //         'kebutuhan' => $this->request->getVar('kebutuhan'),
    //         'umur' => $umur_bulat,

    //     ]);
    //     session()->setFlashdata('success', 'Anggota Keluarga berhasil diperbarui.');
    //     return redirect()->to('/anggota');
    // }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_anggota = $this->request->getVar('id_anggota');

            $anggota = new anggotaModel();

            $anggota->delete($id_anggota);

            $msg = [
                'sukses' => "Data Anggota Keluarga berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function listData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('anggota')
            ->select('desa.nama as namadesa, kepalakeluarga.id_desa as id_desa, id_anggota, kepalakeluarga.nama as namakepala, status_hubungan, anggota.jenis_kelamin as jenis_kelamin, anggota.tanggal_lahir as tanggal_lahir, anggota.status as status, anggota.kebutaan as kebutaan, anggota.kebutuhan as kebutuhan, anggota.umur as umur, anggota.nama as nama')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = anggota.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa');
        return DataTable::of($builder)
            ->addNumbering('no')
            ->filter(function ($builder, $request) {
                if ($request->datadesa)
                    $builder->where('kepalakeluarga.id_desa', $request->datadesa);
            })
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_anggota')\"> <span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_anggota','$row->nama')\">
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
        $builder = $db->table('anggota')
            ->select('id_anggota, desa.nama as namadesa, kepalakeluarga.nama as namakepala, users.id_desa as id_desa, name, status_hubungan, anggota.jenis_kelamin as jenis_kelamin, anggota.tanggal_lahir as tanggal_lahir, anggota.status as status, anggota.kebutaan as kebutaan, anggota.kebutuhan as kebutuhan, anggota.umur as umur, anggota.nama as nama, anggota.id_kk as id_kk')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = anggota.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id());
        return DataTable::of($builder)
            ->addNumbering('no')
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_anggota')\"> <span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_anggota','$row->nama')\">
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
            $id = $this->request->getVar('id_anggota');
            $ambilid = $this->anggotaModel->find($id);
            $id_kk = $ambilid['id_kk'];
            $ambilkk = $this->kepalakeluargaModel->find($id_kk);
            $data = [
                'id_anggota' => $id,
                'namakepala' => $ambilkk['nama'],
                'nama' => $ambilid['nama'],
                'tanggal_lahir' => $ambilid['tanggal_lahir'],
                'status_hubungan' => $ambilid['status_hubungan'],
                'jenis_kelamin' => $ambilid['jenis_kelamin'],
                'status' => $ambilid['status'],
                'kebutaan' => $ambilid['kebutaan'],
                'kebutuhan' => $ambilid['kebutuhan'],


            ];
            $msg = [
                'data' => view('eanggota', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_anggota');
            $namakepala = $this->request->getVar('namakepala');
            $nama = $this->request->getVar('nama');
            $tanggal_lahir = $this->request->getVar('tanggal_lahir');
            $status_hubungan = $this->request->getVar('status_hubungan');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $status = $this->request->getVar('status');
            $kebutaan = $this->request->getVar('kebutaan');
            $kebutuhan = $this->request->getVar('kebutuhan');

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama Anggota Keluarga',
                    'rules' => 'required|min_length[3]|max_length[50]|is_unique[anggota.id_anggota!=' . $id . ' AND ' . 'nama=]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} nama terlalu pendek',
                        'max_length' => '{field} nama terlalu panjang',

                    ]
                ],
                'tanggal_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'jenis_kelamin' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'status' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
                'status_hubungan' => [
                    'label' => 'Status hubungan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

                    ]
                ],
            ]);
            if (!$valid) {
                $validation = $this->validator;
                $msg = [
                    'error' => [

                        'nama' => $validation->getError('nama'),
                        'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                        'status_hubungan' => $validation->getError('status_hubungan'),
                        'jenis_kelamin' => $validation->getError('jenis_kelamin'),
                        'status' => $validation->getError('status'),
                        'kebutaan' => $validation->getError('kebutaan'),
                        'kebutuhan' => $validation->getError('kebutuhan'),

                    ]
                ];
            } else {
                $this->anggotaModel->update($id, [
                    'namakepala' => $namakepala,
                    'nama' => $nama,
                    'tanggal_lahir' => $tanggal_lahir,
                    'status_hubungan' => $status_hubungan,
                    'jenis_kelamin' => $jenis_kelamin,
                    'status' => $status,
                    'kebutaan' => $kebutaan,
                    'kebutuhan' => $kebutuhan,

                ]);

                $msg = [
                    'success' => 'Data Anggota berhasil diubah'
                ];
            }

            echo json_encode($msg);
        }
    }
}
