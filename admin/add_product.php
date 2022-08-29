<?php
require 'includes/header.php';
require 'includes/topbar.php';
require 'includes/sidebar.php';

  $username = $_SESSION['username'];

  $product_error='';
  $product_img_error='';
  $product_price_error='';
  $product_qty_error ='';
  $product_img_error ='';

  if (isset($_POST['submit']))
  {

  $errors= array();
  $product_name=$_POST['pnm'];
  $product_price=$_POST['pprice'];
  $product_qty=$_POST['pqty'];
  $filename=$_FILES['filename']['name'];
  $fileresorce=$_FILES['filename']['tmp_name'];
  $category_name=$_POST['pcategory'];
  $file_tmp = $_FILES['filename']['tmp_name'];
  $file_type = $_FILES['filename']['type'];
  $arr=explode('.',$_FILES['filename']['name']);
  $file_ext=strtolower(end($arr));

  //Product name Validation
  $error=0;
  if (empty($product_name)) {
  $product_error = "Product Name is required";
  $error++;
  }
  //Product Price Validation
  if (empty($product_price)) {
  $product_price_error = "Product Price is required";
  $error++;
  }
  //Product qty Validation
  if (empty($product_qty)) {
  $product_qty_error = "Product Qty is required";
  $error++;
  }
  //Product image Validation
  if (empty($filename)) {
    $product_img_error .= "Please Upload Product Image";
    $error++;
  }
  else
  {
  $expensions= array("jpeg","jpg","png","webp");
  if(in_array($file_ext,$expensions)=== false){
    $product_img_error="extension not allowed, please choose a JPEG or PNG file.";
    $error++;
  }
  }

  if ($error=='0') {
  $uq= "INSERT INTO `products` (`id`, `product_name`, `product_qty`, `product_image`, `category_name`, `product_price`, `created_by`)
        VALUES (NULL, '$product_name', '$product_qty', '$filename', '$category_name', '$product_price', '$username')";
  $n=  mysqli_query($conn, $uq) or die(mysqli_error($conn));
  if ($n)
   {
       if (!empty($filename)) {
           $uploads_dir = '../uploads/';
           move_uploaded_file($fileresorce,  $uploads_dir.$filename);
       }
       $_SESSION['success_message'] = "Product added successfully!";
       header('location: products.php');
   }
  }
}
?>
<div class="content-wrapper">
  <div class="content-header">
    <h3>Add Product</h3>
    <hr>
  </div>
  <div class="card-body">
    <div class="container ml-5">
      <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
      <tr>
        <td>Product Name</td>
        <td><input type="text"   value="" name="pnm" >
          <small class="text-danger pl-3"><?php echo  $product_error;?></small>
        </td>
      </tr>
      <tr>
        <td>Product Price</td>
        <td><input type="number"  value="" name="pprice" >
          <small class="text-danger pl-3"><?php echo  $product_price_error;?></small>
        </td>
      </tr>
      <tr>
        <td>Product Quantity</td>
        <td><input type="number"  name="pqty" value="" >
          <small class="text-danger pl-3"><?php echo  $product_qty_error;?></small>
         </td>
         <!--there is a folder named PRODUCT_IMAGE add the images to the folder in file to store the images -->
      </tr>
       <tr>
         <td>Product Image</td>
          <td>
            <input class="" type="file" value="<?php echo $d['product_image']?>" name="filename" >
            <small class="text-danger"><?php echo  $product_img_error;?></small>
          </td>
      </tr>
      <tr>
        <td>Product Category</td>
        <td>
          <select name="pcategory"class="form-control">
            <?php
            $companies = $conn->query("select * from companies")->fetch_all(MYSQLI_ASSOC);
            foreach($companies as $company){ ?>
              <option value="<?php echo $company['name'] ?>"><?php echo $company['name'] ?></option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
         <td colspan="2" align="left"><input type="submit" name="submit" value="Add Product" class="btn btn-success"></td>
      </tr>
    </form>
    </table>
    </div>
  </div>
</div>
<?php
require 'includes/footer.php';
