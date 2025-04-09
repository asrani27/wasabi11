<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Video Player</title>

    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.css" />
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
            background: #000000;
        }

        body {
            background-color: transparent;

            font-family: 'Rubik', sans-serif;

        }
    </style>
</head>

<body>

    <video id="player" controls></video>

    <!-- Plyr JS -->
    <script src="https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.polyfilled.min.js"></script>

    <!-- HLS.js -->
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
      const video = document.getElementById('player');
      const videoSrc = "{{ asset('storage/suro/outputsatusuroo.m3u8') }}"; // path file m3u8 kamu

      // Cek apakah browser support HLS.js
      if (Hls.isSupported()) {
        const hls = new Hls();
        hls.loadSource(videoSrc);
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED, function () {
          video.play();
        });
      } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        // Untuk Safari / iOS
        video.src = videoSrc;
        video.addEventListener('loadedmetadata', function () {
          video.play();
        });
      }

      // Inisialisasi Plyr
      const player = new Plyr(video);
    });
    </script>

</body>

</html>