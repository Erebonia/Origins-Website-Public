<div class="footer-divider wow fadeIn" data-wow-delay="1s"></div>
			<div class="footerr">
				<div class="container">

					<div class="col-md-6">
						<div class="foot">
							<ul>
								<li><a style="padding-left:0px; " href="home">Home</a></li>
								<li><a href="account">Account</a></li>
								<li><a href="info">Info</a></li>
								<li><a href="pvprankingboard">Ranking</a></li>
								<li><a href="donation">Donate</a></li>
								<li><a style="border: 0px;" href="https://discord.com/invite/bmRdXRh">Discord</a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="socials" style="margin: 0 auto;width: 90%;">
							<ul>
								<li><a href="facebook"><img class="img-responsive center-block" src="img/fb.png"></a></li>
								<li><a href="twitter"><img class="img-responsive center-block" src="img/tw.png"></a></li>
 								<li><a href="https://www.youtube.com/channel/UCnShvWI6CvzoeM-GkJq4Aiw"><img class="img-responsive center-block" src="img/yt.png"></a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="text-left copyrigh">
							<p style="width: 99%;">"They dont really developed or worked on any feature for this game, we have our own developer who actually developing this game since cap 50, we are not a server that get cap95 files/features directly and make costumes/things cheaper. Believe if you made something on your own hands it becomes more valuable for you
In this game all contents youre playing
made by us
developed by us
not took from eyedentity
we developed it
with ou r hands
every night
we did not slept"</p>
							<p>© 2020 Etherious, LLC<br>All other trademarks are property of Origins & their respective owners. </p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="btt" style="width:90%;padding-top: 40px;">
							<a href="download">Play Now</a><br>
							<a class="login-trigger" href="#" data-target="#create" data-toggle="modal">Register</a>
						</div>
					</div>
					<div class="col-md-3"><a href="#"><img  style="margin:0px 20px;width: 80%;" class="img-responsive center-block" src="img/logo.png"></a></div>

				</div>
			</div>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
			<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

			<script type="text/javascript" charset="utf-8">
				$(document).ready(function(){
					$("a[rel^='prettyPhoto']").prettyPhoto({});
				});
			</script>


			<!--<script src="https://gitcdn.xyz/repo/thesmart/jquery-scrollspy/0.1.3/scrollspy.js"></script>-->

			<!-- Modify after -->
			<script>
  // Repeat demo content
  var $body = $('body');
  var $box = $('.box');
  for (var i = 0; i < 20; i++) {
  	$box.clone().appendTo($body);
  }

  // Helper function for add element box list in WOW
  WOW.prototype.addBox = function(element) {
  	this.boxes.push(element);
  };

  // Init WOW.js and get instance
  var wow = new WOW();
  wow.init();

  // Attach scrollSpy to .wow elements for detect view exit events,
  // then reset elements and add again for animation
  $('.wow').on('scrollSpy:exit', function() {
  	$(this).css({
  		'visibility': 'hidden',
  		'animation-name': 'none'
  	}).removeClass('animated');
  	wow.addBox(this);
  }).scrollSpy();

</script>


<div id="login" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-body">

				<form class="box" action="login/login" method="post">
					<h1>Log-in</h1>
					<label>account login name</label>
					<input type="text" name="username" placeholder="Enter your account name">
					<label>Password</label>
					<input type="password" name="password" placeholder="Enter your password">
					<input type="submit" name="Login" value="Login">
					<button data-dismiss="modal" class="cncl">Cancel</button>
					<?php include('login/login.php'); ?>
				</form>
				<form class="box" action="newpassrequest" method="post">
					<label>Password Recovery Request</label>
					<input type="text" name="username" placeholder="Enter your account name">
					<input type="submit" name="Reset Password" value="Request">
					<button data-dismiss="modal" class="cncl">Cancel</button>
				</form>
			</div>
		</div>
	</div> 
</div>


<div id="create" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-body">
				<form class="box" action="registration/register" method="post" enctype="multipart/form-data" autocomplete = "off">
					<h1>Create an Account</h1>
					<label>account login name</label>
					<input type="text" maxlength="20" minlength="4"  name="username" placeholder="Account Name (20 characters maximum)" required> 
					<label>Password</label>
					<input type="password" maxlength="20" minlength="4"  name="password" placeholder="Password (20 characters maximum)" required>
					<label>Confirm Password</label>
					<input type="password" maxlength="20" minlength="4" name="confirmpassword" placeholder="Verify your password" required>
					<label>Email Address</label>
					<input type="email" name="email"  placeholder="Enter a valid email address" required>
					<label>Confirm Email Address</label>
					<input type="email" name="emailconfirm" placeholder="Verify your email address" required>
					<label>Country</label>
					<Select style="color:black" name = "region" required>
					<option value = "1">Europe (EU)</option>
					<option value = "2">North America West(NAW)</option>
					<option value = "3">North America East(NAE)</option>
					<option value = "4">South East Asia (SEA)</option>
					<option value = "5">South America (SA)</option>
					<option value = "6">Hong Kong (HK)</option>
					</Select> 
					<!-- <input type ="text"  maxlength="1" name = "region" placeholder = "Type '1' for Europe or '2' for United States." required> -->
					<input type="submit" value="Register" name = "Register">
					<button data-dismiss="modal" class="cncl">Cancel</button>
					<?php include('registration/register.php'); ?>
				</form>
			</div>
		</div>
	</div>  
</div>

<style type="text/css">

	.modal-content {background: transparent;}
	.box{
		background: #191919;
		border-top: 8px solid #D4AF37 !important;
		border: 2px solid #D4AF37;
		padding: 20px;
	}

	.box h1{
		color: white;
		text-transform: uppercase;
		font-weight: 500;
		font-size: 25px;
		margin-top: 0px;
		margin-bottom: 20px;
		text-align: center;
	}
	.box input[type = "text"],.box input[type = "password"],.box input[type = "email"]{
		border:0;
		background: none;
		display: block;
		margin: 2px auto 20px;
		text-align: center;
		border: 2px solid #456fc6;
		padding: 8px 0px;
		width: 100%;
		outline: none;
		color: white;
		transition: 0.25s;
	}
	.box input[type = "text"]:focus,.box input[type = "password"]:focus,.box input[type = "email"]:focus{

		border-color: orange;
	}
	.box input[type = "submit"]{
		border:0;
		background: none;
		display: block;
		margin: 20px auto;
		text-align: center;
		border: 2px solid #3498db;
		padding: 8px 10px;
		width: 100%;
		outline: none;
		color: white;
		transition: 0.25s;
		display: block;
		text-transform: uppercase;
	}
	.box input[type = "submit"]:hover{
		background: yellow;
		color: black;
	}
	.cncl {
		border:0;
		background: none;
		display: block;
		margin: 20px auto 0;
		text-align: center;
		text-transform: uppercase;
		padding: 10px 10px;
		width: 100%;
		outline: none;
		color: grey;
		transition: 0.25s;
		display: block;
		border: 1px solid grey;
	}
	.cncl:hover {color: #a49393;}
	.box label {margin:0px;padding: 0px;color: white;text-align: left !important;text-transform: uppercase; font-size: 13px;}
</style>


</body>
</html>
