<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VideoJS</title>
    
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />

  <style>
    .container{
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 0px;
    }
    .video{
        padding: 0px;
        width: 100%;
        height: 90%;
    }
  </style>
</head>
<body>
    
<div class="container">
    <video id="my-video" 
    class="video-js vjs-default-skin" 
    controls
    preload="auto"
    width="640" 
    height="360"
    data-setup="{}">
      
            <source src="/storage/stream/{{$data->short_file}}/{{$data->short_file}}.m3u8" type="application/x-mpegURL" />
    </video>
</div>

<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>


</body>
</html>