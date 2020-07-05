<?php

/* @var $model*/

?>

<div class="container">
  <div class="form_sign_up col-sm-6 col-sm-offset-3">
    <form action="/signUp/submit" method="post">
      <div class="form-group">
        <label class="control-label" for="Email">Email</label>
        <input name="email" id="email"  class="form-control">
          <?php if($model && $model->getErrorByField('email')) {
              echo "<div class='error'>" . $model->getErrorByField('email')."</div>";
          } ?>
        <br>
        <div class='error' id='email_error' style="display: none"></div>

        <label class="control-label" for="password">Password</label>
        <input name="password" type= password  class="form-control">
          <?php if($model && $model->getErrorByField('password')) {
              echo "<div class='error'>" . $model->getErrorByField('password')."</div>";
          } ?>

          <?php if(is_object($model) && $model->getErrorByField('login_used')) {
              echo "<div class='error'>" . $model->getErrorByField('login_used')."</div>";
          } ?>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">SignUp</button>
      </div>
    </form>
  </div>
</div>
<style>
  .error {
    color : red;
  }
</style>

<script>
    $(function() {
        $("#email").on("blur", function () {
            $.post(
                "/signUp/ajaxCheckEmail",
                {
                    email: $(this).val()
                },
                function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    if(data.success === false) {
                        $('#email_error').text(data.error).show();
                    } else {
                        $('#email_error').hide();
                    }
                }
            );
        });
    });
</script>