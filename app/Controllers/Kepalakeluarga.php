<?php

namespace App\Controllers;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\kepalakeluargaModel;
use App\Models\desaModel;

class kepalaKeluarga extends BaseController
{
    protected $kepalakeluargaModel;
    protected $desaModel;


    public function __construct()
    {
        $this->kepalakeluargaModel = new kepalakeluargaModel();
        $this->desaModel = new desaModel();
    }
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->semuaData(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'desa' => $this->desaModel->findAll(),
            'desaAdmin' => $this->desaModel->desaAdmin(),
        ];
        return view('kepalaKeluarga', $data);
    }
    public function tabeladmin()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->semuaData(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'desa' => $this->desaModel->findAll(),
            'desaAdmin' => $this->desaModel->desaAdmin(),
        ];
        return view('kepalaKeluarga1', $data);
    }
    public function listData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kepalakeluarga')
            ->select('desa.nama as namadesa, kepalakeluarga.id_desa as id_desa, nik, jenis_kelamin, tanggal_lahir, status, kebutaan, kebutuhan, umur, kepalakeluarga.nama as nama, id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa');
        return DataTable::of($builder)
            ->addNumbering('no')
            ->filter(function ($builder, $request) {
                if ($request->datadesa)
                    $builder->where('kepalakeluarga.id_desa', $request->datadesa);
            })
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_kk')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_kk','$row->nama')\">
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
        $builder = $db->table('kepalakeluarga')
            ->select('desa.nama as namadesa, users.id_desa as id_desa, name, nik, jenis_kelamin, tanggal_lahir, kepalakeluarga.status as status, kebutaan, kebutuhan, umur, kepalakeluarga.nama as nama, id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id());
        return DataTable::of($builder)
            ->addNumbering('no')
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_kk')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_kk','$row->nama')\">
                <span class=\"icon text-white-50\">
                    <i class=\"fa fa-trash\"></i>
                </span>
                <span class=\"text\">Hapus</span>
            </button>";
            })
            ->toJson(true);
    }
    public function save()
    {
        if (!$this->validate([
            'nik' => [
                'label' => 'NIK',
                'rules' => 'required|min_length[16]|max_length[16]|is_unique[kepalakeluarga.nik,id_kk,{id_kk}]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} nama terlalu pendek',
                    'max_length' => '{field} nama terlalu panjang',
                    'is_unique' => '{field} sudah tersedia',
                ]
            ],
            'nama' => [
                'label' => 'Nama Kepala Keluarga',
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[kepalakeluarga.nama,id_kk,{id_kk}]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} nama terlalu pendek',
                    'max_length' => '{field} nama terlalu panjang',
                    'is_unique' => '{field} sudah tersedia',
                ]
            ],
            'id_desa' => [
                'label' => 'Desa/kelurahan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',

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
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $umur = (strtotime(date('d-m-Y')) - strtotime($this->request->getVar('tanggal_lahir'))) / (31536000);
        $umur_bulat = floor($umur);
        $save = [
            'id_kk' => $this->request->getVar('id_kk'),
            'id_desa' => $this->request->getVar('id_desa'),
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'status' => $this->request->getVar('status'),
            'kebutaan' => $this->request->getVar('kebutaan'),
            'kebutuhan' => $this->request->getVar('kebutuhan'),
            'umur' => $umur_bulat,
        ];
        $kepalakeluarga = new kepalakeluargaModel();
        $kepalakeluarga->insert($save);
        session()->setFlashdata('success', 'Data Kepala Keluarga Berhasil Ditambahkan.');
        return redirect()->back();
    }

    // public function update($id)
    // {
    //     if (!$this->validate([
    //         'nik' => [
    //             'label' => 'NIK',
    //             'rules' => 'required|min_length[16]|max_length[16]|is_unique[kepalakeluarga.id_kk!=' . $id . ' AND ' . 'nik=]',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',
    //                 'min_length' => '{field} nama terlalu pendek',
    //                 'max_length' => '{field} nama terlalu panjang',
    //                 'is_unique' => '{field} sudah tersedia',
    //             ]
    //         ],
    //         'nama' => [
    //             'label' => 'Nama Kepala Keluarga',
    //             'rules' => 'required|min_length[3]|max_length[50]|is_unique[kepalakeluarga.id_kk!=' . $id . ' AND ' . 'nama=]',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',
    //                 'min_length' => '{field} nama terlalu pendek',
    //                 'max_length' => '{field} nama terlalu panjang',
    //                 'is_unique' => '{field} sudah tersedia',
    //             ]
    //         ],
    //         'id_desa' => [
    //             'label' => 'Desa/kelurahan',
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} tidak boleh kosong',

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

    //     ])) {

    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }
    //     $umur = (strtotime(date('d-m-Y')) - strtotime($this->request->getVar('tanggal_lahir'))) / (31536000);
    //     $umur_bulat = floor($umur);

    //     $this->kepalakeluargaModel->save([
    //         'id_kk' => $id,
    //         'id_desa' => $this->request->getVar('id_desa'),
    //         'nik' => $this->request->getVar('nik'),
    //         'nama' => $this->request->getVar('nama'),
    //         'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
    //         'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
    //         'status' => $this->request->getVar('status'),
    //         'kebutaan' => $this->request->getVar('kebutaan'),
    //         'kebutuhan' => $this->request->getVar('kebutuhan'),
    //         'umur' => $umur_bulat,

    //     ]);
    //     session()->setFlashdata('success', 'kepala keluarga berhasil diperbarui.');
    //     return redirect()->to('/kepala-keluarga');
    // }
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_kk = $this->request->getVar('id_kk');

            $desa = new kepalakeluargaModel();

            $desa->delete($id_kk);

            $msg = [
                'sukses' => "Data Kepala Keluarga berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_kk');
            $ambilid = $this->kepalakeluargaModel->find($id);
            $id_desa = $ambilid['id_desa'];
            $ambildesa = $this->desaModel->find($id_desa);
            $data = [
                'id_kk' => $id,
                'nama' => $ambilid['nama'],
                'nik' => $ambilid['nik'],
                'id_desa' => $ambilid['id_desa'],
                'namadesa' => $ambildesa['nama'],
                'tanggal_lahir' => $ambilid['tanggal_lahir'],
                'jenis_kelamin' => $ambilid['jenis_kelamin'],
                'status' => $ambilid['status'],
                'kebutaan' => $ambilid['kebutaan'],
                'kebutuhan' => $ambilid['kebutuhan'],
                'desa' => $this->desaModel->findAll(),



            ];
            $msg = [
                'data' => view('ekepalakeluarga', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_kk');
            $nik = $this->request->getVar('nik');
            $nama = $this->request->getVar('nama');
            $id_desa = $this->request->getVar('id_desa');
            $tanggal_lahir = $this->request->getVar('tanggal_lahir');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $status = $this->request->getVar('status');
            $kebutaan = $this->request->getVar('kebutaan');
            $kebutuhan = $this->request->getVar('kebutuhan');

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama Kepala Keluarga',
                    'rules' => 'required|min_length[3]|max_length[50]|is_unique[kepalakeluarga.id_kk!=' . $id . ' AND ' . 'nama=]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} nama terlalu pendek',
                        'max_length' => '{field} nama terlalu panjang',
                        'is_unique' => '{field} sudah tersedia',
                    ]
                ],
                'nik' => [
                    'label' => 'NIK',
                    'rules' => 'required|min_length[16]|max_length[16]|is_unique[kepalakeluarga.id_kk!=' . $id . ' AND ' . 'nik=]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} nama terlalu pendek',
                        'max_length' => '{field} nama terlalu panjang',
                        'is_unique' => '{field} sudah tersedia',
                    ]
                ],
                'id_desa' => [
                    'label' => 'Desa/kelurahan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',

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

            ]);
            if (!$valid) {
                $validation = $this->validator;
                $msg = [
                    'error' => [

                        'nama' => $validation->getError('nama'),
                        'nik' => $validation->getError('nik'),
                        'id_desa' => $validation->getError('nama'),
                        'tanggal_lahir' => $validation->getError('tanggal_lahir'),
                        'jenis_kelamin' => $validation->getError('jenis_kelamin'),
                        'status' => $validation->getError('status'),
                        'kebutaan' => $validation->getError('kebutaan'),
                        'kebutuhan' => $validation->getError('kebutuhan'),

                    ]
                ];
            } else {
                $this->kepalakeluargaModel->update($id, [
                    'nik' => $nik,
                    'id_desa' => $id_desa,
                    'nama' => $nama,
                    'tanggal_lahir' => $tanggal_lahir,
                    'jenis_kelamin' => $jenis_kelamin,
                    'status' => $status,
                    'kebutaan' => $kebutaan,
                    'kebutuhan' => $kebutuhan,

                ]);

                $msg = [
                    'success' => 'Data Kepala Keluarga berhasil diubah'
                ];
            }

            echo json_encode($msg);
        }
    }
}
