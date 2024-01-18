<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4>Quản lý bình luận</h4>

    <style> 
        td,th{
            text-align:center;
        }
        td.value{
            font-size : 15px;
        }

    </style>
    <table style="width: 100%; margin: 5px;">

        <tr style="background: #fff; background: #445; color: #fff; text-align: left; height: 27px; line-height: 27px">
            <td style="font-weight: 500; font-size: 15px; text-align: center; width: 45px">STT</td>
            <td style="font-weight: 500; font-size: 15px">Tên người dùng</td>
            <td style="font-weight: 500; font-size: 15px">Sản phẩm</td>
            <td style="font-weight: 500; font-size: 15px">Nội dung bình luận</td>
            <td style="font-weight: 500; font-size: 15px; text-align: center">Hành động</td>
        </tr>
        <?php
        require_once "../controller/Comment_Control.php";
        $getlist  = new Comment_Control();
        if(isset($_GET['dele'])){
            $getlist ->deleteCommentByID($_GET['dele']);
        }
        $getlist  = $getlist ->getlistComment();
        $sumcount = sizeof( $getlist);
        $count = 0;
        if($sumcount== 0) echo'<tr><td colspan="6" style="text-align: center; font-size: 16px; font-weight: 500; color: #333">Danh sách rỗng</td></tr>';
        while ($count <$sumcount){

            echo '<tr style="font-weight: 400; text-align: left; margin-top: 10px; background: ';
            if($count%2 == 0) echo '#efefef'; else echo "#fcfcfc";  echo '">';
            ?>
            <td style="text-align: center; font-weight: 600"><?php echo $count?></td>

            <td style="" class="value"><?php echo $getlist[$count][1]?></td>
            <td style="" class = "value"><?php echo $getlist[$count][2]?></td>
            <td style="" class ="value"><?php echo $getlist[$count][0]?></td>
            <td style="color: #b21f2d;  font-weight: 500; text-align: center">
               <form method="get">
                   <input type="hidden" name="select" value="comment">
                   <input type="hidden" name="dele" value="<?php echo $getlist[$count][3] ?>">
                   <button style="border: none">
                       <i title="Xóa bình luận" id="<?php echo $getlist[$count][0]?>" class="fas fa-window-close" onClick="deleteitemn(this.id)" class="btn btn-danger   " ></i>
                   </button>
               </form>
            </td>
            </tr>
            <?php
            $count++;
        }
        ?>
        <div style="display: none" id="num-rows"><?php echo $count ?></div>
        <script>
            var n=(parseInt(document.getElementById('num-rows').textContent));

        </script>
    </table>


</div>
