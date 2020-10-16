<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>youtube-downloader</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<h1>YouTube Downloader</h1>



<form>
     <input type="text"  size="80" value="<?php echo $_GET['url']; ?>"   id="txt_url">
    <input type="button" id="btn_fetch" value="Fetch">
</form>

<video width="800" height="600" controls>
    <source src="" type="video/mp4"/>
    <em>Sorry, your browser doesn't support HTML5 video.</em>
</video>



<script>
    $(function () {

        window.onload(function () {

            var url = $("#txt_url").val();

            var oThis = $(this);
            oThis.attr('disabled', true);

            $.get('video_info.php', {url: url}, function (data) {

                console.log(data);

                oThis.attr('disabled', false);

                var links = data['links'];
                var error = data['error'];

                if (error) {
                    alert('Error: ' + error);
                    return;
                }

                // first link with video
                var first = links.find(function (link) {
                    return link['format'].indexOf('video') !== -1;
                });

                if (typeof first === 'undefined') {
                    alert('No video found!');
                    return;
                }

                var stream_url = 'stream.php?url=' + encodeURIComponent(first['url']);

                var video = $("video");
                video.attr('src', stream_url);
                video[0].load();
            });

        });

    });
</script>

</body>
</html>
 
