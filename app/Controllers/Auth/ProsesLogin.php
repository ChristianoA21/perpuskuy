<?php 

namespace App\Controllers\Auth;

use App\Models\ModelUser;
use App\Models\ModelPetugas;

use App\Controllers\BaseController;

class ProsesLogin extends BaseController
{
	
	public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelPetugas = new ModelPetugas();
    }

    public function proses_login()
    {
        $email = $this->request->getPost('Email');
        $password = $this->request->getPost('Password');
        
       $dapatkan_user = $this->ModelUser->dapatkan_user($email)->getRow();
       $dapatkan_petugas = $this->ModelPetugas->dapatkan_petugas($email)->getRow();

       if ($email === 'admin@admin.com' && $password === 'admin') {
           return redirect()->to(base_url('/admin/dashboard'));
       } 
       elseif ($dapatkan_petugas) {
            if ($password === $dapatkan_petugas->PasswordPetugas) {
                session()->set([
                    'Email'=>$dapatkan_petugas->Email, 
                    'Status_login'=> TRUE,
                    ]);

                return redirect()->to(base_url('/petugas/dashboard'));
            } else {
                    return redirect()->to(base_url('/login'));

            }
       } 
        else {
           if ($dapatkan_user) {
               if (password_verify($password, $dapatkan_user->Password)) {
                   session()->set([
                    'Email'=>$dapatkan_user->Email,  
                    'Username' => $dapatkan_user->Username,
                    'NamaLengkap' => $dapatkan_user->NamaLengkap, 
                    'Status_login'=> TRUE,
                   ]);

                   return redirect()->to(base_url('/'));
               }else {
                    return redirect()->to(base_url('/login'));

               }
           } else {
                return redirect()->to(base_url('/login'));

            }
       }

    }
}
 ?>