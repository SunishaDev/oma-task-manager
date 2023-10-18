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
      <div class="registration form">
        <header>Signup</header>
          <?= form_open(base_url('sign-up')); ?>
          <?= form_hidden('csrf_token', $this->security->get_csrf_hash()); ?>
          <input type="text" placeholder="Enter your name" name="username" required>
          <select name="department" required>
            <option value="" selected>Select Department</option>
            <option value="Accounts">Accounts</option>
            <option value="Development">Development</option>
            <option value="Digital Marketing">Digital Marketing</option>
            <option value="Others">Others</option>
          </select>
          <input type="email" class="mail_key" placeholder="Enter your email" name="email" required>
          <span class="mail-key-validation validation" style="color:red;display:none">Email already exist.</span>
          <input type="password" placeholder="Create a password" onChange="onChangePassword()" name="password" required>
          <input type="password" placeholder="Confirm your password" onChange="onChangePassword()" name="confirm_password" required>

          <input type="submit" class="button" value="Sign Up">
          <?= form_close(); ?>

       
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
<script  type="text/javascript">
        $(document).on('change', '.mail_key', function(){
          var mail    = $('.mail_key').val();
          $.ajax({
              url:"<?php echo base_url('check_duplicate_email'); ?>",
              method:"post",
              data:{mail:mail},
              success:function(data){
                  if(data > 0){
                      $('.mail-key-validation').show();
                      setTimeout( function(){$('.mail-key-validation').hide();} , 6000);
                      $('.mail_key').val('');
                  }
                  else
                  {
                      $('.mail-key-validation').hide();
                  }
              }
          });
      });
      function onChangePassword() {
            const password = document.querySelector('input[name=password]');
            const confirm = document.querySelector('input[name=confirm_password]');
            if (confirm.value === password.value) {
                confirm.setCustomValidity('');
            } else {
                confirm.setCustomValidity('Passwords do not match');
            }
        }
</script>
