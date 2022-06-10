<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class FileController extends Controller
{
    public function fileEncryption(Request $request)
    {
        $fileName = $request->file('uploadedFile');
        $encryptedFile = Crypt::encryptString($fileName->getContent());
        return response()->json([
           'encryptedFile' => $encryptedFile
        ]);
    }
     
    public function fileDecryption(Request $request)
    {
        $fileName = $request->file('uploadedFile');
        try {
            $decryptedFile = Crypt::decryptString($fileName->getContent());
        } catch (DecryptException $e) {
            return false;
        }
    
        return response()->json([
            'decryptedFile' => $decryptedFile
        ]); 
    }

   
}
