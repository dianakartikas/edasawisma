<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\desaModel;



class Pengguna extends BaseController
{
    protected $UserModel;
    protected $desaModel;


    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->desaModel = new desaModel();

    }

    public function index()
    {
        $data = [
            'user' => $this->UserModel->findAll(),
            'pengguna' => $this->UserModel->daftarPengguna(),
            'desa' => $this->desaModel->findAll(),

            'validation' => \Config\Services::validation(),
        ];
        return view('pengguna', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'is_unique' => '{field} sudah terdaftar.',
                    'valid_email' => 'tidak dalam bentuk {field} .'
                ]
            ],
            'id_desa' => [
                'label' => 'Admin',
                'rules' => 'required|is_unique[users.id_desa,id,{id}]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],

            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'

                ]
            ],
            'confirm_password' => [
                'label' => 'Konfirmasi password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'matches' => '{field} tidak sama.',
                ]
            ],
            
        ])) {
            return redirect()->to('/pengguna')->withInput()->with('errors', $this->validator->getErrors());
        }
      
        $password   = $this->request->getPost('password');
        $save = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'id_desa' => $this->request->getVar('id_desa'),           
            'password_hash' => password_hash(
                base64_encode(
                    hash('sha384', $password, true)
                ),
                PASSWORD_DEFAULT,
                ['cost' => 10]
            ),

            
            'active' => '1',
        ];
        $user = new UserModel();
        $user->withGroup('admin')->insert($save);
        session()->setFlashdata('success', 'Data Pengguna Berhasil Ditambahkan.');
        return redirect()->to('/pengguna');
    }
    public function confirmdelete($id = null)
    {
        $this->UserModel->delete($id);
        $user = new UserModel();
        $user->purgeDeleted();
        $data = [
            'status' => 'berhasil dihapus',
            'status_test' => 'data user sudah berhasil dihapus',
            'status_icon' => 'success'
        ];
        return $this->response->setJSON($data);
    }
     public function update($id)
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.id!=' . $id . ' AND ' . 'username=]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.id!=' . $id . ' AND ' . 'email=]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'is_unique' => '{field} sudah terdaftar.',
                    'valid_email' => 'tidak dalam bentuk {field} .'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi.'

                ]
            ],
            'confirm_password' => [
                'label' => 'Konfirmasi password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'matches' => '{field} tidak sama.',
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $password   = $this->request->getPost('password');
        $this->UserModel->save([
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password_hash' => password_hash(
                base64_encode(
                    hash('sha384', $password, true)
                ),
                PASSWORD_DEFAULT,
                ['cost' => 10]
            ),

        ]);
        session()->setFlashdata('success', 'data pengguna berhasil diubah.');
        return redirect()->to('/pengguna');
    }

}
