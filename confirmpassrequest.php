<?php
// SET GET Variables to custom params
$accountName = $_GET["accountName"];
$token = $_GET["token"];
?>

<script>
    function validateForm()
    {
        var valid = true;
        var errorMsg = "Error !";
        var newPass = document.forms["myForm"]["NewPassword"].value;
        var confirmNewPass = document.forms["myForm"]["ConfirmNewPassword"].value;
        if(newPass != confirmNewPass)
        {
            valid = false;
            errorMsg = "Password mismatch !"
        }
            
        if(newPass.length < 4)
        {
            valid = false;
            errorMsg = "Password must have atleast 4 characters !"
        }
        if(!valid)
        {
            alert(errorMsg);
        }
        return valid;
    }
</script>

<div class = "pagebg1" class="wow fadeIn" data-wow-delay="1s" style="display: flex;justify-content: center;align-items: center;" >
    <form class="box" name="myForm" action="recoverpass" onsubmit="return validateForm()" method="post" enctype="multipart/form-data" autocomplete = "off">
        <h1>Change password</h1>
        <div class="footer-divider" style="margin-top:1%"></div>
        <div class="container">
            <h3>New password</h3>
            <input type="password" name="NewPassword" placeholder="Enter your new password" required>
            <h3>Confirm New password</h3>
            <input type="password" name="ConfirmNewPassword" placeholder="Confirm password" required>
            <input type="hidden" name="token" value=<?php echo $token;?>>
            <input type="hidden" name="accountName" value=<?php echo $accountName;?>>
            <input type="submit" value="Change" name = "Change">
            <button data-dismiss="modal" type ="CANCEL" class="cncl">Cancel</button>
        </div>
    </form>
</div>

<style type="text/css">

.modal-content {background: transparent;}
.box{


min-height: 1000px;


}
.box h1{
    color: white;
    text-transform: uppercase;
    font-weight: 750;
    font-size: 25px;
    margin-top: 15%;
    text-align: center;
    text-transform:uppercase; 
    text-shadow: 0px 0px 9px white;
}
.box h2{
    color: white;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 15px;
    margin-top: 1%;
    text-align: center;
}
    .box h3{
    color: white;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 15px;
    margin-top: 0%;
    text-align: center;
}
.box input[type = "text"],.box input[type = "password"],.box input[type = "email"]{
    border:0;
    background: rgba(0, 0, 0, 0.3);
    display: block;
    margin: 2px auto 20px;
    text-align: center;
    border: 1px solid gold;
    padding: 8px 0px;
    width: 50%;
    outline: none;
    color: white;
    transition: 0.25s;
}
.box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "email"]:focus{

    border-color: orange;
}
.box input[type = "submit"]{
    border:0;
    background: rgba(0, 0, 0, 0.3);
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 1px solid cyan;
    padding: 8px 10px;
    width: 50%;
    outline: none;
    color: white;
    transition: 0.25s;
    display: block;
    text-transform: uppercase;
}
.box input[type = "submit"]:hover{
    background: rgba(0, 0, 0, 0.7);
    color: black;
}

.cncl {
    border:0;
    background: rgba(0, 0, 0, 0.1);
    display: block;
    margin: 20px auto 0;
    text-align: center;
    text-transform: uppercase;
    padding: 10px 10px;
    width: 50%;
    outline: none;
    color: grey;
    transition: 0.25s;
    display: block;
    border: 1px solid grey;
}
.cncl:hover {
    background: rgba(0, 0, 0, 0.7);
    color: black;}
.box label {margin:0px;padding: 0px;color: white;text-align: left !important;text-transform: uppercase; font-size: 13px;}
</style>

</body>
</html>

<?php include('header.php'); ?>