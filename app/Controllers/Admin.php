<?php 

namespace App\Controllers;

use App\Models\ModelUser;
use App\Models\ModelBuku;
use App\Models\ModelPetugas;
use App\Models\ModelKategori;
use App\Models\ModelSubkategori;
use App\Models\ModelPeminjaman;

class Admin extends BaseController
{
	
	public function __construct()
	{
		$this->ModelUser = new ModelUser();
	}

	public function dashboard(): string 
	{
        $modelBuku = new ModelBuku();
        $data['buku'] = $modelBuku->findAll();

        $modelUser = new ModelUser();
        $data['user'] = $modelUser->findAll();

        $modelPetugas = new ModelPetugas();
        $data['petugas'] = $modelPetugas->findAll();

		return view('admin/dashboard', $data);
	}
	public function daftarBuku(): string
	{
        $modelKategori = new ModelKategori();
        $data['namaKategori'] = $modelKategori->findAll();
        $data['kategori'] = $modelKategori->getKategori();

		$modelBuku = new ModelBuku();
        $data['buku'] = $modelBuku->findAll();

		return view('admin/tabelDaftarBuku', $data);
	}

    public function peminjaman(): string
    {
        $modelBuku = new ModelBuku();
        $data['peminjaman'] = $modelBuku->findAll();

        $modelUser = new ModelUser();
        $data['peminjaman'] = $modelUser->findAll();
        // $user = $modelUser->getUser()->getRow();
        // $userID = ($user) ? $user->UserID : null;

        $modelPeminjaman = new ModelPeminjaman();
        $data['peminjaman'] = $modelPeminjaman->getPeminjamanWithJudulandCoverBuku();

        return view('admin/tabelPeminjaman', $data);
    }

    public function user(): string
    {
        $modelUser = new ModelUser();
        $data['user'] = $modelUser->findAll();

        return view('admin/tabelUser', $data);
    }

    public function petugas(): string 
    {
        $modelPetugas = new ModelPetugas();
        $data['petugas'] = $modelPetugas->findAll();
        $data['level'] = $modelPetugas->getLevels();

        return view('admin/tabelPetugas', $data);
    }


    public function tambahPetugas() 
    {
        $modelPetugas = new ModelPetugas();

        // Ambil data buku dari form
        $data = [
            'NamaPetugas' => $this->request->getPost('NamaPetugas'),
            'UsernamePetugas' => $this->request->getPost('UsernamePetugas'),
            'PasswordPetugas' => $this->request->getPost('PasswordPetugas'),
            'Level' => $this->request->getPost('Level'),
            'Email' => $this->request->getPost('Email')
        ];

        var_dump($this->request->getPost());

        // Simpan data buku ke database
        $modelPetugas->savePetugas($data);

        return redirect()->to(base_url('/admin/petugas'));
    }

    public function editPetugas($id)
    {
        $modelPetugas = new ModelPetugas();

        // Ambil data buku dari form atau request
        $data = [
            'NamaPetugas' => $this->request->getPost('NamaPetugas'),
            'UsernamePetugas' => $this->request->getPost('UsernamePetugas'),
            'PasswordPetugas' => $this->request->getPost('PasswordPetugas'),
            'Level' => $this->request->getPost('Level'),
            'Email' => $this->request->getPost('Email')
        ];

        // Update data buku di database
        $modelPetugas->update($id, $data);

        return redirect()->to(base_url('/admin/petugas'));
    }

    public function hapusPetugas($PetugasID)
    {
        $modelPetugas = new ModelPetugas();

        // Hapus data buku dari database
        $modelPetugas->delete($PetugasID);

        return redirect()->to(base_url('/admin/petugas'));
    }

        public function savePetugas($data)
    {
        // Debug: Tampilkan data yang akan disimpan
        var_dump($data);

        // Lakukan penyimpanan data
        return $this->insert($data);
    }

	public function kategoriBuku(): string 
	{
        $modelKategori = new ModelKategori();
        $data['kategori'] = $modelKategori->findAll();

		return view('admin/tabelKategoriBuku', $data);
	}

    public function tambahKategori()
    {
        $modelKategori = new ModelKategori();

        $data = [
            'KategoriID' => $this->request->getPost('KategoriID'), 
            'NamaKategori' => $this->request->getPost('NamaKategori'),
        ];

        var_dump($this->request->getPost());

        // Simpan data kategori ke database
        $modelKategori->saveKategori($data);

        return redirect()->to(base_url('/admin/kategoriBuku'));

    }

    public function saveKategori($data)
    {
        // Debug: Tampilkan data yang akan disimpan
        var_dump($data);

        // Lakukan penyimpanan data
        return $this->insert($data);
    }

    public function hapusKategori($KategoriID)
    {
        $modelKategori = new ModelKategori();

        // Hapus data buku dari database
        $modelKategori->delete($KategoriID);

        return redirect()->to(base_url('/admin/kategoriBuku'));
    }

    public function editKategori($id)
    {
        $modelKategori = new ModelKategori();

        // Ambil data kategori dari form atau request
        $data = [
            'KategoriID' => $this->request->getPost('KategoriID'), 
            'NamaKategori' => $this->request->getPost('NamaKategori'),
        ];

        // Update data kategori di database
        $modelKategori->update($id, $data);

        return redirect()->to(base_url('/admin/kategoriBuku'));
    }

	public function tambahBuku() 
    {
        $modelBuku = new ModelBuku();

        // Ambil data buku dari form
        $data = [
            'Judul' => $this->request->getPost('judul-buku'),
            'Penulis' => $this->request->getPost('penulis-buku'),
            'Penerbit' => $this->request->getPost('penerbit-buku'),
            'TahunTerbit' => $this->request->getPost('tahun-terbit'),
            'CoverBuku' => $this->handleUpload(), // Panggil fungsi handleUpload
            'NamaKategori' => $this->request->getPost('nama-kategori'), 
            'SubKategori' => $this->request->getPost('sub-kategori'), 
        ];

        var_dump($this->request->getPost());

        // Simpan data buku ke database
        $modelBuku->saveBuku($data);

        return redirect()->to(base_url('/admin/daftarBuku'));
    }
    protected function handleUpload()
    {
        $coverBuku = $this->request->getFile('cover-buku');

        if ($coverBuku->isValid() && !$coverBuku->hasMoved()) {
            // Pindahkan file ke folder penyimpanan
            $newName = $coverBuku->getRandomName();
            $coverBuku->move(ROOTPATH . 'public/uploads', $newName);

            return $newName;
        } else {
            // File tidak valid, mungkin tindakan lain diperlukan
            return null;
        }
    }
    public function saveBuku($data)
	{
	    // Debug: Tampilkan data yang akan disimpan
	    var_dump($data);

	    // Lakukan penyimpanan data
	    return $this->insert($data);
	}

	public function editBuku($id)
    {
        $modelBuku = new ModelBuku();

        // Ambil data buku dari form atau request
        $data = [
            'Judul' => $this->request->getPost('judul-buku'),
            'Penulis' => $this->request->getPost('penulis-buku'),
            'Penerbit' => $this->request->getPost('penerbit-buku'),
            'TahunTerbit' => $this->request->getPost('tahun-terbit'),
            'NamaKategori' => $this->request->getPost('nama-kategori'), 
            'SubKategori' => $this->request->getPost('sub-kategori'), 
        ];

        // Update data buku di database
        $modelBuku->update($id, $data);

        return redirect()->to(base_url('/admin/daftarBuku'));
    }

    public function hapusBuku($BukuID)
    {
        $modelBuku = new ModelBuku();

        // Hapus data buku dari database
        $modelBuku->delete($BukuID);

        return redirect()->to(base_url('/admin/daftarBuku'));
    }

    public function editUser($id)
    {
        $modelUser = new ModelUser();

        // Ambil data buku dari form atau request
        $data = [
            'Username' => $this->request->getPost('Username'),
            'Email' => $this->request->getPost('Email'),
            'NamaLengkap' => $this->request->getPost('NamaLengkap'),
            'Alamat' => $this->request->getPost('Alamat'),
        ];

        // Update data buku di database
        $modelUser->update($id, $data);

        return redirect()->to(base_url('/admin/user'));
    }

    public function hapusUser($UserID)
    {
        $modelUser = new ModelUser();

        // Hapus data buku dari database
        $modelUser->delete($UserID);

        return redirect()->to(base_url('/admin/user'));
    }

}


 ?>