<?php
$msg= '';
include"admin_protect.php";
include"fxs.php";
function get_old_vehicle_name($id){
    include"admin_protect.php";
    $sql = "SELECT * FROM vehicle_model WHERE name='$id'";
    $statement = $conn->query($sql);
    $result = '';
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['name'];
        }
    }
    return $result;
}
function check_if_vehicle_exists($name,$category,$mark){
    include"admin_protect.php";
    $sql = "SELECT * FROM vehicle_model WHERE name='$name' AND vehicle_category='$category' AND vehicle_mark='$mark'";
    $statement = $conn->query($sql);
    if($statement->rowCount() > 0){
      return true;
    }else{
      return false;
    }
  }
if(isset($_POST['editt'])){
  $name = $_POST['names'];
  $id = $_POST['id'];
  $mark = $_POST['mark'];
  $category = $_POST['category'];
  $oldName = get_old_vehicle_name($id);
    if(check_if_vehicle_exists($name,$category,$mark)){
        $msg = "<div class='alert alert-danger'>The name already exists. Try to edit with different vehicle name </div>";
    }else if($name == '' || $id == '' || $mark == ''){
        $msg = "<div class='alert alert-danger'>All fields are required. Fill them correctly.</div>";
    }else{
        //update the data
        $up = "UPDATE vehicle_model SET name='$name',vehicle_category='$category',vehicle_mark='$mark' WHERE id = '$id'";
        $statement = $conn->query($up);

        $up = "UPDATE spare_part_categories SET vehicle_model='$name' WHERE vehicle_model = '$oldName'";
        $statement = $conn->query($up);

        $up = "UPDATE spare_parts SET vehicle_model='$name' WHERE vehicle_model = '$oldName'";
        $statement = $conn->query($up);

        $up = "UPDATE fuel SET vehicle_model='$name' WHERE vehicle_model = '$oldName'";
        $statement = $conn->query($up);

        $up = "UPDATE engine_type SET vehicle_model='$name' WHERE vehicle_model = '$oldName'";
        $statement = $conn->query($up);

        header("Location: v_models.php");
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
                $s = "SELECT * FROM vehicle_model WHERE id=".$_GET['edit']."";
                $stm = $conn->query($s);
                if($stm->rowCount() > 0){
                    while (($row = $stm->fetch(PDO::FETCH_ASSOC)) !== false) {
                        $name = $row['name'];
                        $category = $row['vehicle_category'];
                        ?>
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Vehicle Models / Edit / <?php echo $_GET['edit'];?></h6>
                                </div>
                                <div class="card-body">
                                <?php echo $msg;?>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
                                    <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="names" class="form-control" value="<?php echo $name;?>" placeholder="Enter vehicle name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Vehicle Category</label>
                                        <select name="category" class="form-control" id="vCategory" onchange="getMarks(this)" required>
                                            <?php get_all_vehicles();?>
                                            <option selected value="<?php echo $category?>"><?php echo $category?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Vehicle Mark</label>
                                        <select name="mark" id="allMarks" class="form-control" required>
                                        </select>
                                    </div>
                                    <button type="submit" name="editt" class="btn btn-primary">Submit changes</button>
                                </form>
                                </div>
                            </div>
                        
                            </div><!--col-->
                        
                        <?php
                    }
                }else{
                    echo"Vehicle Model with id of ".$_GET['edit']." does not exist.";
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
  <script>
      $(document).ready(()=>{
        setTimeout(()=> {
            getMarks(document.getElementById("vCategory"))
        },1000)
      })
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
  </script>

</body>

</html>
