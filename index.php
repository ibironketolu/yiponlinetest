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
Add Product
</div>
    <?php 
    if ($_SERVER['REQUEST_METHOD']=='POST') {
    include_once "shared/product.php";
    include_once "portal/header.php";
    $product_name = sanitizeInput($_POST['product_name']);
    $product_desc = sanitizeInput($_POST['product_desc']);
    //Create an object of the clas
    $obj = new Product();

    $output = $obj->insertProduct($product_name,$product_desc);

    if ($output ==true) {
    echo "<div  class='sucess_post_alert mb-4' style='border: 2px solid #EBEBEB; border-left: 3px solid green;height: 35px; background-color:#EBEBEB ;'><h6 style='color:green;padding-left:20px'>Product sucessfully Added </h6></div>";
    }else{
    echo "<div class='alert alert-danger alert-dismissible fade show 'role='alert'>Could not be created</div>";
    }
    }
    ?>
<div class="card-body">
<form action="#" method="POST" enctype="multipart/form-data">
<div class="mb-3">
<label for="" class="form-label">Product Name</label>
<input type="text" class="form-control" id="product_name" placeholder="" name="product_name" value="">
</div>
<div class="mb-3">
<label for="" class="form-label">Product Description</label>
<input type="text" class="form-control" id="product_desc" placeholder="" name="product_desc" value="">
</div>
<div class="mb-3">
<input type="file" name="myfile" placeholder="Add Media" class="btn btn-dark">
</div>
<div class="mb-3">
<input type="submit" class="btn btn-danger" id="" placeholder="" value="UPLOAD">
</div>
</form>
</div>
</div>
</div>

<div class="col-md-8">
<div class="card">
<div class="card-header">
All Product
</div>
    <?php 
    include_once "shared/product.php";

    #create an object of the class

    $obj = new Product();

    $output = $obj->showProducts();

    // echo "<pre>";
    // print_r($output);
    // echo "</pre>";
    ?>
<div class="card-body">
<table class="table table-bordered">
    <?php 
    $kounter = 0
    ?>
<thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Serial No</th>
    <th scope="col">Product_Name</th>
    <th scope="col">Description</th>
    <th scope="col">Image</th>
    <th scope="col">Action</th>
    <th scope="col">Date Uploaded</th>
    </tr>
</thead>
<tbody>
    <?php 
    foreach ($output as $key => $value) {
    $product_name = $value['product_name'];
    $product_desc = $value['product_desc'];
    $date = $value['date'];
    $id =$value['id'];
    $image = $value['image'];
    
    ?>
    <tr>
        <th><?php echo ++$kounter ?></th>
        <td><?php echo $id ?></td>
        <td><?php echo $product_name ?></td>
        <td><?php echo $product_desc ?></td>
        <td class="text-center"><?php echo "<img src='uploads/$image' style='width:150px;height:100px'>" ?></td>
        <td><a href="edit.php?id=<?php echo $id ?>">Edit</a>  | <button type="button" name="btnDelete" id="btnDelete<?php echo $id ?>" class="btn btn-link btnDelete" data-id="<?php echo $id ?>" data-title="<?php echo $product_name ?>">Delete</button></td>

        <td><?php echo date('l jS F, Y h:i:s A',strtotime($date)); ?></td>
        </tr>

        <?php
    }
        ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript" src="jquery_min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   


    <script type="text/javascript">
  $(document).ready(function(){

    $('[id^=btnDelete]').click(function(){

      var id = $(this).attr('data-id');
      var product_name = $(this).attr('data-title');
      var myconfirm = confirm("Are you sure you want to delete?  "+product_name + " product ?");
/*      alert (baseurl);
*/
      if (myconfirm  == true) {
        //using ajax
        $.ajax({
          url:"delete.php",
          type:"POST",
          data:{id:id,product_name:product_name},
          success: function(response){
            console.log(response);
            //redirect to allfriends page
            window.location.href= "index.php";
            $('#result').html("<div  class='alert alert-success mt-3 mb-3'Post sucessfully deleted</div>")
          }
            });
      }

    });


  });

</script>   
</body>

</html>