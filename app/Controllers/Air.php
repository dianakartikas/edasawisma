<?php

namespace App\Controllers;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\airModel;
use App\Models\kepalakeluargaModel;
use App\Models\desaModel;


class Air extends BaseController
{
    protected $airModel;
    protected $desaModel;
    protected $kepalakeluargaModel;


    public function __construct()
    {
        $this->airModel = new airModel();
        $this->kepalakeluargaModel = new kepalakeluargaModel();
        $this->desaModel = new desaModel();
    }

    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'air' => $this->airModel->semuaData(),
            'airAdmin' => $this->airModel->airAdmin(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'desa' => $this->desaModel->findAll()

        ];
        return view('air', $data);
    }
    public function tabeladmin()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'air' => $this->airModel->semuaData(),
            'airAdmin' => $this->airModel->airAdmin(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'desa' => $this->desaModel->findAll()

        ];
        return view('air1', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'id_kk' => [
                'label' => 'Kepala Keluarga',
                'rules' => 'required|is_unique[air.id_kk,id_air,{id_air}]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia',
                ]
            ],

        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($this->request->getVar('pdam') == "Iya" && $this->request->getVar('sumur') == "Iya") {
            $keterangan = "Sehat";
        } else if ($this->request->getVar('pdam') == "Iya" && $this->request->getVar('sumur') == "Tidak") {
            $keterangan = "Sehat";
        } else if ($this->request->getVar('pdam') == "Tidak" && $this->request->getVar('sumur') == "Iya") {
            $keterangan = "Sehat";
        } else {
            $keterangan = "Tidak Sehat";
        }

        $save = [
            'id_kk' => $this->request->getVar('id_kk'),
            'pdam' => $this->request->getVar('pdam'),
            'sumur' => $this->request->getVar('sumur'),
            'keterangan' => $keterangan,

        ];

        $air = new airModel();
        $air->insert($save);
        session()->setFlashdata('success', 'Data Sumber Air Berhasil Ditambahkan.');
        return redirect()->to('/sumber-air');
    }

    public function update1($id)
    {
        if ($this->request->getVar('pdam') == "Iya" && $this->request->getVar('sumur') == "Iya") {
            $keterangan = "Sehat";
        } else if ($this->request->getVar('pdam') == "Iya" && $this->request->getVar('sumur') == "Tidak") {
            $keterangan = "Sehat";
        } else if ($this->request->getVar('pdam') == "Tidak" && $this->request->getVar('sumur') == "Iya") {
            $keterangan = "Sehat";
        } else {
            $keterangan = "Tidak Sehat";
        }

        $this->airModel->save([
            'id_air' => $id,
            'pdam' => $this->request->getVar('pdam'),
            'sumur' => $this->request->getVar('sumur'),
            'keterangan' => $keterangan,

        ]);
        session()->setFlashdata('success', 'data Sumber Air telah diubah.');
        return redirect()->back();
    }
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_air = $this->request->getVar('id_air');

            $air = new airModel();

            $air->delete($id_air);

            $msg = [
                'sukses' => "Data Sumber Air berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
    public function listData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('air')
            ->select('kepalakeluarga.nama as nama, id_air, pdam, sumur, keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = air.id_kk');
        return DataTable::of($builder)
            ->addNumbering('no')
            ->filter(function ($builder, $request) {
                if ($request->datadesa)
                    $builder->where('kepalakeluarga.id_desa', $request->datadesa);
            })
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_air')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_air')\">
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
        $builder = $db->table('air')
            ->select('kepalakeluarga.nama as nama, id_air, pdam, sumur, keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = air.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id());
        return DataTable::of($builder)
            ->addNumbering('no')

            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_air')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_air')\">
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
            $id = $this->request->getVar('id_air');
            $ambilid = $this->airModel->find($id);
            $id_kk = $ambilid['id_kk'];
            $ambilkk = $this->kepalakeluargaModel->find($id_kk);
            $data = [
                'id_air' => $id,
                'nama' => $ambilkk['nama'],
                'pdam' => $ambilid['pdam'],
                'sumur' => $ambilid['sumur'],



            ];
            $msg = [
                'data' => view('eair', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_air');
            $pdam = $this->request->getVar('pdam');
            $sumur = $this->request->getVar('sumur');

            if ($pdam == "Iya" && $sumur == "Iya") {
                $keterangan = "Sehat";
            } else if ($pdam == "Iya" && $sumur == "Tidak") {
                $keterangan = "Sehat";
            } else if ($pdam == "Tidak" && $sumur == "Iya") {
                $keterangan = "Sehat";
            } else {
                $keterangan = "Tidak Sehat";
            }

            $this->airModel->update($id, [
                'pdam' => $pdam,
                'sumur' => $sumur,
                'keterangan' => $keterangan,


            ]);

            $msg = [
                'success' => 'Data Air berhasil diubah'
            ];


            echo json_encode($msg);
        }
    }
}
