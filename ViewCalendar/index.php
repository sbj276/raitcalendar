<?php
require_once('bdd.php');

//fetching the current system events
$sql = "SELECT `cal_events_new`.event_id AS event_id, `cal_events_new`.event_name AS event_name, `cal_events_new`.location AS location, `cal_events_new`.category AS category, `cal_events_new`.start_date AS start_date, `cal_events_new`.end_date AS end_date, `cal_events_new`.event_desc AS description,`cal_events_new`.branch AS branch, `category_table`.category_color AS color, `category_table`.branch_indicator AS indicator FROM cal_events_new LEFT JOIN category_table ON `cal_events_new`.branch=`category_table`.name OR `cal_events_new`.category=`category_table`.name GROUP BY event_id";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

//fetching all the preexisting events
$sql = "SELECT `cal_events`.event_id AS event_id, `cal_events`.event_name AS event_name, `cal_events`.start_date AS start_date, `cal_events`.location AS location, `cal_events`.category AS category, `cal_events`.end_date AS end_date, `cal_events`.event_desc AS description,`cal_events`.branch AS branch, `category_table`.category_color AS color, `category_table`.branch_indicator AS indicator FROM cal_events LEFT JOIN category_table ON `cal_events`.branch=`category_table`.name OR `cal_events`.category=`category_table`.name GROUP BY event_id";

$req = $bdd->prepare($sql);
$req->execute();

$old_events = $req->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Events</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />

    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/chatbubbles.css">

    <!-- Custom CSS -->
    <style>
	#calendar {
		width: 80%;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
    </style>
	    <style>
	#calendar {
		width: 80%;float:left;
		border-radius: 50px;
		margin-top:50px;
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
        <img src="images/headerlogo.png" style="position:absolute;height:100%;width:auto;margin-left:10%">

        <div style="color: #fff;float: right;margin-right: 4%;font-size: 30px;margin-left: 7px;margin-top: 9px;"><a href="../ViewTabular/" style="color:#fff"><i class="fa fa-table" aria-hidden="true" title="Toggle to tabular view"></i></a></div>
        <div id="logged-in-user" style="color:#fff;float:right;margin-right: 1%;font-size:20px;margin-top:15px;"><?php

        session_start();
        if(isset($_SESSION['login'])){
        	echo '<a style="color:#fff" href="../EditModeCalendar">ADD EVENTS</a>';
        }
        else{
        	echo '<a style="color:#fff" href="../Login/">Login</a>';
        }
        ?></div>
    </header>
    <!-- Page Content -->
    <div class="container" style="margin-top:3%">

        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="calendar" class="col-centered">
                </div>

                				<!--sidediv-->
				<div id="colorcor" class="colorcor">
						<!-- not required as we have to -->
						<!-- <table align="left"style="boder:1px solid black; width:100%">
						<col width="80">
						<col width="1">
						<tr><th>Categories:</th>
						<th></th>
						</tr>
						<tr><td align="left">Computer</td>
						<td ><i class="fa fa-desktop" aria-hidden="true"></i></td>
						</tr>
						<tr><td align="left">IT</td>
						<td><i class="fa fa-globe" aria-hidden="true"></i></td>
						</tr>
						<tr><td align="left">Electronics</td>
						<td ><i class="fa fa-plug" aria-hidden="true"></i></td>
						</tr>
						<tr><td align="left">EXTC</td><td><i class="fa fa-signal" aria-hidden="true"></i></td>
						</tr>
						<tr><td align="left">Instrumentation</td><td><i class="fa fa-wrench" aria-hidden="true"></i></td>
						</tr>
						<tr><td align="left">FE</td><td><i class="fa fa-book" aria-hidden="true"></i> </td>
						</tr>
						<tr><td align="left">Technical</td><td style="border-radius: 40px!important;" bgcolor="#0000FF"></td>
						</tr>
						<tr><td align="left">Examination</td><td style="border-radius: 40px!important;" bgcolor="#A52A2A"></td>
						</tr>
						<tr><td align="left">Placement</td><td style="border-radius: 40px!important;" bgcolor="#7FFF00"></td>
						</tr>
						<tr><td align="left">Administration</td><td style="border-radius: 40px!important;" bgcolor="#FF8C00"></td>
						</tr>
						<tr><td align="left">Alumni</td><td style="border-radius: 40px!important;" bgcolor="#00CED1"></td>
						</tr>
						<tr><td align="left">Workshops/Seminars</td><td style="border-radius: 40px!important;" bgcolor="#A0522D"></td>
						</tr>
						<tr><td align="left">Cultural</td><td style="border-radius: 40px!important;" bgcolor="#006400"></td>
						</tr>
						<tr><td align="left">Fests</td><td style="border-radius: 40px!important;" bgcolor="#8A2BE2"></td>
						</tr>
						<tr><td align="left">Sports</td><td style="border-radius: 40px!important;" bgcolor="#FFFF00"></td>
						</tr>
						<tr><td align="left">Committees</td><td style="border-radius: 40px!important;" bgcolor="#EE82EE"></td>
						</tr>
						<tr><td align="left">Faculty</td><td style="border-radius: 40px!important;" bgcolor="#00FFFF"></td>
						</tr>
						<tr><td align="left">Students</td><td style="border-radius: 40px!important;" bgcolor="#808080"></td>
						</tr>
						<tr><td align="left">Holiday</td><td  style="border-radius: 40px!important;" bgcolor="#FF0000"></td>
						</tr>
						<tr><td align="left">Others</td><td style="border-radius: 40px!important;" bgcolor="#000000"></td>
						</tr>
						</table> -->
						<!-- </br></br>
						<h5><i class="fa fa-download" aria-hidden="true"></i><a href="link/to/your/download/file" download="filename">Download Manual</a></h5> -->
		        </div>
				<!--sidedivclose-->
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<!-- Modal -->
		<div class="modal fade" id="ModalDescription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form" method="POST" action="addEvent.php">
			
			  	<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Description</h4>
			  	</div>
			  	<div class="modal-body">
				
				  	<div class="form-group">
						<label for="event_name" class="col-sm-8 control-label">Event Name:</label>
						<input type="text" name="event_name" class="form-control" id="event_name" readonly>
				  	</div>
					<div class="row">
				  		<div class="col-sm-6">

						  	<div class="form-group">
								<label for="event_category" class="col-sm-8 control-label">Category:</label>
								<input type="text" name="event_category" class="form-control" id="event_category" readonly>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="branch" class="col-sm-8 control-label">Branch:</label>
								<input type="text" name="branch" class="form-control" id="branch" readonly>
						  	</div>
						</div>
					</div>
				  	<div class="row">
				  		<div class="col-sm-6">
						  	<div class="form-group">
								<label for="event_start" class="col-sm-8 control-label">Start date</label>
							 	<input type="text" name="event_start" class="form-control datepicker" id="event_start" readonly>
						  	</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="event_end" class="col-sm-8 control-label">End date</label>
								<input type="text" name="event_end" class="form-control datepicker" id="event_end" readonly>
							</div>
						</div>
					</div>
				
				  	<div class="form-group">
						<label for="event_desc" class="col-sm-8 control-label">Description</label>
						<textarea type="text" name="event_desc" rows="5" class="form-control" id="event_desc" readonly></textarea>
				  	</div>
				  	<div class="form-group">
						<label for="event_location" class="col-sm-8 control-label">Location</label>
						<input type="text" name="event_location" class="form-control" id="event_location" readonly>
				  	</div>
			  	</div>
			</form>
		</div>
	</div>
</div>


    </div>

    <div class="talk-bubble border round btm-right-in bubble">
		<div class="talktext">
		   <p>mandeep</p>
		</div>
	</div>


    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	
	<script>


	
	$(document).ready(function() {
		
		$(".bubble").hide();
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			selectable: false,
			selectHelper: false,
			eventMouseover: function(event, jsEvent, view){
				// $(".bubble").hide();
				$(".bubble").find('p').html(event.title);
				$(".bubble").toggle("drop",{direction: "right"});
			},
			eventMouseout: function(event, jsEvent, view){
				$(".bubble").toggle("drop",{direction: "right"});
			},
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				if(event.icon){          
			        element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>  ");
			     }
				element.bind('dblclick', function() {
					// alert(event.description);
					$('#ModalDescription #event_name').val(event.title);
					$('#ModalDescription #event_desc').val(event.description);
					$('#ModalDescription #event_location').val(event.location);
					$('#ModalDescription #event_category').val(event.category);
					$('#ModalDescription #event_start').val(event.start);
					$('#ModalDescription #event_end').val(event.end);
					$('#ModalDescription #branch').val(event.branch);
					//branch
					$('#ModalDescription').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 				

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
					title: "<?php echo "[".$event['category']."] : ".$event['event_name']; ?>",
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
					endforeach; ?>
			]
		});		
	});
</script>

</body>

</html>
