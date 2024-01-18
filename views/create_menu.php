<?php
    if(isset($_POST['act'])){
        require_once '../controller/Product_Control.php';
        $product_Control = new Product_Control();
        $product_Control->createMenu();
    }
?>
<style>
    td{
        font-size: 15px;
        font-weight: 600;
    }
</style>
<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4 style="margin-bottom: 10px">Menu website</h4>
    <span style="font-size: 14px; color: #888;">*Cài đặt hiển thị menu website*</span>
    <table style="width: 100%; margin: 5px;">
        <tr style="background: #fff; background: #445; color: #fff; text-align: left; height: 27px; line-height: 27px">
            <td style="font-weight: 500; font-size: 15px; text-align: center; width: 65px">STT</td>
            <td style="font-weight: 500; font-size: 15px">Tên phân loại</td>
            <td style="font-weight: 500; font-size: 15px">Cấp bậc</td>
            <td style="font-weight: 500; font-size: 15px">Phân loại cha</td>
            <td style="font-weight: 500; font-size: 15px; text-align: center">Hành động</td>
        </tr>
        <?php
        require_once "../module/Product.php";
        $getlist  = new Product();
        if(isset($_GET['dele'])){
            $getlist ->deleteProductCategoryByID($_GET['dele']);
        }
        if(isset($_POST['act'])){
            $act = $_POST['act'];
            require_once "../controller/Product_Control.php";
            $temp  =new  Product_Control();
            if($act=='add'){
                $temp -> addProductCategory();
            }else if($act == 'edit'){

                $temp -> editProductCategory();
            }
        }
        $getlist  = $getlist ->getListProductCategory();
        $sumcount = sizeof( $getlist);
        $count = 0;
        while ($count < $sumcount){

            echo '<tr style="font-weight: 400; text-align: left;background: ';
            if($count%2 == 1) echo '#efefef'; else echo "#fcfcfc";  echo '">';
            ?>
            <td style="text-align: center; font-weight: 500"><?php echo $count+1?></td>

            <td style=""><?php echo $getlist[$count][0]?></td>
            <td style=""><?php echo $getlist[$count][1]?></td>
            <td ><?php echo $getlist[$count][2]?></td>
            <td style="color: #b21f2d;  font-weight: 500; text-align: center">
                <?php
                 $id = $getlist[$count][3];
                    if($getlist[$count][5] ==0 ){
                        echo "<form method='post'>
                                <input type='hidden' name='id' value='$id'>
                            <button class='btn btn-info' style='margin: 2px; padding: 0px 5px;' name='act' value='1'>Hiển thị</button>
                        </form>
                        ";
                    }else{
                        echo "
                              <form method='post'>
                                <input type='hidden' name='id' value='$id'>
                                <button class='btn btn-danger'  style='margin: 2px; padding: 0px 5px;' name='act' value='0'>Ẩn đi</button>
                              </form>";
                    }
                ?>
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


