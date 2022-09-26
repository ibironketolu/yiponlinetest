<?php 

ob_start();


 ?>

  <?php 

  function sanitizeInput($data){
    $data = addslashes($data);
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;
  }
  


 ?>