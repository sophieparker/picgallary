<?php
session_start();
include_once('db.php');
if (isset($_POST['rating'])) {
    $rating = $_REQUEST['rating'];
    $pic = $_REQUEST['picid'];
    $userid = $_SESSION['id'];
    $LoginQuery = "select * from ratings where userid = $userid and pictureId = $pic";
    $result = mysqli_query($a, $LoginQuery);
    $rows = mysqli_num_rows($result);
    // echo $rows;
    // echo $LoginQuery;die;
    
    if($rows > 0)
    {
        $sql = "update ratings set rating = $rating where pictureId = $pic and userid = $userid";
        $result = mysqli_query($a, $sql);
        if(mysqli_affected_rows($a) < 1){
            $_SESSION["error"] = "Rating not saved.";
            header("location: index.php");die;
        }else{
            $_SESSION["success"] = "Rating saved.";
            header("location: index.php");die;
        }
    }else{
        $sql =" insert into ratings (rating,userid,pictureId) values($rating,$userid,$pic)";
        $result = mysqli_query($a, $sql);
        if (mysqli_affected_rows($a) > 0) {
            $_SESSION["success"] = "Rating saved.";
            header("location: index.php");die;
        }else{
            $_SESSION["error"] = "Not Saved.";
            header("location: index.php");die;
        }
    }
}
require 'header.php';
$sql = "SELECT p.*, u.fullname as postedby , (select round(avg(rating),2) from ratings where pictureId = p.id) as score  FROM `pictures` as p
join users as u on p.userid = u.id
order by score desc";
 $result = mysqli_query($a, $sql);
 $rows = mysqli_num_rows($result);

?>
<style>
body {
    font-family: system-ui;
}
.rate_widget {
    border: 1px solid #CCC;
    overflow: visible;
    padding: 10px;
    position: relative;
    width: auto;
    font-size: 20px;
    height: 50px;
}
.btn-primary .glyphicon-star{
    color:yellow;
}
</style>
<div class="container">
    <div class="page-header">
    <h1>Welcome to SophiePicGallery</h1>
    </div>
    <?php
    if($rows == 0)
    {
        ?>
         <h3 class="text-center">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            
            There are no pictures to show for now. Please come back again.<br> Or try to <a href="add.php"> add </a> a picture if you have an artist in you.
        <h3>
        <?php
    }else{
        ?>
        <div class="row">
        <?php while ($pic = $result->fetch_assoc()) {
            ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                        
                        <img data-title="<?php echo $pic['caption']?>" 
                        data-href="pics/<?php echo $pic['path'] ?>" class="popup-image"
                        style="max-height:165px;height:auto;max-width:100%; cursor:pointer;" 
                        src="pics/<?php echo $pic['path'] ?>" alt="<?php echo $pic['caption'] ?>">
                        
                        <div class="caption">
                            <h3><?php echo $pic['caption'] ?></h3>
                            <p>Posted by: <?php echo $pic['postedby'] ?></p>
                            <?php if(isset($pic['score'])){ ?>
                            <p>Avg. Ratings: <?php echo $pic['score'] ?> <span style="color: #ffcc09;" class="glyphicon glyphicon-star"></span></p> 
                            <?php } else{
                                echo "<p class='text-center text-warning'>Not rated Yet</p>";
                            }?>
                            <?php if(isset($_SESSION) && isset($_SESSION['id'])) {?>
                            <p class="text-center">
                             <a  data-title="<?php echo $pic['caption']?>" 
                             data-id="<?php echo $pic['id']?>" 
                             class="popup-rate btn btn-primary btn-block" role="button">Rate</a>
                            </p>
                             <?php }else{
                                 echo "Please login to rate.";
                             }?>
                        </div>
                </div>
            </div>
        <?php }?>
        </div>
        <?php
    }
    ?>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="popupimage-modal">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body text-center " style="padding:0px;">
      <button  type="button" style="position:absolute;top:10px;right:10px;opacity: 1;color: black;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
        <img  id="popupimage-src" style="max-width:100%;height:auto;" />
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="popuprate-modal">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="popupimage-title" ></h4>
    </div>
      <div class="modal-body text-center " style="padding:0px;">
      <form method="POST">
<!--Holds all the rating buttons-->
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="1" class=" btn-star-value" required>
                1 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="2" class=" btn-star-value" required>
                2 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="3" class=" btn-star-value" required>
                3 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="4" class=" btn-star-value" required>
                4 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="5" class=" btn-star-value" required>
                5 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="6" class=" btn-star-value" required>
                6 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="7" class=" btn-star-value" required>
                7 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="8" class=" btn-star-value" required>
                8 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="9" class=" btn-star-value" required>
                9 <span class="glyphicon glyphicon-star"></span>
            </label>
            <label class="btn btn-default btn-star">
                <input type="radio" name="rating" value="10" class=" btn-star-value" required>
                10 <span class="glyphicon glyphicon-star"></span>
            </label>
            <input type="hidden" name="picid" id="ratingpicid" />
            <div class="modal-footer">
                
                <button type="submit" class="btn btn-primary">Rate</button>
            </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    
//Function that displays the added photos on the page
$(function () {
    $('.popup-image').click(function(){
        $('#popupimage-title').text($(this).data('title'));
        $('#popupimage-src').attr('src',$(this).data('href'));
        $('#popupimage-modal').modal('show');
    });
    $('.popup-rate').click(function(){
        $('#popupimage-title').text($(this).data('title'));
        $('#ratingpicid').val($(this).data('id'));
        $('#popuprate-modal').modal('show');
    });

    $('.btn-star').click(function(){
        $('.btn-star').removeClass('btn-primary').removeClass('btn-default').addClass('btn-default');
        $(this).addClass('btn-primary');

    });
   
})
</script>
<?php
require 'footer.php';
?>