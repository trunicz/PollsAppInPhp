<?php

use Trnx\Polls\model\Poll;

if (isset($_POST['title'])) {
  if (isset($_POST['option'])) {
    $title = $_POST['title'];
    $options = $_POST['option'];

    $poll = new Poll($title, true);
    $poll->save();
    $poll->insertOptions($options);

    header('Location: /');
  }
} else {
  header('Location: /');
}

?>
<div class="container">
  <form action="?page=options" method="POST" class="form-create">
    <h3>Questions</h3>
    <input type="hidden" name="title" value="<?= $_POST['title'] ?>">
    <input type="text" name="option[]" id="" placeholder="Option">
    <input type="text" name="option[]" id="" placeholder="Option">
    <div id="more-inputs">

    </div>
    <button id="bAdd">Add Another Option</button>

    <input type="submit" value="Create Poll">
  </form>
</div>

<script>
  const bAdd = document.querySelector('#bAdd');
  const container = document.querySelector("#more-inputs");

  bAdd.addEventListener('click', e => {
    e.preventDefault();

    const wrapper = document.createElement('div');
    wrapper.classList.add('wrapper');

    const bDelete = document.createElement('button');
    bDelete.append('Delete');
    bDelete.addEventListener('click', e => {
      e.preventDefault();
      wrapper.remove();
    })

    const input = document.createElement('input');
    input.name = 'option[]';
    input.type = 'text';
    input.id = crypto.randomUUID();
    input.classList.add('input');
    input.placeholder = 'Option ';

    wrapper.appendChild(input);
    wrapper.appendChild(bDelete);
    container.appendChild(wrapper);
  })
</script>