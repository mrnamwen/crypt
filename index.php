<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="crypt is a file sharing service">
    <meta name="author" content="Liam Newman, Felix Angell">
    <meta name="keywords" content="file, sharing, encryption, AES">

    <title>crypt</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <link type="text/css" href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico">
  </head>

  <body>
    <div class="container">
        <div class="box">
          <?php if(isset($_GET['error'])) { ?>
          <div class="alert alert-danger alert-dismissible" role="alert"><b>Decryption failed. </b> Check your ID and password and try again.</div>
          <?php } ?>
            
          <?php if(isset($_GET['id'])) { ?>
          <div class="alert alert-success alert-dismissible" role="alert"><b>File Uploaded. </b>Your id is <? echo($_GET['id']); ?></div>
          <?php } ?>

          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h1>File Sharing for the Anonymous</h1>
              <p>
                Have you ever had to send critical, confidential or similar files over the internet, worrying 
                about if or who may be viewing them? Worry no longer. Crypt is a free, ad-supported storage 
                solution, allowing file uploads up to 200MB that are encrypted using a password of your choice 
                on upload. Only you and the people you share the password with has access to the content. Everybody 
                else, including us, can't decrypt your files.
              </p>
            </div>
          </div>

          <div class="separator"></div>

          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="tabcontainer" role="tabpanel">
                
                <ul id="tabs" class="nav nav-tabs" role="tabs">
                  <li role="presentation"><a href="#encrypt-tab" aria-controls="tab" role="tab" data-toggle="tab">Encrypt</a></li>
                  <li role="presentation"><a href="#decrypt-tab" aria-controls="tab" role="tab" data-toggle="tab">Decrypt</a></li>
                </ul>

                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane" id="encrypt-tab">
                    <p class="text-left">
                      Choose the file to encrypt and a password for decrypting it later on.
                    </p>
                    <form method="post" action="lelcrypt.php" enctype="multipart/form-data">
                      <input type="hidden" id="upload" name="upload" value="ye" />
                      <div class="login-form">
                        <div class="form-group">
                          <input type="file" id="file" name="file" autocomplete="off" />
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control login-field" value="" placeholder="Password" id="pass" name="pass" autocomplete="off" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" value="Decrypt" name="submit">Encrypt</button>
                      </div>
                    </form>
                  </div>

                  <div role="tabpanel" class="tab-pane" id="decrypt-tab">
                    <p class="text-left">
                      Enter the files identifier and password to decrypt a file.
                    </p>
                    <form method="post" action="lelcrypt.php">
                      <input type="hidden" id="decrypt" name="decrypt" value="ye" />
                      <div class="login-form">
                        <div class="form-group">
                          <input type="text" class="form-control login-field" value="" placeholder="File Identifier" id="file" name="file" autocomplete="off" />
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control login-field" value="" placeholder="Password" id="pass" name="pass" autocomplete="off" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" value="Upload and Encrypt" name="submit">Decrypt</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer">
          <p>Copyright &copy; 2015</p>
        </footer>
      </div>
    </div>
    <!-- /.container -->

    <script>
    $(document).ready(function(){
      $("#tabs a").click(function(e){
          e.preventDefault();
          $(this).tab('show');
      });
      $(document).ready(function(){
          $("#tabs li:eq(1) a").tab('show');
      })
      $('a[data-toggle="tab"]').on('shown', function (e) {
        e.target // active tab
        e.relatedTarget // previous tab
    })
  });
    </script>

  </body>
</html>
