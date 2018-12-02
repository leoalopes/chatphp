
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>Signup - PHPChat</title>
  <link rel="stylesheet" type="text/css" href="assets/semantic/semantic.min.css">
  <style type="text/css">
    body {
      background-color: #454545;
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
    input { 
      border-color: #888888 !important;
      color: black !important;
    }
    input::placeholder {
      color: #888888 !important;      
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
            },
            password_verify: {
              identifier  : 'password-verify',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please verify your password'
                },
                {
                  type   : 'match[password]',
                  prompt : 'The passwords must be equal'
                }
              ]
            }
          },
          onSuccess : (e) => {
            e.preventDefault();
            $.ajax({
              url: '<?php echo baseUrl() ?>/submitSignup',
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
      <div class="content" style="color: white">
        Create your account
      </div>
    </h1>
    <form class="ui large form" id="formSignup">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="name" id="name" placeholder="Name">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="envelope icon"></i>
            <input type="text" name="email" id="email" placeholder="E-mail address">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" id="password" placeholder="Password">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password-verify" id="password-verify" placeholder="Password verify">
          </div>
        </div>
        <div class="ui fluid large teal submit button" style="background-color: #2185d0">Signup</div>
      </div>

      <div class="ui error message"></div>

    </form>

    <div class="ui message">
      Already have an account?  <a href="<?php echo baseUrl() ?>/login">Login</a>
    </div>
  </div>
</div>
</body>
</html>