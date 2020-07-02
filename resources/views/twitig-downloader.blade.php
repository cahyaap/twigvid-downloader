<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Twitig Downloader</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style type="text/css">
        *, *:focus {
            transition: 0.3ms;
            border: none !important;
        }
        body {
            background: #343a40;
            background-image: linear-gradient(to bottom right, #fb3958, rgb(29, 161, 242));
            width: 100%;
            height: 100vh;
        }
        .twitig {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        p {
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <div class="container twitig">
        <div class="row mb-2">
            <div class="col-md-12">
                <p class="h2">Twitig Downloader</p>
                <p class="h6">Twitter and Instagram video downloader, only enter video url then click download button, enjoy it!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 download-area">
                <div class="alert alert-danger" role="alert" style="display: none;"></div>
                <div class="form-group">
                    <input class="form-control text-center" type="text" name="videoUrl" id="videoUrl" placeholder="Enter twitter or instagram video url here..." />
                </div>
                <div class="form-group">
                    <button class="btn btn-light" id="download">Download</button>
                    <img src="{{ asset('loading.gif') }}" id="download-loading" style="width: 45px; display: none;">
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $('#download').click(function(){
            $('.alert').hide();
            $('#download').hide();
            $('#download-loading').show();
            $('.download-video-button').remove();
            if($('#videoUrl').val() === ""){
                $('#download-loading').hide();
                $('#download').show();
                return false;
            }
            $.ajax({
                url: "/download",
                type: "POST",
                data: {
                    _token: CSRF_TOKEN,
                    videoUrl: $('#videoUrl').val()
                },
                success: function(res){
                    if(res.status === 400){
                        $('.alert').html(res.msg);
                        $('.alert').show();
                        $('#download-loading').hide();
                        $('#download').show();
                        return false;
                    }
                    $('.download-area').append("<form id='download-form' method='POST' action='{{ route('download-video') }}'><input type='hidden' name='_token' value='{{ csrf_token() }}'><input type='hidden' name='video' id='video' value='"+res.video_url+"'><div class='form-group download-video-button'><button class='btn btn-light' id='download-btn'>Download Video Here</button></div></form>");
                    $('.alert').hide();
                    $('#download-loading').hide();
                    $('#download').show();
                }
            });
        });
    });
</script>

</html>