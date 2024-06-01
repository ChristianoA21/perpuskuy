<?php 

namespace App\Controllers;

use App\Models\ModelUser;
use App\Models\ModelBuku;
use App\Models\ModelPeminjaman;
use App\Models\ModelKategori;
use App\Models\ModelSubkategori;
use App\Models\ModelPengembalian;
use DateTime;

class Petugas extends BaseController
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
        $data['peminjaman'] = $modelUser->findAll();
        // $user = $modelUser->getUser()->getRow();
        // $userID = ($user) ? $user->UserID : null;

        $modelPeminjaman = new ModelPeminjaman();
        $data['peminjaman'] = $modelPeminjaman->getPeminjamanWithJudulandCoverBuku();


		return view('petugas/dashboard', $data);
	}

	public function daftarBuku(): string
	{
        $modelKategori = new ModelKategori();
        $data['namaKategori'] = $modelKategori->findAll();
        $data['kategori'] = $modelKategori->getKategori();

		$modelBuku = new ModelBuku();
        $data['buku'] = $modelBuku->findAll();

		return view('petugas/tabelDaftarBuku', $data);
	}

    public function peminjaman(): string
    {   
        $modelPeminjaman = new ModelPeminjaman();
       

        $semua_peminjam = $modelPeminjaman->getAllStatusDipinjam();

        $data = [
        'peminjaman' => $semua_peminjam,
        ];

        return view('petugas/tabelPeminjaman', $data);
    }

    public function pengembalian(): string
    {
        $modelPeminjaman = new ModelPeminjaman();
        $peminjamanID = $this->request->getPost('PeminjamanID');
        $userID = $this->request->getPost('UserID');
        
        // Peroleh data peminjaman berdasarkan PeminjamanID
        $peminjamanData = $modelPeminjaman->find($peminjamanID);
        
        // Ambil TanggalPengembalian dari data peminjaman
        $tanggalPengembalian = $peminjamanData['TanggalPengembalian'];

        $tanggalKembali = date('Y-m-d');
        $hariKeterlambatan = $this->hitungHariKeterlambatan($tanggalKembali, $tanggalPengembalian);
        $denda = $this->hitungDenda($hariKeterlambatan);

        $namaLengkap = $this->request->getPost('NamaLengkap');
        $email = $this->request->getPost('email');
        $bukuID = $this->request->getPost('BukuID');
        $total_pinjam = $this->request->getPost('TotalBuku');
        $uangDibayarkan = $this->request->getPost('UangDibayarkan');
        $uangKembalian = $this->request->getPost('UangKembalian');

        $total_keterlambatan = $hariKeterlambatan; // Jumlah hari keterlambatan
        $total_denda = $denda;

        $judul = $this->request->getPost('Judul');

        $modelPengembalian = new ModelPengembalian();

        // Data untuk disimpan ke dalam tabel pengembalian
        $data = [
            'PeminjamanID' => $peminjamanID,
            'TanggalKembali' => $tanggalKembali,
            'UserID' => $userID,
            'hariKeterlambatan' => $total_keterlambatan,
            'Denda' => $denda,
            'UangDibayarkan' => $uangDibayarkan,
            'UangKembalian' => $uangKembalian,
            'BukuID' => $bukuID,
        ];

        // Simpan data pengembalian
        $resultTambahPengembalian = $modelPengembalian->tambahPengembalian($data);

        if ($resultTambahPengembalian) {
            // Jika penyimpanan sukses, tambahkan status peminjaman
            $modelPeminjaman->tambahStatusPeminjaman($peminjamanID, 'kembali');
            
            // Data untuk struk
            $data_struk = [
                'TanggalPengembalian' => $tanggalKembali,
                'Judul' => $judul,
                'hari_keterlambatan' => $total_keterlambatan,
                'total_denda' => $total_denda,
                'UangDibayarkan' => $uangDibayarkan,
                'UangKembalian' => $uangKembalian,
                'email' => $email,
                'NamaLengkap' => $namaLengkap,
                'total_pinjam' => $total_pinjam,
            ];

            return view('print/cetakStrukPengembalian', $data_struk);
        } else {
            // Jika penyimpanan gagal, lakukan sesuatu (misalnya, redirect ke halaman error)
            return redirect()->to(base_url('/errorPage'));
        }
    }



    public function user(): string
    {
        $modelUser = new ModelUser();
        $data['user'] = $modelUser->findAll();

        return view('petugas/tabelUser', $data);
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

        return redirect()->to(base_url('/petugas/user'));
    }

    public function hapusUser($UserID)
    {
        $modelUser = new ModelUser();

        // Hapus data buku dari database
        $modelUser->delete($UserID);

        return redirect()->to(base_url('/petugas/user'));
    }

	public function kategoriBuku(): string 
	{
        $modelKategori = new ModelKategori();
        $data['kategori'] = $modelKategori->findAll();

		return view('petugas/tabelKategoriBuku', $data);
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

        return redirect()->to(base_url('/petugas/kategoriBuku'));

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

        return redirect()->to(base_url('/petugas/kategoriBuku'));
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

        return redirect()->to(base_url('/petugas/kategoriBuku'));
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
            'stok' => $this->request->getPost('stok'),
        ];

        var_dump($this->request->getPost());

        // Simpan data buku ke database
        $modelBuku->saveBuku($data);

        return redirect()->to(base_url('/petugas/daftarBuku'));
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
            'stok' => $this->request->getPost('stok'),
        ];

        // Update data buku di database
        $modelBuku->update($id, $data);

        return redirect()->to(base_url('/petugas/daftarBuku'));
    }

    public function hapusBuku($BukuID)
    {
        $modelBuku = new ModelBuku();

        // Hapus data buku dari database
        $modelBuku->delete($BukuID);

        return redirect()->to(base_url('/petugas/daftarBuku'));
    }

	function hitungDenda($hariKeterlambatan): int
    {
        // Denda per hari keterlambatan
        $dendaPerHari = 1000;

        // Pastikan tidak ada hari keterlambatan negatif
        $hariKeterlambatan = max(0, $hariKeterlambatan);

        // Hitung total denda
        $totalDenda = $hariKeterlambatan * $dendaPerHari;

        return $totalDenda;
    }


	 function hitungHariKeterlambatan($tanggalKembali, $tanggalPengembalian): int
    {
        $dateKembali = new DateTime($tanggalKembali);
        $datePengembalian = new DateTime($tanggalPengembalian);

        // Jika tanggal pengembalian lebih besar dari tanggal kembali,
        // maka hitung selisih harinya
        if ($datePengembalian > $dateKembali) {
            $diff = $dateKembali->diff($datePengembalian);
            return $diff->format('%a');
        }

        // Jika tanggal pengembalian lebih kecil atau sama dengan tanggal kembali,
        // maka hari keterlambatan adalah 0
        return 0;
    }

        public function viewStruk($peminjamanID)
        {
            $modelPeminjaman = new ModelPeminjaman();
            $modelPengembalian = new ModelPengembalian();
            $modelUser = new ModelUser(); 
            $modelBuku = new ModelBuku();

            // Get the peminjaman data
            $peminjamanData = $modelPeminjaman->find($peminjamanID);

            // Check if the peminjaman status is 'kembali'
            if ($peminjamanData['StatusPeminjaman'] == 'kembali') {
                // Get the pengembalian data
                $pengembalianData = $modelPengembalian->getPengembalianByPeminjamanID($peminjamanID)->getRow();

                if ($pengembalianData) {
                    // Get user data based on UserID
                    $userData = $modelUser->find($peminjamanData['UserID']);
                    $pengembalianData->NamaLengkap = $userData['NamaLengkap'];
                    $pengembalianData->email = $userData['Email'];

                    $bukuData = $modelBuku->find($peminjamanData['BukuID']);
                    $pengembalianData->Judul = $bukuData['Judul'];

                    $pengembalianData->TotalBuku =  $peminjamanData['TotalBuku'];




                    $data['pengembalian'] = $pengembalianData;

                    return view('print/cetakViewStrukPengembalian', $data);

                    // Pass other data to the view
                } else {
                    return redirect()->to(base_url('/errorPage'));
                }
            } else {
                return redirect()->to(base_url('/errorPage'));
            }
        }
}
 ?>