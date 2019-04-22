<?php 
	$path = parse_url($_SERVER['REQUEST_URI']);
	
	if($path["path"] == "/" || $path["path"] == "") {
		header("Location: ");
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
					echo $entry;
				} else {
					echo "Hoppla!";
				}
			?>
		</h4>
        <p>
			<?php
				
				if($isIndex) {
			
					$files = scandir("./blog");
				
					if($files == false) {
						echo "Nothing to see here...";
				
					} else {
				
						$files = array_slice($files, 2);
					
						if(count($files) != 0) {
					
							foreach($files as $file) {
						
								echo "<a>".$file."</a><br />";
							}
						} else {
							echo "Nothing to see here...";
						}
					}
				} else if ($isBlog) {
				
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
