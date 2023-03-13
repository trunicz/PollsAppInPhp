<?php
require_once 'src/views/layouts/head.php';
require_once 'src/views/layouts/navbar.php';
if (isset($_GET['page'])) {
  require "src/views/{$_GET['page']}.php";
} else {
  require "src/views/home.php";
}
?>
</body>

</html>