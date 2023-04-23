<?php

namespace App\Controllers;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\kepalakeluargaModel;
use App\Models\kegiatanModel;
use App\Models\desaModel;


class Kegiatan extends BaseController
{
    protected $kepalakeluargaModel;
    protected $kegiatanModel;
    protected $desaModel;


    public function __construct()
    {
        $this->kepalakeluargaModel = new kepalakeluargaModel();
        $this->kegiatanModel = new kegiatanModel();
        $this->desaModel = new desaModel();
    }
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'kegiatan' => $this->kegiatanModel->semuaData(),
            'kegiatanAdmin' => $this->kegiatanModel->kegiatanAdmin(),
            'desa' => $this->desaModel->findAll(),


        ];
        return view('kegiatan', $data);
    }

    public function tabeladmin()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'kepalaKeluarga' => $this->kepalakeluargaModel->findAll(),
            'kepalaKeluargaAdmin' => $this->kepalakeluargaModel->kepalaKeluargaAdmin(),
            'kegiatan' => $this->kegiatanModel->semuaData(),
            'kegiatanAdmin' => $this->kegiatanModel->kegiatanAdmin(),
            'desa' => $this->desaModel->findAll(),


        ];
        return view('kegiatan1', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'id_kk' => [
                'label' => 'Kepala Keluarga',
                'rules' => 'required|is_unique[kegiatan.id_kk,id_kegiatan,{id_kegiatan}]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia',
                ]
            ],

        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }



        $save = [
            'id_kk' => $this->request->getVar('id_kk'),
            'up2k' => $this->request->getVar('up2k'),
            'plp' => $this->request->getVar('plp'),
            'irt' => $this->request->getVar('irt'),
            'kb' => $this->request->getVar('kb'),
            'keterangan' => $this->request->getVar('keterangan'),

        ];

        $kegiatan = new kegiatanModel();
        $kegiatan->insert($save);
        session()->setFlashdata('success', 'Data Keikutsertaan Kegiatan Berhasil Ditambahkan.');
        return redirect()->to('/kegiatan');
    }

    public function update1($id)
    {

        $this->kegiatanModel->save([
            'id_kegiatan' => $id,
            'up2k' => $this->request->getVar('up2k'),
            'plp' => $this->request->getVar('plp'),
            'irt' => $this->request->getVar('irt'),
            'kb' => $this->request->getVar('kb'),
            'keterangan' => $this->request->getVar('keterangan'),

        ]);
        session()->setFlashdata('success', 'data Keikutsertaan Kegiatan telah diubah.');
        return redirect()->back();
    }
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_kegiatan = $this->request->getVar('id_kegiatan');

            $kegiatan = new kegiatanModel();

            $kegiatan->delete($id_kegiatan);

            $msg = [
                'sukses' => "Data Keikutsertaan Kegiatan berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function listData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kegiatan')
            ->select('kepalakeluarga.nama as nama, id_kegiatan, up2k, irt, kb, plp,keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = kegiatan.id_kk');

        return DataTable::of($builder)
            ->addNumbering('no')
            ->filter(function ($builder, $request) {
                if ($request->datadesa)
                    $builder->where('kepalakeluarga.id_desa', $request->datadesa);
            })
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_kegiatan')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_kegiatan')\">
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
        $builder = $db->table('kegiatan')
            ->select('kepalakeluarga.nama as nama, id_kegiatan, up2k, irt, kb, plp,keterangan')
            ->join('kepalakeluarga', 'kepalakeluarga.id_kk = kegiatan.id_kk')
            ->join('desa', 'desa.id_desa = kepalakeluarga.id_desa')
            ->join('users', 'users.id_desa = desa.id_desa')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id= auth_groups_users.group_id')
            ->where('users.id', user_id());
        return DataTable::of($builder)
            ->addNumbering('no')
            ->add('aksi', function ($row) {
                return "<button type=\"button\" class=\"btn btn-primary btn-icon-split btn-sm\" onclick=\"edit('$row->id_kegiatan')\"><span class=\"icon text-white-50\"><i class=\"fa fa-edit\"></i></span><span class=\"text\">Edit</span></button>
            <button type=\"button\" class=\"btn btn-danger btn-icon-split btn-sm\" onclick=\"hapus('$row->id_kegiatan')\">
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
            $id = $this->request->getVar('id_kegiatan');
            $ambilid = $this->kegiatanModel->find($id);
            $id_kk = $ambilid['id_kk'];
            $ambilkk = $this->kepalakeluargaModel->find($id_kk);
            $data = [
                'id_kegiatan' => $id,
                'nama' => $ambilkk['nama'],
                'up2k' => $ambilid['up2k'],
                'plp' => $ambilid['plp'],
                'irt' => $ambilid['irt'],
                'kb' => $ambilid['kb'],

            ];
            $msg = [
                'data' => view('ekegiatan', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_kegiatan');
            $up2k = $this->request->getVar('up2k');
            $plp = $this->request->getVar('plp');
            $irt = $this->request->getVar('irt');
            $kb = $this->request->getVar('kb');
            $keterangan = $this->request->getVar('keterangan');


            $this->kegiatanModel->update($id, [
                'up2k' => $up2k,
                'plp' => $plp,
                'irt' => $irt,
                'kb' => $kb,
                'keterangan' => $keterangan,

            ]);

            $msg = [
                'success' => 'Data Kegiatan berhasil diubah'
            ];


            echo json_encode($msg);
        }
    }
}
