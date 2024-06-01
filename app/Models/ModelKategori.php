<?php 

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table = 'kategoribuku';
    protected $primaryKey = 'KategoriID';
    protected $allowedFields = ['KategoriID', 'NamaKategori'];

    // Fungsi untuk menyimpan data buku
    public function saveKategori($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk mendapatkan data buku
    public function getKategori()
    {
        return $this->findAll();
    }

    public function getNamaKategori()
    {
        $result = $this->select('NamaKategori')->findAll();
    }
}

