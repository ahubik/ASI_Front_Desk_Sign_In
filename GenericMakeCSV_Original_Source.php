<?php
//Instead of making one specialized PHP script for each of five or six CSV formats, I'll just make one script that automatically finds the CSV format it's looking ofr and uses that.  Much easier.

echo "<h1>Thanks for your submission</h1> <br>";
echo "<h2>All updates are processed at the end of the day.</h2><br>";
echo "<h3>Updates submitted after 5:00 PM Eastern Time will be process the following day.</h3><br>";
$fileName=trim(explode(" ", $_POST['formName'])[0])."_".date("Ymd").".csv";
echo("The Form Name is [" . $_POST['formName'] . "]");

$theFile = "../uploads/".$fileName;
//echo "The CSV file is ".$theFile;

$specialColumns = array(
    "pubDate" => "Publish On",
    "unPubDate" => "Unpublish On",
    "pubStatus" => "Published Status"
    );

$GUID="ABC";
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
    }
    elseif ($key != 'formName') {
        //do nothing for now
    }
}
$theTitle=$_POST['theFeatureTitle'];
/*$subName=$_POST['subName']; // These lines should be replaced by the loop
$description=$_POST['description'];
$phone=$_POST["phone"];
$email=$_POST["email"];
$siteURL=$_POST['siteURL'];
$facebook=$_POST["facebook"];
$twitter=$_POST["twitter"];
$pubStatus=$_POST["pubStatus"];
$relationships=$_POST['relationships'];
$categories=$_POST['categories'];
$imageURL=$_POST['imageURL'];
$audioURL=$_POST['audioURL'];
$videoURL=$_POST['videoURL'];
$pubDate=$_POST['pubDate'];
$unPubDate=$_POST['unPubDate'];*/
$UUID="123";

//check for required fields
if(!empty($theTitle)){
//$csvData = $GUID.",".$theTitle.",".$subName.",".$description.",".$phone.",".$email.",".$siteURL.",".$faceBook.",".$twitter.",".$pubStatus.",".$relationships.",".$categories.",".$imageURL.",".$audioURL.",".$videoURL.",".$pubDate.",".$unPubDate.",".$UUID."\n";
    $csvData = $GUID.",".$theTitle.",";
    foreach ($csv_column_names as $name) {
        $csvData = $csvData . $csv_values[$name] . ",";
    }
    $csvData = $csvData . $UUID . "\n";

//If the file does not exist, write the column headers first
if (file_exists($theFile)) {
	//no need to add column headers
	} else {
    //$csvHeader="GUID,Name,SubName,Description,Phone,Email,URL,Facebook Page,Twitter ID,Published Status,Relationship,Categories,Image URL,Audio URL,Video URL,Start Pub Date,End Pub Date,UUID\n";
        $csvHeader="GUID,Name,"; //GUID and UUID are hardcoded and NAme will always exist (and be special)
        $UUID_Placed = FALSE;
        foreach ($csv_column_names as $name) {
            if ($name == "UUID") {
                $UUID_Placed = TRUE;
            }
            $csvHeader = $csvHeader . $name . ",";
        }
        if (!$UUID_Placed){//Put the UUID at the end
            $csvHeader = $csvHeader . "UUID";
        }
        $csvHeader = $csvHeader . "\n";
	$fp = fopen($theFile,"a"); // $fp is now the file pointer to file $filename

    if($fp){
        fwrite($fp,$csvHeader); // Write information to the file
        fclose($fp); // Close the file
    }
}

//write the data
$fp = fopen($theFile,"a"); // $fp is now the file pointer to file $filename

    if($fp){
        fwrite($fp,$csvData); // Write information to the file
        fclose($fp); // Close the file
    }
}
?>