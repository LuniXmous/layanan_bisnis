<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #018797; /* Background color */
            margin: 0;
            padding: 20px;
        }

        #chatbox {
            margin: 0 auto;
            width: 100%;
            max-width: 600px; /* Maximum width for chatbox */
            height: 63vh; /* Height for chatbox */
            overflow-y: auto; /* Scrollable */
            background-color: #EFE8DF; /* White background for chat area */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Padding for chat area */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        #chatbox::-webkit-scrollbar {
            display: none;
        }

        .botText {
            font-family: monospace;
            font-size: 16px;
            text-align: left;
            line-height: 25px;
            color: #000000; /* Color for bot messages */
            margin-bottom: 10px; /* Space between messages */
            padding: 10px; /* Padding for messages */
            border-radius: 10px; /* Rounded corners */
            background-color: #f0f0f0; /* Light background for bot messages */
            display: inline-block; /* To wrap around content */
        }

        .userText {
            text-align: right;
            margin-bottom: 10px; /* Space between messages */
        }

        .userText span {
            font-family: monospace;
            font-size: 16px;
            color: #000000; /* Text color for user messages */
            padding: 10px; /* Padding for messages */
            border-radius: 10px; /* Rounded corners */
            background-color: #e3ffc8; /* Green background for user messages */
            display: inline-block; /* To wrap around content */
        }

        #userInput {
            margin: 20px auto; /* Center input area */
            width: 100%;
            max-width: 600px; /* Maximum width for input area */
            display: flex; /* Flexbox for alignment */
            justify-content: space-between; /* Space between input and button */
        }

        #textInput {
            border: 1px solid #ccc; /* Border for input */
            border-radius: 20px; /* Rounded corners */
            font-family: monospace;
            font-size: 16px;
            padding: 10px; /* Padding for input */
            width: 80%; /* Width for input */
            margin-right: 10px; /* Space between input and button */
            outline: none; /* Remove outline */
        }

        #buttondInput {
            padding: 10px 15px; /* Padding for button */
            font-family: monospace;
            font-size: 16px;
            border: none; /* No border */
            border-radius: 20px; /* Rounded corners */
            background-color: #05887C; /* Button color */
            color: white; /* White text for button */
            cursor: pointer; /* Pointer cursor on hover */
        }

        #buttondInput:hover {
            background-color: #024640; /* Darker color on hover */
        }

        .container-fluid {
            display: flex;
            align-items: center; /* Align items vertically in the center */
            justify-content: flex-start; /* Align items to the left */
            padding: 10px 20px; /* Some padding around the container */
            background-color: #018797; /* Background color for header */
        }

        .navbar-brand {
            background-color: #ffffff; /* White background behind the logo */
            border-radius: 5px; /* Rounded corners for a smoother look */
            padding: 5px; /* Some padding to create space around the logo */
        }

        .navbar-brand img {
            width: 60px;
            height: auto;
        }

        h1 {
            color: #ffffff; /* White text color for the heading */
            margin: 0; /* Remove default margin for better alignment */
            font-family: 'Arial', sans-serif;
            text-align: center; /* Font for the heading */
        }

        .center-heading {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            color: #ffffff; /* White text color for the heading */
            margin: 0; /* Remove default margin for better alignment */
            font-family: 'Arial', sans-serif; /* Font for the heading */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" />
        </a>
        <h1 class="center-heading">CHAT BOT LAYANAN BISNIS</h1>
    </div>
    <div>
        <div id="chatbox">
            <p class="botText"><span>Hai, Perlu Bantuan?</span></p>
        </div>
        <div id="userInput">
            <input id="textInput" type="text" name="userMessage" placeholder="Ketik Pertanyaanmu"/>
            <input id="buttondInput" type="submit" value="Kirim"/>
        </div>
    </div>

    <script>
        function getUserResponse() {
            var userText = $('#textInput').val();
            if (userText.trim() === "") return; // Don't send if input is empty

            // Add user message to chatbox
            var userHtml = "<p class='userText'><span>" + userText + "</span></p>";
            $('#chatbox').append(userHtml);
            $('#textInput').val(""); // Clear input

            // Scroll down after adding user message
            $('#chatbox').animate({ scrollTop: $('#chatbox')[0].scrollHeight }, 500);

            // Get bot response
            $.get("/get", { userMessage: userText }).done(function(data) {
                var botHtml = "<p class='botText'><span>" + data + "</span></p>";
                $('#chatbox').append(botHtml);

                // Scroll down after adding bot message
                $('#chatbox').animate({ scrollTop: $('#chatbox')[0].scrollHeight }, 500);
            });
        }

        // Send message when 'Enter' key is pressed
        $("#textInput").keypress(function(e) {
            if (e.which == 13) {
                getUserResponse();
            }
        });

        // Send message when 'Kirim' button is clicked
        $('#buttondInput').click(function() {
            getUserResponse();
        });
    </script>
</body>
</html>
