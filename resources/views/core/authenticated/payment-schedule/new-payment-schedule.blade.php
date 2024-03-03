<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Validation Form</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('partials.navigation_bar_administrator')
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment Schedules</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Validation</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12 col-lg-12 col-sm-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Payment Schedules - <small>Create A Payment Schedule</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start 
			  <div style="padding: 20px">
				  <div class="" style="background-color: #c8dbfa !important; border-radius: 5px !important; padding: 10px">
					Specify the administrators you want to handle a review of the payment schedule and the permissions assigned to the administrators. The administrators should be specified in the order in which 
					you want them to review the payment schedule. Only administrators selected can review the payment schedule
				  </div>
			  </div>-->
              <form id="quickForm">
                <div class="card-body" id="roleHolder">
                  <div class="form-group">
                    <label for="userType">Specify the Year and Month of this payment </label>
					<div style="clear: both !important">
						<select onchange="handleMonths(this)" name="year" id="year" class="ut form-control float-left selectYear" style="width: auto !important" required placeholder="Enter Name of your User Type">
							<option value>--Select Year--</option>
							@for($x=date('Y'); $x<(date('Y') + 2); $x++)
							<option value="{{$x}}">{{$x}}</option>
							@endfor
						</select>
						  
						  <div class="float-left" style="padding: 5px">
							&nbsp;
						  </div>

						<div class="form-group clearfix">
							<select onchange="(this)" name="month" id="month" class="ut form-control float-left selectMonth" style="width: auto !important" required placeholder="Enter Name of your User Type">
								<option value=-1>--Select Month--</option>
								@foreach($monthList as $key => $val)
								<option value="{{$key}}">{{$val}}</option>
								@endforeach
							</select>
						</div>
					
					</div>
                    
                  </div>
				  
				  <div class="form-group" id="amtClassFarms">
                    <label for="userType">Specify the amount per farm and the farm classification </label>
					<div style="clear: both !important">
						<a  class="btn btn-primary float-left" onclick="handleAddNewAmountAndFarm()"><i class="fa fa-plus"></i></a>
						<input type="number" name="amount[]" class="ut form-control float-left amount" style="width: auto !important" required placeholder="Enter Amount">
						  
						  <div class="float-left" style="padding: 5px">
							&nbsp;
						  </div>

						<div class="form-group clearfix">
							<select onchange="" name="classification[]" id="classification[]" class="ut form-control float-left classification" style="width: auto !important" required>
								<option value=-1>--Select Farm Classification--</option>
								@foreach($farmGroupList as $farmGroup)
								<option value="{{$farmGroup->id}}">{{$farmGroup->farmGroupName}}</option>
								@endforeach
							</select>
						</div>
					
					</div>
                    
                  </div>
				  
				  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a class="btn btn-primary" onclick="createSchedule()">Create Schedule <i class="fa fa-arrow-right"></i></a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<!-- Tastr dependencies -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Page specific script -->
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



function handleMonths()
{
	var currentYear = new Date().getFullYear();
	var currentMonth = new Date().getMonth();
	var monthSelected = $('#month').val();
	var yearSelected = $('#year').val();
	var months = [];
	@foreach($monthList as $key => $val)
		months.push('{{$val}}');
	@endforeach
	var tempMonths = months;
	if(yearSelected==currentYear && currentMonth<11)
	{
		tempMonths = [];
		for(var i=currentMonth+1; i<months.length; i++)
		{
			tempMonths.push(months[i]);
		}
	}
	
	$('#month')
    .find('option')
    .remove()
    .end();
	
	var o = new Option("--Select Month--", null);
	$("#month").append(o);
	for(var i=0; i<tempMonths.length; i++)
	{
		var o = new Option(tempMonths[i], tempMonths[i]);
		$("#month").append(o);
	}
}

function createSchedule()
{
	var amounts = $(".amount");
	var classifications = $(".classification");
	console.log(amounts);
	console.log(classifications);
	var check = true;
	var errorMessage = null;
	var scheduleBreakdownHolder = [];
	var dataHolder = [];
	for(var i=0; i<amounts.length; i++)
	{
		var amtValue = amounts[i].value;
		var classificationValue = classifications[i].value;
		console.log(amtValue);
		if(amtValue.length>0 && amtValue>0)
		{
			
		}
		else
		{
			check = false;
			errorMessage = "Invalid amount found in the fields specifying how much is to be paid";
		}
		
		if(classificationValue.length>0 && classificationValue>-1)
		{
			
		}
		else
		{
			check = false;
			errorMessage = "Invalid classification found in the fields specifying the classification of farms to be paid";
		}
		
		var dataEntry = {};
		dataEntry.amountToPay = amtValue;
		dataEntry.farmGroupId = classificationValue;
		
		dataHolder.push(dataEntry);
	}
	sendDataToCreatePaymentSchedule(dataHolder, $('#year').val(), $('#month').val());
	
	
}


function sendDataToCreatePaymentSchedule(dataHolder, year, month)
{
	var dataToSend = {amountClassification: dataHolder, year: year, month: month};
	dataToSend['_token'] = "{{ csrf_token() }}";
	console.log(dataToSend);
	
	$.ajax({
	  type: "POST",
	  url: "/create-new-payment-schedule-api",
	  data: dataToSend,
	  dataType: "json",
	  encode: true,
	}).done(function (data) {
		console.log(data);
		if(data['status']==0)
		{
			$('#quickForm')[0].reset();
			toastr.success(data['message']);
			setTimeout(
				function() 
				{
					window.location.href = "/administrator/payment-schedule/payment-schedules";
				}, 5000
			);
		}
		else
		{
			toastr.error(data['message']);
		  
		}
	  
	});

	
	event.preventDefault();
}



$(function () {
	
	
	
	
	
	
  $.validator.setDefaults({
    submitHandler: function () {
		
		console.log(new Date( $('#dateOfBirth').val()));
		
		
		var formData = {
		  firstName: $('#firstName').val(),
		  lastName: $('#lastName').val(),
		  otherName: $('#otherName').val(),
		  mobileNumber: $('#mobileNumber').val(),
		  emailAddress: $('#emailAddress').val(),
		  dateOfBirth: $('#dateOfBirth').val(),
		  gender: $('#gender').val(),
		  userTypeId: $('#userType').val(),
		  _token: "{{ csrf_token() }}",
		};
		
		console.log(formData);
		//alert(44);

		$.ajax({
		  type: "POST",
		  url: "/add-admin-user-api",
		  data: formData,
		  dataType: "json",
		  encode: true,
		}).done(function (data) {
		  if(data['responseCode']==0)
		  {
				$('#quickForm')[0].reset();
				toastr.success(data['message']);
				setTimeout(
					function() 
					{
						window.location.href = "/administrator/user/all-users";
					}, 5000
				);
		  }
		  else
		  {
			  toastr.error(data['message']);
			  
		  }
		  
		});

		
		event.preventDefault();
    }
  });
  
});


function handleAddNewAmountAndFarm()
{
	var $div = $("<div>", {"style": "both !important"});
	var $a = $("<a>", {"onclick": "handleAddNewAmountAndFarm()", "class": "btn btn-primary float-left"});
	var $i = $("<i>", {"class": "fa fa-plus"});
	$a.append($i);
	var $input = $("<input>", {"type": "number", "name": "amount[]", "class": "ut form-control float-left amount", "style": "width: auto !important", "required": true, "placeholder":"Enter Amount"});
	var $div1 = $("<div>", {"style": "padding: 5px", "class": "float-left"});
	$div1.html("&nbsp;");
	
	var $div2 = $("<div>", {"class": "form-group clearfix"});
	var $select = $("<select>", {"onchange": "", "name": "classification[]", "class": "ut form-control float-left classification", "style": "width: auto !important", "required": true});
	$select.append($("<option>", {"value": -1, "text": ("--Select Farm Classification--")}));
	@foreach($farmGroupList as $farmGroup)
		$select.append($("<option>", {"value": {{$farmGroup->id}}, "text": "{{$farmGroup->farmGroupName}}"}));
	@endforeach
	$div2.append($select);
	
	$div.append($a);
	$div.append($input);
	$div.append($div1);
	$div.append($div2);
	$('#amtClassFarms').append($div);
	
}

</script>
</body>
</html>
