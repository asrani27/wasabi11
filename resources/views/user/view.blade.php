<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VideoJS</title>

  <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
</head>
<body>
    
  <video
  id="my-video"
  class="video-js"
  controls
  preload="auto"
  width="640"
  height="264"
  poster="MY_VIDEO_POSTER.jpg"
  data-setup="{}"
>
  <source src="/storage/stream/{{$data->short_file}}/{{$data->short_file}}.m3u8" type="application/x-mpegURL" />
</video>

<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
</body>
</html>