<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Model\ModelPeminjaman;

class ModelBuku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'BukuID';
    protected $allowedFields = ['BukuID', 'Judul', 'Penulis', 'Penerbit', 'TahunTerbit', 'CoverBuku', 'NamaKategori', 'SubKategori', 'stok'];

    // Fungsi untuk menyimpan data buku
    public function saveBuku($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk mendapatkan data buku
    public function getBuku()
    {
        return $this->findAll();
    }

    public function dapatkan_buku($bukuID)
    {
        if ($bukuID == false) {
            return $this->findAll();
        } else {
            $result = $this->getWhere(['BukuID' => $bukuID])->getRow();
            return $result ? $result : false;
        }
    }

    public function getBukuWithKategori()
    {
        return $this->select('buku.*, kategoribuku.NamaKategori')
                    ->join('kategoribuku', 'kategoribuku.NamaKategori = buku.NamaKategori')
                    ->findAll();
    }

    // Fungsi untuk mengurangi stok buku saat peminjaman
    public function kurangiStok($bukuID, $stok_baru)
    {
        $builder = $this->db->table($this->table);
        $builder->where('BukuID', $bukuID);

        $data = ['stok' => $stok_baru];
        $builder->update($data);

        return $this->db->affectedRows(); 
    }

    // Fungsi untuk mendapatkan buku dengan stok lebih dari 0
    public function getBukuAvailable()
    {
        return $this->where('stok >', 0)->findAll();
    }
}
