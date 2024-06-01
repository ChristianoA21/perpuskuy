<?php 

namespace App\Controllers;
use Dompdf\Dompdf;
use App\Models\ModelUser;
use App\Models\ModelBuku;
use App\Models\ModelPeminjaman;
use App\Models\ModelPetugas;

/**
 * 
 */
class PdfController extends BaseController
{
	
    public function generate()
    {
    	$modelBuku = new ModelBuku();
        $data['buku'] = $modelBuku->findAll();

        $modelUser = new ModelUser();
        $data['user'] = $modelUser->findAll();

        $modelPeminjaman = new ModelPeminjaman();
        $data['peminjaman'] = $modelPeminjaman->findAll();

        $modelPetugas = new ModelPetugas;
        $data['petugas'] = $modelPetugas->findAll();

        $filename = 'Perpuskuy-Laporan-Admin-'. date('y-m-d-H-i-s');

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('admin/view_pdf', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }

    public function petugas()
    {
        $modelBuku = new ModelBuku();
        $data['buku'] = $modelBuku->findAll();

        $modelUser = new ModelUser();
        $data['user'] = $modelUser->findAll();

        $modelPeminjaman = new ModelPeminjaman();
        $data['peminjaman'] = $modelPeminjaman->findAll();

        $filename = 'Perpuskuy-Laporan-Petugas-'. date('y-m-d-H-i-s');

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('petugas/view_pdf', $data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}

 ?>