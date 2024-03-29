<?php
	// Start session.
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	// Set a key, checked in mailer, prevents against spammers trying to hijack the mailer.
	$security_token = $_SESSION['security_token'] = uniqid(rand());
	
	if ( ! isset($_SESSION['formMessage'])) {
		$_SESSION['formMessage'] = '';	
	}
	
	if ( ! isset($_SESSION['formFooter'])) {
		$_SESSION['formFooter'] = '';
	}
	
	if ( ! isset($_SESSION['form'])) {
		$_SESSION['form'] = array();
	}
	
	function check($field, $type = '', $value = '') {
		$string = "";
		if (isset($_SESSION['form'][$field])) {
			switch($type) {
				case 'checkbox':
					$string = 'checked="checked"';
					break;
				case 'radio':
					if($_SESSION['form'][$field] === $value) {
						$string = 'checked="checked"';
					}
					break;
				case 'select':
					if($_SESSION['form'][$field] === $value) {
						$string = 'selected="selected"';
					}
					break;
				default:
					$string = $_SESSION['form'][$field];
			}
		}
		return $string;
	}
?><!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Sponsorship. - Rush Running Company</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Rush Running Co.</a>
						<ul class="icons">
							<li><a href="https://twitter.com/rushrunning" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="https://www.facebook.com/rushrunning/" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="https://www.instagram.com/rushrunningco/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="mailto:runrunmikerush@yahoo.com" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.html">Home</a></li>
											<li><a href="ask-miles.php">Ask Miles</a></li>
											<li><a href="ask-drew.php">Ask Drew</a></li>
											<li><a href="products.html">Products</a></li>
											<li><a href="newsletter.php">Newsletter - Subscribe</a></li>
											<li><a href="videos.html">Cool Videos</a></li>
											<li><a href="trails.html">Trails</a></li>
											<li><a href="meet-the-staff.html">Meet the Staff</a></li>
											<li><a href="race-team.html">Race Team</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Sponsorship -->
					<article id="sponsorship">
						<header>
							<h1>This page currently under development. Do not use.</h1>
							<h2>Request Sponsorship</h2>
						</header>
						<section class="wrapper style2">
							<div class="inner">
								<div class="message-text"><?php echo $_SESSION['formMessage']; unset($_SESSION['formMessage']); ?></div><br />
								<form action="/files/sponsorship-mailer.php" method="post" enctype="multipart/form-data">
		 							<div>
		 								<!--<center><p><img src="images/miles.jpg" alt="" /></p></center>-->
		 							    <p>If you would like for Rush Running Company to contribute a donation toward your event or cause, please fill out the entire application listed below. Rush Running Company contributes to numerous sponsorships and donations requests throughout the community. Our goal is help the community and grow the number races in North West Arkansas, but it is not always possible to fulfill every request. Once an application is submitted, we will take full consideration of your request.</p>
		 							    <h4>Event Information</h4>

										<label>* Event Name:</label>
										<input class="form-input-field" type="text" value="<?php echo check('element0'); ?>" name="form[element0]" size="40"/><br />

										<label>* Event Date:</label>
										<input class="form-input-field" type="date" value="<?php echo check('element1'); ?>" name="form[element1]" size="10"/><br />

										<label>* Event Time:</label> 
										<input class="form-input-field" type="time" value="<?php echo check('element2'); ?>" name="form[element2]" size="10"/><br />

										<label>* What city is this event located?:</label>
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="40"/><br />

										<label>Event Website:</label>
										<input class="form-input-field" type="url" value="http://"<?php echo check('element4'); ?>" name="form[element4]" size="255"/><br />

										<label>Event Facebook:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element5'); ?>" name="form[element5]" size="255"/><br />

										<label>Please list any other Social media for this event:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element6'); ?>" name="form[element6]" size="255"/><br />

										<label>* Please list the organization(s) that will be benefiting from this event and if they are 501c3:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element7'); ?>" name="form[element7]" size="500"/><br />

										<h3>Race Director or Point of Contact</h3>
										<label>* First Name:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element8'); ?>" name="form[element8]" size="30"/><br />

										<label>* Last Name:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element9'); ?>" name="form[element9]" size="30"><br />

										<label>* E-mail Address:</label>
										<input class="form-input-field" type="email" value="<?php echo check('element10'); ?>" name="form[element10]" size="255"/><br />

										<label>* Phone:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element11'); ?>" name="form[element11]" size="14"/><br />

										<label>Address Line 1:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element12'); ?>" name="form[element12]" size="60"/><br />

										<label>Address Line 2:</label>
										<input class="form-input-field" type="text" value="<?php echo check('element13'); ?>" name="form[element13]" size="60"/><br />

										<label>City:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element14'); ?>" name="form[element14]" size="30"/><br />

										<label for="state">State:</label>
										<select id="state" name="form[element15]">
                                            <option value="Alabama">Alabama</option>
                                            <option value="Alaska">Alaska</option>
                                            <option value="Arizona">Arizona</option>
                                            <option selected="selected" value="Arkansas">Arkansas</option>
                                            <option value="California">California</option>
                                            <option value="Colorado">Colorado</option>
                                            <option value="Connecticut">Connecticut</option>
                                            <option value="Delaware">Delaware</option>
                                            <option value="District Of Columbia">District Of Columbia</option>
                                            <option value="Florida">Florida</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Hawaii">Hawaii</option>
                                            <option value="Idaho">Idaho</option>
                                            <option value="Illinois">Illinois</option>
                                            <option value="Indiana">Indiana</option>
                                            <option value="Iowa">Iowa</option>
                                            <option value="Kansas">Kansas</option>
                                            <option value="Kentucky">Kentucky</option>
                                            <option value="Louisiana">Louisiana</option>
                                            <option value="Maine">Maine</option>
                                            <option value="Maryland">Maryland</option>
                                            <option value="Massachusetts">Massachusetts</option>
                                            <option value="Michigan">Michigan</option>
                                            <option value="Minnesota">Minnesota</option>
                                            <option value="Mississippi">Mississippi</option>
                                            <option value="Missouri">Missouri</option>
                                            <option value="Montana">Montana</option>
                                            <option value="Nebraska">Nebraska</option>
                                            <option value="Nevada">Nevada</option>
                                            <option value="New Hampshire">New Hampshire</option>
                                            <option value="New Jersey">New Jersey</option>
                                            <option value="New Mexico">New Mexico</option>
                                            <option value="New York">New York</option>
                                            <option value="North Carolina">North Carolina</option>
                                            <option value="North Dakota">North Dakota</option>
                                            <option value="Ohio">Ohio</option>
                                            <option value="Oklahoma">Oklahoma</option>
                                            <option value="Oregon">Oregon</option>
                                            <option value="Pennsylvania">Pennsylvania</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Rhode Island">Rhode Island</option>
                                            <option value="South Carolina">South Carolina</option>
                                            <option value="South Dakota">South Dakota</option>
                                            <option value="Tennessee">Tennessee</option>
                                            <option value="Texas">Texas</option>
                                            <option value="Utah">Utah</option>
                                            <option value="Vermont">Vermont</option>
                                            <option value="Virginia">Virginia</option>
                                            <option value="Washington">Washington</option>
                                            <option value="West Virginia">West Virginia</option>
                                            <option value="Wisconsin">Wisconsin</option>
                                            <option value="Wyoming">Wyoming</option>
                                        </select> <br />

										<label>Zip:</label>
										<input class="form-input-field" type="text" value="<?php echo check('element16'); ?>" name="form[element16]" size="20"/><br />

										<h3>Planning Information</h3>	
										<label>* How many participants do you expect at this event?:</label>
										<input class="form-input-field" type="number" min="0" max="99999" value="0"<?php echo check('element17'); ?>" name="form[element17]" size="6"/><br />

										<input class="form-input-field" type="checkbox" id="first-year" value="Yes" name="form[element18]" size="1"/>
										<label for="first-year">Check this box, if this is the first year for this event?</label>
										<br />
 
										<label>How many participants did you have at this event last year?:</label> 
										<input class="form-input-field" type="number" min="0" max="99999" value="0"<?php echo check('element19'); ?>" name="form[element19]" size="6"/><br />

										<h3>Sponsorship Request</h3>
										<label>* Please state the level of sponsorship/donation that you are seeking for this event. Our goal is to provide a quality experience for the events that we support:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element20'); ?>" name="form[element20]" size="1000"/><br />

										<label>* Depending on sponsorship level it will be required to have on-site packet pickup at a Rush Running location.  Do you agree with this requirement?</label>
										<!--<?php $element21 = trim( strtolower($_GET['element21']) ); ?> -->
										<select id="pickup" name="form[element21]">
                                            <option value="Yes" <?php if($element21 == "Yes") echo "Yes"; ?>>
                                            	Yes
                                            </option>
                                            <option value="No" <?php if($element21 == "No") echo "No"; ?>>
                                            	No
                                            </option>
                                        </select> <br />
                                        
                                        <label>
                                        Rush Running reserves the right to be the sole running shoe retailer for running events it sponsors. Do you agree to this requirement?    
										</label>
										<select id="sole" name="form[element22]">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select> <br />

                                        <label>* Signature:</label> 
										<input class="form-input-field" type="text" value="<?php echo check('element23'); ?>" name="form[element23]" size="60"/><br />
										

										<div style="display: none;">
											<label>Spam Protection: Please don't fill this in:</label>
											<textarea name="comment" rows="1" cols="1"></textarea>
										</div>
										<input type="hidden" name="form_token" value="<?php echo $security_token; ?>" />
										<input class="form-input-button" type="reset" name="resetButton" value="Reset" />
										<input class="form-input-button" type="submit" name="submitButton" value="Submit" />
									</div>
								</form>
								<br />
								<div class="form-footer"><?php echo $_SESSION['formFooter']; unset($_SESSION['formFooter']); ?></div><br />
								<?php unset($_SESSION['form']); ?>
							</div>
						</section>
					</article>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="https://twitter.com/rushrunning" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="https://www.facebook.com/rushrunning/" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="https://www.instagram.com/rushrunningco/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="mailto:runrunmikerush@yahoo.com" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; 2016 Rush Running Co.</li> 
							<!--<li>Design: <a href="http://html5up.net">HTML5 UP</a></li> -->
						</ul>
					</footer>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>