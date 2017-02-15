<?php
$name = $_POST['name'];
$description = $_POST['description'];
$version = $_POST['version'];
$status = $_POST['status'];
$medium = $_POST['medium'];
$fakemon = $_POST['fakemon'];
$badges = $_POST['badges'];
$badgeMAX = $_POST['badgeMAX'];
$social = array('twitter'=>$_POST['twitter'],
										'reddit'=>$_POST['reddit'], 
										'facebook'=>$_POST['facebook'],
										'website'=>$_POST['website'],
										'tumblr'=>$_POST['tumblr'],
										'rc'=>$_POST['relicCastle'],
										'pc'=>$_POST['pokeCommunity'],
										'pb'=>$_POST['pokeBeach'],
										'pr'=>$_POST['pokemonReborn'],
										'deviantart'=>$_POST['deviantArt'],
										'soundcloud'=>$_POST['soundCloud'],
										'discord'=>$_POST['discord']);
$email = $_POST['email'];
$formcontent=" From: $name \n Description: $description \nVersion: $version \nStatus: $status \nMedium: $medium \nFakemon: $fakemon \nBadges: $badges of $badgeMAX";
foreach ($social as $site=>$link)
{
	$formcontent = $formcontent . "\n" . $site . ": " . $link;
}
$recipient = "nope@gmail.com";
$subject = "Please add $name";
$mailheader = "From: $name \r\n";

// grab recaptcha library
require_once "recaptchalib.php";
 
 // your secret key
$secret = "THAT'S A SECRET, DUHHHH";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

$validate = true;
foreach ($social as $site=>$link)
{
	if (filter_var($link, FILTER_VALIDATE_URL) == false && $link != "")
	{
		$validate = false;
		break;
	}
}

if ($response != null && $response->success && validate == true)
{
	mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
	mail("pokefanworks@gmail.com", $subject, $formcontent, $mailheader) or die("Error!");
	
	$servername = "mysql11.000webhost.com";
$username = "ENTER HERE";
$password = "ENTER HERE";
$dbname = "ENTER HERE";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

//add normal ones A - Z

$active = "INSERT INTO  `ENTER HERE`.`Games2` (
`id` ,
`verified` ,
`name` ,
`description` ,
`version` ,
`status` ,
`medium` ,
`fakemon` ,
`badges` ,
`badgeMAX` ,
`logo` ,
`twitter` ,
`reddit` ,
`facebook` ,
`website` ,
`tumblr` ,
`relicCastle` ,
`pokeCommunity` ,
`pokeBeach` ,
`pokemonReborn` ,
`deviantArt` ,
`soundCloud` ,
`discord`
)
VALUES (
NULL ,  '0',  '$name',  '$description',  '$version',  '$version',  '$medium',  '$fakemon',  '$badges',  '$badgeMAX',  '$logo'";

foreach ($social as $site=>$link)
{
	if ($link == "")
		$active = $active . ", NULL";
	else
		$active = $active . ", '$link'";
}
$active = $active . ");";

$result = $conn->query($active);

$conn->close();



	echo "Thank You!" . " -" . "<a href='pokefanworks.php' style='text-decoration:none;color:#ff0099;'> Return Home</a>\n\n\n\n" . $active;
}
else
{
	echo "Error - Invalid Info :)";
}


?>
