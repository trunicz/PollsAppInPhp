<?php

use Trnx\Polls\model\Poll;

if (isset($_GET['id'])) {
  $uuid = $_GET['id'];
  $poll = Poll::find($uuid);

  if (isset($_POST['option_id'])) {
    $optionID = $_POST['option_id'];
    $poll = $poll->vote($optionID);
  }
}

$total = $poll->getTotalVotes()

?>

<h1><?= $poll->getTitle() ?></h1>

<h3>Total Votes : <?= $total ?></h3>

<div class="container">
  <?php
  $options = $poll->getOptions();
  foreach ($options as $option) {
    $percentage = $poll->getTotalVotes() === 0 ? 0 : number_format(($option['votes'] / $total) * 100, 0)

  ?>

    <div class="vote-item">
      <div class="bar" style="background-color:crimson;width:<?= $percentage . '%' ?>"><?= $percentage . '%' ?></div>
      <form action="?page=view&id=<?= $uuid ?>" method="post">
        <input type="hidden" name="option_id" value="<?= $option['id'] ?>">
        <input type="submit" value="Vote for <?= $option['title'] ?>">
      </form>
    </div>

  <?php } ?>
</div>