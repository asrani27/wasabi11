<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video.js with Custom Overlay Ads Example</title>
  <link href="https://vjs.zencdn.net/8.0.0/video-js.css" rel="stylesheet">
  <style>
    .ad-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      color: white;
      display: none;
      justify-content: center;
      align-items: center;
      font-size: 24px;
    }
    .skip-button {
      position: absolute;
      bottom: 20px;
      right: 20px;
      background: rgba(0, 0, 0, 0.7);
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      z-index: 20;
      display: none; /* Initially hidden */
    }

    .countdown {
        
      position: absolute;
      bottom: 20px;
      right: 20px;
      background: rgba(0, 0, 0, 0.7);
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      z-index: 20;
      
    }
  </style>
</head>
<body>

  <video
    id="my-video"
    class="video-js vjs-big-play-centered"
    controls
    preload="auto"
    width="640"
    height="264"
    poster="https://vjs.zencdn.net/v/oceans.png"
    data-setup="{}">
    <source src="https://vjs.zencdn.net/v/oceans.mp4" type="video/mp4">
    <source src="https://vjs.zencdn.net/v/oceans.webm" type="video/webm">
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
  </video>

  <div id="ad-overlay" class="ad-overlay"><a href="http://veenix.online" target="_blank">Your Ad Here</a>

    <div id="countdown" class="countdown"></div>
    <button id="skip-button" class="skip-button">Skip Ad</button>
</div>

  <script src="https://vjs.zencdn.net/8.0.0/video.min.js"></script>
  <script>
    var player = videojs('my-video');
    var adOverlay = document.getElementById('ad-overlay');
    var skipButton = document.getElementById('skip-button');
    var countdown = document.getElementById('countdown');
    var adUrl = 'https://www.cpmrevenuegate.com/bq5r5uxdas?key=ad0d6295c26f7e6b4132733881bc9dee';

    
     // Menunda pemutaran video sampai iklan selesai
     player.one('play', function() {
      adOverlay.style.display = 'flex'; // Menampilkan iklan
      player.pause(); // Menghentikan pemutaran video

      // Membuka URL iklan di tab baru
      window.open(adUrl, '_blank');

      var adDuration = 15000; // Durasi iklan dalam milidetik
      var skipTime = 5000; // Waktu mundur untuk tombol skip dalam milidetik (misalnya, tombol bisa diklik setelah 3 detik)

      // Menghitung waktu mundur
      var remainingTime = skipTime / 1000; // Mengubah waktu skip dari milidetik ke detik

      // Menampilkan waktu mundur dan menyembunyikan tombol skip
      countdown.textContent = 'Skip in ' + remainingTime + 's'; // Menampilkan waktu mundur
      skipButton.style.display = 'none'; // Menyembunyikan tombol skip

      // Mengatur interval untuk waktu mundur
      var countdownInterval = setInterval(function() {
        remainingTime -= 1; // Kurangi waktu mundur setiap detik
        countdown.textContent = 'Skip in ' + remainingTime + 's'; // Update waktu mundur

        // Menampilkan tombol skip setelah waktu mundur berakhir
        if (remainingTime <= 0) {
          clearInterval(countdownInterval); // Hentikan interval
          skipButton.style.display = 'block'; // Menampilkan tombol skip
          countdown.textContent = ''; // Menghapus teks countdown
        }
      }, 1000);

      // Mengatur timer untuk menyembunyikan iklan dan melanjutkan video
      setTimeout(function() {
        adOverlay.style.display = 'none'; // Menyembunyikan iklan setelah 5 detik
        player.play(); // Melanjutkan pemutaran video setelah iklan selesai
      }, adDuration); // Durasi iklan
    });

    // Menangani klik pada tombol skip
    skipButton.addEventListener('click', function() {
      adOverlay.style.display = 'none'; // Menyembunyikan iklan
      player.play(); // Melanjutkan pemutaran video
    });
    // Event listener untuk video berakhir
    player.on('ended', function() {
      console.log('The video has ended.');
    });
  </script>

</body>
</html>
