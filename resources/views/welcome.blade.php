<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
      
    </head>
    <body >
    <form   enctype="multipart/form-data"> 
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <input type="file" id="file" name="uploadedFile" onchange="fileInfo()"/>
        <div><label for="fileName">File Name : </label><span id="fileName" ></span></div>
        <div><label for="fileSize">File Size(in bytes) : </label><span id="fileSize" ></span></div>
        <div><label for="fileExtension">File Extension : </label><span id="fileExtension" ></span></div>
        <input type="submit" value="encrypt" id="fileEncrypt" /> 
        <input type="submit" value="decrypt" id="fileDecrypt" /> 
    </form>
    <input type="button" value="fff" onclick="download(fileName, 'img')" /> 
    </body>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
    <script>

        function fileInfo(){

            var fileName = document.getElementById('file').files[0].name;
            var FileSize = document.getElementById('file').files[0].size;
            var fileExtension = fileName.split('.').pop();

            document.getElementById('fileName').innerHTML  = fileName;
            document.getElementById('fileSize').innerHTML = FileSize;
            document.getElementById('fileExtension').innerHTML = fileExtension;  
   
        }


        // Function to download data to a file
        

  
    jQuery(document).ready(function(){
            jQuery('#fileEncrypt').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/fileEncryption') }}",
                  method: 'post',
                  data: {
                    uploadedFile: jQuery('#file').val(),
                    /* type: jQuery('#type').val(),
                     price: jQuery('#price').val()*/
                  },
                  success: function(result){
                  
        let element = document.createElement('a')
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(result.encrypted))
        element.setAttribute('download', result.encrypted)
        element.click()
  
                  }});
               });

               jQuery('#fileDecrypt').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/fileDecryption') }}",
                  method: 'post',
                  data: {
                    uploadedFile: jQuery('#file').val(),
                    /* type: jQuery('#type').val(),
                     price: jQuery('#price').val()*/
                  },
                  success: function(result){
                  
        let element = document.createElement('a')
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + decodeURIComponent(result.decrypted))
        element.setAttribute('download', result.decrypted)
        element.click()
  
                  }});
               });
            });
    

        

    </script>
</html>
