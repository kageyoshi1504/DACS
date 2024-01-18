<?php
require_once '../../controller/Comment_Control.php';
$Comment = new Comment_Control();
$id_product = $_POST['id_product'];
if(isset($_POST['cmt']) && $_POST['cmt']!=""){
    $comment = $_POST['cmt'];
    $Comment->addComment($id_product,$comment);
}
$getComment =  $Comment->getlistCommentByIdProduct($id_product);
$getCount=sizeof($getComment);
?>
<span style="font-size: 15px; margin-left:10px; position:relative; top:-10px;">Có tất cả <?php echo $getCount ?> bình luận</span>
<?php
$dem = 0;
foreach ($getComment as $line) {
    echo '<div class="row" style="margin-top:10px">
              <div class="col-1" style="text-align: center;">
                  <img class="imgicon-avatar-cmt" style="float:left; width:60px; border-radius:60px;"  src="./upload/img/user.png">
              </div>
              <div class="col-11">

                  <span style="font-weight: 700; font-size : 14px;">'.$line[1].'</span><br>
                  <span style ="font-weight: 500;font-size : 14px;">'.$line[0].'</span><br>
                  <span style="font-family: none; font-size : 13px; color : #8f9bb3">'.$line[2].'</span><br>
              </div>
          </div>';

        
}

