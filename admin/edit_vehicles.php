<?php
$msg= '';
include"admin_protect.php";
include"fxs.php";
function get_old_vehicle_name($id){
    include"admin_protect.php";
    $sql = "SELECT * FROM vehicle_categories WHERE id='$id'";
    $statement = $conn->query($sql);
    $result = '';
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['name'];
        }
    }
    return $result;
}
function check_if_vehicle_exists($name){
  include"admin_protect.php";
  $sql = "SELECT * FROM vehicle_categories WHERE name='$name'";
  $statement = $conn->query($sql);
  $amount = 0;
  if($statement->rowCount() == 1){
    return true;
  }else{
    return false;
  }
}
if(isset($_POST['edit'])){
  $folder="../images/uploads/";
  $name = $_POST['names'];
  $id = $_POST['id'];
  $oldName = get_old_vehicle_name($id);
  //image_upload
  $image_upload = $_FILES['image_upload']['name'];
  if($image_upload == ''){
    if(check_if_vehicle_exists($name)){
        $msg = "<div class='alert alert-danger'>The name already exists. try to edit with different vehicle name </div>";
    }else if($name == '' || $id == ''){
        $msg = "<div class='alert alert-danger'>Please provide the vehicle name</div>";
    }else{
        //update the data
        $up = "UPDATE vehicle_categories SET name='$name' WHERE id = '$id'";
        $statement = $conn->query($up);

        $up = "UPDATE vehicle_model SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
        $statement = $conn->query($up);

        $up = "UPDATE vehicle_marks SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
        $statement = $conn->query($up);

        $up = "UPDATE spare_part_categories SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
        $statement = $conn->query($up);

        $up = "UPDATE spare_parts SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
        $statement = $conn->query($up);

        $up = "UPDATE fuel SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
        $statement = $conn->query($up);

        $up = "UPDATE engine_type SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
        $statement = $conn->query($up);

        header("Location: vehicles.php");
    }
  }else{
    $image_upload_loc = $_FILES['image_upload']['tmp_name'];
    $image_upload_size = $_FILES['image_upload']['size'];
    $image_upload_type = $_FILES['image_upload']['type'];
    $temp1= explode(".", $_FILES["image_upload"]["name"]);
    $newfn1= round(microtime(true)) . end($temp1);
  
    //file size in KB
    $image_upload_file_size = $image_upload_size/1024;  
  
    // make file name in lower case
    $new_file_name1 = strtolower($newfn1);
    $new_file1 = strtolower($image_upload);
    // make file name in lower case
    $random_image_upload = str_replace(' ','-',$new_file_name1);
  
    if($name != '' && $image_upload != "" && $id !=""){
        $name_exists = false;
      if(check_if_vehicle_exists($name)){
        $name_exists = true;
      }
      if(!check_image_format($image_upload_type)){
        $msg = "<div class='alert alert-danger'>Invalid file type. supported file types are .gif, .png and .jpg</div>";
      }else{
        if(move_uploaded_file($image_upload_loc,$folder.$random_image_upload)){
            //update the data
            if($name_exists){
                $up = "UPDATE vehicle_categories SET image='$random_image_upload' WHERE id = '$id'";
                $statement = $conn->query($up);
            }else{
                $up = "UPDATE vehicle_categories SET name='$name',image='$random_image_upload' WHERE id = '$id'";
                $statement = $conn->query($up);
            }
    
            $up = "UPDATE vehicle_model SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
            $statement = $conn->query($up);
    
            $up = "UPDATE vehicle_marks SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
            $statement = $conn->query($up);
    
            $up = "UPDATE spare_part_categories SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
            $statement = $conn->query($up);
    
            $up = "UPDATE spare_parts SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
            $statement = $conn->query($up);
    
            $up = "UPDATE fuel SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
            $statement = $conn->query($up);
    
            $up = "UPDATE engine_type SET vehicle_category='$name' WHERE vehicle_category = '$oldName'";
            $statement = $conn->query($up);

            header("Location: vehicles.php");
        }else{
          $msg = "<div class='alert alert-danger'>Failed to upload your image. Try again later.</div>";
        }
      }
    }else{
      $msg = "<div class='alert alert-danger'>All field are required!.</div>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>eCommerce Project</title>

  <!-- <link rel="stylesheet" href="../css/font-awesome.min.css" /> -->
  <link href="../css/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../css/admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include"sidebar.php";?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include"header.php";?>

        <!-- Begin Page Content -->
        <div class="container-fluid">       
          <!-- Content Row -->
          <div class="row">
            
            <?php if(isset($_GET['edit'])){
                $s = "SELECT * FROM vehicle_categories WHERE id=".$_GET['edit']."";
                $stm = $conn->query($s);
                if($stm->rowCount() > 0){
                    while (($row = $stm->fetch(PDO::FETCH_ASSOC)) !== false) {
                        $name = $row['name'];
                        ?>
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Vehicles / Edit / <?php echo $_GET['edit'];?></h6>
                                </div>
                                <div class="card-body">
                                <?php echo $msg;?>
                                <form method="post" action="#" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
                                    <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="names" class="form-control" value="<?php echo $name;?>" placeholder="Enter vehicle name" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Image <font color="red">(Leave this as empty if you dont want to change current vehicle image)</font></label>
                                    <input type="file" name="image_upload" class="form-control">
                                    </div>
                                    <button type="submit" name="edit" class="btn btn-primary">Submit changes</button>
                                </form>
                                </div>
                            </div>
                        
                            </div><!--col-->
                        
                        <?php
                    }
                }else{
                    echo"Vehicle with id of ".$_GET['edit']." does not exist.";
                }
                ?>
                <?php
            }?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>

  <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

  <script src="../js/jquery.easing.min.js"></script>
  <script src="../js/admin.js"></script>

</body>

</html>
