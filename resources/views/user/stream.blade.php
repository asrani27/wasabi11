<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stream NagaFile</title>
  <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />
  <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">

  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .video {
      width: 100%;
      height: 100%;
    }

    .vjs-text-track-display div {
      color: yellow !important;
    }

    .vjs-control-bar {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .vjs-custom-button {
      font-size: 14px;
      padding: 5px 10px;
      margin: 5px;
      background-color: white;
      color: black;
      border-radius: 5px;
      border: 1px solid black;
      cursor: pointer;
    }

    .vjs-custom-button:hover {
      background-color: white;
    }
  </style>
</head>

<body>
  <div class="container">
    <video id="my-video" class="video-js vjs-theme-fantasy video" controls preload="auto" width="640" height="360">
      <source src="{{$mp4TemporaryUrl}}" type="video/mp4" />
    </video>
  </div>

  <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>

  <script>
    const player = videojs('my-video', {
      controlBar: {
        skipButtons: { forward: 5, backward: 5 },
        playbackRateMenuButton: true
      },
      playbackRates: [0.5, 1, 1.5, 2, 3]
    });
    const videoKey = 'video-time-' + window.location.href;

    player.on('pause', function() {
    if (window.navigator.userAgent.includes("Chrome")) {
        player.play(); // Paksa play jika dipause oleh debug
        }
    });

    player.on('timeupdate', () => {
      localStorage.setItem(videoKey, player.currentTime());
    });

    player.ready(() => {
      const lastTime = localStorage.getItem(videoKey);
      if (lastTime) {
        player.one('play', () => player.currentTime(lastTime));
      }
    });

    player.on('ended', () => {
      localStorage.removeItem(videoKey);
      player.currentTime(0);
      location.reload();
    });

    document.addEventListener('keydown', (event) => {
      if (event.target.tagName !== 'INPUT' && event.target.tagName !== 'TEXTAREA') {
        if (event.key === ' ') {
          event.preventDefault();
          player.paused() ? player.play() : player.pause();
        } else if (event.key === 'ArrowRight') {
          player.currentTime(player.currentTime() + 5);
        } else if (event.key === 'ArrowLeft') {
          player.currentTime(player.currentTime() - 5);
        }
      }
    });

    player.ready(() => {
      const settings = player.textTrackSettings;
      settings.setValues({
        backgroundColor: "#000",
        backgroundOpacity: "0",
        edgeStyle: "uniform"
      });
      settings.updateDisplay();
    });
    
  </script>
</body>

</html>