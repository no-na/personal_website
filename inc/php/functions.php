<?php
include 'config.php';

$functionName = $_POST['functionName'];
switch($functionName){
	case 'getWorks':
		getWorks($link);
		break;
  case 'getDetailed':
		getDetailed($link);
		break;
}

function getWorks($link){
	$works = array();

	$query="SELECT * FROM works ORDER BY id";
	$result=mysqli_query($link, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($works,$row);
	}
  foreach($works as &$row)
    echo '<div id="option-' . $row["id"] . '" onclick="getDetailed(' . $row["id"] . ',this.id)" class="portfolio-menu-option"><div class="portfolio-menu-option-text">' . $row["title"] . '</div></div>';
}

function getDetailed($link){
  $details = array();
	$work_id = $_POST['work_id'];

	$query="SELECT * FROM works WHERE id='" . $work_id . "'";
	$result=mysqli_query($link, $query);
  $row=mysqli_fetch_assoc($result);
	
  array_push($details,'<div>' . $row["title"] . '</div>');
  array_push($details,$row["company"] . " " . $row["release_year"]);
  array_push($details,$row["description"]);
  array_push($details,'<a id="link" href="' . $row["link"] . '" target="_blank"><div class="portfolio-main-link">Visit Project Website</div></a>');
  array_push($details,'<img src="../files/' . $row["background"] . '" width="100%">');
  array_push($details,'<div id="background" class="portfolio-main-background-wrapper" style="background-image:url(../files/' . $row["background"] . ');"><div class="portfolio-main-background" style="background-image:url(../files/' . $row["background"] . ');"></div></div>');
  array_push($details,'<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $row["youtube"] .'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
  header("Content-Type: application/json", true);
  echo json_encode($details);
}

?>