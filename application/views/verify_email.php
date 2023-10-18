<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Task Manager</title>
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
</head>
<body>
<div class="background"></div>
  <div class="middle_height"> 
  <div class="container container_1">
    <div class="login form">
      <header>Verify Email</header>
        <?php if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger" role="alert" id="d1">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"  onclick="document.getElementById('d1').style.display='none'"  style="float: right;">&times;</a>    
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
            </div>
        <?php } ?>
        <form action="<?= base_url('validate-email') ?>" method="POST">
          <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
          <input type="email" name="email" placeholder="Enter your email" required>
          <input type="submit" class="button" value="Verify">
        </form>
        <div class="signup">
          <span class="signup">Already have an account?
          <label for="check"><a href="<?= base_url() ?>" >Login</a></label>
          </span>
      </div>
    </div>
  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    setTimeout( function(){$('.alert').hide();} , 6000);
  });
</script>
