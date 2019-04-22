<?php 
	$path = parse_url($_SERVER['REQUEST_URI']);
	
	if(isset($_SERVER['HTTPS'])) {
		$server_prefix = "https://";
	} else {
		$server_prefix = "http://";
	}
	
	if($path["path"] == "/" || $path["path"] == "") {
		header("Location: ".$server_prefix.$_SERVER['SERVER_NAME']."/index");
	}
	
	$isIndex = false;
	$isBlog = false;
	
	$isIndex = ($path["path"] == "/index");
	$isBlog = ($path["path"] == "/entry");
	
	if($isBlog) {
		$entry = $path["query"];
	}
?>

<!DOCTYPE html>
<html lang="de">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Your page title here :)</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 10%">
        <h4>
			<?php
				if($isIndex) {
					echo "Index";
				} elseif ($isBlog) {
					echo substr($entry, 8);
				} else {
					echo "Hoppla!";
				}
			?>
		</h4>
        <p>
			<?php
				
				if($isIndex) {
					
					$date = new DateTime();
					$date = $date->format('Ymd');
			
					$files = scandir("./blog", SCANDIR_SORT_ASCENDING);
				
					if($files == false) {
						echo "Nothing to see here...";
				
					} else {
				
						$files = array_slice($files, 2);

						$files = array_reverse($files);
	
						if(count($files) != 0) {
					
							foreach($files as $file) {
								
								if(!(substr($file, 0, 8) > $date)) {
									echo "<a href=\"".$server_prefix.$_SERVER['SERVER_NAME']."/entry?".$file."\">".substr($file, 8)."</a><br />";
								}
							}
						} else {
							echo "Nothing to see here...";
						}
					}
				} else if ($isBlog) {
					
					$temp_content = file_get_contents("./blog/".$entry, FILE_TEXT);
					
					echo mb_convert_encoding($temp_content, 'UTF-8', mb_detect_encoding($temp_content, 'UTF-8, ISO-8859-1', true));
					
				} else {
				
					echo "Hoppla. Diese Seite konnte nicht gefunden werden.";
				}
			?>
		</p>
      </div>
    </div>
  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
