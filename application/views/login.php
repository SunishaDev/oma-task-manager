<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  </head>
  <body>
  <div class="background"></div>
    <div class="middle_height"> 
      <div class="container container_1">
        <div class="login form">
          <header>Login</header>
          <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success" role="alert" id="d1">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"  onclick="document.getElementById('d1').style.display='none'"  style="float: right;">&times;</a>    
                <strong><?php echo $this->session->flashdata('success'); ?></strong>
            </div>
          <?php }  if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger" role="alert" id="d1">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"  onclick="document.getElementById('d1').style.display='none'"  style="float: right;">&times;</a>    
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
            </div>
        <?php } ?>
        <form action="<?= base_url('login') ?>" method="POST">
          <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
          <input type="email" name="email" placeholder="Enter your email" required>
          <input type="password" name="password"  placeholder="Enter your password" required>
          <a href="<?= base_url('validate-email') ?>" >Forgot password?</a>
          <input type="submit" class="button" value="Login">
        </form>
        <div class="signup">
          <span class="signup">Don't have an account?
          <label for="check"><a href="<?= base_url('sign-up') ?>" >Sign Up</a></label>
          </span>
        </div>
      </div>  
    </div>
  </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    setTimeout( function(){$('.alert').hide();} , 4000);
  });
</script>
