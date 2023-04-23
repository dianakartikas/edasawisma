<?php

namespace App\Controllers;

use App\Models\kepalakeluargaModel;
use App\Models\anggotaModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Home extends BaseController
{
    protected $kepalakeluargaModel;
    protected $anggotaModel;
    protected $UserModel;


    public function __construct()
    {
        $this->kepalakeluargaModel = new kepalakeluargaModel();
        $this->anggotaModel = new anggotaModel();
        $this->UserModel = new UserModel();
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
            'countBalita' => $this->anggotaModel->countBalita(),

            'validation' => \Config\Services::validation(),
        ];

        return view('welcome_message', $data);
    }

    public function masuk()
    {
        $data = [

            'config' => config('Auth'),
        ];
        return view('masuk', $data);
    }
    public function profile()
    {

        $data = [
            'validation' => \Config\Services::validation(),
            'users' => $this->UserModel->lihatProfile(),
            'password' => $this->UserModel->lihatPassword(),


        ];

        return view('/profile', $data);
    }
    public function updateprofile()
    {

        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.id!=' . user_id() . ' AND ' . 'username=]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.id!=' . user_id() . ' AND ' . 'email=]',
                'errors' => [
                    'required' => '{field} wajib di isi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],

            'user_image' => [
                // jangan pake spasi 
                'rules' => 'max_size[user_image,1024]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png,image/svg]',
                'errors' => [
                    // 'uploaded' => 'Pilih gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gmbar'
                ]
            ],

        ])) {

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $fileGambar = $this->request->getFile('user_image');
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        } else {
            // generate nama foto
            $namaGambar = $fileGambar->getRandomName();
            // pindahkan ke folder
            $fileGambar->move('img/user', $namaGambar);
            // hapus foto

            if ($fileGambar != "") {
                if (file_exists('img/user/' .  $this->request->getVar('gambarLama') != 'default.svg')) {
                    unlink('img/user/' . $this->request->getVar('gambarLama'));
                }
            }
        }


        $this->UserModel->save([
            'id' => user_id(),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),

            'user_image' => $namaGambar,


        ]);
        session()->setFlashdata('success', 'data pengguna berhasil diubah.');
        return redirect()->to('/profile');
    }
    public function updatepassword()
    {
        if (!$this->validate([

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
            return redirect()->to('/profile')->withInput()->with('errors', $this->validator->getErrors());
        }

        $password   = $this->request->getPost('password');
        $this->UserModel->save([
            'id' => user_id(),
            'password_hash' => password_hash(
                base64_encode(
                    hash('sha384', $password, true)
                ),
                PASSWORD_DEFAULT,
                ['cost' => 10]
            ),

        ]);


        session()->setFlashdata('success', 'Data password berhasil diubah.');
        return redirect()->to('/logout');
    }
    public function laporan()
    {

        $data = [
            'validation' => \Config\Services::validation(),
            'cetak' => $this->kepalakeluargaModel->cetakData(),
            'cetakAdmin' => $this->kepalakeluargaModel->cetakDataDesa(),

        ];

        return view('/laporan', $data);
    }

    public function export()
    {
        $cetak = $this->kepalakeluargaModel->cetakData();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setSize(8);
        $sheet->setCellValue('A1', 'REKAPITULASI');
        $sheet->setCellValue('A2', 'CATATAN DATA DAN KEGIATAN WARG');
        $sheet->setCellValue('A3', 'KELOMPOK DASAWISMA');
        $sheet->setCellValue('A5', 'DASAWISMA');
        $sheet->setCellValue('A6', 'RT');
        $sheet->setCellValue('A7', 'RW');
        $sheet->setCellValue('A8', 'DESA/KELURAHAN');
        $sheet->setCellValue('A9', 'TAHUN');
        $sheet->setCellValue('A10', 'NO');
        $sheet->setCellValue('B10', 'NAMA KEPALA RUMAH TANGGA');
        $sheet->setCellValue('C10', 'JML KK');
        $sheet->setCellValue('D10', 'JUMLAH ANGGOTA KELUARGA');
        $sheet->setCellValue('O10', 'KRITERIA RUMAH');
        $sheet->setCellValue('U10', 'SUMBER AIR KELUARGA');
        $sheet->setCellValue('X10', 'MAKANAN POKOK');
        $sheet->setCellValue('Z10', 'WARGA MENGIKUTI KEGIATAN');
        $sheet->setCellValue('AD10', 'KET');
        $sheet->setCellValue('D11', 'TOTAL');
        $sheet->setCellValue('F11', 'BALITA');
        $sheet->setCellValue('H11', 'PUS');
        $sheet->setCellValue('I11', 'WUS');
        $sheet->setCellValue('J11', 'IBU HAMIL');
        $sheet->setCellValue('K11', 'IBU MENYUSUI');
        $sheet->setCellValue('L11', 'LANSIA');
        $sheet->setCellValue('M11', '3 BUTA');
        $sheet->setCellValue('N11', 'BERKEBUTUHAN KHUSUS');
        $sheet->setCellValue('O11', 'SEHAT LAYAK HUNI');
        $sheet->setCellValue('P11', 'TIDAK SEHAT LAYAK HUNI');
        $sheet->setCellValue('Q11', 'MEMILIKI TMP. PEM.SAMPAH');
        $sheet->setCellValue('R11', 'MEMILIKI SPAL');
        $sheet->setCellValue('S11', 'MEMILIKI JAMBAN KELUARGA');
        $sheet->setCellValue('T11', 'MENEMPEL STIKER PMK');
        $sheet->setCellValue('U11', 'PDAM');
        $sheet->setCellValue('V11', 'SUMUR');
        $sheet->setCellValue('W11', 'DLL');
        $sheet->setCellValue('X11', 'BERAS');
        $sheet->setCellValue('Y11', 'NON BERAS');
        $sheet->setCellValue('Z11', 'UP2K');
        $sheet->setCellValue('AA11', 'PEMANFAATAN TANAH PERKARANGAN');
        $sheet->setCellValue('AB11', 'INDUSTRI RUMAH TANGGA');
        $sheet->setCellValue('AC11', 'KERJA BAKTI');
        $sheet->setCellValue('D13', 'L');
        $sheet->setCellValue('E13', 'P');
        $sheet->setCellValue('F13', 'L');
        $sheet->setCellValue('G13', 'P');
        $sheet->setCellValue('A14', '1');
        $sheet->setCellValue('B14', '2');
        $sheet->setCellValue('C14', '3');
        $sheet->setCellValue('D14', '4');
        $sheet->setCellValue('E14', '5');
        $sheet->setCellValue('F14', '6');
        $sheet->setCellValue('G14', '7');
        $sheet->setCellValue('H14', '8');
        $sheet->setCellValue('I14', '9');
        $sheet->setCellValue('J14', '10');
        $sheet->setCellValue('K14', '11');
        $sheet->setCellValue('L14', '12');
        $sheet->setCellValue('M14', '14');
        $sheet->setCellValue('N14', '14');
        $sheet->setCellValue('O14', '15');
        $sheet->setCellValue('P14', '16');
        $sheet->setCellValue('Q14', '17');
        $sheet->setCellValue('R14', '18');
        $sheet->setCellValue('S14', '19');
        $sheet->setCellValue('T14', '20');
        $sheet->setCellValue('U14', '21');
        $sheet->setCellValue('V14', '22');
        $sheet->setCellValue('W14', '23');
        $sheet->setCellValue('X14', '24');
        $sheet->setCellValue('Y14', '25');
        $sheet->setCellValue('Z14', '26');
        $sheet->setCellValue('AA14', '27');
        $sheet->setCellValue('AB14', '28');
        $sheet->setCellValue('AC14', '29');
        $sheet->setCellValue('AD14', '30');
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ),

        );
        $style_col2 = array(

            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ),
            ),
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

            ),
            'borders' => array(
                'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );




        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 15; // Set baris pertama untuk isi tabel adalah baris ke 5
        $nomor = 1;
        foreach ($cetak as $data) {
            $sheet->setCellValue('A' . $numrow, $nomor++);
            $sheet->setCellValue('B' . $numrow, $data['nama']);
            $sheet->setCellValue('C' . $numrow, 1);
            $sheet->setCellValue('D' . $numrow, $data['jenis_kelaminkk1'] + $data['jenis_kelamin1']);
            $sheet->setCellValue('E' . $numrow, $data['jenis_kelaminkk2'] + $data['jenis_kelamin2']);
            $sheet->setCellValue('F' . $numrow, $data['balitalaki']);
            $sheet->setCellValue('G' . $numrow, $data['balitaperempuan']);
            $sheet->setCellValue('H' . $numrow, $data['psu'] + $data['psu2']);
            $sheet->setCellValue('I' . $numrow, $data['wus'] + $data['wus2']);
            $sheet->setCellValue('J' . $numrow, $data['ih'] + $data['ih2']);
            $sheet->setCellValue('K' . $numrow, $data['im'] + $data['im2']);
            $sheet->setCellValue('L' . $numrow, $data['lu'] + $data['lu2']);
            $sheet->setCellValue('M' . $numrow, $data['buta1'] + $data['buta2'] + $data['butah1'] + $data['butah2']);
            $sheet->setCellValue('N' . $numrow, $data['spesial1'] + $data['spesial2']);
            if ($data['ps'] == "1" && $data['spal'] == "1" && $data['jk'] == "1" && $data['stikerpkk'] == "1") {
                $sheet->setCellValue('O' . $numrow, 1);
            } else {
                $sheet->setCellValue('O' . $numrow, 0);
            }
            if ($data['ps'] == "0" || $data['spal'] == "0" || $data['jk'] == "0" || $data['stikerpkk'] == "0") {
                $sheet->setCellValue('P' . $numrow, 1);
            } else {
                $sheet->setCellValue('P' . $numrow, 0);
            }
            $sheet->setCellValue('Q' . $numrow, $data['ps']);
            $sheet->setCellValue('R' . $numrow, $data['spal']);

            $sheet->setCellValue('S' . $numrow, $data['jk']);
            $sheet->setCellValue('T' . $numrow, $data['stikerpkk']);
            $sheet->setCellValue('U' . $numrow, $data['pdam']);
            $sheet->setCellValue('V' . $numrow, $data['sumur']);
            $sheet->setCellValue('W' . $numrow, 1);

            $sheet->setCellValue('X' . $numrow, $data['beras']);
            $sheet->setCellValue('Y' . $numrow, $data['nonberas']);
            $sheet->setCellValue('Z' . $numrow, $data['up2k']);
            $sheet->setCellValue('AA' . $numrow, $data['plp']);
            $sheet->setCellValue('AB' . $numrow, $data['irt']);
            $sheet->setCellValue('AC' . $numrow, $data['kb']);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping

        }
        $sheet->getStyle('A1')->applyFromArray($style_col);
        $sheet->getStyle('A2')->applyFromArray($style_col);
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('A5')->applyFromArray($style_col);
        $sheet->getStyle('A6')->applyFromArray($style_col);
        $sheet->getStyle('A7')->applyFromArray($style_col);
        $sheet->getStyle('A8')->applyFromArray($style_col);
        $sheet->getStyle('A9')->applyFromArray($style_col);
        $sheet->getStyle('A10:AD' . $numrow)->applyFromArray($style_col2);
        $sheet->getStyle('A11')->applyFromArray($style_col2);
        $sheet->getStyle('A12')->applyFromArray($style_col2);
        $sheet->getStyle('A13')->applyFromArray($style_col);
        $sheet->getStyle('A14')->applyFromArray($style_col);
        $sheet->getStyle('A15')->applyFromArray($style_col);
        $sheet->getStyle('A16')->applyFromArray($style_col);
        $sheet->getStyle('A17')->applyFromArray($style_col);

        $sheet->getColumnDimension('A')->setWidth(4); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(5); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(3); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(5); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(5); // Set width kolom C
        $sheet->getColumnDimension('G')->setWidth(5); // Set width kolom D
        $sheet->getColumnDimension('H')->setWidth(5); // Set width kolom E
        $sheet->getColumnDimension('J')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('K')->setWidth(8); // Set width kolom A
        $sheet->getColumnDimension('L')->setWidth(8); // Set width kolom B
        $sheet->getColumnDimension('M')->setWidth(8); // Set width kolom C
        $sheet->getColumnDimension('N')->setWidth(8); // Set width kolom D
        $sheet->getColumnDimension('O')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('P')->setWidth(8); // Set width kolom C
        $sheet->getColumnDimension('Q')->setWidth(11); // Set width kolom D
        $sheet->getColumnDimension('R')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('S')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('T')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('U')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('V')->setWidth(8); // Set width kolom A
        $sheet->getColumnDimension('W')->setWidth(8); // Set width kolom B
        $sheet->getColumnDimension('X')->setWidth(8); // Set width kolom C
        $sheet->getColumnDimension('Y')->setWidth(8); // Set width kolom D
        $sheet->getColumnDimension('Z')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('AA')->setWidth(8); // Set width kolom C
        $sheet->getColumnDimension('AB')->setWidth(8); // Set width kolom D
        $sheet->getColumnDimension('AC')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('AD')->setWidth(8); // Set width kolom E
        $sheet->mergeCells('A1:AD1');
        $sheet->mergeCells('A2:AD2');
        $sheet->mergeCells('A3:AD3');
        $sheet->mergeCells('A5:AD5');
        $sheet->mergeCells('A6:AD6');
        $sheet->mergeCells('A7:AD7');
        $sheet->mergeCells('A8:AD8');
        $sheet->mergeCells('A9:AD9');
        $sheet->mergeCells('D10:N10');
        $sheet->mergeCells('O10:T10');
        $sheet->mergeCells('U10:W10');
        $sheet->mergeCells('X10:Y10');
        $sheet->mergeCells('Z10:AC10');
        $sheet->mergeCells('D11:E12');
        $sheet->mergeCells('F11:G12');
        $sheet->mergeCells('A10:A13');
        $sheet->mergeCells('B10:B13');
        $sheet->mergeCells('C10:C13');
        $sheet->mergeCells('AD10:AD13');
        $sheet->mergeCells('H11:H12');
        $sheet->mergeCells('I11:I12');
        $sheet->mergeCells('J11:J12');
        $sheet->mergeCells('K11:K12');
        $sheet->mergeCells('L11:L12');
        $sheet->mergeCells('M11:M12');
        $sheet->mergeCells('N11:N12');
        $sheet->mergeCells('O11:O12');
        $sheet->mergeCells('P11:P12');
        $sheet->mergeCells('Q11:Q12');
        $sheet->mergeCells('R11:R12');
        $sheet->mergeCells('S11:S12');
        $sheet->mergeCells('T11:T12');
        $sheet->mergeCells('U11:U12');
        $sheet->mergeCells('V11:V12');
        $sheet->mergeCells('W11:W12');
        $sheet->mergeCells('X11:X12');
        $sheet->mergeCells('Y11:Y12');
        $sheet->mergeCells('Z11:Z12');
        $sheet->mergeCells('AA11:AA12');
        $sheet->mergeCells('AB11:AB12');
        $sheet->mergeCells('AC11:AC12');



        $sheet->getStyle('A1:AD1')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A2:AD2')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A3:AD3')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A5:AD5')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A6:AD6')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A7:AD7')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A8:AD8')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A9:AD9')->getAlignment()->setWrapText(true);
        $sheet->getStyle('D10:N10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('O10:T10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('U10:W10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('X10:Y10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('Z10:AC10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('D11:E12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('F11:G12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A10:A13')->getAlignment()->setWrapText(true);
        $sheet->getStyle('B10:B13')->getAlignment()->setWrapText(true);
        $sheet->getStyle('C10:C13')->getAlignment()->setWrapText(true);
        $sheet->getStyle('AD10:AD13')->getAlignment()->setWrapText(true);
        $sheet->getStyle('H11:H12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('I11:I12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('J11:J12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('K11:K12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('L11:L12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('M11:M12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('N11:N12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('O11:O12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('P11:P12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('Q11:Q12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('R11:R12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('S11:S12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('T11:T12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('U11:U12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('V11:V12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('W11:W12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('X11:X12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('Y11:Y12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('Z11:Z12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('AA11:AA12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('AB11:AB12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('AC11:AC12')->getAlignment()->setWrapText(true);


        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=dasawisma.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    public function export2()
    {
        $cetak = $this->kepalakeluargaModel->cetakDataDesa();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setSize(8);
        $sheet->setCellValue('A1', 'REKAPITULASI');
        $sheet->setCellValue('A2', 'CATATAN DATA DAN KEGIATAN WARGA');
        $sheet->setCellValue('A3', 'KELOMPOK DASAWISMA');
        $sheet->setCellValue('A5', 'DASAWISMA');
        $sheet->setCellValue('A6', 'RT');
        $sheet->setCellValue('A7', 'RW');
        $sheet->setCellValue('A8', 'DESA/KELURAHAN');
        $sheet->setCellValue('A9', 'TAHUN');
        $sheet->setCellValue('A10', 'NO');
        $sheet->setCellValue('B10', 'NAMA KEPALA RUMAH TANGGA');
        $sheet->setCellValue('C10', 'JML KK');
        $sheet->setCellValue('D10', 'JUMLAH ANGGOTA KELUARGA');
        $sheet->setCellValue('O10', 'KRITERIA RUMAH');
        $sheet->setCellValue('U10', 'SUMBER AIR KELUARGA');
        $sheet->setCellValue('X10', 'MAKANAN POKOK');
        $sheet->setCellValue('Z10', 'WARGA MENGIKUTI KEGIATAN');
        $sheet->setCellValue('AD10', 'KET');
        $sheet->setCellValue('D11', 'TOTAL');
        $sheet->setCellValue('F11', 'BALITA');
        $sheet->setCellValue('H11', 'PUS');
        $sheet->setCellValue('I11', 'WUS');
        $sheet->setCellValue('J11', 'IBU HAMIL');
        $sheet->setCellValue('K11', 'IBU MENYUSUI');
        $sheet->setCellValue('L11', 'LANSIA');
        $sheet->setCellValue('M11', '3 BUTA');
        $sheet->setCellValue('N11', 'BERKEBUTUHAN KHUSUS');
        $sheet->setCellValue('O11', 'SEHAT LAYAK HUNI');
        $sheet->setCellValue('P11', 'TIDAK SEHAT LAYAK HUNI');
        $sheet->setCellValue('Q11', 'MEMILIKI TMP. PEM.SAMPAH');
        $sheet->setCellValue('R11', 'MEMILIKI SPAL');
        $sheet->setCellValue('S11', 'MEMILIKI JAMBAN KELUARGA');
        $sheet->setCellValue('T11', 'MENEMPEL STIKER PMK');
        $sheet->setCellValue('U11', 'PDAM');
        $sheet->setCellValue('V11', 'SUMUR');
        $sheet->setCellValue('W11', 'DLL');
        $sheet->setCellValue('X11', 'BERAS');
        $sheet->setCellValue('Y11', 'NON BERAS');
        $sheet->setCellValue('Z11', 'UP2K');
        $sheet->setCellValue('AA11', 'PEMANFAATAN TANAH PERKARANGAN');
        $sheet->setCellValue('AB11', 'INDUSTRI RUMAH TANGGA');
        $sheet->setCellValue('AC11', 'KERJA BAKTI');
        $sheet->setCellValue('D13', 'L');
        $sheet->setCellValue('E13', 'P');
        $sheet->setCellValue('F13', 'L');
        $sheet->setCellValue('G13', 'P');
        $sheet->setCellValue('A14', '1');
        $sheet->setCellValue('B14', '2');
        $sheet->setCellValue('C14', '3');
        $sheet->setCellValue('D14', '4');
        $sheet->setCellValue('E14', '5');
        $sheet->setCellValue('F14', '6');
        $sheet->setCellValue('G14', '7');
        $sheet->setCellValue('H14', '8');
        $sheet->setCellValue('I14', '9');
        $sheet->setCellValue('J14', '10');
        $sheet->setCellValue('K14', '11');
        $sheet->setCellValue('L14', '12');
        $sheet->setCellValue('M14', '14');
        $sheet->setCellValue('N14', '14');
        $sheet->setCellValue('O14', '15');
        $sheet->setCellValue('P14', '16');
        $sheet->setCellValue('Q14', '17');
        $sheet->setCellValue('R14', '18');
        $sheet->setCellValue('S14', '19');
        $sheet->setCellValue('T14', '20');
        $sheet->setCellValue('U14', '21');
        $sheet->setCellValue('V14', '22');
        $sheet->setCellValue('W14', '23');
        $sheet->setCellValue('X14', '24');
        $sheet->setCellValue('Y14', '25');
        $sheet->setCellValue('Z14', '26');
        $sheet->setCellValue('AA14', '27');
        $sheet->setCellValue('AB14', '28');
        $sheet->setCellValue('AC14', '29');
        $sheet->setCellValue('AD14', '30');
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ),

        );
        $style_col3 = array(
            'font' => array('bold' => true), // Set font nya jadi bold


        );
        $style_col2 = array(

            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ),
            ),
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

            ),
            'borders' => array(
                'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );




        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 15; // Set baris pertama untuk isi tabel adalah baris ke 5
        $nomor = 1;
        foreach ($cetak as $data) {
            $sheet->setCellValue('A' . $numrow, $nomor++);
            $sheet->setCellValue('B' . $numrow, $data['nama']);
            $sheet->setCellValue('C' . $numrow, 1);
            $sheet->setCellValue('D' . $numrow, $data['jenis_kelaminkk1'] + $data['jenis_kelamin1']);
            $sheet->setCellValue('E' . $numrow, $data['jenis_kelaminkk2'] + $data['jenis_kelamin2']);
            $sheet->setCellValue('F' . $numrow, $data['balitalaki']);
            $sheet->setCellValue('G' . $numrow, $data['balitaperempuan']);
            $sheet->setCellValue('H' . $numrow, $data['psu'] + $data['psu2']);
            $sheet->setCellValue('I' . $numrow, $data['wus'] + $data['wus2']);
            $sheet->setCellValue('J' . $numrow, $data['ih'] + $data['ih2']);
            $sheet->setCellValue('K' . $numrow, $data['im'] + $data['im2']);
            $sheet->setCellValue('L' . $numrow, $data['lu'] + $data['lu2']);
            $sheet->setCellValue('M' . $numrow, $data['buta1'] + $data['buta2'] + $data['butah1'] + $data['butah2']);
            $sheet->setCellValue('N' . $numrow, $data['spesial1'] + $data['spesial2']);
            if ($data['ps'] == "1" && $data['spal'] == "1" && $data['jk'] == "1" && $data['stikerpkk'] == "1") {
                $sheet->setCellValue('O' . $numrow, 1);
            } else {
                $sheet->setCellValue('O' . $numrow, 0);
            }
            if ($data['ps'] == "0" || $data['spal'] == "0" || $data['jk'] == "0" || $data['stikerpkk'] == "0") {
                $sheet->setCellValue('P' . $numrow, 1);
            } else {
                $sheet->setCellValue('P' . $numrow, 0);
            }
            $sheet->setCellValue('Q' . $numrow, $data['ps']);
            $sheet->setCellValue('R' . $numrow, $data['spal']);
            $sheet->setCellValue('S' . $numrow, $data['jk']);
            $sheet->setCellValue('T' . $numrow, $data['stikerpkk']);
            $sheet->setCellValue('U' . $numrow, $data['pdam']);
            $sheet->setCellValue('V' . $numrow, $data['sumur']);
            $sheet->setCellValue('X' . $numrow, $data['beras']);
            $sheet->setCellValue('Y' . $numrow, $data['nonberas']);
            $sheet->setCellValue('Z' . $numrow, $data['up2k']);
            $sheet->setCellValue('AA' . $numrow, $data['plp']);
            $sheet->setCellValue('AB' . $numrow, $data['irt']);
            $sheet->setCellValue('AC' . $numrow, $data['kb']);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
            $sheet->setCellValue('C8', ': ' . $data['namadesa']);
        }
        $sheet->getStyle('A1')->applyFromArray($style_col);
        $sheet->getStyle('A2')->applyFromArray($style_col);
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('A5')->applyFromArray($style_col3);
        $sheet->getStyle('A6')->applyFromArray($style_col3);
        $sheet->getStyle('A7')->applyFromArray($style_col3);
        $sheet->getStyle('A8')->applyFromArray($style_col3);
        $sheet->getStyle('A9')->applyFromArray($style_col3);
        $sheet->getStyle('A10:AD' . $numrow)->applyFromArray($style_col2);
        $sheet->getStyle('A11')->applyFromArray($style_col2);
        $sheet->getStyle('A12')->applyFromArray($style_col2);
        $sheet->getStyle('A13')->applyFromArray($style_col);
        $sheet->getStyle('A14')->applyFromArray($style_col);
        $sheet->getStyle('A15')->applyFromArray($style_col);
        $sheet->getStyle('A16')->applyFromArray($style_col);
        $sheet->getStyle('A17')->applyFromArray($style_col);

        $sheet->getColumnDimension('A')->setWidth(4); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(5); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(3); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(5); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(5); // Set width kolom C
        $sheet->getColumnDimension('G')->setWidth(5); // Set width kolom D
        $sheet->getColumnDimension('H')->setWidth(5); // Set width kolom E
        $sheet->getColumnDimension('J')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('K')->setWidth(8); // Set width kolom A
        $sheet->getColumnDimension('L')->setWidth(8); // Set width kolom B
        $sheet->getColumnDimension('M')->setWidth(8); // Set width kolom C
        $sheet->getColumnDimension('N')->setWidth(8); // Set width kolom D
        $sheet->getColumnDimension('O')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('P')->setWidth(8); // Set width kolom C
        $sheet->getColumnDimension('Q')->setWidth(11); // Set width kolom D
        $sheet->getColumnDimension('R')->setWidth(9); // Set width kolom E
        $sheet->getColumnDimension('S')->setWidth(10); // Set width kolom E
        $sheet->getColumnDimension('T')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('U')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('V')->setWidth(8); // Set width kolom A
        $sheet->getColumnDimension('W')->setWidth(8); // Set width kolom B
        $sheet->getColumnDimension('X')->setWidth(8); // Set width kolom C
        $sheet->getColumnDimension('Y')->setWidth(8); // Set width kolom D
        $sheet->getColumnDimension('Z')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('AA')->setWidth(10); // Set width kolom C
        $sheet->getColumnDimension('AB')->setWidth(10); // Set width kolom D
        $sheet->getColumnDimension('AC')->setWidth(8); // Set width kolom E
        $sheet->getColumnDimension('AD')->setWidth(8); // Set width kolom E
        $sheet->mergeCells('A1:AD1');
        $sheet->mergeCells('A2:AD2');
        $sheet->mergeCells('A3:AD3');
        $sheet->mergeCells('A5:B5');
        $sheet->mergeCells('A6:B6');
        $sheet->mergeCells('A7:B7');
        $sheet->mergeCells('A8:B8');
        $sheet->mergeCells('A9:B9');
        $sheet->mergeCells('C8:G8');

        $sheet->mergeCells('D10:N10');
        $sheet->mergeCells('O10:T10');
        $sheet->mergeCells('U10:W10');
        $sheet->mergeCells('X10:Y10');
        $sheet->mergeCells('Z10:AC10');
        $sheet->mergeCells('D11:E12');
        $sheet->mergeCells('F11:G12');
        $sheet->mergeCells('A10:A13');
        $sheet->mergeCells('B10:B13');
        $sheet->mergeCells('C10:C13');
        $sheet->mergeCells('AD10:AD13');
        $sheet->mergeCells('H11:H13');
        $sheet->mergeCells('I11:I13');
        $sheet->mergeCells('J11:J13');
        $sheet->mergeCells('K11:K13');
        $sheet->mergeCells('L11:L13');
        $sheet->mergeCells('M11:M13');
        $sheet->mergeCells('N11:N13');
        $sheet->mergeCells('O11:O13');
        $sheet->mergeCells('P11:P13');
        $sheet->mergeCells('Q11:Q13');
        $sheet->mergeCells('R11:R13');
        $sheet->mergeCells('S11:S13');
        $sheet->mergeCells('T11:T13');
        $sheet->mergeCells('U11:U13');
        $sheet->mergeCells('V11:V13');
        $sheet->mergeCells('W11:W13');
        $sheet->mergeCells('X11:X13');
        $sheet->mergeCells('Y11:Y13');
        $sheet->mergeCells('Z11:Z13');
        $sheet->mergeCells('AA11:AA13');
        $sheet->mergeCells('AB11:AB13');
        $sheet->mergeCells('AC11:AC13');

        $sheet->getStyle('A1:AD1')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A2:AD2')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A3:AD3')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A5:AD5')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A6:AD6')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A7:AD7')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A8:AD8')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A9:AD9')->getAlignment()->setWrapText(true);
        $sheet->getStyle('D10:N10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('O10:T10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('U10:W10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('X10:Y10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('Z10:AC10')->getAlignment()->setWrapText(true);
        $sheet->getStyle('D11:E12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('F11:G12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A10:A13')->getAlignment()->setWrapText(true);
        $sheet->getStyle('B10:B13')->getAlignment()->setWrapText(true);
        $sheet->getStyle('C10:C13')->getAlignment()->setWrapText(true);
        $sheet->getStyle('AD10:AD13')->getAlignment()->setWrapText(true);
        $sheet->getStyle('H11:H12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('I11:I12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('J11:J12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('K11:K12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('L11:L12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('M11:M12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('N11:N12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('O11:O12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('P11:P12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('Q11:Q12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('R11:R12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('S11:S12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('T11:T12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('U11:U12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('V11:V12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('W11:W12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('X11:X12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('Y11:Y12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('Z11:Z12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('AA11:AA12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('AB11:AB12')->getAlignment()->setWrapText(true);
        $sheet->getStyle('AC11:AC12')->getAlignment()->setWrapText(true);


        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=dasawisma.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}
