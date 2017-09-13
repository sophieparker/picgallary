<html>
<head>
<title>PicGallery </title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">
        PicGallery
        </a>
    </div>
    <?php if(isset($_SESSION) && isset($_SESSION["name"])) {?>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            <li class="active"><a href="add.php">Add photos <span class="sr-only">(current)</span></a></li>
            
            </ul>

            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name']; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="logout.php">Log out</a></li>
                </ul>
                </li>
            </ul>
    </div><!-- /.navbar-collapse -->
        <?php }else{
            ?>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
        <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php">Login</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
            <?php
        } ?>
  
 
  </div>
</nav>
<?php
if(isset($_SESSION["error"]))
{
	?>
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php echo $_SESSION["error"]; unset($_SESSION["error"]);?>
    </div>
    <?php
}
?>
<?php
if(isset($_SESSION["success"]))
{
	?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
        <span class="sr-only">Wonderfull:</span>
        <?php echo $_SESSION["success"]; unset($_SESSION["success"]);?>
    </div>
    <?php
}
?>
