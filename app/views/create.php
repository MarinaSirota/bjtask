<?php

/* @var $model*/

?>

<div class="container">
  <div class="form col-sm-6 col-sm-offset-3">

    <form action="/site/create" method="post">
      <div class="form-group">
        <label class="control-label" for="name">Name</label>
        <input type="text" id="name" class="form-control" name="name" maxlength="256" autocomplete="off">
          <?php
          if($model && $model->getErrorByField('name')) {
              echo "<div class='error'>" . $model->getErrorByField('name')."</div>";
          }
          ?>

        <label class="control-label" for="email">Email</label>
        <input type="text" id="email" class="form-control" name="email" maxlength="256" autocomplete="off">
          <?php
          if($model && $model->getErrorByField('email')) {
              echo "<div class='error'>" . $model->getErrorByField('email')."</div>";
          }
          ?>
        <label class="control-label" for="text">Text</label>
        <input type="text" id="text" class="form-control" name="text" maxlength="256" autocomplete="off">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>

    </form>
  </div>
</div>


