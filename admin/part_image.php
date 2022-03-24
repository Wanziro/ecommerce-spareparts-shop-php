<?php
$msg = '';
include "admin_protect.php";
include "fxs.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Auto experts Rwanda</title>
    <link href="../css/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/croppie.css" />
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "sidebar.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "header.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">

                        <?php if (isset($_GET['edit'])) {
                            $s = "SELECT * FROM spare_parts WHERE id=" . $_GET['edit'] . "";
                            $stm = $conn->query($s);
                            if ($stm->rowCount() > 0) {
                        ?>
                                <div class="col-lg-12">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Change image for <?php echo get_part_name($_GET['edit']); ?></h6>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="id" id="partId" value="<?php echo $_GET['edit']; ?>">
                                            <input type="file" name="upload_image" id="upload_image" class="form-control mb-3">
                                            <div id="uploaded_image"></div>
                                        </div>
                                    </div>

                                </div>
                                <!--col-->

                            <?php
                            } else {
                                echo "Part with id of " . $_GET['edit'] . " does not exist.";
                            }
                            ?>
                        <?php
                        } ?>
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
        <script src="../js/croppie.js"></script>
</body>

</html>


<div id="uploadimageModal" class="modal" style="bottom: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="pull-left">
                    <h4 class="modal-title">Crop & Upload Image</h4>
                </div>
                <div class="pull-right">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo"></div>
                    </div>
                    <div class="col-md-4" align="center">
                        <button class="btn btn-success crop_image" id="uploadBtn">Save</button>
                        <div class="upload-main-container">
                            <div class="upload-details-row" align="left">
                                <div class="upload-details-status">&nbsp;</div>
                                <div class="upload-details-percentage">0%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 150,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload_image').on('change', function() {
            let fl = document.getElementById('upload_image');
            let c = document.getElementById('uploaded_image');
            let flp = fl.value;
            c.style.color = "red";
            let allowed = /(\.jpg|\.jpeg|\.png)$/i; //this is a list of supported image types
            if (!allowed.exec(flp)) {
                let ms = "Invalid file type. Try to select .jpg or .png image types.";
                //this is a message to show whenever user uploaded unsuported image
                $("#uploaded_image").html(ms);
                fl.value = "";
                return false;
            } else {
                $('.upload-main-container').hide();
                $('#okay').hide();
                $('#uploadBtn').show();
                let reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            }
        });

        $('.crop_image').click(function(event) {
            $('#uploadBtn').hide();
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'original'
            }).then(function(response) {
                $('.upload-main-container').show();
                let form_data = new FormData();
                form_data.append('image', response);
                form_data.append('id', $("#partId").val());

                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../images/uploads/image.php', true);
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        let percentComplete = (e.loaded / e.total) * 100;
                        percentComplete = Math.trunc(percentComplete);
                        $('.upload-details-percentage').html(percentComplete + '%');
                        $('.upload-details-status').css('width', percentComplete + '%');
                        if (percentComplete == 100) {
                            $('.upload-details-status').css('border-top-right-radius', '6px');
                            $('.upload-details-status').css('border-bottom-right-radius', '6px');
                        } else {
                            $('.upload-details-status').css('border-top-right-radius', '0px');
                            $('.upload-details-status').css('border-bottom-right-radius', '0px');
                        }

                    }
                };
                xhr.onload = function() {
                    $('#uploadimageModal').modal('hide');
                    $('#uploaded_image').html(xhr.response);
                    $('#okay').show();
                };
                xhr.send(form_data);
            })
        });

    });
</script>