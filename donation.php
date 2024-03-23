<?php include 'header.php';?>
<?php error_reporting(0);ini_set('display_errors', 0); if(session_status()==PHP_SESSION_NONE) session_start();
$AccountName = $_SESSION['AccountName'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Donation</title>
</head>
<div class="pagebg1" style="padding:0px 0px 50px;">
<?php if (isset($_SESSION["AccountID"])) {
                if (isset($_SESSION['AccountID'] )) {
                echo '<!-- Display Account Credentials before donation! -->
                <div  class="wow fadeIn" style="padding-top: 100px; ">
                <div class="test"><center><span style = "font-size: 25px;"><b>Account Verified</b></div></font>
                ';
                echo "<b>";
                echo  '<center><input style="background: rgba(0,0,0,0.5); color:green;text-align:center;" type="text" value="'.$AccountName.'"></input>';
                echo "</b>";
                }else{
                echo '<!-- IF THE USER IS NOT LOGGED ON THEN DISPLAY THE FOLLOWING -->
                <div role="main" class="container" style="padding-top: 100px;">
                <div class="test"><center><font color="red">Account Verification has failed. Please login!</div></font>
                ';
                echo '<center><input style= "background: rgba(0,0,0,0.5); color:red;" readonly= "readonly" type="text" value="Unable to identify account!"></input>';    
                }
                ?>
    <div class="wow fadeIn" data-wow-delay="0.01s" style="background: rgba(0,0,0,0.5); border-radius: 20px; padding: 15px;color: #f1f0e9;margin:70px 25px 25px;box-shadow: 0px 0px 9px white;width:75%;"> 
    <h1>Rates: 1€ = 2000 Origin Cash</h1> 
    <br>

    <div id="smart-button-container">
    <div style="text-align: center; color: green;"><label for="description">Paypal Note: </label><input style = " background-color: #161711;" type="read" name="descriptionInput" id="description" maxlength="127" value="Donation for Origin Cash"></div>
      <p id="descriptionError" style="visibility: hidden; color:green; text-align: center;">Please enter a description</p>
    <div style="text-align: center; color: green;"><label for="amount">Donation Amount €: </label><input style = " background-color: #161711;" name="amountInput" type="number" id="amount" value="" ></div>
      <p id="priceLabelError" style="visibility: hidden; color:green; text-align: center;">Please enter a price</p>
    <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
      <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
    <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
  </div>
  <script src="https://www.paypal.com/sdk/js?client-id=AcT2uc2ud2Jbd0uTM8FMbRSUOxApcdVDoTvGo3DeGgkAiNDJuXHwSufUhpL82P-DNNWfX_oMTQHE9WdD&currency=EUR" data-sdk-integration-source="button-factory"></script>
  <script>
  function initPayPalButton() {
    var description = document.querySelector('#smart-button-container #description');
    var amount = document.querySelector('#smart-button-container #amount');
    var descriptionError = document.querySelector('#smart-button-container #descriptionError');
    var priceError = document.querySelector('#smart-button-container #priceLabelError');
    var invoiceid = document.querySelector('#smart-button-container #invoiceid');
    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

    var elArr = [description, amount];

    if (invoiceidDiv.firstChild.innerHTML.length > 1) {
      invoiceidDiv.style.display = "block";
    }

    var purchase_units = [];
    purchase_units[0] = {};
    purchase_units[0].amount = {};

    function validate(event) {
      return event.value.length > 0;
    }

    paypal.Buttons({
      style: {
        color: 'gold',
        shape: 'rect',
        label: 'paypal',
        layout: 'vertical',
        
      },

      onInit: function (data, actions) {
        actions.disable();

        if(invoiceidDiv.style.display === "block") {
          elArr.push(invoiceid);
        }

        elArr.forEach(function (item) {
          item.addEventListener('keyup', function (event) {
            var result = elArr.every(validate);
            if (result) {
              actions.enable();
            } else {
              actions.disable();
            }
          });
        });
      },

      onClick: function () {
        if (description.value.length < 1) {
          descriptionError.style.visibility = "visible";
        } else {
          descriptionError.style.visibility = "hidden";
        }

        if (amount.value.length < 1) {
          priceError.style.visibility = "visible";
        } else {
          priceError.style.visibility = "hidden";
        }

        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
          invoiceidError.style.visibility = "visible";
        } else {
          invoiceidError.style.visibility = "hidden";
        }

        purchase_units[0].description = description.value;
        purchase_units[0].amount.value = amount.value;

        if(invoiceid.value !== '') {
          purchase_units[0].invoice_id = invoiceid.value;
        }
      },

      createOrder: function(data, actions) {
   return actions.order.create({
      purchase_units: [{
         custom_id: '<?PHP echo $AccountName; ?>',
         amount: {
            value: amount.value
         }
      }]
   });
},

      onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
          alert('Transaction completed by ' + details.payer.name.given_name + '! Please check your game account for the Origin Cash! :)');
        });
      },

      onError: function (err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
  </script>
    
<?php 
if(isset($_SESSION['AccountName'])) 
{
  $AccountName = $_SESSION['AccountName'];
  $AccountID = $_SESSION['AccountID'];
  if(strcmp($AccountName, 'miftahul192') == 0)
  {
    echo "<script>location.href='failed.php'</script>";
    exit();
  }
  if(strcmp($AccountName, 'RuneScape') == 0)
  {
    echo "<script>location.href='failed.php'</script>";
    exit();
  }
} 
}else 
{
  echo "<script>location.href='failed.php'</script>";
  exit();
}
?>
        
        
    <!-- Miscellaneous Info -->
    <div class="container">
    

	</div>
    </div>
                
</html>

<?php include 'footer.php';?>