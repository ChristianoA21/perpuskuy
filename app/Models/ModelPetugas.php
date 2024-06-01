<?php 

namespace App\Models;

use CodeIgniter\Model;

class ModelPetugas extends Model
{
	 protected $table = 'petugas';
    protected $primaryKey = 'PetugasID';
    protected $allowedFields = ['PetugasID', 'NamaPetugas', 'UsernamePetugas', 'PasswordPetugas', 'Level', 'Email'];

    // Fungsi untuk menyimpan data petugas
    public function savePetugas($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk mendapatkan data petugas
    public function getPetugas()
    {
        return $this->findAll();
    }

    public function getLevels()
    {
        $query = $this->db->table('petugas')->get();
        return $query->getResultArray();
    }

    public function dapatkan_petugas($email) {
        if ($email == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['email' => $email]);
        }
    }

}

 ?>