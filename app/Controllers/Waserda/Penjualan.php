<?php

namespace App\Controllers\Waserda;


use App\Models\ItemTerjualModel;
use App\Models\BarangModel;
use App\Controllers\BaseController;
use App\Models\StokModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penjualan extends BaseController
{
    public function index()
    {
        $data = [];

        // Handle the sales report form submission
        if ($this->request->getMethod() === 'post') {
            $startDate = $this->request->getPost('start_date');
            $endDate = $this->request->getPost('end_date');

            $itemTerjualModel = new ItemTerjualModel();
            $barangModel = new BarangModel();

            // Fetch and aggregate data within the specified time span
            $items = $itemTerjualModel->select('id_barang, SUM(jumlah) as total_jumlah, SUM(harga * jumlah) as total_earnings')
                                      ->where('tanggal >=', $startDate)
                                      ->where('tanggal <=', $endDate)
                                      ->groupBy('id_barang')
                                      ->findAll();

            // Get product details
            foreach ($items as &$item) {
                $barang = $barangModel->find($item['id_barang']);
                $item['nama_barang'] = $barang['nama_barang'];
            }

            $data['salesReport'] = $items;
            $data['start_date'] = $startDate;
            $data['end_date'] = $endDate;
        }

        return view('waserda/report', $data);
    }

    public function laba()
    {
        $stokmodel = new StokModel();
        
        // Ambil bulan dan tahun dari request
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
    
        // Buat query dasar
        $labaQuery = $stokmodel->select('stok.id_stok, barang.nama_barang, stok.kuantitas as total_kuantitas, stok.harga_beli, (stok.kuantitas * stok.harga_beli) as total_modal, SUM(item_terjual.jumlah) as total_terjual, item_terjual.harga as harga_jual, SUM(item_terjual.jumlah * item_terjual.harga) as total_pendapatan, (SUM(item_terjual.jumlah * item_terjual.harga) - (stok.terjual * stok.harga_beli)) as total_keuntungan')
                                ->join('item_terjual', 'item_terjual.id_stok = stok.id_stok')
                                ->join('barang', 'barang.id_barang = stok.id_barang');
    
        // Tambahkan filter jika bulan dan tahun ada
        if ($bulan && $tahun) {
            $labaQuery->where('MONTH(item_terjual.tanggal)', $bulan)
                       ->where('YEAR(item_terjual.tanggal)', $tahun);
        }
    
        // Kelompokkan hasil
        $laba = $labaQuery->groupBy('stok.id_stok, stok.kuantitas, stok.harga_beli, item_terjual.harga')->findAll();
    
        $data['laba'] = $laba;
        return view('waserda/laba', $data);
    }
    
    public function exportExcel()
    {
        $stokmodel = new StokModel();

        // Ambil bulan dan tahun dari request
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        // Query dasar
        $labaQuery = $stokmodel->select('stok.id_stok, barang.nama_barang, stok.kuantitas as total_kuantitas, stok.harga_beli, (stok.kuantitas * stok.harga_beli) as total_modal, SUM(item_terjual.jumlah) as total_terjual, item_terjual.harga as harga_jual, SUM(item_terjual.jumlah * item_terjual.harga) as total_pendapatan, (SUM(item_terjual.jumlah * item_terjual.harga) - (stok.terjual * stok.harga_beli)) as total_keuntungan')
                            ->join('item_terjual', 'item_terjual.id_stok = stok.id_stok')
                            ->join('barang', 'barang.id_barang = stok.id_barang');

        // Tambahkan filter jika bulan dan tahun ada
        if ($bulan && $tahun) {
            $labaQuery->where('MONTH(item_terjual.tanggal_terjual)', $bulan)
                       ->where('YEAR(item_terjual.tanggal_terjual)', $tahun);
        }

        // Kelompokkan hasil
        $laba = $labaQuery->groupBy('stok.id_stok, stok.kuantitas, stok.harga_beli, item_terjual.harga')->findAll();

        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Stok');
        $sheet->setCellValue('C1', 'Nama Barang');
        $sheet->setCellValue('D1', 'Kuantitas');
        $sheet->setCellValue('E1', 'Harga Beli');
        $sheet->setCellValue('F1', 'Total Modal');
        $sheet->setCellValue('G1', 'Terjual');
        $sheet->setCellValue('H1', 'Harga Jual');
        $sheet->setCellValue('I1', 'Pendapatan');
        $sheet->setCellValue('J1', 'Keuntungan');

        // Isi Data
        $rowNumber = 2;
        foreach ($laba as $index => $row) {
            $sheet->setCellValue('A' . $rowNumber, $index + 1);
            $sheet->setCellValue('B' . $rowNumber, $row['id_stok']);
            $sheet->setCellValue('C' . $rowNumber, $row['nama_barang']);
            $sheet->setCellValue('D' . $rowNumber, $row['total_kuantitas']);
            $sheet->setCellValue('E' . $rowNumber, number_format($row['harga_beli'], 2, ',', '.'));
            $sheet->setCellValue('F' . $rowNumber, number_format($row['total_modal'], 2, ',', '.'));
            $sheet->setCellValue('G' . $rowNumber, $row['total_terjual']);
            $sheet->setCellValue('H' . $rowNumber, number_format($row['harga_jual'], 2, ',', '.'));
            $sheet->setCellValue('I' . $rowNumber, number_format($row['total_pendapatan'], 2, ',', '.'));
            $sheet->setCellValue('J' . $rowNumber, number_format($row['total_keuntungan'], 2, ',', '.'));
            $rowNumber++;
        }

        // Buat writer dan simpan file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan_Laba_' . date('YmdHis') . '.xlsx';
        $filePath = WRITEPATH . 'uploads/' . $fileName;

        $writer->save($filePath);

        // Kirim file sebagai respons
        return $this->response->download($filePath, null)->setFileName($fileName);
    }   
}
