<?php
//session
session_start();

if(!isset($_SESSION['login']))
    {
    header('Location:../Login');
    }
$logged_in_user=$_SESSION['login'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add event</title>
       

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="../css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href='/raitcalendarnew/css/jquery-ui.css'>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    </head>
    <body>
   <header style="display:block;position:relative;background:#9B1B30;height:60px;width:100%">
        <img src="../images/headerlogo.png" style="position:absolute;height:100%;width:auto;margin-left:10%">
        <div style="color: #fff;float: right;margin-right: 4%;font-size: 30px;margin-left: 7px;margin-top: 7px;"><a href="../EditModeCalendar/" style="color:#fff"><i class="fa fa-calendar" aria-hidden="true" title="Toggle to calendar view"></i></a></div>
        <div id="logged-in-user" style="color:#fff;float:right;margin-right:1%;font-size:20px;margin-top:15px;">Welcome, <?php echo $_SESSION['login']; ?></div>
        <div style="color: #fff;float: right;margin-right: 5px;font-size: 30px;margin-left: 0px;margin-top: 9px;"><a href="../Login/logout.php" style="color:#fff"><i class="fa fa-power-off" aria-hidden="true" title="Log Out"></i></i></a></div>
   </header>
        <div class="container" style="margin-top:2%">
            <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Add Event</div>
                                </div>
                                <div >
                                    <form class="form-horizontal" action="addevent.php" method="POST">
                                        <fieldset style="margin-top:3%">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="typeahead">Event Name: </label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control col-md-6" id="typeahead" name="event_name" placeholder="Event Name " required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="date01">Start Date</label>
                                                <div class="col-lg-2">
                                                    <input type='text' class="form-control datepicker" name="event_start" value="Date" placeholder="mm/dd/yyyy" style="width: 120%" required/>
                                                </div>
                                                <label class="col-lg-2 control-label" for="date01">End Date</label>
                                                <div class="col-lg-2">
                                                    <input type="text" class="form-control datepicker" name="event_end" value="Date" placeholder="mm/dd/yyyy" style="width: 120%" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="textarea-wysihtml5">Event Description</label>
                                                <div class="col-lg-10">
                                                    <textarea id="textarea-wysihtml5" class="form-control textarea-wysihtml5" name="event_desc" placeholder="Enter description..." style="width: 100%; height: 200px"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="select01">Event Category</label>
                                                <div class="col-lg-10 show-categories">
                                                <?php

                                                include '../connect.php';

                                                $category_result=mysqli_query($conn,"SELECT category FROM restrictions WHERE username='$logged_in_user' AND category!=''");//todo:change to session variable
                                                // if(!$category_result)
                                                //     echo mysqli_error($conn);
                                                $branch_result=mysqli_query($conn,"SELECT branch FROM restrictions WHERE username='$logged_in_user' AND branch!=''");//todo:change to session variable
                                                // if(!$branch_result)
                                                //     echo mysqli_error($conn);

                                                echo '<div class="row">
                                                        <div class="col-lg-4">';
                                                echo '<div class="radio"><label><b>Branches</b></label></div>';

                                                    if(mysqli_num_rows($branch_result)==6){
                                                        echo '
                                                                <div class="checkbox">
                                                                    <label><input type="checkbox" id="checkall" value="">All Branches</label>
                                                                </div>';
                                                    }

                                                        while($row=mysqli_fetch_array($branch_result)){
                                                            echo '<div class="checkbox">
                                                                    <label><input type="checkbox" name="'.$row['branch'].'">'.$row['branch'].'</label>
                                                                </div>';
                                                        }
    
                                                echo '</div><!--end of column 1-->
                                                        <div class="col-lg-4">';
                                                    echo '<div class="radio"><label><b>Categories</b></label></div>';

                                                            $i=0;
                                                            while($row=mysqli_fetch_array($category_result)){
                                                                // $i=$i+1;
                                                                // if($i==8){
                                                                //     echo '<div class="col-lg-4">';
                                                                // }
                                                                echo '<div class="radio">
                                                                        <label><input type="radio" name="event_category" value="'.$row['category'].'">'.$row['category'].'</label>
                                                                      </div>';
                                                            }
                                                            // if($i>=8){
                                                                //echo '</div>';
                                                            // }
                                                
                                                echo '    </div><!--end of column 2-->
                                                    </div><!--end of row-->';
                                                ?>
                                                </div><!--end of show category-->
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="typeahead">Event Location: </label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control col-md-6" id="typeahead" name="event_location" placeholder="Event location ">
                                                   
                                                </div>
                                            </div>
                                           
                                            
                                            
                                            <button type="submit" class="btn btn-primary pull-right" style="margin-right:2%;margin-bottom:1%">Submit</button>
                                            <button type="reset" class="btn btn-default pull-right" style="margin-right:2%;margin-bottom:1%">Reset</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="/raitcalendarnew/js/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <script>
        $(document).ready(function(){
            $("#checkall").change(function(){
                if ($(this).is(':checked')) {
                    $("input:checkbox").prop( "checked", true );
                }
                else
                    $("input:checkbox").prop( "checked", false );
            });

            $('.datepicker').datetimepicker({
                format : 'YYYY/MM/DD HH:mm:ss'
            });
        });
        </script>
    </body>
</html>
