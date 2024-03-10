<?php

use Storage;

class FileUpload
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function upload(string $dir, string $fileName) {
        $result = Storage::disk('sftp')->putFileAs($dir, $this->file, $fileName);
        $URL = 'https://' . env('SFTP_HOST') . '/' . Storage::disk('sftp')->url($result);    
        return $URL;
    }
}
