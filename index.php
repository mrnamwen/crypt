<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="crypt is a file sharing service">
    <meta name="author" content="Liam Newman, Felix Angell">
    <meta name="keywords" content="file, sharing, encryption, AES">
    <title>crypt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/ripples.min.css" rel="stylesheet">
    <script src="dist/js/vendor/jquery.min.js"></script>
    <script src="dist/js/vendor/video.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link type="text/css" href="css/style.css" rel="stylesheet">

    <script>$.material.init();</script>
    <link rel="shortcut icon" href="img/favicon.ico">

    <!--[if lt IE 9]>
    <script src="js/vendor/html5shiv.js"></script>
    <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
      <div class="row-fluid">
        <div class="text-center">
          <div class="box">
          <h1>File Sharing for the Anonymous</h1>
          <p>
            Have you ever had to send critical, confidential or similar files over the internet, worrying 
            about if or who may be viewing them? Worry no longer. Crypt is a free, ad-supported storage 
            solution, allowing file uploads up to 200MB that are encrypted using a password of your choice 
            on upload. Only you and the people you share the password with has access to the content. Everybody 
            else, including us, can't decrypt your files.
          </p>

          <hr>

          <?php if(isset($_GET['error'])) { ?>
          <div class="alert alert-danger alert-dismissible" role="alert"><b>Decryption failed. </b> Check your ID and password and try again.</div>
          <?php } ?>
            
          <?php if(isset($_GET['id'])) { ?>
          <div class="alert alert-success alert-dismissible" role="alert"><b>File Uploaded. </b>Your id is <? echo($_GET['id']); ?></div>
          <?php } ?>

            <div class="row">
              <div class="col-md-12">
                <form method="post" action="lelcrypt.php">
                  <input type="hidden" id="decrypt" name="decrypt" value="ye" />
                  <div class="login-form">
                    <div class="form-group">
                      <input type="text" class="form-control login-field" value="" placeholder="File Identifier" id="file" name="file" autocomplete="off" />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control login-field" value="" placeholder="Password" id="pass" name="pass" autocomplete="off" />
                      <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" value="Upload and Encrypt" name="submit">Decrypt</button>
                  </div>
                </form>
              </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-12">
                <form method="post" action="lelcrypt.php" enctype="multipart/form-data">
                  <input type="hidden" id="upload" name="upload" value="ye" />
                  <div class="login-form">
                    <div class="form-group">
                      <input type="file" id="file" name="file" autocomplete="off" />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control login-field" value="" placeholder="Password" id="pass" name="pass" autocomplete="off" />
                      <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" value="Decrypt" name="submit">Encrypt</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container -->
  </body>
</html>