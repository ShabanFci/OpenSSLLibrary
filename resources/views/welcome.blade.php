<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OpenSSLLibrary</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">   
    </head>
    <body >
        <form id="file-upload-form" class="uploader" enctype="multipart/form-data">
            <meta name="csrf-token" content="{{ csrf_token() }}"> 
            <h3>OpenSSLLibrary Encryption/Decryption</h3>
            <input id="uploadedFile" type="file" name="fileUpload"  onchange="fileInfo()" />
            <label for="uploadedFile" id="file-drag">
                <div id="start">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <div>Select a file</div>
                    <span id="uploadedFile-btn" class="btn btn-primary">Select a file</span>
                    <label for="fileName">File Name : <span id="fileName" ></span></label>
                    <label for="fileSize">File Size(in bytes) :<span id="fileSize" ></span> </label>
                    <label for="fileExtension">File Extension : <span id="fileExtension" ></span></label>
                </div>
            </label>
            <input class="btn btn-primary" type="submit" value="encrypt" id="fileEncrypt" /> 
            <input class="btn btn-primary" type="submit" value="decrypt" id="fileDecrypt" /> 
        </form>   
    </body>


    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        // Getting The Uploaded File Info
        function fileInfo(){
            var fileName = document.getElementById('uploadedFile').files[0].name;
            var FileSize = document.getElementById('uploadedFile').files[0].size;
            var fileExtension = fileName.split('.').pop();
            document.getElementById('fileName').innerHTML  = fileName;
            document.getElementById('fileSize').innerHTML = FileSize;
            document.getElementById('fileExtension').innerHTML = fileExtension;  
   
        }
        
        jQuery(document).ready(function(){
            // file Encrypt Action
            jQuery('#fileEncrypt').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                var uploadedFile  = $('#uploadedFile').prop('files')[0];
                var form_data = new FormData();
                form_data.append('uploadedFile', uploadedFile);
                $.ajax({
                    url: "{{url('fileEncryption')}}",
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(data){
            
                    let element = document.createElement('a')
                    element.setAttribute('href', 'data:file;charset=utf-8,' + encodeURIComponent(data.encryptedFile))
                    element.setAttribute('download', 'untitled')
                    element.click()
                }});
            });

            // file Decrypt Action
            jQuery('#fileDecrypt').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
    
                var uploadedFile  = $('#uploadedFile').prop('files')[0];
                var form_data = new FormData();
                form_data.append('uploadedFile', uploadedFile);
               $.ajax({
                    url: "{{url('fileDecryption')}}",
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(data){                  
                        let element = document.createElement('a')
                        element.setAttribute('href', 'data:file;charset=utf-8,' + encodeURIComponent(data.decryptedFile))
                        element.setAttribute('download', 'untitled')
                        element.click()
  
                    }});
                });
            });
    </script>
</html>
