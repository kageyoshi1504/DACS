
<?php
if(isset($_POST['oldpassword'])){
    require_once "../controller/Account_Control.php";
    $temp  =new  Account_Control();
    $temp -> ChangePasswordAdmin();
}
?>
<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4>Thay đổi mật khẩu admin</h4>

        <br>
        <form method="post">
            <div class="form-group">
                <label  for="exampleInputEmail1">Nhập mật khẩu cũ</label><br>
                <input type="password" class="form-control-sm" style="width: 400px; max-width: 90%" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập mật khẩu cũ" required name="oldpassword">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nhập mật khẩu mới</label><br>
                <input type="password" class="form-control-sm" style="width: 400px; max-width: 90%" id="exampleInputPassword1" placeholder="Nhập mật khẩu mới" name="new1password" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Xác nhận mật khẩu mới</label><br>
                <input type="password" class="form-control-sm" style="width: 400px; max-width: 90%" id="exampleInputPassword1" placeholder="Xác nhận mật khẩu mới" name="new2password" required>
            </div>
            <button type="submit" class="btn btn-info">Thay đổi</button>
        </form>
</div>