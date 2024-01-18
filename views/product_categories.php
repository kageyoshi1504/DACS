<style>
    td{
        font-size: 15px;
        font-weight: 600;
    }
</style>
<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4 style="margin-bottom: 10px">Quản lý phân loại sản phẩm <span style="padding: 2px 10px; margin-left: 5px" class="btn-info btn"  onclick="themPhanLoai()">THÊM MỚI PHÂN LOẠI</span></h4>
    <span style="font-size: 14px; color: #888;">*Cấp bậc phân loại gồm hai cấp bậc 1 hoặc 2, cấp bậc 2 là cấp bậc con của cấp bậc 1. Ví dụ, ta có phân loại IPHONE là cấp bậc 1, và các phân loại con cấp bậc 2 là IPHONE 6, IPHONE 7, IPHONE CŨ, IPHONE LOCK...*</span>
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

            <?php if($getlist[$count][3]!=0)  { ?>
        <i title="Xóa phân loại" id="<?php echo $getlist[$count][3]?>" class="fas fa-window-close" onClick="deleteitemn(this.id)" class="btn btn-danger   " ></i>
            <i title="Sửa thông tin phân loại" id="<?php echo $getlist[$count][3] ?>" class="fas fa-pen-square" onclick="editPhanloai(this.id,'<?php echo $getlist[$count][0]?>','<?php echo $getlist[$count][1]?>','<?php echo $getlist[$count][2]?>','<?php echo $getlist[$count][4]?>')"></i>
            <?php } else echo"[Mặc định]"; ?>

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
        <tr><td colspan="6" style="text-align: center; font-size: 16px; font-weight: 600; color: #0000ff; border: solid 1px #889; background: #dde; font-size: 15px" onclick="themPhanLoai()">
                <i class="fas fa-plus-square"></i> THÊM MỚI PHÂN LOẠI</td></tr>
    </table>
    <dialog id="xacnhanxoa" style="padding: 10px 15px;border: none; width: 400px;  box-shadow: 0px 0px 15px 0px #aaa; border-radius: 5px; display: none; position: fixed; top:50%;left: 50%;  transform: translate(-50%,-50%);">
        <p style="font-size: 16px;">Bạn có thực sự muốn xóa tài khoản này!</p>
        <hr style="margin-top: -7px; margin-bottom: 7px">
        <button class="btn btn-danger" style="float: right; margin-left: 10px; padding: 2px; font-size: 14px" id="huydelete">Hủy</button>
        <form style="float: right" method="get" action="#">
            <input name="select" value="product-categories" style="display: none">
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


    <dialog id="editit" style="padding: 15px 10px;border: none; width: 500px;  box-shadow: 0px 0px 15px 0px #aaa; border-radius: 5px; display: none;position: fixed; top:50%;left: 50%;  transform: translate(-50%,-50%);">
        <i class="fas fa-window-close"  class="btn btn-danger"  id="huyedit" style="float: right; color: #c82333"></i>
        <p style="font-size: 21px; font-weight: 400">Chỉnh sửa thông tin tài khoản</p>
        <hr style="margin-top: -5px; margin-bottom: 5px">
        <form method="post" action="#" style="text-align: left">
            <input type="hidden" id="editid" name='id' value="haha">
            <span style="font-weight: 400; ">Tên phân loại</span><br>
            <input id="name" class="form-control-sm" type="text" aria-invalid="name" id="name" name="name" required value="" style="width: 100%; border: solid 1px #333">
            <br> <br><span style="font-weight: 400">Cấp bậc của phân loại</span><br>
            <input  class="form-control-sm" id="lever2" type="number" name="lever" required value="1" style="width: 100%; border: solid 1px #333">
            <br><br>
            <div id="capdocha2">
                <span style="font-weight: 400">Phân loại cha</span><br>
                <?php
                $getClass  = new Product();
                $listdata = $getClass->getListProductCategoryLever1();
                $sumcount = sizeof( $listdata);
                $count = 0;
                ?>
                <select name="capdocha" id="someselect" class="form-control-sm" style="width: 100%">
                    <?php
                    while ($count < $sumcount){?>
                        <option value="<?php echo $listdata[$count][0]?>" <?php if($count==0) echo "selected"?>> <?php echo $listdata[$count][1]?></option>
                        <?php
                        $count++;
                    }
                    ?>
                </select>
            </div>
            <p></p>
            <button   class="btn btn-info" id="add" name="act" value="edit" style="float: right; padding: 2px 5px">Xác nhận</button>
        </form>
    </dialog>
    <script>function editPhanloai(clicked_id, name, lever, phanloaicha, id_phanloaicha)
    {
        $('#someselect').find('option').each(function(i,e){
            $(e).attr("selected", false);
            if($(e).val() == id_phanloaicha){
                $(e).attr("selected", true);
            }
        });

        if(lever==1) $('#capdocha2').css('display','none');
        else $('#capdocha2').css('display','block');
        var xacnhan = document.getElementById('editit');
        var huyedit = document.getElementById('huyedit');

        document.getElementById('editid').value = clicked_id;
        document.getElementById('lever2').value = lever;
        document.getElementById('name').value = name;

        huyedit.addEventListener('click', function() {
            xacnhan.close();
            xacnhan.style.display='none';
        });
        xacnhan.showModal();
        xacnhan.style.display='block';
    }</script>
    <script>
        $(document).ready(function(){
            if($('#lever2').val()== 1) {
                $('#capdocha2').css('display','none');
            }
            else if($('#lever2').val()  == 2) {
                $('#capdocha2').css('display','block');
            }
            $('#lever2').change(function (){
                if($('#lever2').val()== 1) {
                    $('#capdocha2').css('display','none');
                }
                else if($('#lever2').val()  == 2) {
                    $('#capdocha2').css('display','block');
                }
                if($('#lever2').val() < 1) {
                    alert("Cấp bậc phân loại có hai cấp bậc là 1 hoặc 2");
                    $('#lever2').val(1);
                    $('#capdocha2').css('display','none');
                }
                else if($('#lever2').val()  > 2) {
                    $('#lever2').val(2);
                    alert("Cấp bậc phân loại có hai cấp bậc là 1 hoặc 2");
                    $('#capdocha2').css('display','block');
                }
            })
        });
    </script>

    <dialog id="themphanloai" style="padding: 15px 10px;border: none; width: 500px;  box-shadow: 0px 0px 15px 0px #aaa; border-radius: 5px; display: none;position: fixed; top:50%;left: 50%;  transform: translate(-50%,-50%);">
        <i class="fas fa-window-close"  class="btn btn-danger"  id="huythem" style="float: right; color: #c82333"></i>
        <p style="font-size: 21px; font-weight: 400">THÊM MỚI PHÂN LOẠI SẢN PHẨM</p>
        <hr style="margin-top: -5px; margin-bottom: 5px">
        <form method="post" action="#" style="text-align: left">
            <span style="font-weight: 400; ">Tên phân loại</span><br>
            <input id="name" class="form-control-sm" type="text" aria-invalid="name" name="name" required value="" style="width: 100%; border: solid 1px #333">
            <br> <br><span style="font-weight: 400">Cấp bậc</span><br>
            <input  class="form-control-sm" id="lever" type="number" name="lever" required value="1" style="width: 100%; border: solid 1px #333">
            <br><br>
            <div id="capdocha">
                <span style="font-weight: 400">Phân loại cha</span><br>
                <?php
                  $getClass  = new Product();
                  $listdata = $getClass->getListProductCategoryLever1();
                  $sumcount = sizeof( $listdata);
                  $count = 0;
                ?>
                <select name="capdocha" class="form-control-sm" style="width: 100%">
                    <?php
                        while ($count < $sumcount){?>
                            <option value=" <?php echo $listdata[$count][0]?>"> <?php echo $listdata[$count][1]?></option>
                    <?php
                            $count++;
                        }
                    ?>
                </select>
            </div>
            <p></p>
            <button   class="btn btn-info" id="add" name="act" value="add" style="float: right; padding: 2px 5px">Thêm mới</button>
        </form>
    </dialog>

    <script>function themPhanLoai()
        {
            var xacnhan = document.getElementById('themphanloai');
            var huyedit = document.getElementById('huythem');

            huyedit.addEventListener('click', function() {
                xacnhan.close();
                xacnhan.style.display='none';
            });
            xacnhan.showModal();
            xacnhan.style.display='block';
        }</script>
    <script>
        $(document).ready(function(){
            if($('#lever').val()== 1) {
                $('#capdocha').css('display','none');
            }
            else if($('#lever').val()  == 2) {
                $('#capdocha').css('display','block');
            }
            $('#lever').change(function (){
                if($('#lever').val()== 1) {
                    $('#capdocha').css('display','none');
                }
                else if($('#lever').val()  == 2) {
                    $('#capdocha').css('display','block');
                }
                if($('#lever').val() < 1) {
                    alert("Cấp bậc phân loại có hai cấp bậc là 1 hoặc 2");
                    $('#lever').val(1);
                    $('#capdocha').css('display','none');
                }
                else if($('#lever').val()  > 2) {
                    $('#lever').val(2);
                    alert("Cấp bậc phân loại có hai cấp bậc là 1 hoặc 2");
                    $('#capdocha').css('display','block');
                }
            })
        });
    </script>
</div>


