<?php include"connect.php";
include"fxs.php";
if(!isset($_SESSION['username'])){
  header("Location: login_register.php");
}else{
$sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
  $statement = $conn->query($sql);
  if($statement->rowCount() == 1){
      while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $username = $row['username'];  
        echo"
        <input type='hidden' value='".$fname."' id='userFname'>
        <input type='hidden' value='".$lname."' id='userLname'>
        <input type='hidden' value='".$email."' id='userEmail'>
        <input type='hidden' value='".$username."' id='userUsername'>
        ";     
      }
  }else{
    header("Location: login_register.php");
  }
  function get_latest_address(){
    include"connect.php";
    $latest_address = '';
    $sql = "SELECT * FROM shipping_info WHERE username='".$_SESSION['username']."' ORDER BY id ASC";
    $statement = $conn->query($sql);
    if($statement->rowCount() > 0){
      while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $latest_address = $row['address'];   
      }
    }
    echo $latest_address;
  }
  function get_latest_province(){
    include"connect.php";
    $latest_address = '';
    $sql = "SELECT * FROM shipping_info WHERE username='".$_SESSION['username']."' ORDER BY id ASC";
    $statement = $conn->query($sql);
    if($statement->rowCount() > 0){
      while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $latest_address = $row['province'];   
      }
    }
    echo $latest_address;
  }
  function get_latest_email(){
    include"connect.php";
    $latest_address = '';
    $sql = "SELECT * FROM shipping_info WHERE username='".$_SESSION['username']."' ORDER BY id ASC";
    $statement = $conn->query($sql);
    if($statement->rowCount() > 0){
      while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $latest_address = $row['email'];   
      }
    }else{
      $sql = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
      $statement = $conn->query($sql);
      if($statement->rowCount() == 1){
          while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
            $latest_address = $row['email'];     
          }
      }
    }
    echo $latest_address;
  }
  function get_latest_phone(){
    include"connect.php";
    $latest_address = '';
    $sql = "SELECT * FROM shipping_info WHERE username='".$_SESSION['username']."' ORDER BY id ASC";
    $statement = $conn->query($sql);
    if($statement->rowCount() > 0){
      while (($row = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
        $latest_address = $row['phone'];   
      }
    }
    echo $latest_address;
  }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>KAS LTD Online</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/fontawesome-stars.css" />
    <link rel="stylesheet" href="css/meanmenu.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/slick.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/jquery-ui.min.css" />
    <link rel="stylesheet" href="css/venobox.css" />
    <link rel="stylesheet" href="css/nice-select.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/helper.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
  </head>
  <body>
    <div class="body-wrapper">
      <?php include"header.php";?>
      <div class="checkout-area pt-60 pb-30">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-12">
              <form id="billingInfoForm">
              <script src="https://checkout.flutterwave.com/v3.js"></script>
                <div class="checkbox-form">
                  <h3>Billing Details</h3>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="country-select clearfix">
                        <label>Country <span class="required">*</span></label>
                        <select class="nice-select wide">
                          <option data-display="Rwanda">Rwanda</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-form-list">
                        <label
                          >First Name <span class="required">*</span></label
                        >
                        <input placeholder="Enter your first name" id="fname" required value="<?php echo $fname;?>" type="text" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-form-list">
                        <label>Last Name <span class="required">*</span></label>
                        <input placeholder="Enter your last name" id="lname" required value="<?php echo $lname;?>" type="text" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="checkout-form-list">
                        <label>Address <span class="required">*</span></label>
                        <input placeholder="Enter your address" id="address" required value="<?php get_latest_address();?>" type="text" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-form-list">
                        <label
                          >Province <span class="required">*</span></label
                        >
                        <select id="province" onchange="calculateDeliveryFee()">
                          <option value="<?php get_latest_province();?>"><?php get_latest_province();?></option>
                          <option value="Kigali City">Kigali City</option>
                          <option value="Northern Province">Northern Province</option>
                          <option value="Southern Province">Southern Province</option>
                          <option value="Eastern Province">Eastern Province</option>
                          <option value="Western Province">Western Province</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-form-list">
                        <label
                          >Delivery Fee <span class="required">*</span></label
                        >
                        <input type="text" id="deliveryFee" disabled="true" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-form-list">
                        <label
                          >Email Address <span class="required">*</span></label
                        >
                        <input placeholder="Enter your email address here" required id="email" value="<?php get_latest_email();?>"  type="email" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="checkout-form-list">
                        <label>Phone <span class="required">*</span></label>
                        <input type="text" pattern="07[8,2,3]{1}[0-9]{7}" title="Invalid Phone (MTN or Airtel-tigo phone number)" placeholder="Ex: 078............" id="phone" value="<?php get_latest_phone();?>" maxlength="10" required/>
                      </div>
                    </div>
                  </div>
                </div>
                <input style="opacity:0" type="submit" value="Submit" id="submitBtn">
              </form>
            </div>
            <div class="col-lg-6 col-12">
              <div class="your-order">
                <h3>Your order</h3>
                <div class="your-order-table table-responsive">
                  <div id="checkListItems"></div>
                </div>
                <div class="payment-method mt-0">
                  <div class="payment-accordion">
                    <b>Steps to follow:</b>
                    <ol type="1">
                      <li>Check/update your billing info on this page.</li>
                      <li>Click Place order button bellow</li>
                      <li>Enter the phone number where the money will come from</li>
                      <li>Click Pay button</li>
                      <li>Enter the OTP code sent to the provided phone number and click verify. (this is for security reasons and spam prevention)</li>
                      <li>Confirm the payment on your phone.</li>
                    </ol>
                    <div class="order-button-payment">
                      <input value="Place order" type="button" onclick="submitForm()" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include"footer.php";?>
    </div>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/jquery.meanmenu.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.mixitup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.barrating.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/venobox.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/scrollUp.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      $(document).ready(()=>{
        $.ajax({
          method: 'post',
          url:'ajax.php',
          data:{getCheckoutList:1},
          success:data=>{
            $("#checkListItems").html(data)
          }
        });
        $("#billingInfoForm").submit(e=>{
          e.preventDefault();
          $("input, select, option, textarea", "#billingInfoForm"). prop('disabled',true); 
          let totalAmountToPay = $('#totalAmountToPay').val();
          let fname = $('#userFname').val();
          let lname = $('#userLname').val();
          let email = $('#userEmail').val();
          let username = $('#userUsername').val();

          let formFname = $("#fname").val();
          let formLname = $("#lname").val();
          let formProvince = $("#province").val();
          let formEmail = $("#email").val();
          let formPhone = $("#phone").val();
          let formAddress = $("#address").val();

          FlutterwaveCheckout({
          public_key: "FLWPUBK-0123e0c6266b1b6640283d1954fd7484-X",
          tx_ref: "RX1",
          amount: totalAmountToPay,
          currency: "RWF",
          country: "RW",
          payment_options: "mobilemoneyrwanda",
          customer: {
            email: email,
            phone_number: formPhone,
            name: fname +" "+ lname,
          },
          callback: function (res) { // specified callback function
            console.log(res);
            // alert(data)
            if(res.status === "successful"){
              //save invoice
              $.ajax({
                url: "ajax.php",
                method: "POST",
                data: { saveInvoice: 1,tx_id:res.transaction_id,tx_ref:res.flw_ref,amount:res.amount },
                success:(data)=>{
                  //save shipping info
                  $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: { saveShippingInfo: 1,fname: formFname,lname:formLname,province:formProvince,address:formAddress,email:formEmail,phone:formPhone,tx_id:res.transaction_id},
                    success: data => {
                      window.location = 'success.php';
                    }
                  })
                }
              })
            }
          },
          customizations: {
            title: "KAS LTD Online",
            description: "Payment for all items in the cart",
            logo: "http://localhost/ecommerce/images/tyre.jpg",
          },
        });
        })
      })
      const submitForm = () => {
        $("#submitBtn").click();
      }
      const calculateDeliveryFee = () => {
        if($("#province").val() == "Kigali City"){
          $("#deliveryFee").val('1000 RWF')
          $("#deliveryString").text('1000 RWF')
          let y = $("#currentPrice").val();
          let x = parseInt(y, 10) + 1000;
          $("#totalAmountToPay").val(x)
          $("#amountString").text(x + ' RWF')
        }else{
          $("#deliveryFee").val('2500 RWF')
          let y = $("#currentPrice").val();
          let x = parseInt(y, 10) + 2500;
          $("#totalAmountToPay").val(x)
          $("#deliveryString").text('2500 RWF')
          $("#amountString").text(x + ' RWF')
        }
      }
    </script>
  </body>

  <!-- checkout31:27-->
</html>
