<?php

/* @var $model*/

?>

<div class="container">
  <div class="col-sm-6 col-sm-offset-3">
    <form METHOD=post name="form_sign_in" ACTION="/signIn/submit">
      <label class="control-label" for="">Email</label>
      <input name="email" type= text  class="form-control">
      <br>
        <?php if(is_object($model) && $model->getErrorByField('email')) {
            echo "<div class='error'>" . $model->getErrorByField('email')."</div>";
        } ?>

      <label class="control-label" for="password">Password</label>
      <input name="password" type= password  class="form-control" >
      <br>
        <?php if(is_object($model) && $model->getErrorByField('password')) {
            echo "<div class='error'>" . $model->getErrorByField('password')."</div>";
        } ?>
        <?php if(is_object($model) && $model->getErrorByField('login_error')) {
            echo "<div class='error'>" . $model->getErrorByField('login_error')."</div>";
        } ?>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">SignIn</button>
      </div>
    </form>
  </div>
</div>
