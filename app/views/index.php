<?php

/* @var $model*/

?>

<div class="container">
  <table class="table table-striped table-bordered">
    <thead>
    <tr>
      <th><form action="/site/sort" method="post">
          <input type="hidden" name="sort" value="id">
          <button type="submit" title="Sort by ID">
            ID
          </button>
        </form>
      </th>
      <th><form action="/site/sort" method="post">
          <input type="hidden" name="sort" value="name">
          <button type="submit" title="Sort by Name" >
            Name
          </button>
        </form>
      </th>
      <th><form action="/site/sort" method="post">
          <input type="hidden" name="sort" value="email">
          <button type="submit" title="Sort by Email">
            Email
          </button>
        </form>
      </th>
      <th><form action="/site/sort" method="post">
          <input type="hidden" name="sort" value="text">
          <button type="submit" title="Sort by Text">
            Text
          </button>
        </form>
      </th>
      <th><form action="/site/sort" method="post">
          <input type="hidden" name="sort" value="status">
          <button type="submit" title="Sort by Status">
            Status
          </button>
        </form>
      </th>

      <th></th>
    </tr>
    </thead>
    <tbody>
    <?php $item=0;
    foreach ($model['objects'] as $task):
        $item++;?>
      <tr data-key="<?=$task->id?>">
        <td><?=$item?></td>
        <td><?=$task->name?></td>
        <td><a href="mailto:<?=$task->email?>"><?=$task->email?></a></td>
        <td>
            <?php if ($_SESSION['isAdmin'] == true && $task->status != 2): ?>
              <form action="/site/update" method="post">
                <input type="hidden" name="id" value="<?=$task->id?>">
                <textarea id="text" class="form-control" name="text"><?=$task->text?></textarea>
                <button type="submit" title="Edit" data-id="<?=$task->id?>">
                  <span class="glyphicon glyphicon-pencil"></span>
                </button>
              </form>
            <?php else:?>
                <?=$task->text?>
            <?php endif;?>
        </td>
        <td>
            <?php
            if ($task->status==1)
                echo 'Edited by admin';
            if ($task->status==0)
                echo 'Added';
            if ($task->status==2)
                echo 'Done';
            ?>
        </td>
        <td>

          <form action="/site/view" method="post">
            <input type="hidden" name="id" value="<?=$task->id?>">
            <button type="submit" title="View">
              <span class="glyphicon glyphicon-eye-open"></span>
            </button>
          </form>
            <?php if ($_SESSION['isAdmin'] == true && $task->status != 2): ?>
              <form action="/site/setDoneStatus" method="post">
                <input type="hidden" name="id" value="<?=$task->id?>">
                <button type="submit" title="Done" >
                  <span class="glyphicon glyphicon-ok"></span>
                </button>
              </form>
            <?php endif;?>
        </td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table>
</div>

<div class="container">
  Summary: <?=$model['totalRows']?>
  <br>
  <p> Pages:
      <?php for ($i = 1; $i <= $model['totalPages']; $i++)
      {
          if ($i != $model['page']) {
              echo " &nbsp <a href='?page=$i'>$i</a> &nbsp";

          } else {
              echo " $i";

          }
      } ?>
  </p>
</div>

