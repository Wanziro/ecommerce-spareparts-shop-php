<?php
include "../../connect.php";
if (isset($_POST["image"])) {
	$data = $_POST["image"];
	$partId = $_POST['id'];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = time() . '.png';
	if (file_put_contents($imageName, $data)) {
		$q = mysqli_query($conn2, "select * from spare_parts where id='$partId'");
		if (mysqli_num_rows($q) == 1) {
			while ($row = mysqli_fetch_assoc($q)) {
				$img = $row['image'];
				if (trim($img) != '') {
					if (file_exists($img)) {
						unlink($img);
					}
				}
				$qq = mysqli_query($conn2, "update spare_parts set image='$imageName' where id='$partId'");
				if ($qq) {
					echo '
					<div class="row">
						<div class="col-md-6">
							<img src="../images/uploads/' . $imageName . '" class="img-thumbnail" />
						</div>
						<div class="col-md-6">
							<div class="alert alert-success mb-3">Image uploaded successfull.</div>
							<a href="spare_parts.php">
								<button class="btn btn-primary">Go back.</button>
							</a>
						</div>
					</div>
					';
				} else {
					unlink($imageName);
					echo "<div class='alert alert-danger'>Something went wrong, try again later.</div>";
				}
			}
		} else {
			unlink($imageName);
			echo "<div class='alert alert-danger'>Something went wrong, try again later.</div>";
		}
	} else {
		echo "<div class='alert alert-danger'>Failed to update your profile. Try again later after sometime.</div>";
	}
}//isset
