<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function upload(string $dir, string $fileName)
    {
        $result = Storage::disk('azure')->putFileAs($dir, $this->file, $fileName);
        $URL = Storage::disk('azure')->url($result);
        return $URL;
    }
}
