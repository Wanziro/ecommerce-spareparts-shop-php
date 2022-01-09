<?php
$msg= '';
include"admin_protect.php";
include"fxs.php";
function get_old_des($id){
    include"admin_protect.php";
    $sql = "SELECT * FROM spare_parts WHERE id='$id'";
    $statement = $conn->query($sql);
    $result = '';
    if($statement->rowCount() == 1){
        while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result = $row['description'];
        }
    }
    return $result;
}
if(isset($_POST['save'])){
    $id = $_POST['id'];
    $description = $_POST['description'];
    $name = $_POST['name'];
    $cc =  "<div><div>$name</div><div>$description</div></div>,";
    $new_des = get_old_des($id) .''. $cc;
    $sql = "UPDATE spare_parts set description=? where id='$id'";
    $statement = $conn->prepare($sql);
    $statement->execute(array($new_des));
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
  <style>
      .descriptions > div {
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 10px;
          border-bottom: 1px solid #ccc;
      }
  </style>

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
            
            <?php if(isset($_GET['product'])){
                $s = "SELECT * FROM spare_parts WHERE id=".$_GET['product']."";
                $stm = $conn->query($s);
                if($stm->rowCount() > 0){
                    while (($row = $stm->fetch(PDO::FETCH_ASSOC)) !== false) {
                        $name = $row['name'];
                        $part_number = $row['part_number'];
                        $description = $row['description'];
                        $description = str_replace(">,",">",$description);
                        ?>
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Description for <?php echo"$name - $part_number";?></h6>
                                </div>
                                <div class="card-body">
                                   <div class="descriptions">
                                       <?php echo $description;?>
                                   </div>
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
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add more details to the product</h6>
                    </div>
                    <div class="card-body">
                    <form method="post" action="#" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $_GET['product'];?>">
                        <div class="form-group">
                            <label>Detail Name</label>
                            <div class="form-control">
                                <input type="text" name="name"  class="form-control" required placeholder="Ex: Size">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div class="form-control">
                                <input type="text" class="form-control" name="description" required placeholder="Ex: 23 mm">
                            </div>
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
      $(document).ready(()=>{
        setTimeout(()=> {
            getMarks(document.getElementById("vCategory"));
            setTimeout(() => {
                $.ajax({
                    url: "../ajax.php",
                    method:"POST",
                    data: {getVehicleModels:1,vehicleMark:$("#allMarks").val(),vehicle:$("#vCategory").val()},
                    success: data => {
                    $("#allModels").html(data)
                    }
                });          
            }, 500);
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
  </script>

</body>

</html>
