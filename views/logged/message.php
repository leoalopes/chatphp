
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Panel - PHPChat</title>
  <link rel="stylesheet" type="text/css" href="assets/semantic/semantic.min.css">

  <style type="text/css">
  body {
    background-color: #FFFFFF;
  }
  .ui.menu .item img.logo {
    margin-right: 1.5em;
  }
  .main.container {
    margin-top: 4em;
  }
  .wireframe {
    margin-top: 2em;
  }
  .ui.footer.segment {
    margin: 8em 0em 0em;
    padding: 5em 0em;
  }
  .menu-item {
    font-size: 18px;
  }
  .section-header {
    text-align: center;
    font-size: 20px !important;
  }
  .header.main-title {
    text-align: center;
  }
  .not-found {
    text-align: center;
    font-size: 20px;
    margin-top: 50px;
    margin-bottom: 50px;
  }
  #message-container {
    background-color: #fefefe;
    min-height: 400px;
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #dededf;
    border-bottom: none;
    border-radius: 5px 5px 0 0;
  }
  .text-input {
    display: flex !important;
    justify-content: center !important;
  }
  @media (max-width: 600px) {
    .message-container-column {
      padding: 0 !important;
    }
  }
  </style>
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/semantic/semantic.min.js"></script>
</head>
<body>
  <div class="ui inverted menu">
    <div class="ui container">
      <a href="<?php echo baseUrl().'/panel'; ?>" class="header item menu-item">
        PHP Chat
      </a>
      <div class="right menu">
        <a href="<?php echo baseUrl().'/profile'; ?>"><div class="item menu-item">
          <?php echo $_SESSION['logged']['name'] ?>
        </div></a>
        <div class="item menu-item">
          <a href="<?php echo baseUrl().'/logout'; ?>"><i class="sign-out icon"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div class="ui main container">
    <div class="main-title">
      <h2 class="ui blue header main-title"><img class="ui avatar image main-title" src="<?php echo ($_SESSION['logged']['receiver']['image'] != '' ? $_SESSION['logged']['receiver']['image'] : "https://i.imgur.com/jNNT4LE.jpg"); ?>"><?php echo $_SESSION['logged']['receiver']['name']; ?></h2>
    </div><br>
  </div>
  <div class="ui centered grid container">
    <div class="ten wide computer fourteen wide tablet sixteen wide mobile column message-container-column" style="padding-bottom: 0 !important">
        <div class="ui container" id="message-container" style="padding-top: 20px">
        </div>
    </div>
    <div class="ten wide computer fourteen wide tablet sixteen wide mobile column" style="padding-top: 0 !important">
        <div class="ui action input text-input">
            <input type="text" name="message" id="message" placeholder="Write your message...">
            <button class="ui blue button" onclick="sendMessage()">&nbsp;&nbsp;<i class="paper plane icon"></i></button>
        </div>
    </div>
  </div>

  <div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
      Made by Leonardo Lopes | 2018
    </div>
  </div>
</body>

<script>
    $("#message").keydown(function(event) {
        if (event.which == 13) {
            sendMessage();
        }
    });

    function sendMessage() {
        $.ajax({
            url: '<?php echo baseUrl() ?>/sendMessage',
            method: 'POST',
            data: {
                text: $("#message").val()
            },
            success: function(response) {
                $("#message").val('');
                refreshMessages();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function refreshMessages() {
        $.ajax({
            url: '<?php echo baseUrl() ?>/refreshReceiver',
            method: 'GET',
            success: function(response) {
                var messages = JSON.parse(response);
                console.log(messages);
                var newHtml = '';
                if(!messages || messages.length == 0) {
                } else {
                    var width = $(window).width();
                    messages.map(function(message) {
                        newHtml += `
                        <div class="ui icon container" style="text-align: `+(message.received ? 'left' : 'right')+`; padding-`+(message.received ? 'left' : 'right')+`: 3% !important; margin-bottom: 20px; color: `+(message.received ? 'black' : 'white')+`; font-size: 15px;">
                            <span style="background-color: `+(message.received ? '#f1f0f0' : '#2185d0')+`; padding: 10px; border-radius: 6px; word-wrap: break-word; `+(message.text.length > 60 || width < 650 ? 'display: block' : '')+`">`+message.text+`</span>
                        </div>
                        `;
                    });
                }
                $("#message-container").html(newHtml);
            },
            error: function(error) {
                console.log(error);
            }
        })
    }

    $(document).ready(function() {
        refreshMessages();
        setInterval(refreshMessages, 2000);
    });
</script>

</html>