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

				<!-- Miles -->
					<article id="sponsorship">
						<header>
							<h2>Request Sponsorship</h2>
						</header>
						<section class="wrapper style2">
							<div class="inner">
								<div class="message-text"><?php echo $_SESSION['formMessage']; unset($_SESSION['formMessage']); ?></div><br />
								<form action="/files/ask-miles-mailer.php" method="post" enctype="multipart/form-data">
		 							<div>
		 								<!--<center><p><img src="images/miles.jpg" alt="" /></p></center>-->
		 							    <p>If you would like for Rush Running Company to contribute a donation toward your event or cause, please fill out the entire application listed below. Rush Running Company contributes to numerous sponsorships and donations requests throughout the community. Our goal is help the community and grow the number races in North West Arkansas, but it is not always possible to fulfill every request. Once an application is submitted, we will take full consideration of your request.</p>
		 							    <h4>Event Information</h4>

										<label>Event Name:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element0'); ?>" name="form[element0]" size="40"/><br /><br />

										<label>Event Date:</label> *<br />
										<input class="form-input-field" type="date" value="<?php echo check('element1'); ?>" name="form[element1]" size="10"/><br /><br />

										<label>Event Time:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element1'); ?>" name="form[element1]" size="60"/><br /><br />

										<label>What city is this event located?:</label> <br />
										<input class="form-input-field" type="text" value="<?php echo check('element2'); ?>" name="form[element2]" size="40"/><br /><br />

										<label>Event Website:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="255"/><br /><br />

										<label>Event Facebook:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="255"/><br /><br />

										<label>Please list any other Social media for this event:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="255"/><br /><br />

										<label>Please list the organization(s) that will be benefiting from this event and if they are 501c3:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="500"/><br /><br />

										<h3>Race Director or Point of Contact</h3>
										<label>First Name:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="30"/><br /><br />

										<label>Last Name:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="30"><br /><br />

										<label>E-mail Address:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="255"/><br /><br />

										<label>Phone:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="14"/><br /><br />

										<label>Address Line 1:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="60"/><br /><br />

										<label>Address Line 2:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="60"/><br /><br />

										<label>City:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="30"/><br /><br />

										<label>State:</label>
										<select id="state" name="state">
                                            <option>Alabama</option>
                                            <option>Alaska</option>
                                            <option>Arizona</option>
                                            <option>Arkansas</option>
                                            <option>California</option>
                                            <option>Colorado</option>
                                            <option>Connecticut</option>
                                            <option>Delaware</option>
                                            <option>District Of Columbia</option>
                                            <option>Florida</option>
                                            <option>Georgia</option>
                                            <option>Hawaii</option>
                                            <option>Idaho</option>
                                            <option>Illinois</option>
                                            <option>Indiana</option>
                                            <option>Iowa</option>
                                            <option>Kansas</option>
                                            <option>Kentucky</option>
                                            <option>Louisiana</option>
                                            <option>Maine</option>
                                            <option>Maryland</option>
                                            <option>Massachusetts</option>
                                            <option>Michigan</option>
                                            <option>Minnesota</option>
                                            <option>Mississippi</option>
                                            <option>Missouri</option>
                                            <option>Montana</option>
                                            <option>Nebraska</option>
                                            <option>Nevada</option>
                                            <option>New Hampshire</option>
                                            <option>New Jersey</option>
                                            <option>New Mexico</option>
                                            <option>New York</option>
                                            <option>North Carolina</option>
                                            <option>North Dakota</option>
                                            <option>Ohio</option>
                                            <option>Oklahoma</option>
                                            <option>Oregon</option>
                                            <option>Pennsylvania</option>
                                            <option>Puerto Rico</option>
                                            <option>Rhode Island</option>
                                            <option>South Carolina</option>
                                            <option>South Dakota</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Utah</option>
                                            <option>Vermont</option>
                                            <option>Virginia</option>
                                            <option>Washington</option>
                                            <option>West Virginia</option>
                                            <option>Wisconsin</option>
                                            <option>Wyoming</option>
                                        </select> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="2"/><br /><br />
										 <label for="state">State</label>
                                         

										<label>Zip:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="60"/><br /><br />





										<h3>Planning Information</h3>	
										<label>How many participants do you expect at this event?:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="50"/><br /><br />

										<label>How many participants did you have at this event last year?:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="50"/><br /><br />

										<h3>Sponsorship Request</h3>
										<p>Select the level of sponsorship you are seeking for this event. Our goal is to provide a quality experience for the events that we support.  </p>
										<label>How many participants did you have at this event last year?:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element3'); ?>" name="form[element3]" size="50"/><br /><br />

										<div style="display: none;">
											<label>Spam Protection: Please don't fill this in:</label>
											<textarea name="comment" rows="1" cols="1"></textarea>
										</div>
										<input type="hidden" name="form_token" value="<?php echo $security_token; ?>" />
										<input class="form-input-button" type="reset" name="resetButton" value="Reset" />
										<input class="form-input-button" type="submit" name="submitButton" value="Ask your question!" />
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