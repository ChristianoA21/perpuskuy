<?php

namespace App\Controllers;

use App\Models\ModelUser;
use App\Models\ModelBuku;
use App\Models\ModelPeminjaman;
use App\Models\ModelKategori;
use App\Models\ModelUlasan;
use App\Models\ModelKoleksi;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index(): string
    {
        $modelBuku = new ModelBuku();
        $data['buku'] = $modelBuku->findAll();

        $modelPeminjaman = new ModelPeminjaman();
        $data['peminjaman'] = $modelPeminjaman->findAll();
        $data['cekTanggalPengembalian'] = $modelPeminjaman->cekTanggalPengembalian();

        return view('index', $data);
    }

    public function login() : string
    {
        return view('login');
    }

    public function register() : string 
    {
        return view('register');
    }
    public function daftarBuku() : string 
    {
        $modelBuku = new ModelBuku();
        $data['buku'] = $modelBuku->findAll();

        $modelPeminjaman = new ModelPeminjaman();
        $data['peminjaman'] = $modelPeminjaman->findAll();
        $data['cekTanggalPengembalian'] = $modelPeminjaman->cekTanggalPengembalian();

        $modelUlasan = new ModelUlasan();
        $data['ulasan'] = $modelUlasan->findAll();
        $BukuID = $modelUlasan->find('BukuID');
        $semuaBuku = $modelUlasan->ulasanByBuku($BukuID);
        $avgRating = $modelUlasan->avgRating($BukuID);

        // Mendapatkan email dari sesi
        $email = session()->get('Email');

        // Mengambil UserID dari tabel yang sesuai dengan email
        $modelUser = new ModelUser();
        $user = $modelUser->dapatkan_user($email)->getRow();
        $data['userID'] = ($user) ? $user->UserID : null;
        
        return view ('daftarBuku', $data);
    }

    public function daftarPeminjaman() 
    {
        $email = session()->get('Email');
        $modelUser = new ModelUser();
        $user = $modelUser->dapatkan_user($email)->getRow();
        $userID = ($user) ? $user->UserID : null;

        $modelPeminjaman = new ModelPeminjaman();
        $data['peminjaman'] = $modelPeminjaman->getPeminjamanWithJudulandCoverBukuByUserID($userID);

        $data['cekTanggalPengembalian'] = $modelPeminjaman->cekTanggalPengembalian();

        return view('daftarPeminjaman', $data);
    }

    public function tambahPeminjaman() 
    {
        $modelPeminjaman = new ModelPeminjaman();
        $bukuID = $this->request->getPost('BukuID');
        $totalPinjam = $this->request->getPost('TotalBuku');

        // 1. Pisahkan proses insert dan ambil ID dari data yang baru dimasukkan
        $dataInsert = [
            'UserID' => $this->request->getPost('UserID'),
            'BukuID' => $bukuID, 
            'TanggalPeminjaman' => $this->request->getPost('TanggalPeminjaman'), 
            'TanggalPengembalian' => $this->request->getPost('TanggalPengembalian'),
            'TotalBuku' => $totalPinjam,
            'StatusPeminjaman' => 'meminjam', 
        ];

        // Simpan data peminjaman ke database
        $modelPeminjaman->savePeminjaman($dataInsert);

        // Ambil ID dari data yang baru dimasukkan
        $peminjamanID = $modelPeminjaman->insertID();

            $modelBuku = new ModelBuku();
            $dapatkan_buku = $modelBuku->dapatkan_buku($bukuID);
            $stok_sekarang = $dapatkan_buku->stok;

            $stok_baru = $stok_sekarang - $totalPinjam;
            $modelBuku->kurangiStok($bukuID, $stok_baru);

        return redirect()->to(base_url('/daftarBuku'));
    }




    public function logout()
    {
        // Hapus session
        $session = session();
        $session->remove('Email');
        $session->remove('Status_login');

        // Redirect ke halaman login atau halaman lain yang sesuai
        return redirect()->to(base_url('/login'));
    }

    public function koleksiBuku()
    {
        $email = session()->get('Email');
        $modelUser = new ModelUser();
        $user = $modelUser->dapatkan_user($email)->getRow();
        $userID = ($user) ? $user->UserID : null;

        $modelKoleksi = new ModelKoleksi();
        $data['koleksi'] = $modelKoleksi->getKoleksiWithJudulandCoverBukuByUserID($userID);

        return view('daftarKoleksi', $data);
    }


   public function tambahKoleksi()
    {
        $email = session()->get('Email');

        $modelUser = new ModelUser();
        $user = $modelUser->dapatkan_user($email)->getRow();
        $userID = ($user) ? $user->UserID : null;
        $username = ($user) ? $user->Username : null;

        // Fetch username based on the email


        $modelKoleksi = new ModelKoleksi();
        // Assuming $BukuID and $Judul are already defined in your code
        $data = [
            'UserID' => $userID,
            'BukuID' => $this->request->getPost('BukuID'),
            'Judul' => $this->request->getPost('Judul'),
            'Username' => $username
        ];

        // Simpan data koleksi ke database
        $modelKoleksi->tambahKoleksi($data);

        return redirect()->to(base_url('/daftarBuku'));
    }

    public function hapus_koleksi_buku($KoleksiID)
    {
        $modelKoleksi = new ModelKoleksi();

        // Hapus data buku dari database
        $modelKoleksi->delete($KoleksiID);

        return redirect()->to(base_url('/daftarKoleksi'));
    }


    public function tambahUlasan() 
    {
        $email = session()->get('Email');

        $modelUser = new ModelUser();
        $user = $modelUser->dapatkan_user($email)->getRow();
        $userID = ($user) ? $user->UserID : null;
        $username = ($user) ? $user->Username : null;
        $tanggalUlasan = date('Y-m-d');

        // Fetch username based on the email


        $modelUlasan = new ModelUlasan();
        // Assuming $BukuID and $Judul are already defined in your code
        $data = [
            'UserID' => $userID,
            'BukuID' => $this->request->getPost('BukuID'),
            'Ulasan' => $this->request->getPost('Ulasan'), 
            'Rating' => $this->request->getPost('Rating'), 
            'Username' => $username,
            'Judul' => $this->request->getPost('Judul'),
            'TanggalUlasan' => $tanggalUlasan
        ];

        var_dump($this->request->getPost());

        // Simpan data ulasan ke database
        $modelUlasan->tambahUlasan($data);

        return redirect()->to(base_url('/daftarBuku'));
    }



    

}
