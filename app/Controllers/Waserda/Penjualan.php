<?php

namespace App\Controllers\Waserda;

use App\Models\ItemTerjualModel;
use App\Models\BarangModel;
use App\Controllers\BaseController;

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
}
