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
        height: 100%;
    }
    /* Custom styling for Video.js subtitles */
    .vjs-text-track-display div {
      color: yellow !important; /* Ubah warna teks subtitle */
    }
  </style>
  
</head>
<body style="margin:0px">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<div class="container">
    <video id="my-video" 
    class="video-js vjs-default-skin video yellow" 
    controls
    preload="auto"
    width="640" 
    height="360"
    data-setup="{}">
            {{-- <source src="{{$public}}" type="application/x-mpegURL" />       --}}
            <source src="http://localhost:8000/storage/stream/{{$data->short_file}}/{{$data->short_file}}_0_{{$data->resolusi}}.m3u8" type="application/x-mpegURL" />
            <track kind="captions" src="/srt/deadpool.vtt" srclang="id" label="Indonesia" default>
    </video>
</div>

<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-ads/7.5.2/videojs.ads.js" integrity="sha512-M/pHAt5s4Eq/RURcqkUTvoyU8EdtL1mQBdzePGQM03shlMWJpBLNHmzaWaYGLZjJhAl0/C6jYFgf8ncNr2802A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
    var player = videojs('my-video');
    var adUrl = 'https://www.cpmrevenuegate.com/bq5r5uxdas?key=ad0d6295c26f7e6b4132733881bc9dee';

    player.one('play', function() {
        window.open(adUrl,'_blank');
        window.focus();
    });
    // Tambahkan event listener untuk mendeteksi tombol ditekan
    document.addEventListener('keydown', function(event) {
        // Dapatkan kode tombol yang ditekan
        var key = event.key;

        // Jika tombol panah kanan ditekan, skip forward 5 detik
        if (key === 'ArrowRight') {
            var currentTime = player.currentTime();
            player.currentTime(currentTime + 5);
        }

        // Jika tombol panah kiri ditekan, skip backward 5 detik
        if (key === 'ArrowLeft') {
            var currentTime = player.currentTime();
            player.currentTime(currentTime - 5);
        }
    });
    
    player.on('ended', function() {
        player.currentTime(0);
        location.reload();
      console.log('The video has ended.');
    });
</script>

<script>
let textcolor = videojs('my-video');
    textcolor.ready(function(){
        var settings = this.textTrackSettings;
        settings.setValues({
            "backgroundColor": "#000",
            "backgroundOpacity": "0",
            "edgeStyle": "uniform",
        });
        settings.updateDisplay();
    });
</script>
<script>
    function togglePlayPause(){
    var player = videojs('my-video');
        if (player.paused()) {
            player.play();
        } else {
            player.pause();
        }
    }
    

$(function() {
  const videoContainer = document; // replace this with just immediate container of video player
  $(videoContainer).on('keypress', function() {
    const keyCode = event.keyCode || event.which;
    if (keyCode == 32) {
      // targetting all buttons, change with class if you want
      if (event.target.type === 'button') {
        event.target.blur();
        event.preventDefault();
      }
      togglePlayPause();
    }
  });      
});
</script>
</body>
</html>