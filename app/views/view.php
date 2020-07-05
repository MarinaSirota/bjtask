<?php

/* @var $model*/

?>


<div class="col-sm-12">

  <div class="col-sm-3">
    <h3><strong> Name</strong> </h3>
    <h4><?=$model->name?></h4>
  </div>

  <div class="col-sm-3">
    <h3><strong> Email</strong> </h3>
    <h4><?=$model->email?></h4>
  </div>

  <div class="col-sm-3">
    <h3><strong> Text</strong></h3>
    <h4><?=$model->text?></h4>
  </div>

  <div class="col-sm-3">
    <h3><strong> Status</strong> </h3>
    <h4>
        <?php
        if ($model->status==1)
            echo 'Edited by admin';
        if ($model->status==0)
            echo 'Added';
        if ($model->status==2)
            echo 'Done';
        ?>
    </h4>
  </div>


</div>

