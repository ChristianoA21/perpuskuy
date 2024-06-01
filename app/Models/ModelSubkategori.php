<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModelSubkategori extends Model
{
	protected $table = 'subkategori';
    protected $primaryKey = 'SubKategoriID';

    protected $allowedFields = ['SubKategoriID', 'NamaSubKategori', 'BukuID', 'Judul', 'KategoriID', 'NamaKategori'];

    public function getBukuId()
    {
        return $this->db->table('subkategori')
            ->join('buku', 'subkategori.BukuID = buku.BukuID')
            ->get()
            ->getResultArray();
    }

    public function getKategoriId()
    {
        return $this->db->table('subkategori')
            ->join('kategoribuku', 'subkategori.KategoriID = kategoribuku.KategoriID')
            ->get()
            ->getResultArray();
    }
    // Fungsi untuk menyimpan data buku
    public function saveSubkategori($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk mendapatkan data buku
    public function getSubkategori()
    {
        return $this->findAll();
    }


}

 ?>