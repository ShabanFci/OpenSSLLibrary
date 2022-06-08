<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class FileController extends Controller
{
    public function fileEncryption(request $request)
    {

       $fileName = $request->uploadedFile;
       
        
        $encrypted =  Crypt::encryptString($fileName);
     
        
    return response()->json([
        'encrypted' => $encrypted
       
    ]);
    }
     
    public function fileDecryption(request $request)
    {

       $fileName = $request->uploadedFile;

        try {
        $decrypted = Crypt::decryptString($fileName);
    } catch (DecryptException $e) {
      return false;
    }
    return response()->json([
        'decrypted' => $decrypted ,
        'fileName' =>$fileName
       
    ]);
    }

   
}
