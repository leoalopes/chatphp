
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>Homepage - PHPChat</title>
  <link rel="stylesheet" type="text/css" href="assets/semantic/semantic.min.css">
  <style type="text/css">
    i {
      margin-right: 0 !important;      
    }
      
    .hidden.menu {
      display: none;
    }

    .masthead.segment {
      min-height: 700px;
      padding: 1em 0em;
    }
    .masthead .logo.item img {
      margin-right: 1em;
    }
    .masthead .ui.menu .ui.button {
      margin-left: 0.5em;
    }
    .masthead h1.ui.header {
      margin-top: 3em;
      margin-bottom: 0em;
      font-size: 4em;
      font-weight: normal;
    }
    .masthead h2 {
      font-size: 1.7em;
      font-weight: normal;
    }

    .ui.vertical.stripe {
      padding: 8em 0em;
    }
    .ui.vertical.stripe h3 {
      font-size: 2em;
    }
    .ui.vertical.stripe .button + h3,
    .ui.vertical.stripe p + h3 {
      margin-top: 3em;
    }
    .ui.vertical.stripe .floated.image {
      clear: both;
    }
    .ui.vertical.stripe p {
      font-size: 1.33em;
    }
    .ui.vertical.stripe .horizontal.divider {
      margin: 3em 0em;
    }

    .quote.stripe.segment {
      padding: 0em;
    }
    .quote.stripe.segment .grid .column {
      padding-top: 5em;
      padding-bottom: 5em;
    }

    .footer.segment {
      padding: 5em 0em;
    }

    .secondary.pointing.menu .toc.item {
      display: none;
    }

    @media only screen and (max-width: 700px) {
      .ui.fixed.menu {
        display: none !important;
      }
      .secondary.pointing.menu .item,
      .secondary.pointing.menu .menu {
        display: none;
      }
      .secondary.pointing.menu .toc.item {
        display: block;
      }
      .masthead.segment {
        min-height: 350px;
      }
      .masthead h1.ui.header {
        font-size: 2em;
        margin-top: 1.5em;
      }
      .masthead h2 {
        margin-top: 0.5em;
        font-size: 1.5em;
      }
    }
  </style>
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/semantic/semantic.min.js"></script>
  <script>
  $(document)
    .ready(function() {
      $('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            $('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            $('.fixed.menu').transition('fade out');
          }
        })
      ;
      $('.ui.sidebar')
        .sidebar('attach events', '.toc.item')
      ;
    })
  ;
  </script>
</head>
<body>
<!-- Following Menu -->
<div class="ui large top fixed hidden menu">
  <div class="ui container">
    <a class="active item">Home</a>
    <div class="right menu">
      <div class="item">
        <a class="ui button" href="<?php echo baseUrl() ?>/login">Log in</a>
      </div>
      <div class="item">
        <a class="ui primary button" href="<?php echo baseUrl() ?>/signup">Sign Up</a>
      </div>
    </div>
  </div>
</div>

<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
  <a class="active item">Home</a>
  <a class="item" href="<?php echo baseUrl() ?>/login">Login</a>
  <a class="item" href="<?php echo baseUrl() ?>/signup">Signup</a>
</div>


<!-- Page Contents -->
<div class="pusher">
  <div class="ui inverted vertical masthead center aligned segment">

    <div class="ui container">
      <div class="ui large secondary inverted pointing menu">
        <a class="toc item">
          <i class="sidebar icon"></i>
        </a>
        <a class="active item">Home</a>
        <div class="right item">
          <a class="ui inverted button" href="<?php echo baseUrl() ?>/login">Log in</a>
          <a class="ui inverted button" href="<?php echo baseUrl() ?>/signup">Sign Up</a>
        </div>
      </div>
    </div>

    <div class="ui text container">
      <h1 class="ui inverted header">
        PHP Chat
      </h1>
      <h2>An experimental chat made with vanilla PHP.</h2><br>
        <a href="<?php echo baseUrl() ?>/signup"><div class="ui huge primary button">Try it now&nbsp;&nbsp;&nbsp;&nbsp;<i class="comments icon"></i></div></a>
    </div>

  </div>
</div>

<div class="ui vertical footer segment" style="background-color: white">
  <div class="ui center aligned container">
    Made by Leonardo Lopes | 2018
  </div>
</div>

</body>
</html>
