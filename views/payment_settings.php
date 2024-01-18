
<?php
require_once "../controller/Option_Control.php";
$temp  =new  Option_Control();
if(isset($_POST['act'])){
    $temp -> ChangeBillingInformation();
}
$data = $temp->GetBillingInformation();
?>
<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4>Cài đặt thông tin thanh thanh toán</h4>
    <br>
    <form method="post">
        <h5>Thông tin thanh toán ngân hàng</h5>
        <div class="form-group">
            <label  for="exampleInputEmail1">Tên ngân hàng</label><br>
            <input type="text" class="form-control-sm" style="width: 400px; max-width: 90%" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $data->bankname?>" required name="bankname">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Số tài khoản</label><br>
            <input type="text" class="form-control-sm" style="width: 400px; max-width: 90%" id="exampleInputPassword1"  value="<?php echo $data->stk?>" name="stk" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Chủ tài khoản</label><br>
            <input type="text" class="form-control-sm" style="width: 400px; max-width: 90%" id="exampleInputPassword1" value="<?php echo $data->ctkbank?>" name="ctkbank" required>
        </div>
        <br>
        <h5>Thông tin thanh toán Momo</h5>
        <div class="form-group">
            <label  for="exampleInputEmail1">Số điện thoại</label><br>
            <input type="text" class="form-control-sm" style="width: 400px; max-width: 90%" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?php echo $data->sdt?>" name="sdt">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Chủ tài khoản</label><br>
            <input type="text" class="form-control-sm" style="width: 400px; max-width: 90%" id="exampleInputPassword1" value="<?php echo $data->ctkmomo?>" name="ctkmomo" required>
        </div>
        <button type="submit" class="btn btn-info" name="act">Thay đổi</button>

    </form>
</div>