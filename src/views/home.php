<h1>Polls</h1>

<?php

use Trnx\Polls\model\Poll;

$polls = Poll::getPolls(); ?>
<div class="main-content">
  <?php foreach ($polls as $poll) { ?>
    <div><a href='?page=view&id=<?= $poll->getUUID() ?>'><?= $poll->getTitle() ?></a></div>
  <?php } ?>
</div>