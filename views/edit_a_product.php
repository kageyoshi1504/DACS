<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    include '../module/Product.php';
    $product  = new Product();
    $data = $product->getProductById2($id);
}
if(isset($_POST['editaproduct'])){
    include '../controller/Product_Control.php';
    $getClass  = new Product_Control();
    $getClass->edit_a_product();
}?>

<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4>Sửa sản phẩm</h4>
    <style>
        .form-control-sm{
            border: solid 1px #445;
        }
        td{
            font-size: 17px;
        }
        tr{
            border: solid 1px #888;
            padding:0px 6px;
        }
        table, tr{
            width: 100%;
        }
        .tsct td{
            font-size: 14px;
            padding: 1px 3px;
        }
        .tsct input{
            height: 20px;
            font-size: 14px;
        }
    </style>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $id?>" name="id">
    <div class="row">
        <div class="col-md-7">
            <table>
                <tr><td style="font-size: 16px; height: 100%;padding: 0px 3px; background: #445; color: #f1f1f1">
                        <i class="fas fa-plus-square"></i>
                        <span style="font-weight: 500;">Nội dung bài viết đánh giá</span>
                    </td></tr>
                <tr><td style="padding: 3px">  <textarea name="posts" id="cmt"><?php echo $data['posts']?></textarea>
                        <script> CKEDITOR.replace('cmt');</script></td></tr>
            </table>
        </div>
        <div class="col-md-5">
            <table>
                <tr><td style="font-size: 16px;padding: 0px 3px;color: #f1f1f1; background: #445">
                        <i class="fas fa-plus-square"></i>
                        <span style="font-weight: 500;">Các thành phần</span>
                    </td></tr>
                <tr><td style="padding: 5px 10px; background: #fff">
                            <div class="form-group">
                                <label style="color: #000; font-weight: 500;" for="">Tiêu đề bài viết</label><br>
                                <input type="text" style=" width: 70%" class="form-control-sm"  id="password" required="" placeholder="enter post title" name="title" value="<?php echo $data['ten']?>">
                            </div>
                            <div class="form-group">
                                <label style="color: #000; font-weight: 500;" for="">Ảnh đại diện sản phẩm</label><br>
                                <img id="blah" src="" alt="Ảnh đại diện" style="height: 140px; width: 200px;" /><br><br>
                                <input type='file' style="font-size: 12px;" name="imgInp" id="imgInp" />
                            </div>
                            <div class="form-group">
                                <label style="color: #000; font-weight: 500;" for="">Phân loại sản phẩm</label><br>
                                <div id="phanloai">
                                    <span style="font-weight: 400">Phân loại cha</span><br>
                                    <?php
                                    require_once '../module/Product.php';
                                    $getClass  = new Product();
                                    $listdata = $getClass->getListProductCategoryLever1();
                                    $sumcount = sizeof( $listdata);
                                    $count = 0;
                                    ?>
                                    <select name="phanloai" id="someselect" class="form-control-sm" style="width: 100%">
                                        <?php
                                        while ($count < $sumcount){?>
                                            <option value="<?php echo $listdata[$count][0]?>"> <?php echo $listdata[$count][1]?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <script>
                                    $('#someselect').find('option').each(function(i,e){
                                        $(e).attr("selected", false);
                                        if($(e).val() == <?php echo $data['id_phanloai']?>){
                                            $(e).attr("selected", true);
                                        }
                                    });
                                </script>
                                <br> <span style="color: #999; font-size: 13px">*Thêm nhiều phân loại hơn tại <a style="color: #1d75b3" href="./?select=product-categories">Quản lý phân loại</a> *</span>
                            </div>
                            <div class="form-group">
                                <label style="color: #000; font-weight: 500;" for="">Giá bán</label><br>
                                <input name="giaban" type="number" class="form-control-sm" value="<?php echo $data['giaban']?>"> <span style="font-size: 14px; color: #ff2222; font-weight: bold">VNĐ</span>
                            </div>
                            <div class="form-group">
                                <label style="color: #000; font-weight: 500;" for="">Số lượng</label><br>
                                <input name="soluong" type="number" class="form-control-sm" value="<?php echo $data['soluong']?>">
                            </div>
                            <div class="form-group">
                                <label style="color: #000; font-weight: 500;" for="">Tình trạng hàng</label><br>
                                <input name="tinhtrang" type="text" class="form-control-sm" value="<?php echo $data['tinhtrang']?>">
                            </div>
                            <div style="font-weight: 500;font-size: 16px; border: solid 1px #aaa; padding: 0px 5px; color: #f2f2f2; background: #445" onclick="themThongSoChiTiet()">
                                <i class="fas fa-info-circle"></i> Thêm chi tiết thông số kỹ thuật sản phẩm
                                <span id="icon_ttct">  <i class="bx bxs-chevron-down arrow" style="float: right"></i></span>
                            </div>
                            <div style="border: solid 1px #445; padding: 5px; display: none" id="add_ttct">
                                <table class="tsct">
                                    <tr class="tr1">
                                        <td class="td1">Thương hiệu</td>
                                        <td class="td2">    <input name="thuonghieu" type="text" class="form-control-sm" value="<?php echo $data['thuonghieu']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Xuất xứ thương hiệu</td>
                                        <td class="td2">    <input name="xuatxu" type="text" class="form-control-sm" value="<?php echo $data['xuatxu']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Kích thước màn hình</td>
                                        <td class="td2">    <input name="kichthuoc" type="text" class="form-control-sm" value="<?php echo $data['kichthuocman']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Độ phân giải</td>
                                        <td class="td2">    <input name="dophangiai" type="text" class="form-control-sm" value="<?php echo $data['dophangiai']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Trọng lượng</td>
                                        <td class="td2">    <input name="trongluong" type="text" class="form-control-sm" value="<?php echo $data['trongluong']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Dung lượng pin</td>
                                        <td class="td2">    <input name="dungluong" type="text" class="form-control-sm" value="<?php echo $data['dungluongpin']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">CPU</td>
                                        <td class="td2">    <input name="cpu" type="text" class="form-control-sm" value="<?php echo $data['cpu']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Tốc độ CPU</td>
                                        <td class="td2">    <input name="tocdocpu" type="text" class="form-control-sm" value="<?php echo $data['tocdocpu']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Bộ nhớ ROM</td>
                                        <td class="td2">    <input name="rom" type="text" class="form-control-sm" value="<?php echo $data['rom']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Bộ nhớ RAM</td>
                                        <td class="td2">    <input name="ram" type="text" class="form-control-sm" value="<?php echo $data['ram']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Camera sau</td>
                                        <td class="td2">    <input name="camerasau" type="text" class="form-control-sm" value="<?php echo $data['camerasau']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Camera trước</td>
                                        <td class="td2">    <input name="cameratruoc" type="text" class="form-control-sm" value="<?php echo $data['cameratruoc']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Loại Sim</td>
                                        <td class="td2">    <input name="loaisim" type="text" class="form-control-sm" value="<?php echo $data['loaisim']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Wifi</td>
                                        <td class="td2">    <input name="wifi" type="text" class="form-control-sm" value="<?php echo $data['wifi']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Mạng di động</td>
                                        <td class="td2">    <input name="mangdidong" type="text" class="form-control-sm" value="<?php echo $data['mangdidong']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">GPS</td>
                                        <td class="td2">    <input name="gps" type="text" class="form-control-sm" value="<?php echo $data['gps']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Bluetooth</td>
                                        <td class="td2">    <input name="bluetooth" type="text" class="form-control-sm" value="<?php echo $data['bluetooth']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Hỗ trợ thẻ nhớ ngoài</td>
                                        <td class="td2">    <input name="thenho" type="text" class="form-control-sm" value="<?php echo $data['thenho']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Chip đồ họa (GPU)</td>
                                        <td class="td2">    <input name="gpu" type="text" class="form-control-sm" value="<?php echo $data['gpu']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Phụ kiện đi kèm</td>
                                        <td class="td2">    <input name="phuukien" type="text" class="form-control-sm" value="<?php echo $data['phukien']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Cổng sac</td>
                                        <td class="td2">    <input name="congsac" type="text" class="form-control-sm" value="<?php echo $data['congsac']?>"></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td class="td1">Pin có thể tháo rời</td>
                                        <td class="td2">    <input name="pin" type="text" class="form-control-sm" value="<?php echo $data['pin']?>"></td>
                                    </tr>
                                    <tr class="tr1">
                                        <td class="td1">Jack tai nghe</td>
                                        <td class="td2">    <input name="taynghe" type="text" class="form-control-sm" value="<?php echo $data['jacktaynghe']?>"></td>
                                    </tr>
                                </table>
                            </div>
                            <button class="btn-info btn" name="editaproduct" style="margin-top: 25px">Hoàn thành</button>

                    </td></tr>
            </table>
        </div>
    </div>
    </form>
</div>
<script>

    function themThongSoChiTiet(){
        var ttct =  document.getElementById('add_ttct').style;
        var icon =  document.getElementById('icon_ttct');
        if (ttct.display == 'none'){
            ttct.display='block';
            icon.innerHTML = '<i class="fas fa-angle-up"  style="float: right"></i>';
        }
        else{
            ttct.display = 'none';
            icon.innerHTML = '<i class="bx bxs-chevron-down arrow" style="float: right"></i>';
        }
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>