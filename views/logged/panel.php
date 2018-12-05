
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
    margin-top: 7em;
  }
  .wireframe {
    margin-top: 2em;
  }
  .ui.footer.segment {
    margin: 5em 0em 0em;
    padding: 5em 0em;
  }
  .menu-item {
    font-size: 18px;
  }
  .section-header {
    text-align: center;
    font-size: 20px !important;
  }
  .main-title {
    text-align: center;
  }
  .main-divider {
    margin-bottom: 50px !important;
  }
  .not-found {
    text-align: center;
    font-size: 20px;
    margin-top: 50px;
    margin-bottom: 50px;
  }
  .avatar.image {
    margin-right: 5% !important;
  }
  .message-container {
    cursor: pointer;
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
      <h2 class="ui red header main-title">This is your main panel</h2>
      <p>Here you can access your groups and individual messages, as well as start a new conversation.</p>
    </div>
    <h4 class="ui horizontal divider header main-divider">
      &nbsp;&nbsp;&nbsp;&nbsp;<i class="check red icon"></i>
    </h4>
    <div class="ui stackable three column grid">
      <div class="column">
        <div class="ui container segment">
          <h2 class="ui green header section-header">Messages</h2>
          <h4 class="ui horizontal divider header">
          &nbsp;&nbsp;&nbsp;&nbsp;<i class="green comments icon"></i>
          </h4>
          <div id="messages">
          </div>
        </div>
      </div>
      <div class="column">
        <div class="ui container segment">
          <h2 class="ui blue header section-header">Online Users</h2>
            <h4 class="ui horizontal divider header">
            &nbsp;&nbsp;&nbsp;&nbsp;<i class="blue user icon" style="color: #21ba45"></i>
            </h4>
            <div id="online-users">
            </div>
          </div>
        </div>
      <div class="column">
        <div class="ui container segment">
          <h2 class="ui orange header section-header">Groups</h2>
          <h4 class="ui horizontal divider header">
          &nbsp;&nbsp;&nbsp;&nbsp;<i class="orange users icon" style="color: #21ba45"></i>
          </h4>
          <div id="groups">
          </div>
          <script>
            var messages;
            if(!messages) {
              document.write('<div class="not-found">No groups yet.</div>');
            } else {

            }
          </script>
          </div>
        </div>
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
  function stayOnline() {
    $.ajax({
      url: '<?php echo baseUrl() ?>/stayOnline',
      method: 'GET',
      success: function(response) {},
      error: function(error) {
        console.log(JSON.parse(error.responseText).error);
      }
    })
  }

  function refreshMessages() {
    $.ajax({
      url: '<?php echo baseUrl() ?>/refreshMessages',
      method: 'GET',
      success: function(response) {
        var messages = JSON.parse(response);
        var newHtml = '';
        if(!messages || messages.length == 0) {
          newHtml = '<div class="not-found">No messages yet.</div>';
        } else {
          messages.map(function(message) {
            newHtml += `
              <div class="ui icon message message-container" onclick="setReceiver(`+message.id+`)">
                <img class="ui avatar image" src="`+(message.image && message.image != "" ? message.image : "https://i.imgur.com/jNNT4LE.jpg")+`">
                <div class="content">
                  <div class="header">
                    `+message.name+`
                  </div>
                  <p>`+(message.message.received ? '' : '<i class="reply icon"></i>  ')+(message.message.text.length > 20 ? message.message.text.substr(0, 20) + '...' : message.message.text)+`</p>
                </div>
              </div>
            `;
          });
        }
        $("#messages").html(newHtml);
      },
      error: function(error) {
        console.log(JSON.parse(error.responseText).error);
      }
    })
  }

  function refreshOnline() {
    $.ajax({
      url: '<?php echo baseUrl() ?>/refreshOnline',
      method: 'GET',
      success: function(response) {
        var online = JSON.parse(response);
        var newHtml = '';
        if(!online || online.length == 0) {
          newHtml = '<div class="not-found">No users online.</div>';
        } else {
          online.map(function(person) {
            newHtml += `
              <div class="ui icon message">
                <img class="ui avatar image" src="`+(person.image && person.image != "" ? person.image : "https://i.imgur.com/jNNT4LE.jpg")+`">
                <div class="content">
                  <div class="header">
                    `+person.name+`
                  </div>
                </div>
              </div>
            `;
          });
        }
        $("#online-users").html(newHtml);
      },
      error: function(error) {
        console.log(JSON.parse(error.responseText).error);
      }
    })
  }

  function setReceiver(id) {
    $.ajax({
      url: '<?php echo baseUrl() ?>/setReceiver',
      method: 'POST',
      data: {
        receiver: id
      },
      success: function(response) {
        window.location.href = "<?php echo baseUrl().'/message'; ?>";
      },
      error: function(error) {
        console.log(error);
      }
    })
  }

  $(document).ready(function() {
    stayOnline();
    setInterval(stayOnline, 60000);
    refreshMessages();
    setInterval(refreshMessages, 5000);
    refreshOnline();
    setInterval(refreshOnline, 10000);
  })
</script>
</html>
