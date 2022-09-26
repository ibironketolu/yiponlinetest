 <?php 
  include_once("shared/product.php");
    include_once("shared/common.php");

		
		//create object
		$obj = new Product();
		//make use of delete method
		$obj->deleteProduct($_REQUEST['id']);



	?>



