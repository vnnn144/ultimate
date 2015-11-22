<?php if(!defined('__AUTH')) exit('Prohibited areas') ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Oops! Error</title>
		<style type="text/css">
			html, body {
			 	width: 100%;
			  	height: 100%;
			  	margin: 0;
			  	padding: 0;
			  	background-color: #000;
			}
			 
			.bg-img {
			  	position: absolute;
			  	width: 100%;
			  	height: 100%;
			  	background: url(public/images/nothing_to_see_here_naked_gun.gif) no-repeat center center fixed;
			  	background-size: 100% 99%;
			  	background-color: #000;
			  	opacity: 0.5;
			  	filter: alpha(opacity=50);
			}
			 
			.content {
			  	font-family: 'Avenir-Next',Avenir,Helvetica,sans-serif;
			  	color: #fff;
			  	background-color: none;
			  	z-index: 2;
			  	position: absolute;
			  	top: 50%;
			  	-webkit-transform: translateY(-50%);
			  	-ms-transform: translateY(-50%);
			  	transform: translateY(-50%);
			}
			 
			.row {
 	 			margin-right: -15px;
  				margin-left: -15px;
			}

			.container { 
			    width: 70%;
			    margin: -20px auto;
			    padding-right: 15px;
			    padding-left: 15px;
			}
			 
			h1 {
			  	font-size: 160px;
			  	margin-bottom: 0;
			  	margin-top: 0;
			}
			 
			h2 {
			  	margin-top: 0;
			  	max-width: 700px;
			  	font-size: 30px;
			  	width: 90%;
			}
			 
			p {
			  	text-align: left;
			  	padding-bottom: 32px;
			}

			a {
				color: #fff;
			}
			 
			.btn {
			  	display: inline-block;
			  	border: 1px solid #aaa;
			  	border-radius: 40px;
			  	padding: 15px 30px;
			  	margin-right: 15px;
			  	margin-bottom: 10px;
			}

			.btn:hover {
			  	color: #e2e2e2;
			  	background: rgba(255, 255, 255, 0.1);
			}
			 
			@media only screen and (max-width: 480px) {
			  	.btn {
			    	background-color: white;
			    	color: #444444;
			    	width: 100%;
			  	}
			 
			  	h1 {
			    	font-size: 120px;
			  	}
			}
		</style>
	</head>
	<body>
		<div class='container'>
    		<div class='row content'>
      			<div>
        			<h1>ERROR</h1>
       				<h2><?php echo $exc->getMessage() ?></h2>
        			<p>	
          				in <b><?php echo $exc->getFile() ?></b> on line <b><?php echo $exc->getLine() ?></b>
        			</p>
        			<a><span class='btn'>RETURN HOME</span></a>
        			<a><span class='btn'>REPORT PROBLEM</span></a>
      			</div>
    		</div>
  		</div>
		<div class='bg-img'></div>
	</body>
</html>