
<?php
if(isset($_GET['receive'])){
    require_once "./module/Product.php";
    $Product = new Product();
    $id_product = $_GET['receive'];
    $getProduct = $Product->getProductById($id_product);


    if(sizeof($getProduct)==0) {
        echo "<h1 class='container'>Sản phẩm không tồn tại</h1>"; die();
    }
}else{
    echo "<h1 class='container'>Sản phẩm không tồn tại</h1>";
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="./upload/img/logochuongmobile.png">
    <title> <?php echo $getProduct['ten'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <script src="./include/script/ckeditorbasic/ckeditor.js"></script>
    <script src="script/js/myJS.js"></script>
    <link rel="stylesheet" href="script/css/mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

</head>
<body>
<?php include 'views/header.php' ?>
    <div class="between">
        <div class="content">
            <div class="container">
                <h2 style="margin-top: 15px"><?php echo $getProduct['ten']?></h2> <hr>
                <div class="box-gtpr ">
                    <div class="row">
                        <div class="col-md-7" style="padding-left: 0px">
                        <img class="img-avatarpr1" src="<?php 
                            $url = filter_var($getProduct['img'], FILTER_VALIDATE_URL);
                            if ($url) {
                                echo $getProduct['img'];
                            } else {
                                echo '.' . $getProduct['img'];
                            }
                        ?>">
                        </div>
                        <div class="col-md-5 bg-white">
                            <h4 style="margin-top: 20px; font-weight: 900;" >THÔNG TIN ĐẶT HÀNG</h4>
                            <br>
                            <p class="parameter-pr">Tên sản phẩm: <span style="font-weight: 900;"><?php echo $getProduct['ten']?></span></p>
                            <p class="parameter-pr" id="giaban">Giá bán: <span style="font-weight: 900; color:#fd7e14"><?php echo number_format($getProduct['giaban'],0,'1','.')?>đ</span></p>
                            <p class="parameter-pr">Tình trạng: <span style="font-weight: 900;"><?php echo $getProduct['tinhtrang']?></span></p>
                            <p class="parameter-pr">Số lượng còn: <span style="font-weight: 900;"><?php echo $getProduct['soluong']?></span></p>
                            <p class="parameter-pr">Số lượng mua: <span style="font-weight: 900; text-align:center;">
                            <input name="soluong" id="soluong" type="number" style="width: 40px;font-weight: 700; border: solid 1px #000; color: #000; border-radius: 5px;" value="1">
                            <div class="row" style="margin-top: 30px; margin-bottom: 15px">
                               <?php
                                if(isset($_COOKIE['login'])){ echo'
                                    <div class="col-6">
                                        <input name="id_user" value="'.$_COOKIE['login'].'" type="hidden">
                                        <input name="id_product" value="'.$_GET['receive'].'" type="hidden">
                                        <button onclick="addCart()" class="btn btn-outline-info" style="width: 100%;font-weight: 600">THÊM GIỎ HÀNG</button>
                                    </div>
                                    <div class="col-6">
                                        <form action="purchase.php" method="get">
                                            <button class="btn btn-info" style="width: 100%; font-weight: 600" onclick="addCart1()">MUA NGAY</button>
                                        </form>
                                    </div>
                                ';} else echo '
                                    <div class="col-12" style="text-align: center">
                                       <a href="./login.php" >
                                         <button class="btn btn-danger" style="font-weight: 600; max-width: 100%">  Bạn cần đăng nhập để mua hàng</button>
                                        </a>
                                    </div>'
                                ?>
                            </div>
                            </div>
                        </div>
                        <script>
                            function addCart1() {
                                $hehe = document.getElementById('cart-number');
                                $setVl =  $hehe.textContent.slice(1,-1);
                                $hehe.textContent = "("+(Number($setVl) + 1) +")";
                                var sol = $('#soluong').val();
                                $.ajax({
                                    url : "./views/viewajax/add_product_cart.php",
                                    type : "post",
                                    dataType:"text",
                                    data : {
                                        id_user:'<?php echo $_COOKIE['login']?>',
                                        id_product:'<?php echo $_GET['receive']?>',
                                        soluong: sol,
                                    },
                                    success : function (result){
                                    }
                                });

                            }
                            function addCart() {
                                $hehe = document.getElementById('cart-number');
                                $setVl =  $hehe.textContent.slice(1,-1);
                                $hehe.textContent = "("+(Number($setVl) + 1) +")";
                                var sol = $('#soluong').val();
                                $.ajax({
                                    url : "./views/viewajax/add_product_cart.php",
                                    type : "post",
                                    dataType:"text",
                                    data : {
                                        id_user:'<?php echo $_COOKIE['login']?>',
                                        id_product:'<?php echo $_GET['receive']?>',
                                        soluong: sol,
                                    },
                                    success : function (result){
                                    }
                                });

                                alert("Sản phẩm đã được thêm vào giỏ hàng");
                            }</script>
                        <div class="col-12 bg-white" style="margin-top: 25px; padding-top: 8px; padding-bottom: 18px">
                                <H5 style ="font-weight : 700;">THÔNG SỐ KỸ THUẬT CHI TIẾT</H5>
                            <table>
                                <tr class="tr1">
                                    <td class="td1" style="width: 50% ; font-weight : 700;">Thương hiệu</td>
                                    <td class="td2"   <?php if ($getProduct['thuonghieu']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['thuonghieu']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Xuất xứ thương hiệu</td>
                                    <td class="td2"   <?php if ($getProduct['xuatxu']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['xuatxu']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Kích thước màn hình</td>
                                    <td class="td2"   <?php if ($getProduct['kichthuocman']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['kichthuocman']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Độ phân giải</td>
                                    <td class="td2"   <?php if ($getProduct['dophangiai']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['dophangiai']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Trọng lượng</td>
                                    <td class="td2"   <?php if ($getProduct['trongluong']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['trongluong']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Dung lượng pin</td>
                                    <td class="td2"   <?php if ($getProduct['dungluongpin']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['dungluongpin']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">CPU</td>
                                    <td class="td2"   <?php if ($getProduct['cpu']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['cpu']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Tốc độ CPU</td>
                                    <td class="td2"   <?php if ($getProduct['tocdocpu']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['tocdocpu']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Bộ nhớ ROM</td>
                                    <td class="td2"   <?php if ($getProduct['rom']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['rom']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Bộ nhớ RAM</td>
                                    <td class="td2"   <?php if ($getProduct['ram']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['ram']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Camera sau</td>
                                    <td class="td2"   <?php if ($getProduct['camerasau']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['camerasau']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Camera trước</td>
                                    <td class="td2"   <?php if ($getProduct['cameratruoc']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['cameratruoc']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Loại Sim</td>
                                    <td class="td2"   <?php if ($getProduct['loaisim']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['loaisim']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Wifi</td>
                                    <td class="td2"   <?php if ($getProduct['wifi']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['wifi']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Mạng di động</td>
                                    <td class="td2"   <?php if ($getProduct['mangdidong']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['mangdidong']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">GPS</td>
                                    <td class="td2"   <?php if ($getProduct['gps']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['gps']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Bluetooth</td>
                                    <td class="td2"   <?php if ($getProduct['bluetooth']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['bluetooth']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Hỗ trợ thẻ nhớ ngoài</td>
                                    <td class="td2"   <?php if ($getProduct['thenho']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['thenho']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Chip đồ họa (GPU)</td>
                                    <td class="td2"   <?php if ($getProduct['gpu']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['gpu']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;">Phụ kiện đi kèm</td>
                                    <td class="td2"   <?php if ($getProduct['phukien']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['phukien']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Cổng sạc</td>
                                    <td class="td2"   <?php if ($getProduct['congsac']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['congsac']?></td>
                                </tr>
                                <tr class="tr2">
                                    <td class="td1" style = "font-weight : 700;"> Pin có thể tháo rời</td>
                                    <td class="td2"   <?php if ($getProduct['pin']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['pin']?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1" style = "font-weight : 700;">Jack tai nghe</td>
                                    <td class="td2"   <?php if ($getProduct['jacktaynghe']=='[Chưa cập nhật]') echo 'style = "color:#c22"'?>><?php echo $getProduct['jacktaynghe']?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 bg-white" style="margin-top: 25px; padding-top: 8px">
                            <H5 style = "font-weight: 700;">BÀI VIẾT ĐÁNH GIÁ</H5>
                           <div id ="posts">
                             <?php echo $getProduct['posts'];
                                ?>
                           </div>
                        </div>
                        <div class="col-12 bg-white" style="margin-top: 25px; padding-top: 8px">
                            <H5 style = "font-weight: 700;">NHẬN XÉT SẢN PHẨM</H5>
                                <div style="width: 100%; border-radius: 3px; padding: 10px">
                                    <?php if(isset($_COOKIE['login'])) echo '
                       
                            <input id="cmt" name="cmt" style="width: 100%; height: 60px;border-radius: 5px">
                            <div style="text-align: right; margin-top: 15px">
                            <button onclick="addCommet()" class="btn btn-secondary">Bình luận</button> </div>
                        
                       ';

                                    else {
                                        echo '<span>Hãy <a href="./login.php">Đăng nhập</a> để bình luận!</span>
<input type="hidden" id="cmt" name="cmt">';
                                    }
                                    ?>

                                    <hr>
                                    <div class="view_ajax" id="view_ajax">:>>
                                    </div>

                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
    </div>
    <a id="back"> <i class="fa-solid fa-arrow-up"></i></a>

<script>
    ajaxcmt();
    function addCommet() {
        ajaxcmt();
    }
function ajaxcmt(){
    var cmt = document.getElementById('cmt').value;
    document.getElementById('cmt').value = "";
    $.ajax({
        url : "./views/viewajax/ajax_comment.php",
        type : "post",
        dataType:"text",
        data : {
            cmt:cmt,
            id_product: '<?php echo $_GET['receive']?>',
        },
        success : function (result){
          document.getElementById('view_ajax').innerHTML = result;
        }
    });
}
</script>
    <?php include 'views/footer.html'?>
    <script>
        function formatCash(str) {
            return str.split('').reverse().reduce((prev, next, index) => {
                return ((index % 3) ? next : (next + '.')) + prev
            })
        }
        function tongtien(a){
            return formatCash((a * <?php echo $getProduct['giaban'] ?>).toString());
        }

        $(document).ready(function(){
            $('#tongthanhtoan').html(tongtien($('#soluong').val()) +"đ");
            $('#soluong').change(function (){
                $('#tongthanhtoan').html(tongtien($('#soluong').val()) +"đ");
                if($('#soluong').val() < 1) {
                    $('#tongthanhtoan').html(tongtien(1) +" ");
                    $('#soluong').val(1);
                    alert("Bạn cần mua ít nhất là 1 sản phẩm");
                }
                else if($('#soluong').val()  > <?php echo $getProduct['soluong'] ?>) {
                    $('#soluong').val(<?php echo $getProduct['soluong'] ?>);
                    $('#tongthanhtoan').html(tongtien($('#soluong').val()) +"đ");
                    alert("Bạn không thể mua nhiều hơn số sản phẩm còn lại");
                }
            })
        });
        $(window).load(function(){
            responsive();
            $(window).resize(function(){
                responsive();
            });
        });

        // back to top
    var back = document.getElementById('back');
    console.log(back)

    window.onscroll = function ()
    {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300 )
        {
            back.style.display = 'block';
        }
        else {
            back.style.display = 'none';
        }

        back.addEventListener('click' , ()=> {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    }
    </script>

</body>
</html>
