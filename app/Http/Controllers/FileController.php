<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class FileController extends Controller
{
    public function fileEncryption(request $request)
    {

       $fileName = $request->uploadedFile->getClientOriginalName();
       
        
        $encrypted =  Crypt::encryptString($fileName);
       // return $this->storeFile();
        try {
        $decrypted = Crypt::decryptString($encrypted);
    } catch (DecryptException $e) {
        //
    }
    return response()->json([
        'encrypted' => $encrypted ,
       // 'decrypted'=> $decrypted
    ]);
    }

    function storeFile($selectedFile, $location)
    {
        $ext    = $selectedFile->getClientOriginalExtension();
        $file   = date('YmdHis') . rand(1, 99999) . '.' . $ext;
       // $selectedFile->storeAs($location, $file);
        //$location = str_replace('public', 'storage', $location);
        return $file;
    }
}
