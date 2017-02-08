<?php
//session
session_start();

if(!isset($_SESSION['login']))
	{
	header('Location:../Login');
	}

	//start
require_once('bdd.php');

$sql = "SELECT `cal_events_new`.event_id AS event_id, `cal_events_new`.event_name AS event_name, `cal_events_new`.start_date AS start_date, `cal_events_new`.location AS location, `cal_events_new`.end_date AS end_date, `cal_events_new`.event_desc AS description,`cal_events_new`.branch AS branch, `cal_events_new`.category AS category,`cal_events_new`.web_user AS web_user, `category_table`.category_color AS color, `category_table`.branch_indicator AS indicator FROM cal_events_new LEFT JOIN category_table ON `cal_events_new`.branch=`category_table`.name OR `cal_events_new`.category=`category_table`.name GROUP BY event_id";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Events</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='../css/fullcalendar.css' rel='stylesheet' />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css">
    <!-- Custom CSS -->
    <style>
	.col-centered{
		float: none;
		margin: 0 auto;
	}

	#calendar {
		width: 100%;float:left;
		border-radius: 50px;
		font-size: 150%;
	}
	#colorcor {
	    background-color: white;
	    float: right;
	    width: 19%;
	    height: 500px;
	    margin-left: 5px;
	    margin-top: 101px;
	    padding-left: 14px;
	}
	#lab  {
		float:left;
	}
	tr{
		padding:1px!important;
	}
    </style>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <header style="display:block;position:relative;background:#9B1B30;height:60px;width:100%">
        <img src="../images/headerlogo.png" style="position:absolute;height:100%;width:auto;margin-left:10%">

        <div style="color: #fff;float: right;margin-right: 4%;font-size: 30px;margin-left: 7px;margin-top: 9px;"><a href="../EditModeForm/" style="color:#fff"><i class="fa fa-table" aria-hidden="true" title="Toggle to form view"></i></a></div>
        <div id="logged-in-user" style="color:#fff;float:right;    margin-right: 1%;font-size:20px;margin-top:15px;">Welcome,<?php echo $_SESSION['login']; ?></div>
		<div style="color: #fff;float: right;margin-right: 5px;font-size: 30px;margin-left: 0px;margin-top: 9px;"><a href="../Login/logout.php" style="color:#fff"><i class="fa fa-power-off" aria-hidden="true" title="Log Out"></i></i></a></div>
    </header>
    <!-- Page Content -->
    <div class="container" style="margin-top:3%">

        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="calendar" class="col-centered">
                </div>
            </div>
        </div>
        <!-- /.row -->
		

		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form" method="POST" action="addEvent.php">
			
			  	<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add Event</h4>
			  	</div>
			  	<div class="modal-body">
				
				  	<div class="form-group">
						<label for="event_name" class="col-sm-8 control-label">Event Name:</label>
						<input type="text" name="event_name" class="form-control" id="event_name" placeholder="Event Name" required>
				  	</div>
					<div class="row">
				  		<div class="col-sm-6">

						  	<div class="form-group">
								<label for="event_category" class="col-sm-2 control-label">Category:</label>
							  	<select name="event_category" class="form-control" id="event_category" required>
								  	<option value="">Select Category</option>
								  	<option style="color:#0000FF;" value="Technical">Technical</option>
								  	<option style="color:#A52A2A;" value="Examination">Examination</option>
								  	<option style="color:#7FFF00;" value="Placement">Placements</option>
								  	<option style="color:#FF8C00;" value="Administration">Administration</option>
								  	<option style="color:#00CED1;" value="Alumini">Alumini</option>
								  	<option style="color:#A0522D;" value="Workshop">Workshop</option>
								  	<option style="color:#006400;" value="Cultural">Cultural</option>
								  	<option style="color:#8A2BE2;" value="Fests">Fests</option>
								  	<option style="color:#FFFF00;" value="Sports">Sports</option>
								  	<option style="color:#EE82EE;" value="Committee">Committee</option>						  
								  	<option style="color:#00FFFF;" value="Faculty">Faculty</option>
								  	<option style="color:#FF0000;" value="Holiday">Holiday</option>
								  	<option style="color:#808080;" value="Student">Student</option>
								  	<option style="color:#000000;" value="Others">Others</option>
								</select>
						  	</div>
						</div>
						<div class="col-sm-6">
							<label for="branch" class="col-sm-2 control-label">Branch:</label>
							<select class="selectpicker form-control" name="branch[]" id="branch" multiple required>
								<option data-icon="fa-desktop">COMPUTER</option>
								<option data-icon="fa-globe">IT</option>
								<option data-icon="fa-signal">EXTC</option>
								<option data-icon="fa-plug">ETRX</option>
								<option data-icon="fa-wrench">INSTRU</option>
								<option data-icon="fa-graduation-cap">FE</option>
							</select>
						</div>
					</div>
				  	<div class="row">
				  		<div class="col-sm-6">
						  	<div class="form-group">
								<label for="event_start" class="col-sm-8 control-label">Start date</label>
							 	<input type="text" name="event_start" class="form-control datepicker" id="event_start" required>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="event_end" class="col-sm-8 control-label">End date</label>
								<input type="text" name="event_end" class="form-control datepicker" id="event_end" required>
							</div>
						</div>
					</div>
				
				  	<div class="form-group">
						<label for="event_desc" class="col-sm-8 control-label">Description</label>
						<textarea type="text" name="event_desc" rows="5" class="form-control" id="event_desc" required></textarea>
				  	</div>
				  	<div class="form-group">
						<label for="event_location" class="col-sm-8 control-label">Location</label>
						<input type="text" name="event_location" class="form-control" id="event_location" required>
				  	</div>
			  	</div>
			  	<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
			  	</div>
			</form>
		</div>
	</div>
</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form" method="POST" action="updateEvent.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
			  </div>
			  <div class="modal-body">
				  <input type="text" name="event_id" id="event_id"/>
				  <div class="form-group">
						<label for="event_name" class="col-sm-8 control-label">Event Name:</label>
						<input type="text" name="event_name" class="form-control" id="event_name" placeholder="Event Name" required>
				  	</div>

						  	<div class="form-group">
								<label for="event_category" class="col-sm-2 control-label">Category:</label>
							  	<select name="event_category" class="form-control" id="event_category" required>
								  	<option value="">Select Category</option>
								  	<option style="color:#0071c5;" value="Technical">Technical</option>
								  	<option style="color:#40E0D0;" value="Examination">Examination</option>
								  	<option style="color:#008000;" value="Placement">Placements</option>
								  	<option style="color:#FFD700;" value="Administration">Administration</option>
								  	<option style="color:#FF8C00;" value="Alumini">Alumini</option>
								  	<option style="color:#FF0000;" value="Workshop">Workshop</option>
								  	<option style="color:#000000;" value="Cultural">Cultural</option>
								  	<option style="color:#0071c5;" value="Fests">Fests</option>
								  	<option style="color:#40E0D0;" value="Sports">Sports</option>
								  	<option style="color:#008000;" value="Committee">Committee</option>						  
								  	<option style="color:#FFD700;" value="Faculty">Faculty</option>
								  	<option style="color:#FF8C00;" value="Holiday">Holiday</option>
								  	<option style="color:#FF0000;" value="Others">Others</option>
								  	<option style="color:#000000;" value="Others">Others</option>
								</select>
						  	</div>


					<div class="form-group">
						<label for="event_desc" class="col-sm-8 control-label">Description</label>
						<textarea type="text" name="event_desc" rows="5" class="form-control" id="event_desc" required></textarea>
				  	</div>
				  	<div class="form-group">
						<label for="event_location" class="col-sm-8 control-label">Location</label>
						<input type="text" name="event_location" class="form-control" id="event_location" required>
				  	</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
			  <div class="row">
			  	<div class="col-sm-6">
			  		<div class="form-group"> 
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
						  </div>
					</div>
				</div>
				<div class="col-sm-6">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			  </div>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='../js/moment.min.js'></script>
    <script src="../js/bootstrap-datetimepicker.min.js"></script>
	<script src='../js/fullcalendar.min.js'></script>
	<script src='../js/bootstrap-select.min.js'></script>
	
	<script>

	$(document).ready(function() {
		
		$("#event_id").hide();
		$("#branch1").hide();
		$('.selectpicker').selectpicker({
    		iconBase: 'fa',
    		tickIcon: 'fa-check'
		});

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				$('#ModalAdd #event_start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #event_end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				if(event.icon){          
			        element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>  ");
			     }
				element.bind('dblclick', function() {
					// alert("dblclick");
					$('#ModalEdit #event_id').val(event.id);
					$('#ModalEdit #branch').val(event.branch);
					$('#ModalEdit #event_name').val(event.title);
					$('#ModalEdit #event_desc').val(event.description);
					$('#ModalEdit #event_location').val(event.location);
					$('#ModalEdit #event_category').val(event.category);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // if change of position
				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // if the change in length
				edit(event);

			},
			events: [
			<?php foreach($events as $event): 
			if($_SESSION['login']==$event['web_user']){
				

				$start = explode(" ", $event['start_date']);
				$end = explode(" ", $event['end_date']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start_date'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end_date'];
				}
			?>
				{
					id: '<?php echo $event['event_id']; ?>',
					title: "<?php echo $event['event_name']; ?>",
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
					icon: '<?php switch($event['branch']){
									case "COMPUTER" : echo "desktop";break;
									case "IT" : echo "globe";break;
									case "EXTC" : echo "signal";break;
									case "INSTRU" : echo "desktop";break;
									case "ETRX" : echo "plug";break;
									case "FE" : echo "book";break;
								} ?>',
					description: "<?php echo $event['description']; ?>",
					location: "<?php echo $event['location']; ?>",
					branch: "<?php echo $event['branch']; ?>",
					category: "<?php echo $event['category']; ?>"
				},
					<?php
					} 
					
				else if($_SESSION['login']=="admin"){
				

				$start = explode(" ", $event['start_date']);
				$end = explode(" ", $event['end_date']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start_date'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end_date'];
				}
			?>
				{
					id: '<?php echo $event['event_id']; ?>',
					title: "<?php echo $event['event_name']; ?>",
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
					icon: '<?php switch($event['branch']){
									case "COMPUTER" : echo "desktop";break;
									case "IT" : echo "globe";break;
									case "EXTC" : echo "signal";break;
									case "INSTRU" : echo "desktop";break;
									case "ETRX" : echo "plug";break;
									case "FE" : echo "book";break;
								} ?>',
					description: "<?php echo $event['description']; ?>"
				},
					<?php
					} 
					endforeach; ?>
			]
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
	});
</script>

</body>

</html>
