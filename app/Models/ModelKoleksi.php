<?php 

namespace App\Models;

use CodeIgniter\Model;

class ModelKoleksi extends Model
{
	 protected $table = 'koleksipribadi';
     protected $primaryKey = 'KoleksiID';
     protected $allowedFields = ['KoleksiID', 'UserID', 'BukuID', 'Judul', 'Username'];

     public function saveKoleksi($data)
    {
        return $this->insert($data);
    }

    public function cekDuplikasi($userID, $bukuID)
    {
        return $this->where(['UserID' => $userID, 'BukuID' => $bukuID])->countAllResults() > 0;
    }

    public function tambahKoleksi($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function getKoleksiWithJudulandCoverBukuByUserID($userID)
    {
        return $this->select('koleksipribadi.*, buku.CoverBuku')
                    ->join('buku', 'buku.BukuID = koleksipribadi.BukuID')
                    ->where('koleksipribadi.UserID', $userID)
                    ->get()
                    ->getResultArray();
    }

    public function semua_koleksi_by_user($UserID)
     {
         $query = $this->db->table('koleksipribadi');
         $result = $query->select('*')
             ->join('user', 'user.UserID = koleksipribadi.UserID')
             ->join('buku', 'buku.BukuID = koleksipribadi.BukuID')
             ->join('kategoribuku', 'kategoribuku.KategoriID = buku.KategoriID')
             ->where('koleksipribadi.UserID', $UserID)
             ->get()
             ->getResultArray();
     
         return $result;
     }

    public function hapus_koleksi_buku($BukuID)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['BukuID' => $BukuID]);
    } 

    public function cek_user_koleksi($UserID, $BukuID)
    {
        return $this->getWhere([
            'UserID' => $UserID,
            'BukuID' => $BukuID,
        ])->getRow();
    }

    public function dapatkan_buku_koleksi($BukuID)
    {
        $this->select('*');
        $this->join('kategoribuku', 'kategoribuku.KategoriID = '.$this->table.'.KategoriID');

        if ($BukuID === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['BukuID' => $BukuID])->getRow();
        }
    }

    // query untuk method buku_dikembalikan by member
     public function semua_koleksi_by_member($UserID)
     {
         $query = $this->db->table('koleksipribadi');
         $result = $query->select('*')
             ->join('user', 'user.UserID = koleksipribadi.UserID')
             ->join('buku', 'buku.BukuID = koleksipribadi.BukuID')
             ->join('tb_kategori_buku', 'tb_kategori_buku.id_kategori_buku = buku.id_kategori_buku')
             ->where('koleksipribadi.UserID', $UserID)
             ->get()
             ->getResultArray();
     
         return $result;
     }
}

 ?>