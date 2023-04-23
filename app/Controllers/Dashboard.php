<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\kepalakeluargaModel;
use App\Models\anggotaModel;
use App\Models\desaModel;



class Dashboard extends BaseController
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
            'countPUS' => $this->kepalakeluargaModel->countPUS(),
            'countWUS' => $this->kepalakeluargaModel->countWUS(),
            'countIM' => $this->kepalakeluargaModel->countIM(),
            'countIH' => $this->kepalakeluargaModel->countIH(),
            'countLU' => $this->kepalakeluargaModel->countLU(),
            'countButa' => $this->kepalakeluargaModel->countButa(),
            'countBH' => $this->kepalakeluargaModel->countBH(),
            'countBK' => $this->kepalakeluargaModel->countBK(),
            'countPUS1' => $this->anggotaModel->countPUS(),
            'countWUS1' => $this->anggotaModel->countWUS(),
            'countIM1' => $this->anggotaModel->countIM(),
            'countIH1' => $this->anggotaModel->countIH(),
            'countLU1' => $this->anggotaModel->countLU(),
            'countButa1' => $this->anggotaModel->countButa(),
            'countBH1' => $this->anggotaModel->countBH(),
            'countBK1' => $this->anggotaModel->countBK(),
            'desa' => $this->desaModel->findAll(),
            'desakk' => $this->kepalakeluargaModel->getDataByDesa(),

            // 'countpro' => $this->kepalakeluargaModel->countKKDesa($id),


            'validation' => \Config\Services::validation(),
        ];
        return view('dashboard', $data);
    }
    public function tambah()
    {
        return view('tambah');
    }
}
