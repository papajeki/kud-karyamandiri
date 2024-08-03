<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Files\File;

class FileController extends Controller {
    public function download($filename) {
        $filePath = WRITEPATH . 'uploads/berkas/' . $filename;

        // Debugging log
        log_message('debug', 'Trying to download file: ' . $filePath);

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
