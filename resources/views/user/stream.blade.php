<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stream NagaFile</title>
  <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet" />

  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      position: relative;
    }

    .video {
      width: 100%;
      height: 100%;
    }

    .vjs-text-track-display div {
      color: yellow !important;
    }

    /* Tombol kontrol */
    .controls {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: flex;
      gap: min(15vw, 50px);
      /* Responsif, maksimal 50px */
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
      pointer-events: none;
      max-width: 90vw;
    }

    .control-btn {
      font-size: min(8vw, 40px);
      color: white;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 50%;
      padding: min(3vw, 15px);
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: transform 0.2s ease;
    }

    .control-btn:active {
      transform: scale(1.2);
    }

    .show {
      opacity: 1;
      pointer-events: auto;
    }

    .fade-out {
      animation: fadeOut 1s forwards;
    }

    @keyframes fadeOut {
      0% {
        opacity: 1;
      }

      100% {
        opacity: 0;
        pointer-events: none;
      }
    }
  </style>

  <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

  <div class="container">
    <video id="my-video" class="video-js vjs-theme-fantasy video" controls preload="auto" width="640" height="360"
      data-setup="{}">
      <source src="{{$mp4TemporaryUrl}}" type="video/mp4" />
    </video>

    <!-- Tombol rewind, play/pause, forward -->
    <div id="controls" class="controls">
      <div id="rewindBtn" class="control-btn"><i class="fas fa-backward"></i></div>
      <div id="playPauseBtn" class="control-btn"><i class="fas fa-play"></i></div>
      <div id="forwardBtn" class="control-btn"><i class="fas fa-forward"></i></div>
    </div>
  </div>

  <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var player = videojs('my-video');
        var controls = document.getElementById('controls');
        var playPauseBtn = document.getElementById('playPauseBtn');
        var rewindBtn = document.getElementById('rewindBtn');
        var forwardBtn = document.getElementById('forwardBtn');
        var icon = playPauseBtn.querySelector('i');

        function getVideoKey() {
            return 'video-time-' + window.location.href;
        }

        // 🔥 Cek apakah perangkat adalah mobile
        function checkDevice() {
            if (window.innerWidth > 768) {
                rewindBtn.style.display = "none"; // Sembunyikan rewind di desktop
                forwardBtn.style.display = "none"; // Sembunyikan forward di desktop
            } else {
                rewindBtn.style.display = "flex"; // Tampilkan rewind di mobile
                forwardBtn.style.display = "flex"; // Tampilkan forward di mobile
            }
        }

        // Panggil saat halaman dimuat
        checkDevice();

        // Panggil ulang saat layar di-resize
        window.addEventListener('resize', checkDevice);

        // Simpan progress terakhir
        player.on('timeupdate', function () {
            localStorage.setItem(getVideoKey(), player.currentTime());
        });

        // Load progress terakhir
        player.ready(function () {
            const lastTime = localStorage.getItem(getVideoKey());
            if (lastTime) {
                player.one('play', function () {
                    player.currentTime(lastTime);
                });
            }
        });

        // Hapus progress jika video selesai
        player.on('ended', function () {
            localStorage.removeItem(getVideoKey());
            player.currentTime(0);
            location.reload();
        });

        // Fungsi Play/Pause
        function togglePlayPause() {
            if (player.paused()) {
                player.play();
                icon.classList.remove("fa-play");
                icon.classList.add("fa-pause");
                hideControlsAfterDelay(); // 🔥 Sembunyikan tombol setelah beberapa detik
            } else {
                player.pause();
                icon.classList.remove("fa-pause");
                icon.classList.add("fa-play");
                showControls(); // 🔥 Tetap tampil saat pause
            }
        }

        // Fungsi rewind (mundur 5 detik)
        function rewind() {
            player.currentTime(player.currentTime() - 5);
            showControls();
        }

        // Fungsi forward (maju 5 detik)
        function forward() {
            player.currentTime(player.currentTime() + 5);
            showControls();
        }

        // 🔥 Tampilkan tombol kontrol dan sembunyikan otomatis hanya saat play
        function showControls() {
            controls.classList.add('show');
            controls.classList.remove('fade-out');
        }

        function hideControlsAfterDelay() {
            setTimeout(() => {
                if (!player.paused()) { // 🔥 Hanya sembunyikan jika video sedang diputar
                    controls.classList.add('fade-out');
                }
            }, 700);
        }

        // Event Listener untuk tombol
        playPauseBtn.addEventListener('click', togglePlayPause);
        rewindBtn.addEventListener('click', rewind);
        forwardBtn.addEventListener('click', forward);

        // Klik di tengah video untuk play/pause
        player.el().addEventListener('click', function (event) {
            if (event.target.closest('.vjs-control-bar')) return;
            togglePlayPause();
        });

        // Tambahkan support sentuhan (smartphone)
        player.el().addEventListener('touchstart', function (event) {
            if (event.target.closest('.vjs-control-bar')) return;
            togglePlayPause();
        });

        // Kontrol menggunakan keyboard
        document.addEventListener('keydown', function (event) {
            if (event.target.tagName.toLowerCase() === 'input') return;
            if (event.key === 'ArrowRight') forward();
            if (event.key === 'ArrowLeft') rewind();
            if (event.key === ' ') {
                event.preventDefault();
                togglePlayPause();
            }
        });

        // Custom subtitle styling
        player.ready(function () {
            var settings = player.textTrackSettings;
            settings.setValues({
                "backgroundColor": "#000",
                "backgroundOpacity": "0",
                "edgeStyle": "uniform",
            });
            settings.updateDisplay();
        });

        // 🔥 Deteksi saat video dipause agar tombol tetap tampil
        player.on('pause', function () {
            showControls();
        });

        // 🔥 Sembunyikan tombol setelah delay hanya saat video diputar
        player.on('play', function () {
            hideControlsAfterDelay();
        });
    });
  </script>


</body>

</html>