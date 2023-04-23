<?php

namespace App\Controllers;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\makananModel;
use App\Models\kepalakeluargaModel;
use App\Models\desaModel;

class Makanan extends BaseController
{
    protected $kepalakeluargaModel;
    protected $makananModel;
    protected $desaModel;



    public function __construct()
    {
        $this->makananModel = new makananModel();
        $this->kepalakeluargaModel = new kepalakeluargaModel();
        $this->desaModel = new desaModel();
    }

    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'makanan' => $this->makananModel->semuaData(),
            'makananAdmin' => $this->makananModel->makananAdmin(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'desa' => $this->desaModel->findAll()


        ];
        return view('makanan', $data);
    }
    public function tabeladmin()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'makanan' => $this->makananModel->semuaData(),
            'makananAdmin' => $this->makananModel->makananAdmin(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'desa' => $this->desaModel->findAll()


        ];
        return view('makanan1', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'id_kk' => [
                'label' => 'Kepala Keluarga',
                'rules' => 'required|is_unique[makanan.id_kk,id_makanan,{id_makanan}]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia',
                ]
            ],
            'makanan_pokok' => [
                'label' => 'Makanan Pokok',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }



        $save = [
            'id_kk' => $this->request->getVar('id_kk'),
            'makanan_pokok' => $this->request->getVar('makanan_pokok'),
            'keterangan' => $this->request->getVar('keterangan'),


        ];

        $makanan = new makananModel();
        $makanan->insert($save);
        session()->setFlashdata('success', 'Data Makanan Pokok Berhasil Ditambahkan.');
        return redirect()->to('/makanan-pokok');
    }
    public function update1($id)
    {
        if (!$this->validate([
            'makanan_pokok' => [
                'label' => 'Makanan Pokok',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->makananModel->save([
            'id_makanan' => $id,
            'makanan_pokok' => $this->request->getVar('makanan_pokok'),
            'keterangan' => $this->request->getVar('keterangan'),

        ]);
        session()->setFlashdata('success', 'Data Makanan Pokok telah diubah.');
        return redirect()->back();
    }
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_makanan = $this->request->getVar('id_makanan');

            $makanan = new makananModel();

            $makanan->delete($id_makanan);

            $msg = [
                'sukses' => "Data Makanan Pokok berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function listData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('makanan')
            ->select('kepalakeluarga.nama as nama, id_makanan, makanan_pokok, keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = makanan.id_kk');

        return DataTable::of($builder)
            ->addNumbering('no')
            ->filter(function ($builder, $request) {
                if ($request->datadesa)
                    $builder->where('kepalakeluarga.id_desa', $request->datadesa);
            })
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_makanan')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_makanan')\">
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
        $builder = $db->table('makanan')
            ->select('kepalakeluarga.nama as nama, id_makanan, makanan_pokok, keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = makanan.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id());
        return DataTable::of($builder)
            ->addNumbering('no')

            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_makanan')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_makanan')\">
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
            $id = $this->request->getVar('id_makanan');
            $ambilid = $this->makananModel->find($id);
            $id_kk = $ambilid['id_kk'];
            $ambilkk = $this->kepalakeluargaModel->find($id_kk);
            $data = [
                'id_makanan' => $id,
                'nama' => $ambilkk['nama'],
                'makanan_pokok' => $ambilid['makanan_pokok'],
            ];
            $msg = [
                'data' => view('emakanan', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_makanan');
            $nama = $this->request->getVar('nama');
            $makanan_pokok = $this->request->getVar('makanan_pokok');
            $keterangan = $this->request->getVar('keterangan');


            $valid = $this->validate([
                'makanan_pokok' => [
                    'label' => 'Makanan Pokok',
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

                        'makanan_pokok' => $validation->getError('makanan_pokok'),


                    ]
                ];
            } else {
                $this->makananModel->update($id, [
                    'makanan_pokok' => $makanan_pokok,
                    'keterangan' => $keterangan,


                ]);

                $msg = [
                    'success' => 'Data Makanan berhasil diubah'
                ];
            }

            echo json_encode($msg);
        }
    }
}
