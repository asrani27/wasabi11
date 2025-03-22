<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Video Player</title>
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet">
    <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">
</head>

<body>
    <video id="my-video" class="video-js vjs-theme-fantasy" controls preload="auto" width="640" height="360">
        <source src="{{$mp4TemporaryUrl}}" type="video/mp4">
    </video>

    <script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
    <script>
        videojs('my-video', {
            controlBar: { 
                skipButtons: { forward: 5, backward: 10 },
                playbackRateMenuButton: true
            },
            playbackRates: [0.5, 1, 1.5, 2, 3]
        });
    </script>
</body>

</html>