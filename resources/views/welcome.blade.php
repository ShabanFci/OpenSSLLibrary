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
    <form action="{{route('fileEncryption')}}" method="post" enctype="multipart/form-data"> 
    {{ csrf_field() }}   
        <input type="file" id="file" name="uploadedFile" onchange="fileInfo()"/>
        <div><label for="fileName">File Name : </label><span id="fileName" ></span></div>
        <div><label for="fileSize">File Size(in bytes) : </label><span id="fileSize" ></span></div>
        <div><label for="fileExtension">File Extension : </label><span id="fileExtension" ></span></div>
        <input type="submit" value="encrypt" /> 
    </form>
    <input type="button" value="fff" onclick="download(fileName, 'img')" /> 
    </body>

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
        function download(filename, text){
        let element = document.createElement('a')
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text))
        element.setAttribute('download', filename)
        element.click()
    }

    download("hello.txt","This is the content")


    fetch('/fileEncryption', {
    method: 'POST', 
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'url': '/fileEncryption',
        "X-CSRF-Token": document.querySelector('input[name=_token]').value
    },
})

    </script>
</html>
