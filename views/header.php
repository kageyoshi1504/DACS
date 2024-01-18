<?php
    require_once './controller/Cart_Control.php';
    $cart = new Cart_Control();
    $countcart = $cart->getNumByIdUser();
?>
<div class="header">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <a href="./">
                        <img src="upload/img/logochuongmobile.png" alt="logo chương mobile" class="logo-chuongmobile">
                    </a>
                </div>
                <div class="col-sm-6 top-header-left">
                    <a href="./cart.php" style="text-decoration: none">
                        <span class="box-border box-padding1" id="icon-cart">
                          <i class="fas fa-shopping-cart"></i>
                          <i class="cart-text" id="cart-text">Giỏ hàng</i>
                            <span class="cart-text" id="cart-number">(<?php echo $countcart ?>)</span>
                       </span>
                    </a>
                    <a href="<?php if(isset($_COOKIE['login'])) echo './account.php'; else  echo './login.php';?>"  class="cart-text" >
                       <span class="box-border box-padding2" style="margin-left: 20px" id="icon-user">
                       <i class="fas fa-user"></i><?php if(!isset($_COOKIE['login'])) echo 'Đăng nhập';?>
                    </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once './controller/Product_Control.php';
        $product_Control = new Product_Control();
        $data = $product_Control->getMenu();
    ?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="./" style="color: white">HOME</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <?php
                        foreach ($data as $line){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./?classify=<?php echo $line[3]?>" style="color: white"><?php echo $line[0]?></a>
                            </li>
                    <?php
                        }
                    ?>
                </ul>

            </div> <form class="navbar-form navbar-left" action="./search.php" style="margin-bottom: -17px;" method="get">
            <table>
                <tr><td><div class="form-group" style=" margin-right: 5px">
                    <input type="text" class="form-control" name ="key" placeholder="Nhập tên sản phẩm để tìm kiếm">
                </div></td><td> <button type="submit" class="btn btn-default" style="margin-bottom: 17px" >Tìm kiếm</button></td></tr>
            </table>
        </form>
        </div>
    </nav>
</div>

