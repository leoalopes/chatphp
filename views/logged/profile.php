
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
  .sixteen.wide.column {
    display: flex !important;
    justify-content: center !important;
  }
  .modal {
    width: 40% !important;
    height: 30% !important;
  }
  .content {
    text-align: center;
    font-size: 18px !important;
    line-height: 55px !important;
  }
  </style>
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/semantic/semantic.min.js"></script>
</head>
<body>
  <div class="ui modal">
    <div class="header"><strong>Error</strong></div>
    <div class="content" id="error"></div>
  </div>

  <div class="ui inverted menu" style="margin-top: 0 !important">
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
      <h2 class="ui blue header main-title">Profile</h2>
      <div class="ui divider"></div>
    </div>
  </div>
  <div class="ui stackable three column centered grid container">
    <div class="column">
        <div class="ui card">
            <div class="image">
                <img src="<?php echo (isset($_SESSION['logged']['image']) && $_SESSION['logged']['image'] != '' ? $_SESSION['logged']['image'] : "https://i.imgur.com/jNNT4LE.jpg"); ?>">
            </div>
            <div class="content">
                <a class="header"><?php echo $_SESSION['logged']['name']; ?></a>
                <div class="description">
                PHP Chat user.
                </div>
            </div>
        </div>
    </div>
    <div class="column" style="margin-top: 8%">
        <div class="ui centered grid container">
            <div class="sixteen wide column">
                <div class="ui left icon input">
                    <input type="text" placeholder="Nickname" id="nickname" value="<?php echo $_SESSION['logged']['name']; ?>">
                    <i class="user icon"></i>
                </div>
            </div>
            <div class="sixteen wide column">
                <div class="ui left icon input">
                    <input type="text" placeholder="Image url" id="url" value="<?php echo (isset($_SESSION['logged']['image']) && $_SESSION['logged']['image'] != '' ? $_SESSION['logged']['image'] : ''); ?>">
                    <i class="linkify icon"></i>
                </div>
            </div>
            <div class="sixteen wide column">
                <button class="ui blue button" onclick="editProfile()">
                    Save
                </button>
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
    function editProfile() {
        $.ajax({
            url: '<?php echo baseUrl() ?>/editProfile',
            method: 'POST',
            data: {
                name: $("#nickname").val(),
                image: $("#url").val()
            },
            success: function(response) {
                window.location.reload();
            },
            error: function(error) {
                $("#error").text(JSON.parse(error.responseText).error);
                $('.ui.modal')
                  .modal('show')
                ;
            }
        })
    }
</script>

</html>