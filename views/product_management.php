
<style>
    td{
        font-size: 14px;
        font-weight: 400;
    }
</style>
<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4 style="margin-bottom: 10px">Quản lý sản phẩm <a href="./?select=add-new-products"> <span style="padding: 2px 10px; margin-left: 5px" class="btn-info btn" >Thêm mới sản phẩm</span></a></h4>
     <table style="width: 100%; margin: 5px;">
        <tr style="background: #fff; background: #445; color: #fff; text-align: left; height: 27px; line-height: 27px">
            <td style="font-weight: 500; font-size: 15px; text-align: center; width: 65px">STT</td>
            <td style="font-weight: 500; font-size: 15px">Hình ảnh</td>
            <td style="font-weight: 500; font-size: 15px">Tên sản phẩm</td>
            <td style="font-weight: 500; font-size: 15px">Phân loại</td>
            <td style="font-weight: 500; font-size: 15px">Tình trạng</td>
            <td style="font-weight: 500; font-size: 15px">Số lượng</td>
            <td style="font-weight: 500; font-size: 15px">Giá bán</td>
            <td style="font-weight: 500; font-size: 15px">Thông số kỹ thuật</td>
            <td style="font-weight: 500; font-size: 15px; text-align: center">Hành động</td>
        </tr>
        <?php
        require_once "../module/Product.php";
        $getlist  = new Product();
        if(isset($_GET['dele'])){
            $getlist ->deleteProductByID($_GET['dele']);
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
        $getlist  = $getlist ->getListProduct();
        $sumcount = sizeof( $getlist);
        $count = 0;
        while ($count < $sumcount){

        echo '<tr style="font-weight: 400; text-align: left;background: ';
            if($count%2 == 1) echo '#efefef'; else echo "#fcfcfc";  echo '">';
        ?>
        <td style="text-align: center; font-weight: 500"><?php echo $count +1?></td>
        <td style="">
        <img style="width: 60px; height: auto; margin: 3px 0px;" 
     src="<?php 
            $url = filter_var($getlist[$count]['img'], FILTER_VALIDATE_URL);
            if ($url) {
                echo $getlist[$count]['img'];
            } else {
                echo '.' . $getlist[$count]['img'];
            }
         ?>" 
     alt="<?php echo $getlist[$count]['ten']?>">
        </td>
        <td style=""><?php echo $getlist[$count]['ten']?></td>
            <td <?php if($getlist[$count]['id_phanloai'] == 0) echo 'style="color:#c22"'?>><?php echo $getlist[$count]['phanloaitext']?></td>
            <td <?php if ($getlist[$count]['tinhtrang']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getlist[$count]['tinhtrang']?></td>
            <td style="color: #027dc1; font-weight: 600"><?php echo $getlist[$count]['soluong']?></td>
            <td style="color: #fd5e14; font-weight: 700" ><?php echo number_format($getlist[$count]['giaban'],0,',','.')?>đ</td>
            <td style="font-weight: 900; color: #048CAD; text-align: center">
                <button style="padding: 0px  7px; font-size: 14px" class="btn-secondary btn" onclick="productdetails('<?php echo $getlist[$count]['id']?>')">Xem chi tiết</button>
            </td>
        <td style="color: #b21f2d;  font-weight: 500; text-align: center">

            <i title="Xóa sản phẩm" id="<?php echo $getlist[$count]['id']?>" class="fas fa-window-close" onClick="deleteitemn(this.id)" class="btn btn-danger   " ></i>
            <a href="./?select=edit-a-product&id=<?php echo $getlist[$count]['id']?>">
                <i title="Sửa thông tin sản phẩm" id="<?php echo $getlist[$count][3] ?>" class="fas fa-pen-square"></i>
            </a>
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
    <dialog id="xacnhanxoa" style="padding: 10px 15px;border: none; width: 400px;  box-shadow: 0px 0px 15px 0px #aaa; border-radius: 5px; display: none; position: fixed; top:50%;left: 50%;  transform: translate(-50%,-50%);">
        <p style="font-size: 16px;">Bạn có thực sự muốn xóa sản phẩm này!</p>
        <hr style="margin-top: -7px; margin-bottom: 7px">
        <button class="btn btn-danger" style="float: right; margin-left: 10px; padding: 2px; font-size: 14px" id="huydelete">Hủy</button>
        <form style="float: right" method="get" action="#">
            <input name="select" value="management-products" style="display: none">
            <input id = "dele" name="dele" value="" style="display: none">
            <button style="padding: 2px; font-size: 14px" class="btn btn-info" id="xacnhandelete">Xác nhận</button>
        </form>
    </dialog>
    <script>function deleteitemn(clicked_id)
    {
        var xacnhan = document.getElementById('xacnhanxoa');
        var id =  document.getElementById(clicked_id);
        var huydelete = document.getElementById('huydelete');
        var dele = document.getElementById('dele');
        dele.value = clicked_id;
        huydelete.addEventListener('click', function() {
            xacnhan.style.display='none';
            xacnhan.close();
        });
        xacnhan.style.display='block';
        xacnhan.showModal();
    }</script>
    <dialog id="productdetails" style="padding: 10px 15px;border: none; width: 600px;  box-shadow: 0px 0px 15px 0px #aaa; border-radius: 5px; display: none; position: fixed; top:50%;left: 50%;  transform: translate(-50%,-50%);">
        <i class="fas fa-window-close"  class="btn btn-danger"  id="anproductdetails" style="float: right; color: #c82333"></i>
        <div class="loadajax"></div>
    </dialog>
    <script>function productdetails(clicked_id) {
            $.ajax({
                url : "../views/viewajax/ajax_product_details.php",
                type : "post",
                dataType:"text",
                data : {
                    id: clicked_id
                },
                success : function (result){
                    $('.loadajax').html(result);
                }
            });

            var xacnhan = document.getElementById('productdetails');
            var id =  document.getElementById(clicked_id);
            var huydelete = document.getElementById('anproductdetails');

            huydelete.addEventListener('click', function() {
                xacnhan.style.display='none';
                xacnhan.close();
            });
            xacnhan.style.display='block';
            xacnhan.showModal();
        }</script>
</div>


