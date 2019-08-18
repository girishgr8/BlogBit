<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>WordFlow</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"><!-- 
	<link rel="javascript" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js">
	<link rel="javascript" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"> -->
	<script src="http:////ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http:////maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- put first the jquery path, otherwise the bootstrap.js won't work-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

 <!--    <script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script> -->

	<link rel="stylesheet" href="style.css"/>
	<!-- <script type="text/javascript" src="functions.js"></script> -->

	<!-- <script type="text/javascript">
		$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});
	</script> -->
	
</head>
<body>
	<!-- Navigation -->
<nav id="topNav" class="navbar navbar-expand-lg fixed-top navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
             <!--    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> -->
                <a class="navbar-brand page-scroll" href="#first">WordFlow</a>
            </div>
            <div class="navbar-collapse collapse" id="bs-navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="#">Intro</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">Highlights</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">Gallery</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">Features</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">Contact</a>
                    </li>
                </ul>
                <ul class="nav navbar-right">
                    <li>
                        <a class="page-scroll"  title="A free Bootstrap video landing theme" href="#about">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<script type="text/javascript">
 $('a.page-scroll').bind('click', function(event) {
        var $ele = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($ele.attr('href')).offset().top - 60)
        }, 1450, 'easeInOutExpo');
        event.preventDefault();
        console.log('Executed.')
    });
 		
    </script>

<!--SignUp Modal -->
  <div id="SignUp" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-body">
        		<div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="margin-top-0 wow fadeIn">Sign Up</h2>
                    <hr class="primary">
                    <p>Sign Up to connect with people and discover new opportunities!</p>
                </div>
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <form class="contact-form row" action="register.php" method="POST"><br>
                        <div class="col-md-4">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" name="firstname" required>
                        </div>
                        <div class="col-md-4">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" placeholder="Middle Name" name="middlename" required>
                        </div>
                        <div class="col-md-4">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lastname" required>
                        </div>
						<br>
                        <div class="col-md-4"><br>						
                            <label>Username</label>
                            <input type="Username" class="form-control" placeholder="Username" name="username" required>
                        </div>
                        <div class="col-md-4"><br>
                            <label>Password</label>
                            <input type="Password" class="form-control" placeholder="Password" name="password" required>
                        </div>

                        <br>
                        <div class="col-md-12"><br>
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="col-md-4"><br>
                            <label>Phone</label>
                            <input type="text" class="form-control" placeholder="Phone" name="phone" required>
                        </div>
                        <div class="col-md-4"><br>
                            <label>Gender</label><br>
                            <select name="gender">
                            	<option value="M">Male</option>
                            	<option value="F">Female</option>
                            </select>
                        </div>
                          <div class="col-md-4"><br>
                            <label>Birthday</label>
                             <input type="date" name="bday" required>
                        </div>
                       
                        <div class="col-md-9"><br>
                        	
                        <!--     <label>Address</label><br> -->
                        <br>
                            City: <input type="text" class="form-control" placeholder="City" name="city" required>
                            <br>
                            Street: <input type="text" class="form-control" placeholder="Street" name="street" required>
                            <br>
                            Pincode: <input type="text" class="form-control" placeholder="Pincode" name="pincode" required>
                            <!-- textarea class="form-control" rows="9" placeholder="Address" name="address" required></textarea> -->
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <label></label>
                            <input type="submit" class="btn btn-primary btn-lg center-block" name="Submit">
                            <!-- <button type="submit" class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true" onclick="">Submit</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
  		<br/>     		
        		
        	</div>
        </div>
        </div>
    </div>
    <!-- Modal End -->


    <!-- Login Modal -->
    <div id="LogIn" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-body">
        		<div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="margin-top-0 wow fadeIn">Log In</h2>
                    <hr class="primary">
                    <p>Welcome Back!</p>
                </div>
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <form class="contact-form row">
                        <div class="col-md-9">
                            <label>Username</label>
                            <input type="Username" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-md-9">
                            <label>Password</label>
                            <input type="Password" class="form-control" placeholder="Password">
                        </div>
                       <div class="col-md-4 col-md-offset-4">
                            <label></label>
                            <input type="submit" class="btn btn-primary btn-lg center-block" name="Submit">
                            <!-- <button type="submit" class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true" onclick="">Submit</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
  		<br/>     		
        		<!-- <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Submit </button> -->
        	</div>
        </div>
        </div>
    </div>
    <!-- Modal End -->

  <header id="first">
        <div class="header-content">
            <div class="inner">
                <h1>Word-Flow</h1>
                <hr class="divider my-4">
                <h4>Discover new ideas, share your imagination.</h4>
                <br><br>
                <button class="btn btn-primary btn-xl" data-toggle="modal" data-target="#LogIn">Log In</button> &nbsp; &nbsp;
                <button class="btn btn-primary btn-xl" data-toggle="modal" data-target="#SignUp" >Sign Up</button>
                <!-- 
                <a href="#video-background" id="toggleVideo" data-toggle="collapse" class="btn btn-primary btn-xl">Toggle Video</a> &nbsp; <a href="#one" class="btn btn-primary btn-xl page-scroll">Get Started</a> -->
            </div>
        </div>
        
    </header>


<section class="py-5" id="about">
  <div class="container">
    <h2 class="font-weight-light">About</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat reprehenderit expedita.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat reprehenderit expedita.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat reprehenderit expedita.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus ab nulla dolorum autem nisi officiis blanditiis voluptatem hic, assumenda aspernatur facere ipsam nemo ratione cumque magnam enim fugiat reprehenderit expedita.</p>
  </div>
</section>


    <footer id="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6 col-sm-3 column">
                    <h4>Information</h4>
                    <ul class="list-unstyled">
                        <li><a href="">Products</a></li>
                        <li><a href="">Services</a></li>
                        <li><a href="">Benefits</a></li>
                        <li><a href="">Developers</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-3 column">
                    <h4>About</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3 column">
                    <h4>Stay Posted</h4>
                    <form>
                        <div class="form-group">
                          <input type="text" class="form-control" title="No spam, we promise!" placeholder="Tell us your email">
                        </div>
                        <div class="form-group">
                          <button class="btn btn-primary" data-toggle="modal" data-target="#alertModal" type="button">Subscribe for updates</button>
                        </div>
                    </form>
                </div>

               
        </div>
    </footer>

  



</body>
</html>