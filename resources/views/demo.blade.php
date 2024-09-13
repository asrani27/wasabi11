<!DOCTYPE html>
<!-- saved from url=(0067)https://www.jqueryscript.net/demo/jQuery-AJAX-File-Uploader-FileUp/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>jQuery FileUp Demos</title>
<link rel="stylesheet" href="/fileup/bootstrap.min.css">
<link href="/fileup/jquery.growl.css" rel="stylesheet" type="text/css">
<link href="/fileup/fileup.css" rel="stylesheet" type="text/css">
<style>
body { background-color:#fafafa; font-family:'Roboto';}
h2 { margin:20px auto;}
.container { margin:50px auto;}
.dropzone {
    background-color: #ccc;
    border: 3px dashed #888;
    width: 350px;
    height: 150px;
    border-radius: 25px;
    font-size: 20px;
    color: #777;
    padding-top: 50px;
    text-align: center;
}
.dropzone.over {
    opacity: .7;
    border-style: solid;
}
#dropzone .dropzone {
    margin-top: 25px;
    padding-top: 60px;
}
</style>
</head>

<body>
<div class="container">
<h1>jQuery FileUp Demos</h1>
  <button type="button" class="btn btn-success fileup-btn">
  Select file
  <input type="file" id="upload-1">
  </button>
  <div id="upload-1-queue" class="queue"></div>
  
    
</div>
<script src="/fileup/jquery-1.12.4.min.js"></script> 
<script src="/fileup/bootstrap.min.js"></script> 
<script src="/fileup/jquery.growl.js"></script> 
<script src="/fileup/fileup.js"></script> 
<script>
        $.fileup({
            url: 'example.com/your/path?file_upload=1',
            inputID: 'upload-1',
            queueID: 'upload-1-queue',
            onSuccess: function(response, file_number, file) {
                $.growl.notice({ title: "Upload success!", message: file.name });
            },
            onError: function(event, file, file_number) {
                $.growl.error({ message: "Upload error!" });
            }
        });	
</script>
</body>
</html>