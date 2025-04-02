<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stream NagaFile</title>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .video {
            width: 100%;
        }
    </style>
</head>

<body style="margin:0px;">
    <div class="container">
        <video id="player" playsinline controls data-poster="">
            <source src="{{$mp4TemporaryUrl}}" type="video/mp4" />
            <!-- Tambahkan format lain jika diperlukan -->
            Browser Anda tidak mendukung elemen video.
        </video>
    </div>
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
    <script>
        const player = new Plyr('#player');
    </script>
</body>

</html>