<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\desaModel;


class Desa extends BaseController
{
    protected $desaModel;

    public function __construct()
    {
        $this->desaModel = new desaModel();
    }

    public function index()
    {
        $data = [
            'desa' => $this->desaModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('desa', $data);
    }


    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'label' => 'Nama Desa / Kelurahan',
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[desa.nama,id_desa,{id_desa}]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} nama terlalu pendek',
                    'max_length' => '{field} nama terlalu panjang',
                    'is_unique' => '{field} sudah tersedia',
                ]
            ],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $save = [
            'id_desa' => $this->request->getVar('id_desa'),
            'nama' => $this->request->getVar('nama'),


        ];
        $desa = new desaModel();
        $desa->insert($save);
        session()->setFlashdata('success', 'Data desa / kelurahan Berhasil Ditambahkan.');
        return redirect()->to('/desa-kelurahan');
    }
    public function update($id)
    {
        if (!$this->validate([
            'nama' => [
                'label' => 'Nama Desa / Kelurahan',
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[desa.id_desa!=' . $id . ' AND ' . 'nama=]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'min_length' => '{field} nama terlalu pendek',
                    'max_length' => '{field} nama terlalu panjang',
                    'is_unique' => '{field} nama terlalu panjang',
                ]
            ],

        ])) {

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->desaModel->save([
            'id_desa' => $id,
            'nama' => $this->request->getVar('nama'),

        ]);
        session()->setFlashdata('success', 'data desa / kelurahan berhasil diperbarui.');
        return redirect()->to('/desa-kelurahan');
    }
    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_desa = $this->request->getVar('id_desa');

            $desa = new desaModel();

            $desa->delete($id_desa);

            $msg = [
                'sukses' => "Data desa / kelurahan berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
}
