<?php 

namespace App\Models;

use CodeIgniter\Model;

class ModelPengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'PengembalianID';
    protected $allowedFields = ['PeminjamanID', 'TanggalKembali', 'UserID', 'hariKeterlambatan', 'Denda', 'UangDibayarkan', 'UangKembalian', 'BukuID'];

        public function tambahPengembalian($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    // Fungsi untuk mendapatkan data pengembalian berdasarkan PeminjamanID
    public function getPengembalianByPeminjamanID($peminjamanID)
    {
        return $this->where('PeminjamanID', $peminjamanID)->get();
    }

}

 ?>