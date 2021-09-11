<?php

require_once(ROOT_PATH .'Controllers/SeaController.php');

$delete=new SeaController();
$params = $delete->delete($id);

header("Location:index.php");
?>
