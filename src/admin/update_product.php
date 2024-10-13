<?php
require 'includes/header.php';
require 'includes/topbar.php';
require 'includes/sidebar.php';

    $id = $_GET['id'];

           $query = "select * from products where id='{$id}'";
            $sql = mysqli_query($conn,$query) or die(mysqli_error($conn));
            $d = mysqli_fetch_array($sql);

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
          $filename=$d['product_image'];
    }
    else
    {
          $expensions= array("jpeg","jpg","png");
          if(in_array($file_ext,$expensions)=== false){
             $product_img_error="extension not allowed, please choose a JPEG or PNG file.";
             $error++;
          }
      }

      if ($error=='0') {

          $uq= "update products set product_name='{$product_name}',product_price='{$product_price}',product_qty='{$product_qty}',product_image='{$filename}',category_name='{$category_name}'  where id='{$id}' ";
          $n=  mysqli_query($conn, $uq) or die(mysqli_error($conn));
           if ($n)
            {
                if (!empty($filename)) {
                    $uploads_dir = '../uploads/';
                    move_uploaded_file($fileresorce,  $uploads_dir.$filename);
                }
                $_SESSION['success_message'] = 'Product updated!';
                header('location: ../admin/products.php');
            }
        }
}
?>
<div class="content-wrapper" style="width: 100%;">
  <div class="content-header">
  <h3>Manage Users</h3>
  <hr>
  </div>
  <div class="card-body">
    <div class="container ml-5">
      <table class="table">
        <form action="" method="post" enctype="multipart/form-data">
      <tr>
        <td>Product Name</td>
        <td>
          <input type="text"   value="<?php echo $d['product_name'] ?>" name="pnm" >
          <small class="text-danger pl-2"><?php echo  $product_error;?></small>
        </td>
      </tr>
      <tr>
        <td>Product Price</td>
        <td>
          <input type="number"  value="<?php echo $d['product_price'] ?>" name="pprice" >
          <small class="text-danger pl-2"><?php echo  $product_price_error;?></small>
        </td>
      </tr>
      <tr>
        <td>Product Quantity</td>
        <td>
          <input type="number"  name="pqty" value="<?php echo $d['product_qty'] ?>" >
          <small class="text-danger pl-2"><?php echo  $product_qty_error;?></small>
       </td>
         <!--there is a folder named PRODUCT_IMAGE add the images to the folder in file to store the images -->
      </tr>
      <tr>
        <td>Product Image</td>
        <td>
           <?php
             $product_image='';
               if(!empty($d['product_image'])){ ?>
                  <img src="<?php echo 'http://127.0.0.1/uploads/'.$d['product_image'] ?>" height="80px">
            <?php } ?>
         </td>
       </tr>
       <tr>
          <td>Upload new image </td>
          <td>
            <input class="" type="file" value="<?php echo $d['product_image']?>" name="filename" >
            <?php echo $product_img_error;?><br/>
          </td>
      </tr>
      <tr>
        <td>Product Category</td>
        <td>
          <select name="pcategory"class="form-control">
          <option <?php if ($d['category_name']=="Toyota"){echo "selected";}?>>Toyota</option>
          <option <?php if ($d['category_name']=="BMW"){echo "selected";}?>>BMW</option>
          <option <?php if ($d['category_name']=="Honda"){echo "selected";}?>>Honda</option>
          <option <?php if ($d['category_name']=="Chevrolet"){echo "selected";}?>>Chevrolet</option>
          <option <?php if ($d['category_name']=="Jeep"){echo "selected";}?>>Jeep</option>
          <option <?php if ($d['category_name']=="Nissan"){echo "selected";}?>>Nissan</option>
          <option <?php if ($d['category_name']=="Volvo"){echo "selected";}?>>Volvo</option>
        </select>
        </td>
      </tr>
      <tr>
         <td colspan="2" align="left"><input type="submit" name="submit" value="Update" class="btn btn-success"></td>
      </tr>
    </form>
    </table>
    </div>
  </div>
</div>
