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
            <h1>Workflow Settings</h1>
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
                <h3 class="card-title">Workflow Settings - <small>Manage Workflow Process</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  <div style="padding: 20px">
				  <div class="" style="background-color: #c8dbfa !important; border-radius: 5px !important; padding: 10px">
					Specify the administrators you want to handle a review of the payment schedule and the permissions assigned to the administrators. The administrators should be specified in the order in which 
					you want them to review the payment schedule. Only administrators selected can review the payment schedule
				  </div>
			  </div>
              <form id="quickForm">
                <div class="card-body" id="roleHolder">
                  <div class="form-group">
                    <label for="userType">Select An administrator</label>
					<div style="clear: both !important">
						<a  class="btn btn-primary float-left" onclick="handleAddNewAdministrator()"><i class="fa fa-plus"></i></a>
						<select onchange="(this)" name="workflowuser[]" class="ut form-control float-left select1" style="width: auto !important" required placeholder="Enter Name of your User Type">
							<option value=-1>--Select An Administrator--</option>
							@foreach($userList as $ul)
							<option value="{{$ul->user->id}}">{{$ul->user->firstName}} {{$ul->user->lastName}} - ({{$ul->userType}})</option>
							@endforeach
						</select>
						  
						  <div class="float-left" style="padding: 20px">
							&nbsp;
						  </div>

						<div class="form-group clearfix">
						  <div class="icheck-primary d-inline">
							<input type="checkbox" id="" name="approve[]" class="approveClass">
							<label for="">
							</label>
						  </div>
						  <div class="icheck-primary d-inline" style="padding-left: 10px !important">
							<label for="">
							  Approve Permission
							</label>
						  </div>
						  
						  <div class="icheck-primary d-inline" style="padding-left: 20px !important">
							<input type="checkbox" id="" name="disapprove[]" class="disapproveClass">
							<label for="">
							</label>
						  </div>

						  <div class="icheck-primary d-inline" style="padding-left: 10px !important">
							<label for="">
							  Dispprove Permission
							</label>
						  </div>
						</div>
					
					</div>
                    
                  </div>
				  
				  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a class="btn btn-primary" onclick="submitWorkflowSettings()">Proceed <i class="fa fa-arrow-right"></i></a>
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


function submitWorkflowSettings()
{
	var approveCheckboxes = $(".approveClass");
	var disapproveCheckboxes = $(".disapproveClass");
	console.log(approveCheckboxes);
	var check = true;
	var errorMessage = null;
	var workflowuserHolder = [];
	var dataHolder = [];
	$(".select1").each(function (index, element) {
        // element == this
        console.log(element.value);
		if(check==true && element.value==-1)
		{
			check = false;
			errorMessage = "Your workflow process should contain administrator members. You have not selected one member in the list";
		}
		if(check==true && workflowuserHolder.includes(element.value))
		{
			check = false;
			errorMessage = "Your workflow process can not contain people appearing more than once in the process. Check your selection to ensure this is not happening";
		}
		if(check==true && approveCheckboxes[index].checked==false && disapproveCheckboxes[index].checked==false)
		{
			check = false;
			errorMessage = "In your workflow process, every member must be assigned at least one permission. You have not assigned a permisison to at least one of the selected members";
		}
		
		workflowuserHolder.push(element.value);
		var dataEntry = {};
		var dataPermission = [];
		
		if(approveCheckboxes[index].checked==true)
			dataPermission.push("APPROVE_PAYMENT_SCHEDULE");
		
		if(disapproveCheckboxes[index].checked==true)
			dataPermission.push("DISAPPROVE_PAYMENT_SCHEDULE");
		
		if(approveFarmCheckboxes[index].checked==true)
			dataPermission.push("APPROVE_FARM");
		
		if(disapproveFarmCheckboxes[index].checked==true)
			dataPermission.push("DISAPPROVE_FARM");
		
		
		dataEntry.userId = element.value;
		dataEntry.permission = dataPermission;
		dataEntry.level = (index+1);
		
		dataHolder.push(dataEntry);
		console.log("====================>>>");
		//console.log(dataHolder);
    });
	
	if(workflowuserHolder.length==1)
	{
		errorMessage = "Your workflow process must contain at least two people";
	}
	
	if(errorMessage!=null)
		toastr.error(errorMessage);
	else
		sendDataToCreateWorkflow(dataHolder);
	
	
}


function sendDataToCreateWorkflow(dataHolder)
{
	var dataToSend = {};
	dataToSend['data'] = dataHolder;
	dataToSend['_token'] = "{{ csrf_token() }}";
	console.log(dataToSend);
	
	$.ajax({
	  type: "POST",
	  url: "/create-new-workflow-api",
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
					window.location.href = "/administrator/workflow/view-users";
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



function handleAddNewAdministrator()
{
	//alert(33);
	
	var $div = $("<div>", {"class": "form-group"});
	var $select = $("<select>", {"onchange": "(this)", "name": "workflowuser[]", "class": "ut form-control float-left select1", "style": "width: auto !important", "required": true, "placeholder":"Enter Name of your User Type"});
	$select.append($("<option>", {"value": -1, "text": ("--Select An Administrator--")}));
	@foreach($userList as $ul)
		$select.append($("<option>", {"value": {{$ul->user->id}}, "text": ("{{$ul->user->firstName}} {{$ul->user->lastName}} - ({{$ul->userType}})")}));
	@endforeach
	var $a = $("<a>", {"class": "btn btn-primary float-left", "onclick": "handleAddNewAdministrator()"});
	var $i = $("<i>", {"class": "fa fa-plus"});
	var etc = '<div class="float-left" style="padding: 20px">&nbsp;</div>';
	etc = etc + '<div class="form-group clearfix">';
	  etc = etc + '<div class="icheck-primary d-inline">';
		etc = etc + '<input type="checkbox" id="" name="approve[]" class="approveClass">';
		etc = etc + '<label for="">';
		etc = etc + '</label>';
	  etc = etc + '</div>';
	  etc = etc + '<div class="icheck-primary d-inline" style="padding-left: 10px !important">';
		etc = etc + '<label for="">';
		  etc = etc + 'Approve Permission';
		etc = etc + '</label>';
	  etc = etc + '</div>';
	  
	  etc = etc + '<div class="icheck-primary d-inline" style="padding-left: 20px !important">';
		etc = etc + '<input type="checkbox" id="" name="disapprove[]" class="disapproveClass">';
		etc = etc + '<label for="">';
		etc = etc + '</label>';
	  etc = etc + '</div>';

	  etc = etc + '<div class="icheck-primary d-inline" style="padding-left: 10px !important">';
		etc = etc + '<label for="">';
		  etc = etc + 'Dispprove Permission';
		etc = etc + '</label>';
	  etc = etc + '</div>';
	etc = etc + '</div>';
					
	$a.append($i);
	$div.append($a);
	$div.append($select);
	$div.append(etc);
	var roleHolder = $('#roleHolder').append($div);
	//console.log($('#roleHolder').html());
	
	/*<div class="form-group">
		<label for="userType">Select A User Role</label>
		<div style="clear: both !important">
			<select name="userType" class="ut form-control float-left" style="width: auto !important" required id="userType" placeholder="Enter Name of your User Type">
				<option value>--Select An Administrator---</option>
				@foreach($userList as $ul)
				<option value="{{$ul->user->id}}">{{$ul->user->firstName}} {{$ul->user->lastName}}</option>
				@endforeach
			</select>
			<a  class="btn btn-primary" onclick="handleAddNewAdministrator()"><i class="fa fa-plus"></i></a>
		</div>
		
	  </div>*/
}

</script>
</body>
</html>
