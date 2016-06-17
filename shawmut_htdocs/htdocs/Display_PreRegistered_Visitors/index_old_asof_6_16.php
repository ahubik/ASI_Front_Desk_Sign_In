<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="refresh" content="300; URL='index.html'" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Welcome to Shawmut</title>

    <!-- Bootstrap Core CSS -->
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="table.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="cover.css" rel="stylesheet">
    <link href="shawmut.css" rel="stylesheet">

    <!-- Date Time Picker -->
    <link href="css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">    


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<style type="text/css">
   body { background: #5d5597 !important; }
</style>
    <div id="wrapper">
        <div id="page-wrapper" class="span10">
            <div class="row">
                <div class="col-lg-12">
                    <a href="../signin/index.html"><img src="img/shawmut-logo.png" alt="Shawmut" max-height="100%" max-width="100%"></a>
                    <h1 class="page-header">Pre-Registered visitors</h1>
				</div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <br><br><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-shawmut">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body panel-shawmut">
                            <div class="row">
                                <div class="col-lg-6">
                                <table border="1">
                                <thead> If you have been Pre-Registered, please click on your entry. <!-- Pre-Registered Visitors --> </thead>
                                <?php 
                                $path = "PreRegistered_Visitor_Data.csv";
								$pointer = fopen($path, 'r');
								
								//echo "<br>"; //Debugging
    		
								while(!feof($pointer))
  								{
									$line = fgets($pointer);
									
									echo "<tr>\n";
									
									$items = explode(',', $line);
									//echo "[".implode("|", $items)."] <br>";
									$count = 0; //debug
									
									$rowString = "";
									reset($items);
									foreach ($items as $item) {
										//echo "<td>" . $item ." (no. ". $count . ")</td>";
										$rowString .= "<td>" . $item . "</td>\n";
										$count += 1;
									}
									echo $rowString;
									
									echo "</tr>\n";
  								}
  								
								fclose($pointer);
								
                                ?>
                                </table>                 
                                </div>
                                <div class="col-lg-1">
                                </div>
                                <div class="col-lg-5">  
                                
                                
                                <!-- <SCRIPT LANGUAGE="Javascript">
								var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
								var monthNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
								var now = new Date();

								var theYear = now.getFullYear();
								var theMonth = (now.getMonth()+1)%12;
								var theDay = now.getDay();
								var theDate = now.getDate();
								var theHour = now.getHours();
								var theAMPM = "AM";
								if(theHour>11) theAMPM = "PM";
								theHour = theHour%12;
								if(theHour==0){theHour=12;}
								var theMinute = now.getMinutes();
								if(theMinute<10) theMinute = "0" + theMinute;
								document.write("<h1><center>" + dayNames[now.getDay()]  + "</center></h1><hr><h2><center>" + theMonth + "/" + theDate + "/" + theYear + "   " + theHour + ":" + theMinute + " " + theAMPM + "</h2></center>");
								</SCRIPT> -->
                                
                                
                               	</div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <button onclick="window.location.href='../Front_Desk_Check_In'" style="color:black">I'm not in this list</button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
