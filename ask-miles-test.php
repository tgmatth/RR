<?php
	// Start session.
	session_start();
	
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
		<title>Ask Miles. - Rush Running Company</title>
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
											<li><a href="ask-miles.html">Ask Miles</a></li>
											<li><a href="ask-drew.html">Ask Drew</a></li>
											<li><a href="products.html">Products</a></li>
											<li><a href="newsletter.html">Newsletter - Subscribe</a></li>
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
					<article id="miles">
						<header>
							<h2>Ask Miles</h2>
						</header>
						<section class="wrapper style2">
							<div class="inner">
								<div class="message-text"><?php echo $_SESSION['formMessage']; unset($_SESSION['formMessage']); ?></div><br />
								<form action="/files/ask-miles-test-mailer.php" method="post" enctype="multipart/form-data">
		 							<div>
		 								<!--<center><p><img src="images/miles.jpg" alt="" /></p></center>-->
		 							    <p>Have a running or walking related question? Use this form to ask Miles! He will get back to you as soon as he can.</p>
										<label>Your Name:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element0'); ?>" name="form[element0]" size="40"/><br /><br />

										<label>Your Email:</label> *<br />
										<input class="form-input-field" type="text" value="<?php echo check('element1'); ?>" name="form[element1]" size="40"/><br /><br />

										<label>Subject:</label> <br />
										<input class="form-input-field" type="text" value="<?php echo check('element2'); ?>" name="form[element2]" size="40"/><br /><br />

										<label>Your walking or running related question:</label> *<br />
										<textarea class="form-input-field" name="form[element3]" rows="8" cols="38"><?php echo check('element3'); ?></textarea><br /><br />

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
<!--							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>  -->
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