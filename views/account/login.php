
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>Login - PHPChat</title>
  <link rel="stylesheet" type="text/css" href="assets/semantic/semantic.min.css">
  <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="assets/semantic/semantic.min.js"></script>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            email: {
              identifier  : 'email',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your e-mail'
                },
                {
                  type   : 'email',
                  prompt : 'Please enter a valid e-mail'
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            }
          }
        })
      ;
    })
  ;
  </script>
</head>
<body>

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h1 class="ui teal header">
      <div class="content">
        Log-in to your account
      </div>
    </h1>
    <form class="ui large form" id="formLogin">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="email" id="email" placeholder="E-mail address">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" id="password" placeholder="Password">
          </div>
        </div>
        <div class="ui fluid large teal submit button">Login</div>
      </div>

      <div class="ui error message"></div>

    </form>

    <div class="ui message">
      Not registered yet?  <a href="<?php echo baseUrl() ?>/signup">Sign Up</a>
    </div>
  </div>
</div>
</body>
    
<script>
    $("#formLogin").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo baseUrl() ?>/submitLogin',
            method: 'POST',
            data: {
                email: $("#email").val(),
                password: $("#password").val()
            }
        })
        .done(function(response) {
        })
        .fail(function(error) {
            console.log(error);
        });
    });
</script>

</html>
