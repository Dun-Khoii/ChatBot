<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container-fluid m-0 p-5">
        <div class="chatbot-header">
            <span class="bot-name">CHATBOT</span>
        </div>
        <div id="content-box" class="p-2">
            {{-- output --}}
        </div>
        <div class="chat-input p-2">
            <input type="text" id="input" placeholder="Type a message...">
            <button id="button-submit" class="btn">SEND</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.js" crossorigin="anonymous"></script>
    <script>
        // Set up csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Event click for button-submit
        $('#button-submit').on('click', function() {
            var value = $('#input').val();  // Get input value

            if (value.trim() !== '') {
                // Append user message to content-box
                $('#content-box').append(`<div class="user-message float-right">` + value + `</div> <div style="clear: both"></div>`);
                $('#input').val('');  // Clear input

                // Ajax post request
                $.ajax({
                    type: 'POST',
                    url: '/send',
                    data: {'input': value},
                    success: function(data) {
                        // Append bot response to content-box
                        $('#content-box').append(
                            `<div class="bot-message">
                                <div>` + data + `</div>
                            </div>`
                        );
                        $('#content-box').scrollTop($('#content-box')[0].scrollHeight);  // Scroll to the bottom
                    }
                });
            }
        });
    </script>
</body>

</html>
