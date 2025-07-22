<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="robots" content="noindex" />
  <META NAME="GOOGLEBOT" CONTENT="NOINDEX" />
  <title>Veenix Player</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link href="/plyr/rubik.css" rel="stylesheet">
  <script src="/plyr/plyr.polyfilled.min.js"></script>
  <script src="/plyr/jquery-3.7.1.min.js" type="text/javascript"></script>
  <link href="/plyr/plyr.css" rel="stylesheet">
  <script src="/plyr/pb.js?v=1"></script>
  <link href="/plyr/pb.css?v=1" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
  <meta name="description" content="" />
  <style>
    * {
      user-select: none;
      /* supported by Chrome and Opera */
      -webkit-user-select: none;
      /* Safari */
      -khtml-user-select: none;
      /* Konqueror HTML */
      -moz-user-select: none;
      /* Firefox */
      -ms-user-select: none;
      /* Internet Explorer/Edge */
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    :root {
      --plyr-color-main: #ff7755;
      --plyr-video-background: transparent;
      --plyr-captions-background: black;
      --plyr-captions-text-color: white;
      --plyr-font-weight-regular: 600;
      --plyr-font-weight-bold: 600;

      --plyr-font-family: 'Rubik';

      --webkit-text-track-display: none;
      --plyr-font-size-xlarge: 30px;
    }

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

    .container {
      width: 100%;
      height: 100%;
    }

    video {
      width: 100%;
      height: 100%;
    }

    .plyr__poster {
      background-size: cover;
    }

    .plyr__control--overlaid {
      background: #ff7755;
      box-shadow: #4a4a4a20 0 0 27px;
    }

    .plyr--video {
      height: 100%;
    }

    .plyr--video .plyr__control.plyr__tab-focus,
    .plyr--video .plyr__control:hover,
    .plyr--video .plyr__control[aria-expanded=true] {
      background: #ff7755;
    }

    .plyr__control.plyr__tab-focus {
      box-shadow: 0 0 0 5px rgba(255, 0, 0, .5);
    }

    .plyr__menu__container .plyr__control[role=menuitemradio][aria-checked=true]::before {
      background: #ff7755;
    }

    [data-plyr="captions"].plyr__control {
      border-bottom: solid 3px transparent;
    }

    [data-plyr="captions"].plyr__control--pressed {
      border-bottom: solid 3px #ff7755;
    }

    .plyr__captions {
      font-size: 20px;
    }

    @media (max-width: 479px) {
      .plyr__captions {
        font-size: 18px;
      }
    }

    @media (min-width: 480px) {
      .plyr__captions {
        font-size: 18px;
      }
    }

    @media (min-width: 768px) {
      .plyr__captions {
        font-size: 23px;
      }
    }

    @media (min-width: 1024px) {
      .plyr__captions {
        font-size: 26px;
      }
    }

    .plyr__progress input {
      border-radius: 0px !important;
      -webkit-appearance: none;
      background: transparent;
    }

    .plyr__progress input[value]::-webkit-progress-bar {
      border-radius: 0px !important;
    }

    .plyr__progress input[value]::-webkit-progress-value {
      border-radius: 0px !important;
    }

    .plyr audio,
    .plyr iframe,
    .plyr video {
      max-height: 100vh;
    }

    .plyr__spacer {
      width: 100%;
    }

    .plyr__progress__container {
      position: absolute;
      top: 14px;
      left: 10px;
      width: calc(100% - 24px);
    }

    @media (max-width: 480px) {
      .plyr__progress__container {
        top: -5px;
      }
    }

    .wt-chart-active .ct-series-a .ct-area,
    .ct-series-a .ct-slice-donut-solid,
    .ct-series-a .ct-slice-pie {
      fill: url(#gradient-active);
    }

    .ct-series-a .ct-area,
    .ct-series-a .ct-slice-donut-solid,
    .ct-series-a .ct-slice-pie {
      fill: url(#gradient-a);
    }

    .ct-series-a .ct-bar,
    .ct-series-a .ct-line,
    .ct-series-a .ct-point,
    .ct-series-a .ct-slice-donut {
      stroke: #ff7755;
    }

    .plyr__pb {
      position: absolute;
      top: 0px;
      left: 0px;
      width: 100%;
      z-index: 3;
      margin-left: calc(var(--plyr-range-thumb-height, 13px)*-.5);
      margin-right: -6.5px;
      margin-right: calc(var(--plyr-range-thumb-height, 13px)*-.5);
      width: calc(100% + 13px);
      width: calc(100% + var(--plyr-range-thumb-height, 13px));
    }

    .plyr__preview-thumb {
      bottom: 22px;
      transition: bottom ease 0.1s;
    }

    .plyr__controls {
      padding-top: 70px;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-webkit-slider-runnable-track {
      background-color: transparent !important;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-moz-range-track {
      background-color: transparent !important;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-ms-track {
      background-color: transparent !important;
    }

    .plyr__progress input {
      background-color: transparent !important;
      color: transparent !important;
      top: -6px !important;
      z-index: 7 !important;
      cursor: pointer;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-webkit-slider-thumb {
      opacity: 0;
      transition: opacity ease 0.1s;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-moz-range-thumb {
      opacity: 0;
      transition: opacity ease 0.1s;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]::-ms-thumb {
      opacity: 0;
      transition: opacity ease 0.1s;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]:active::-webkit-slider-thumb {
      opacity: 1;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]:active::-moz-range-thumb {
      opacity: 1;
    }

    .plyr--full-ui.plyr--video .plyr__progress input[type=range]:active::-ms-thumb {
      opacity: 1;
    }

    .plyr__menu__container {
      z-index: 10;
    }

    @media (min-width: 1280px) {
      .plyr--full-ui.plyr--video .plyr__control--overlaid {
        width: 60px;
        height: 60px;
      }

      .plyr__control svg {
        height: 21px;
        width: 21px;
      }
    }

    .plyr__control--overlaid svg {
      margin-left: auto;
      margin-right: auto;
    }

    .plyr__control--logo {
      height: auto;
      max-height: 23.5px;
      position: absolute;
      left: 44%;
      top: 37px;
      margin-left: -50px;
    }

    .plyr__tooltip--drag {
      opacity: 1;
      transform: translate(-50%) scale(1);
    }

    .plyr__controls__item[data-plyr="rewind"],
    .plyr__controls__item[data-plyr="fast-forward"] {
      padding: 4px;
    }

    .plyr__controls__item[data-plyr="rewind"] svg,
    .plyr__controls__item[data-plyr="fast-forward"] svg {
      height: 24px;
      height: var(--plyr-control-icon-size, 24px);
      pointer-events: none;
      width: 24px;
      width: var(--plyr-control-icon-size, 24px);
    }

    .plyr--full-ui ::-webkit-media-text-track-container {
      display: var(--webkit-text-track-display);
    }

    .disable-poster-transition .plyr__poster {
      transition: none;
    }

    /*workaround to fix safari bug with not showing video thumbnail:*/
    .plyr__video-wrapper {
      z-index: 0;
    }

    /* fix for vertical subtitles scrolling */
    .plyr__menu__container>div {
      max-height: 50vh;
      overflow-y: auto;
    }

    /* Fix for controls overlapping on small devices */
    @media only screen and (max-width: 500px) {
      .hide_mobile.plyr__spacer {
        display: none
      }
    }

    .plyr--is-ios .plyr__volume {
      min-width: 32px;
    }

    /* Chromecast */
    .chromecast-connected {

      opacity: 1;
    }

    .chromecast-disconnected {
      opacity: 0.5;
    }

    .error-message {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: rgba(0, 0, 0, 0.5);
      text-align: center;
      color: #ccc;
      padding-top: 50px;
    }
  </style>
  <style>
    /* Efek loading */
    .loading-spinner {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 50px;
      height: 50px;
      border: 5px solid rgba(255, 255, 255, 0.2);
      border-top: 5px solid #ffffff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      z-index: 10;
    }

    @keyframes spin {
      0% {
        transform: translate(-50%, -50%) rotate(0deg);
      }

      100% {
        transform: translate(-50%, -50%) rotate(360deg);
      }
    }

    /* Sembunyikan loading saat video selesai dimuat */
    .hidden {
      display: none;
    }
  </style>
</head>

<body id="body">
  <div class="container" id="video-container">
    <div id="loading-spinner" class="loading-spinner"></div>
    <video id="main-video" preload="auto" crossorigin="anonymous" data-plyr-config='{ "title": "vidio.mp4" }'
      playsinline data-poster="">
      <source src="{{$hlsUrl}}" type="video/mp4" />

    </video>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", async function () {
        var video = document.getElementById("main-video");
        var loadingSpinner = document.getElementById("loading-spinner");
  
        const STORAGE_KEY = 'video-time-' + window.location.href;

  video.addEventListener("loadeddata", function () {
      loadingSpinner.classList.add("hidden");
  });

  video.addEventListener("click", function () {
      enterFullscreen();
  });

  function enterFullscreen() {
      if (video.requestFullscreen) {
          video.requestFullscreen();
      } else if (video.webkitRequestFullscreen) {
          video.webkitRequestFullscreen();
      } else if (video.msRequestFullscreen) {
          video.msRequestFullscreen();
      }

      if (screen.orientation && screen.orientation.lock) {
          screen.orientation.lock("landscape").catch(function (error) {
              console.log("Tidak dapat mengunci orientasi: ", error);
          });
      }
  }

  document.addEventListener("fullscreenchange", function () {
      if (document.fullscreenElement) {
          console.log("Fullscreen aktif, mengunci orientasi ke landscape...");
          if (screen.orientation && screen.orientation.lock) {
              screen.orientation.lock("landscape").catch(function (error) {
                  console.log("Gagal mengunci orientasi: ", error);
              });
          }
      }
  });

  var defaultOptions = {
      storage: {
          enabled: true,
          key: 'plyr--lib-1300'
      },
      fullscreen: {
          enabled: true,
          fallback: true,
          iosNative: true
      },
      iconUrl: '/plyr/plyr.svg',
      captions: { active: false, language: '', update: true },
      controls: [
          "play-large","play","rewind","fast-forward","progress","current-time","volume","settings","fullscreen"
      ],
      settings: ['quality', 'speed', 'loop'],
      speed: { selected: 1, options: [0.5,0.75,1,1.25,1.5,1.75,2,4] },
  };

  function initPlayer() {
      player.elements.captions.dir = "auto";
      $('<div class="plyr__controls__item hide_mobile plyr__spacer"></div>').insertBefore(".plyr__progress__container");

      $("video").on('webkitbeginfullscreen webkitendfullscreen', function (event) {
          if (event.type === 'webkitbeginfullscreen') {
              document.documentElement.style.setProperty('--webkit-text-track-display', 'block');
          } else {
              document.documentElement.style.setProperty('--webkit-text-track-display', 'none');
          }
      });

      $(".plyr__progress__container input").css("top", "-5px");
      $(".plyr__progress__container progress").css("top", "4px");
      $(".plyr__progress__container progress").css("opacity", "0.01");
      $(".plyr__progress").prepend($('<div class="plyr__pb"></div>'));
      
      var pb = new PB(".plyr__pb", ".plyr__progress__container input", {
          keyColor: "#ff7755",
          videoLength: 20,
          chapters: [],
          moments: [],
          onScrubbingChange: function(seekTime, offset) {
              var thumbWidth = $(".plyr__preview-thumb").width();
              var position = Math.max(thumbWidth / 2, offset);
              position = Math.min($(".plyr__controls").width() - $(".plyr__preview-thumb").width() + (thumbWidth / 4), position);
              $(".plyr__preview-thumb").css("left", (position - 5.5) + "px");
          }
      });

      player.on("loadedmetadata", function () {
          pb.SetDuration(player.duration);
          const savedTime = parseFloat(localStorage.getItem(STORAGE_KEY)) || 0;
          if (savedTime > 0 && savedTime < player.duration) {
            player.currentTime = savedTime;
          }
      });

      player.on("timeupdate", function() {
          localStorage.setItem(STORAGE_KEY, player.currentTime);
      });

      player.on("ended", function() {
        localStorage.removeItem(STORAGE_KEY);
      });

      setInterval(function () {
          pb.SetCurrentProgress(player.currentTime);
          pb.SetBufferProgress(player.duration * player.buffered);
      }, 16);
  }
    

  player = new Plyr(video, defaultOptions);
  initPlayer();

  document.addEventListener("keydown", function (e) {
      if (!player) return;

      switch (e.code) {
          case "Space":
          case "Spacebar": // untuk kompatibilitas lama
              e.preventDefault(); // Hindari scroll
              if (player.playing) {
                  player.pause();
              } else {
                  player.play();
              }
              break;
          case "ArrowRight":
              e.preventDefault();
              player.forward(10); // maju 10 detik
              break;
          case "ArrowLeft":
              e.preventDefault();
              player.rewind(10); // mundur 10 detik
               break;
          case "ArrowUp":
              e.preventDefault();
              player.volume = Math.min(player.volume + 0.1, 1); // naik volume 10%
              break;
          case "ArrowDown":
              e.preventDefault();
              player.volume = Math.max(player.volume - 0.1, 0); // turun volume 10%
              break;
      }
  });

});
  </script>


</body>

</html>