<?php
$msg= '';
include"admin_protect.php";
include"fxs.php";
function check_if_vehicle_exists($name,$category,$mark,$model,$fuel,$engine){
  include"admin_protect.php";
  $sql = "SELECT * FROM spare_part_categories WHERE name='$name' AND vehicle_category='$category' AND vehicle_mark='$mark' AND vehicle_model='$model' AND fuel='$fuel' AND engine_type='$engine'";
  $statement = $conn->query($sql);
  if($statement->rowCount() > 0){
    return true;
  }else{
    return false;
  }
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sqlx = "SELECT * FROM spare_part_categories where id='$id'";
    $statementx = $conn->query($sqlx);
    if($statementx->rowCount() == 1){
      while (($rw = $statementx->fetch(PDO::FETCH_ASSOC)) !== false) {
          $name = $rw['name'];
          $sql2 = "DELETE FROM spare_part_categories WHERE id='$id'";
          $statement = $conn->query($sql2);

          //delete all spare_parts
          $sql5 = "DELETE FROM spare_parts WHERE engine='$name'";
          $statement = $conn->query($sql5);
          }
      }
}
if(isset($_POST['save'])){
  $folder="../images/uploads/";
  $name = $_POST['names'];
  $category = $_POST['v_category'];
  $mark = $_POST['mark'];
  $model = $_POST['model'];
  $fuel = $_POST['fuel'];
  $engine = $_POST['engine'];
  //image_upload
  $image_upload = $_FILES['image_upload']['name'];
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

  if($name != '' && $category != "" && $mark != ""){
    if(check_if_vehicle_exists($name,$category,$mark,$model,$fuel,$engine)){
      $msg = "<div class='alert alert-danger'>Engine '$name' already exists. Try to register other new engines.</div>";
    }else if(!check_image_format($image_upload_type)){
      $msg = "<div class='alert alert-danger'>Invalid file type. supported file types are .gif, .png and .jpg</div>";
    }else{
      if(move_uploaded_file($image_upload_loc,$folder.$random_image_upload)){
        $sql = "INSERT INTO spare_part_categories(name,vehicle_category,vehicle_mark,vehicle_model,fuel,engine_type,image) VALUES (?,?,?,?,?,?,?)";
        $statement = $conn->prepare($sql);
        $statement->execute(array($name,$category,$mark,$model,$fuel,$engine,$random_image_upload));
        $msg = '';
      }else{
        $msg = "<div class='alert alert-danger'>Failed to upload your image. try again later.</div>";
      }
    }
  }else{
    $msg = "<div class='alert alert-danger'>All field are required!.</div>";
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
            <?php
            $sql = "SELECT * FROM spare_part_categories ORDER BY id DESC";
            $statement = $conn->query($sql);
            if($statement->rowCount() > 0){
                ?>
                <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Spare part categories in the system</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Engine Type</th>
                    <th>Fuel</th>
                    <th>Model</th>
                    <th>Mark</th>
                    <th>Vehicle Category</th>
                    <th>Action</th>
                </tr>
                <?php
                while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $category = $row['vehicle_category'];
                    $model = $row['vehicle_model'];
                    $mark = $row['vehicle_mark'];
                    $fuel = $row['fuel'];
                    $engine = $row['engine_type'];
                    $image = $row['image'];
                    echo"
                    <tr>
                      <td><img src='../images/uploads/$image' class='vehicle-image'></td>
                      <td>$name</td>
                      <td>$engine</td>
                      <td>$fuel</td>
                      <td>$model</td>
                      <td>$mark</td>
                      <td>$category</td>
                    <td>";
                    ?>
                        <!-- <a href="edit_fuels.php?edit=<?php echo $id;?>">
                          <button class='btn btn-primary'><i class='fa fa-edit'></i> Edit</button>
                        </a> -->
                        <a href="spare_parts_categories.php?delete=<?php echo $id;?>" onclick="return confirm('Do want to delete this Category?\nAll data related to this vehicle will also be deleted')">
                            <button class='btn btn-danger'><i class='fa fa-delete'></i> Delete</button>
                        </a>
                    <?php echo"</td>
                    ";
                }
                ?>
                </table>
                </div>
                </div>
                </div>
                </div>
        
                <?php
            }else{echo'<div class="col-xl-12 col-lg-12"><h2>No Categories Found</h2><br></div>';}
            ?>  
            
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Register New category</h6>
                </div>
                <div class="card-body">
                  <?php echo $msg;?>
                  <form method="post" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="names" class="form-control" placeholder="Enter Category name" required>
                    </div>
                    <div class="form-group">
                      <label>Vehicle Category</label>
                      <select name="v_category" class="form-control" id="vCategory" onchange="getMarks(this)" required>
                          <?php get_all_vehicles();?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Vehicle Mark</label>
                      <select name="mark" id="allMarks" class="form-control" required onchange="getModels(this)"></select>
                    </div>
                    <div class="form-group">
                      <label>Vehicle Model</label>
                      <select name="model" id="allModels" onchange="getFuels(this)" class="form-control" required></select>
                    </div>

                    <div class="form-group">
                      <label>Fuel</label>
                      <select name="fuel" id="allFuels" onchange="getEngines(this)" class="form-control" required></select>
                    </div>

                    <div class="form-group">
                      <label>Engine type</label>
                      <select name="engine" id="allEngines" class="form-control" required></select>
                    </div>

                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" name="image_upload" class="form-control">
                    </div>
                    
                    <button type="submit" name="save" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
          
            </div><!--col-->
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
  <script>
    function getMarks(v){
      $.ajax({
        url: "../ajax.php",
        method:"POST",
        data: {getVehicleMarks:1,vehicle:v.value},
        success: data => {
          $("#allMarks").html(data)
        }
      })
    }
    function getModels(v){
      $.ajax({
        url: "../ajax.php",
        method:"POST",
        data: {getVehicleModels:1,vehicleMark:v.value,vehicle:$("#vCategory").val()},
        success: data => {
          $("#allModels").html(data)
        }
      })
    }
    function getFuels(v){
      $.ajax({
        url: "../ajax.php",
        method:"POST",
        data: {getVehicleFuels:1,vehicleModel:v.value,vehicleMark:$("#allMarks").val(),vehicle:$("#vCategory").val()},
        success: data => {
          $("#allFuels").html(data)
        }
      })
    }
    function getEngines(v){
      $.ajax({
        url: "../ajax.php",
        method:"POST",
        data: {getVehicleEngineType:1,vehicleFuel:v.value,vehicleModel:$("#allModels").val(),vehicleMark:$("#allMarks").val(),vehicle:$("#vCategory").val()},
        success: data => {
          $("#allEngines").html(data)
        }
      })
    }
  </script>

</body>

</html>
