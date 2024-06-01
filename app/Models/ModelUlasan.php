<?php 

namespace App\Models;

use CodeIgniter\Model;

class ModelUlasan extends Model
{
	 protected $table = 'ulasanbuku';
     protected $primaryKey = 'UlasanID';
     protected $allowedFields = ['UlasanID', 'UserID', 'BukuID', 'Ulasan', 'Rating', 'Username', 'Judul', 'TanggalUlasan'];

     public function saveUlasan($data)
    {
        return $this->insert($data);
    }

    public function avgRating($BukuID)
    {
        $query = $this->db->query('SELECT AVG(Rating) as average_rating FROM ' . $this->table . ' WHERE BukuID = ?', [$BukuID]);
        return $query->getRow()->average_rating;
    }

    public function ulasanByBuku()
    {
        return $this->select('ulasanbuku.*, user.*, buku.*')
            ->join('user', 'user.UserID = ulasanbuku.UserID')
            ->join('buku', 'buku.BukuID = ulasanbuku.BukuID')
            ->get()
            ->getResultArray();
    }

    public function tambahUlasan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }


}

 ?>