<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPeminjaman extends Model
{
    protected $table = 'peminjam';
    protected $primaryKey = 'PeminjamanID';
    protected $allowedFields = ['PeminjamanID', 'UserID', 'BukuID', 'TanggalPeminjaman', 'TanggalPengembalian', 'StatusPeminjaman', 'TotalBuku'];

    // Fungsi untuk menyimpan data buku
    public function savePeminjaman($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk mendapatkan data buku
    public function getPeminjaman()
    {
        // Ambil UserID dari sesi login
        $userID = session()->get('UserID');

        // Jika tidak ada UserID dari sesi login, kembalikan array kosong
        if (!$userID) {
            return [];
        }

        // Ambil data peminjaman berdasarkan UserID
        return $this->getPeminjamanByUserID($userID);
    }

    public function getPeminjamanById($peminjamanID)
    {
        return $this->where('PeminjamanID', $peminjamanID)->first();
    }

    public function getPeminjamanByUserID($userID)
    {
        return $this->where('UserID', $userID)->get();
    }

    public function tambahStatusPeminjaman($peminjamanID, $status)
    {
        $data = ['StatusPeminjaman' => $status];

        $this->where('PeminjamanID', $peminjamanID)
             ->set($data)
             ->update();
    }

     public function getPeminjamanWithJudulandCoverBukuByUserID($userID)
    {
        return $this->select('peminjam.*, buku.Judul, buku.CoverBuku')
                    ->join('buku', 'buku.BukuID = peminjam.BukuID')
                    ->where('peminjam.UserID', $userID)
                    ->get()
                    ->getResultArray();
    }

    public function getPeminjamanWithJudulandCoverBuku()
    {
        return $this->select('peminjam.*, buku.Judul, buku.CoverBuku')
                    ->join('buku', 'peminjam.BukuID = buku.BukuID')
                    ->findAll();
    }

    public function getPeminjamanWithEmailandNamaLengkap()
    {
        return $this->select('peminjam.*, user.Email, user.NamaLengkap')
                    ->join('user', 'user.UserID = peminjam.UserID')
                    ->findAll();
    }

    public function getPeminjamanWithhariKeterlambatan()
    {
        return $this->select('peminjam.*, pengembalian.hariKeterlambatan')
                    ->join('pengembalian', 'peminjam.PeminjamanID = pengembalian.PeminjamanID')
                    ->findAll();
    }

    public function cekTanggalPengembalian()
    {
        $currentDate = date('Y-m-d');
        
        $overdueReturns = $this->where('TanggalPengembalian <', $currentDate)
                              ->where('StatusPeminjaman', 'meminjam')
                              ->findAll();

        return $overdueReturns;
    }

    public function getAllStatusDipinjam()
    {
        return $this->select('peminjam.*, user.*, buku.*')
            ->join('user', 'user.UserID = peminjam.UserID')
            ->join('buku', 'buku.BukuID = peminjam.BukuID')
            ->groupStart()
            ->orWhere('StatusPeminjaman', 'meminjam')
            ->orWhere('StatusPeminjaman', 'kembali')
            ->groupEnd()
            ->orderBy('TanggalPeminjaman', 'DESC') // Urutan tanggal terbaru (DESC)
            ->get()
            ->getResultArray();
    }

    public function buku()
    {
        return $this->belongsTo(ModelBuku::class, 'BukuID');
    }

    public function getPeminjamanWithBookInfo($peminjamanID)
    {
        return $this->db->table('peminjam')
            ->select('peminjam.*, buku.Judul')
            ->join('buku', 'buku.BukuID = peminjam.BukuID')
            ->where('PeminjamanID', $peminjamanID)
            ->get()
            ->getRow();
    }

}
