<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VideoJS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-hls-quality-selector@2.0.0/dist/videojs-hls-quality-selector.min.css">
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
        
   
  {{-- <source src="https://vjs.zencdn.net/v/oceans.mp4?sd" type='video/mp4' label='SD' res='480' />
  <source src="https://vjs.zencdn.net/v/oceans.mp4?hd" type='video/mp4' label='HD' res='1080'/>
  <source src="https://vjs.zencdn.net/v/oceans.mp4?phone" type='video/mp4' label='phone' res='144'/>
  <source src="https://vjs.zencdn.net/v/oceans.mp4?4k" type='video/mp4' label='4k' res='2160'/> --}}
        <source src="https://bitdash-a.akamaihd.net/content/MI201109210084_1/m3u8s/f08e80da-bf1d-4e3d-8899-f0f6155f6efa.m3u8" type="application/x-mpegURL" />
      
            {{-- <source src="/storage/stream/{{$data->short_file}}/{{$data->short_file}}.m3u8" type="application/x-mpegURL" /> --}}
    </video>
</div>

<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-quality-levels/4.1.0/videojs-contrib-quality-levels.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/videojs-hls-quality-selector@2.0.0/dist/videojs-hls-quality-selector.min.js"></script>
<script>

var player = videojs('my-video');

player.hlsQualitySelector();
</script>



</body>
</html>