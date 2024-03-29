<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Registration Form | CodingLab </title>
    <link rel="stylesheet" href="/css/register.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" placeholder="Enter your first name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" placeholder="Enter your surname" required>
          </div>
          <div class="input-box">
            <span class="details">Other Name</span>
            <input type="text" placeholder="Enter your middle name" required>
          </div>
          <div class="input-box">
            <span class="details">Date of Birth</span>
            <input type="date" placeholder="Enter your date of birth" required>
          </div>
          <div class="input-box">
            <span class="details">Email Address</span>
            <input type="email" placeholder="Enter your email address" required>
          </div>
          <div class="input-box">
            <span class="details">Mobile Number</span>
            <input type="number" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" required>
          </div>
          <div class="gender-details">
			  <input type="radio" name="gender" id="dot-1">
			  <input type="radio" name="gender" id="dot-2">
			  <span class="gender-title">Gender</span>
			  <div class="category">
				<label for="dot-1">
				<span class="dot one"></span>
				<span class="gender">Male</span>
			  </label>
			  <label for="dot-2">
				<span class="dot two"></span>
				<span class="gender">Female</span>
			  </label>
			  </div>
			</div>
        </div>
        <!--<div class="gender-details">
          <input type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          </div>
        </div>-->
        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>

</body>
</html>



<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jquery-validation -->
<script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

<!-- Tastr dependencies -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>

$(document).ready(function() {
	toastr.options = {
		'closeButton': true,
		'debug': false,
		'newestOnTop': false,
		'progressBar': false,
		'positionClass': 'toast-top-right',
		'preventDuplicates': false,
		'showDuration': '1000',
		'hideDuration': '1000',
		'timeOut': '5000',
		'extendedTimeOut': '1000',
		'showEasing': 'swing',
		'hideEasing': 'linear',
		'showMethod': 'fadeIn',
		'hideMethod': 'fadeOut',
	}
});




</script>