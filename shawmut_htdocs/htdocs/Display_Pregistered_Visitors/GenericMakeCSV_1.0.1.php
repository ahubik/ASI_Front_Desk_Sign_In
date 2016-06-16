<?php
$date=date("Ymd");
$firstName=$_POST['First_Name'];

echo "<h1>Thanks for signing in ".$firstName."!</h1> <br>";
$fileName="Visitor_Log_".$date.".csv";
$path ="./" . $fileName;
echo("The Form Name is [" . $_POST['formName'] . "]");
echo("The Path is [" . $path . "]");

$theFile = $path; //just plop it in the same folder for now
//echo "The CSV file is ".$theFile;

$specialColumns = array(
    "pubDate" => "Publish On",
    "unPubDate" => "Unpublish On",
    "pubStatus" => "Published Status"
    );

$csv_column_names = array();//containers for columns and values, to be dynamically populated
$csv_values = array();
foreach ($_POST as $key => $value) {//loop through the POST results, ignoring the title and any other special fields, to populate the column titles and values

    if ($key != 'theFeatureTitle' && $key != 'formName') {//make some exceptions
        if (array_search($key, array_keys($specialColumns))){
            $fieldTitle = $specialColumns[$key];
        } else {
            $fieldTitle = str_replace('_', ' ', $key);//Replace underscores with spaces, allowing forms to utilize the exact field names required.
            //if time, detedt and split up camel case
        }
        $csv_column_names[] = $fieldTitle;//make this one ordered
        $csv_values[$fieldTitle] = $value;//but structure this one by field name
        
 //       echo "<hr>";
//        echo("The key is [" .$key. "]<p>");
//        echo("The fieldTitle is [" .$fieldTitle. "]<p>");
//        echo("The value is [" .$value. "]<p>");
        

    }
    elseif ($key != 'formName') {
        //do nothing for now
    }
}

//check for required fields
    foreach ($csv_column_names as $name) {
        $csvData = $csvData . $csv_values[$name] . ",";
    }
    $csvData = $csvData . $date . "\n";

//If the file does not exist, write the column headers first
if (file_exists($theFile)) {
	//no need to add column headers
	} else {
    //$csvHeader="GUID,Name,SubName,Description,Phone,Email,URL,Facebook Page,Twitter ID,Published Status,Relationship,Categories,Image URL,Audio URL,Video URL,Start Pub Date,End Pub Date,Date\n";
        $csvHeader="";//GUID,"; //GUID and Date are hardcoded and NAme will always exist (and be special)
        $date_Placed = FALSE;
        foreach ($csv_column_names as $name) {
            if ($name == "Date") {
                $date_Placed = TRUE;
            }
            $csvHeader = $csvHeader . $name . ",";
        }
        if (!$date_Placed){//Put the Date at the end
            $csvHeader = $csvHeader . "Date";
        }
        $csvHeader = $csvHeader . "\n";
	$fp = fopen($theFile,"a"); // $fp is now the file pointer to file $filename

    if($fp){
        fwrite($fp,$csvHeader); // Write information to the file
        fclose($fp); // Close the file
    }
}
echo "Got here 3 <p>";

//write the data
        echo("The csvData is [" .$csvData. "]<p>");

$fp = fopen($theFile,"a"); // $fp is now the file pointer to file $filename

    if($fp){
        fwrite($fp,$csvData); // Write information to the file
        fclose($fp); // Close the file
    }

?>