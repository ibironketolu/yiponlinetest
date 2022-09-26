<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OOP - YIP CRUD APPLICATION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="main_content">
<div class="container">
<div class="row"> 
<div class="col-md-4">
<div class="card">
<div class="card-header">
Edit Product
</div>
<?php 

    include_once "shared/product.php";
     include_once("shared/common.php");

    $postobj = new Product();
       // fetch existing data
      $data = $postobj->getProduct($_REQUEST['id']);

    //   echo "<pre>";
    //   print_r($data);
    //   echo "</pre>";

// check if the button is clicked
     if (isset($_POST['btnEdit'])){
      // validate
        if(empty($_POST['product_name'])){
          $errors['product_name'] = "Product Name cannot be empty!";
        }

        if(empty($_POST['product_desc'])){
          $errors['product_desc'] = "content cannot be empty!";
        }

        include_once "portal/header.php";
      // sanitize
        $product_name = sanitizeInput($_POST['product_name']);
        $product_desc = ($_POST['product_desc']);
        $productid = $_POST['productid'];

      // update record
      
          $myobj = new Product();  
      // reference insertclub
      $output = $myobj->editProduct($product_name,$product_desc,$productid);

      // check if it's successful
        if ($output == true) {
          $alert = "Post was successfully edited";
          // redirect to listclubs
          header("Location: index.php?good=$alert");

        }elseif ($output == 0){
          $alert = "Oops! No Changes was made!";
            header("Location: index.php?info=$alert");
        }else{
          $errors[] = "Oops! Could not add post. ".$output;
       }



     }

   ?>
<div class="card-body">
<form action="edit.php?id=<?php if(isset($_REQUEST['id'])){
          echo $_REQUEST['id'];
        }?>" method="POST" enctype="multipart/form-data">
<div class="mb-3">
<label for="" class="form-label">Product Name</label>
<input type="text" class="form-control" id="product_name" placeholder="" name="product_name" value="<?php if(isset($data['product_name'])){ echo $data['product_name']; }?>">
</div>
<div class="mb-3">
<label for="" class="form-label">Product Description</label>
<input type="text" class="form-control" id="product_desc" placeholder="" name="product_desc" value="<?php if(isset($data['product_desc'])){ echo $data['product_desc']; }?>">
</div>
<div class="mb-3">
<input type="file" name="myfile" placeholder="Add Media" class="btn btn-dark">
</div>
<div class="mb-3">
<input type="submit" class="btn btn-danger" id="" placeholder="" value="UPLOAD" name="btnEdit">
</div>
<input type="hidden" name="productid" value="<?php if(isset($data['id'])){
            echo $data['id'];
          }?>">
</form>
</div>
</div>
</div>

</div>
</div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   


    
</body>

</html>