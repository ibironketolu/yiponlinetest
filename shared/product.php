<?php include_once 'constants.php'; 
	include_once 'common.php';

class Product{
	public $name;
	public $desc;
	public $dbcon;
    public $id;


	public function __construct(){
		$this->dbcon= new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASENAME);
		if ($this->dbcon->connect_error) {
			die("Failed connection".$this->dbcon->connect_error);
		}else{

		}
	}

    public function insertProduct($name,$desc){
		//prepare the statement
		$statement=$this->dbcon->prepare("INSERT INTO products(product_name,product_desc,image) VALUES(?,?,?)");

		//convert the image file
		$ext= array('jpg','png','jpeg','gif');

		$obj = new Common;
		$image = $obj->uploadAnyFile("uploads/",1048576,$ext);

		//bind the params
			if (array_key_exists('success',$image)) {
					

				$filename = $image['success'];

					// bind parameters
					$statement->bind_param("sss",$name,$desc,$filename);

					// execute
					$statement->execute();


					if ($statement->affected_rows == 1){
						return true;
					}else{
						return $statement->error;
					}
				}else{
					return $image['error'];
				}


		}

        
    public function showProducts(){
        $statement = $this->dbcon->prepare("SELECT * FROM products ORDER BY id ASC LIMIT 6");

        $statement->execute();

        $result = $statement->get_result();

        $records = array();

        if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $records[] = $row;
                }

        }

        return $records;
        
    }	


    public function editProduct($name,$desc,$id){
        //prepare the statement
        $statement=$this->dbcon->prepare("UPDATE products SET product_name=?, product_desc=? WHERE id=?");
            //convert the image file
                // bind parameters
                $statement->bind_param("ssi",$name,$desc,$id);

                // execute
                $statement->execute();


                if ($statement->affected_rows == 1){
                    return true;
                }else{
                    return $statement->error;
                }
            }

    public function getProduct($id){
        //prepare the statement

    $statement=$this->dbcon->prepare("SELECT * FROM products WHERE id =?");

    $statement->bind_param("i",$id);

    $statement->execute();

    $result = $statement->get_result();

    return $result->fetch_assoc();

}



public function deleteProduct($id){
    $statement= $this->dbcon->prepare("DELETE FROM products WHERE id=?");

    #bind the param
    $statement->bind_param("i",$id);

    #execute the statement

    $statement->execute();


    if ($statement->affected_rows == 1) {
        //redirect to list products
        $msg = "Post was successfully deleted!";
        header("location:index.php?m=$msg");
        exit;
    }else{
        $msg = "Oops! could not delete post record.";
        header("location:index.php?info=$msg");
        exit;
    }

}









//end of class product
}
?>