<!DOCTYPE html>
<html lang="en">
<head>
  <title>SCP Web Application</title>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>
<?php include "app/connection.php"; ?>
<nav class="navbar navbar-inverse" >
  <div class="container-fluid" >
    
    <div class="navbar-header" id="myNavbar" >
      <ul class="nav navbar-nav" >
          <li><a href="index.php">Home</a></li>
			 <?php foreach($result as $menu_item): ?>
        <li class="active"> <a class="nav-link active" href="index.php?subject='<?php echo $menu_item['item_no']; ?>' " >
                    <?php echo $menu_item['item_no']; ?>
                    </a></li>
				 <?php endforeach; ?>
        <li class="active"><a href="form.php" class="nav-link active">Enter New Subject</a></li>
        
      </ul>
      
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center" >    
  <div class="row content">
    
    <div class="col-sm-12 text-left"> 
	
	<?php

                  if(isset($_GET['subject']))
                  {
                    //remove single quotes from subject get value
                    $item_number= trim($_GET['subject'], "'");

                    //run sql command to select record based on get value
                    $record= $connection->query("select * from subject where item_no='$item_number'") or die($connection->error());

                    //covert $record into an array for us to echo out on screen
                    $row = $record->fetch_assoc();

                    // create variables that hold data from db fields
                    $item_number = $row['item_no'];
                    $object_class = $row['object_class'];
                    $subject_image = $row['subject_image'];
                    $procedures = $row['procedures'];
                    $description = $row['description'];
                    $history = $row['history'];
                    $ad_notes = $row['ad_notes'];
                    $reference = $row['reference'];

                    // strip out \n and replace with linebreaks
                    $procedures = str_replace('\n', '<br><br>', $procedures);
                    $description = str_replace('\n', '<br><br>', $description);
                    $history = str_replace('\n', '<br><br>', $history);
                    $ad_notes = str_replace('\n', '<br><br>', $ad_notes);
                    $reference = str_replace('\n', '<br><br>', $reference);
                    
                    
                    if (!empty($item_number)) { ?> <h2>Item_#: <?php echo  $item_number;   ?></h2>  <?php }

                    if (!empty($object_class)) { ?> <h3>Object Class: <?php echo $object_class;  ?></h3>  <?php } 
                    
                     if (!empty($subject_image))  { ?><p><img src="<?php echo $subject_image; ?>"></p>  <?php }  

                    if (!empty($procedures))  { ?> <h3>Special Containment Procedures</h3>      <p><?php echo $procedures; ?></p>  <?php }  

                    if (!empty($description)) { ?>  <h3>Description</h3> <p> <?php echo $description; ?></p>  <?php } 
                    
                    if (!empty($history)) { ?>  <h3>Chronological History</h3> <p> <?php echo $history; ?></p>  <?php } 
                    if (!empty($ad_notes)) { ?>  <h3>Additional Notes</h3> <p> <?php echo $ad_notes; ?></p>  <?php } 
                    if (!empty($reference)) { ?>  <h3>Reference</h3> <p> <?php echo $reference; ?></p>  <?php } 
                      
                  } 
                    
                    else
                  {

                    echo "
                  <h1 style='text-align:center; color: #15a0cf;'>Welcome to SCP Web Application</h1>
                  <p align='center'>SCP Foundation is a secret organization responsible for locating and containing individuals, entities, locations and objects that violate natural low.</p><br>
                  <p align='center'>Click on above links to know more about this Web Application</p>
				  <hr>
					<p align='center'><img src='images/Web-Application.jpg' align='middle'></p>
                    
                    ";

                  }
                    
                    ?>
	
      
      
    </div>
    
  </div>
</div>

<footer class="container-fluid text-center">
  <p>©copyright 2020 Developed by Monica  Student ID:30025447</p>
</footer>

</body>
</html>