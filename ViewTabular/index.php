<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tabular|Calendar</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">

    <link rel='stylesheet prefetch' href='../css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='../css/bootstrap-theme.min.css'>
    <link rel='stylesheet prefetch' href='http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css'>

    <!-- js -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
	<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>


<style type="text/css">  
.LabelB{
font-family: OpenSans;
  width:8%;
  border-radius: 8px;
  border-style: groove;
  padding:3px;
  transition: all ease 0.3s;	
}
  #Technical:hover{
    background: #0000ff;
  }
  #Placement:hover{
    background: #A52A2A;
  }
  #Examination:hover{
    background: #7FFF00;
  }
  #Administration:hover{
    background: #FF8C00;
  }
  #Alumini:hover{
    background: #00CED1;
  }
  #Faculty:hover{
    background: #A0522D;
  }
  #Fest:hover{
    background: #006400;
  }
  #Sports:hover{
    background: #8A2BE2;
  }
  #Committee:hover{
    background: #FFFF00;
  }
  #Workshop:hover{
    background: #EE82EE;
  }
  #Holiday:hover{
    background: #00FFFF;
  }
  #Others:hover{
    background: #808080;
  }
</style>
  </head>
  <body>
   <header style="display:block;position:relative;background:#9B1B30;height:60px;width:100%">
   		<img src="../images/headerlogo.png" style="position:absolute;height:100%;width:auto;margin-left:10%">
   		<div style="color: #fff;float: right;margin-right: 4%;font-size: 30px;margin-left: 7px;margin-top: 7px;"><a href="../ViewCalendar/" style="color:#fff"><i class="fa fa-calendar" aria-hidden="true" title="Toggle to calendar view"></i></a></div>
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

	<div class="container">
		<div class="row" style="margin-top:2%">
			<div class="dropdown col-md-2 col-md-push-10" id="timestamp">	
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								Select timestamp
					<span class="caret"></span>
				</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li><a href="#">All</a></li>
						<li><a href="#">Today</a></li>
						<li><a href="#">Tomorrow</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Current_Week</a></li>
						<li><a href="#">Next_Week</a></li>
						<li><a href="#">Current_Month</a></li>
						<li><a href="#">Next_Month</a></li>
					</ul>
			</div>
			<div class="btn-group col-md-10 col-md-pull-2">
			  <button type="button" class="btn btn-default col-md-1 branch" id="COMPUTER"><i class="fa fa-laptop" aria-hidden="true"> COMP </i></button>
        <button type="button" class="btn btn-default col-md-1 branch" id="EXTC"><i class="fa fa-signal" aria-hidden="true"></i> EXTC</button>
        <button type="button" class="btn btn-default col-md-1 branch" id="IT" ><i class="fa fa-globe" aria-hidden="true"></i> IT </button>
			  <button type="button" class="btn btn-default col-md-1 branch" id="ETRX"><i class="fa fa-plug" aria-hidden="true"></i> ETRX</button>
			  <button type="button" class="btn btn-default col-md-1 branch" id="INSTRU"><i class="fa fa-wrench" aria-hidden="true"></i> INSTR</button>
			  <button type="button" class="btn btn-default col-md-1 disabled">&nbsp;</button>
        <button type="button" class="btn btn-default col-md-1 disabled">&nbsp;</button>
        <button type="button" class="btn btn-default col-md-1 disabled">&nbsp;</button>
        <button type="button" class="btn btn-default col-md-2 branch" id="">All Branches</button>
        <button type="button" class="btn btn-default col-md-2 category" id="">All Categories</button>

			</div>
		</div>

		<hr>

		<div class="row"  style="margin-top:1%">
			<div class="btn-group col-md-12"> 
			
 <input type="checkbox"   class='category' id="technical" style='display:none;' name='technical'><label for='technical' class=" col-md-1 LabelB" id='technical'>Technical</label>
 
  <input type="checkbox"  class='category' id="Examination" style='display:none;' name='Examination'><label for='Examination' class=" col-md-1 LabelB" id='Examination'>Examination</label>
  
  <input type="checkbox"  class='category' id="Placement" style='display:none;'><label for='Placement'class=" col-md-1 LabelB" id='Placement'>Placement</label>
  
  <input type="checkbox"   class='category' id="Administration" style='display:none; '><label for='Administration' style='width:10%;' class=" col-md-1 LabelB" id='Administration'>Administration</label>
  
  <input type="checkbox"   class='category' id="Alumini" style='display:none;'>	<label for='Alumini' class=" col-md-1 LabelB" id='Alumini'>Alumini</label>
  
  <input type="checkbox"  class='category' id="Faculty" style='display:none;' ><label for='Faculty' class=" col-md-1 LabelB" id='Faculty'>Faculty</label>
  
  <input type="checkbox"  class='category'id="Fest" style='display:none;'><label for='Fest' class=" col-md-1 LabelB" id='Fest'>Fest</label>
  
  <input type="checkbox"  class='category'id="Sports" style='display:none;'><label for='Sports'class=" col-md-1 LabelB" id='Sports'>Sports</label>
  
  <input type="checkbox"  class='category'id="Commitee" style='display:none;'><label for='Committee' class=" col-md-1 LabelB"id='Committee'>Committee</label>
  
  <input type="checkbox"  class='category' id="Workshop" style='display:none;'><label for='Workshop'class=" col-md-1 LabelB" id='Workshop'>Workshop</label>
  
  <input type="checkbox"  class='category' id="Others" style='display:none;'><label for='Others' class=" col-md-1 LabelB" id='Others'>Others</label>
  
  <input type="checkbox"  class='category' id="Holiday" style='display:none;'><label for='Holiday' class=" col-md-1 LabelB" id='Holiday'>Holiday</label>
 
			</div>
		</div>
		<hr>	
	</div>

  <center><div class="status">Showing sorted results for all branches, all categories, all timerange.</div></center>
	<div class="container">
  		<div class="row">
    		<form class="col-md4"></form>
  		</div>
  		<div class="row">
    		<div class="col md12">
      			<table class="table table-striped table-hover datatables">
        			<thead>
          			<tr>
            			<th style="width:20%">Event Name</th>
            			<th style="width:10%">From</th>
            			<th style="width:10%">To</th>
                  <th style="width:40%">Description</th>
            			<th style="width:20%">Location</th>
          			</tr>
        			</thead>
        			<tbody>
        				
        			</tbody>
      			</table>
    		</div>
  		</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <!--import datatables-->
    <!--js to import all the data-->
   <script>
    // $("#timestamp").hide();
	
    var table,branch="",category="",favorite = [],selected=[];
    $(document).ready(function() {
    	//the format of the description
		  // function format (data) {
		  //     return '<div class="details-container" style="padding:5% 5% 5% 5%">'+row.data().event_desc+'</div>';
		  // };
  		$(".LabelB").click(function(){
        if(-1==$.inArray($(this).attr('id'),selected,0)){
          selected.push($(this).attr('id'));   
         console.log("pushed");
         $(this).width(60);
         //$(this).css("background-color",($(this).css("background-color")));
         $(this).css("color","red");
         $(this).css("font-size",12);
          
        }else{
         console.log("not pushed");
         $(this).width(80);
         selected.splice($.inArray($(this).attr('id'), selected),1);
         $(this).css("color","black");
         $(this).css("font-size",14);
       }

      });
  		//intialising datatables
		    table = $('.datatables').DataTable({
		    ajax: 'return.php',
		    // Column definitions
			 
		    columns : [
		      {data : 'event_name'},
		      {data : 'start_date'},
		      {data : 'end_date'},
          {data : 'event_desc'},
		      {data : 'location'}
		    ],success: function(response) {
				$('#result').html(response);
				},
		     
		    pagingType : 'full_numbers',
		    lengthChange: true,
		    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		    bDestroy   : true,
		    dom: '<<B><lf><rt><ip>>',
        	buttons: [
            	'copy', 'csv', 'excel', 'pdf', 'print'
        	]
					

		    });


		    function reInitDatatable(link, reftable){
		    	$(".datatables").dataTable().fnDestroy();
		    	reftable = $('.datatables').DataTable({
		    // Column definitions
		    	ajax: link,
		    	columns : [
		      			{data : 'event_name'},
		      			{data : 'start_date'},
		      			{data : 'end_date'},
                {data : 'event_desc'},
		      			{data : 'location'}
		    		],success: function(response) {
				$('#result').html(response);
				},
			
		    pagingType : 'full_numbers',
        lengthChange: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        bDestroy   : true,
        dom: '<<B><lf><rt><ip>>',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]

		  	});
		    }
 		 //code to expand rows
  		  $('.datatables tbody').on('click', 'td', function () {
  		     var tr  = $(this).closest('tr'),
  		         row = table.row(tr);
  		    
  		     if (row.child.isShown()) {
  		       tr.next('tr').removeClass('details-row');
  		       row.child.hide();
  		       tr.removeClass('shown');
  		     }
  		     else {
  			   row.child('<div class="details-container" style="padding:5% 5% 5% 5%">'+row.data().event_desc+'</div>').show();
  		       tr.next('tr').addClass('details-row');
  		       tr.addClass('shown');
  		     }
  		  });
	 

/*     //to change the dropdown name as selected
      	$(".dropdown-menu li a").click(function(){
      		$(".dropdown-toggle").html($(this).text()+"<span class=caret></span>");
      		$(".dropdown-toggle").val($(this).text());
      		$(".dropdown-toggle").css({'background':'#aaa','color':'#fff'});
          timerange = $(".dropdown-toggle").val();
          $(".status").html("<b>Branch: </b>"+branch+"   <b>Category: </b>"+ category+"   <b>Timerange: </b>"+ timerange);
     		});
 */
   	//to show that a particular branch is selected
     		$(".branch").click(function(){
     			branch = $(this).attr('id');
				/* $.each($(".category:checked"), function(){            
				favorite.push($(this).attr('id'));
				}); */
				$(".status").html("<b>Branch: </b>"+branch+" <b>Category: </b>"+ category);
     			reInitDatatable('return.php?branch='+branch+'&category='+favorite,table);
				
     		});
		     $(".category").click(function(){
				
					  if($(this).prop("checked") == true){
						  favorite.push($(this).attr('id'));   
						
						$( '.checkboxes' ).on( 'click', 'input[type="checkbox"]', function () {
						$( this ).next('label').css('background-color','red');
						});
						  
						//category = this).attr('id');
							$(".status").html("<b>category: </b>"+favorite+"<b>branch:</b>"+branch);
							reInitDatatable('return.php?branch='+branch+'&category='+favorite,table);

					  }
					  if($(this).prop("checked") == false){
							category = $(this).attr('id');
							 favorite.splice($.inArray(category, favorite),1);
							 $(".status").html("<b>category: </b>"+favorite+"<b>branch:</b>"+branch);
						  reInitDatatable('return.php?branch='+branch+'&category='+favorite,table);
					  }
     		});
			
			/* $(".LabelB").click(function(){
				var i=0;
				var text=$(this).text();
				if(text=='Technical'){
					$(this).css('background-color','red');
					
				}
				else{
					$(this).css('background-color','White');
					}
				
			}); */


  });
   	</script>
  </body>
</html>
