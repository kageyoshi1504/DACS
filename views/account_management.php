<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4>Quản lý người dùng</h4>

    <table style="width: 100%; margin: 5px;">

        <tr style="background: #fff; background: #445; color: #fff; text-align: left; height: 27px; line-height: 27px">
            <td style="font-weight: 500; font-size: 15px; text-align: center; width: 45px">STT</td>
            <td style="font-weight: 500; font-size: 15px">Email</td>
            <td style="font-weight: 500; font-size: 15px">Tên</td>
            <td style="font-weight: 500; font-size: 15px">Số điện thoại</td>
            <td style="font-weight: 500; font-size: 15px">Địa chỉ</td>
            <td style="font-weight: 500; font-size: 15px; text-align: center">Hành động</td>
        </tr>
        <?php
        require_once "../module/Account.php";
        $getlist  = new Account();
        if(isset($_GET['dele'])){
            $getlist ->deleteUserByID($_GET['dele']);
        }
        if(isset($_POST['act'])){
            $act = $_POST['act'];
            if($act=='edit'){
                require_once "../controller/Account_Control.php";
                $temp  =new  Account_Control();
                $temp -> ChangeInfoUserByAmin();
            }else if($act == 'editpass'){
                require_once "../controller/Account_Control.php";
                $temp  =new  Account_Control();
                $temp -> ChangePassUserByAmin();
            }
        }
        $getlist  = $getlist ->getlistUser();
        $sumcount = sizeof( $getlist);
        $count = 1;
        if($sumcount==1) echo'<tr><td colspan="6" style="text-align: center; border: solid 0.5px #123; font-size: 16px; font-weight: 500; color: #333">Danh sách rỗng</td></tr>';
        while ($count < $sumcount){

            echo '<tr style="font-weight: 400; text-align: left;background: ';
            if($count%2 == 1) echo '#efefef'; else echo "#fcfcfc";  echo '">';
            ?>
            <td style="text-align: center; font-weight: 600"><?php echo $count?></td>

            <td style=""><?php echo $getlist[$count][1]?></td>
            <td style=""><?php echo $getlist[$count][3]?></td>
            <td style=""><?php echo $getlist[$count][4]?></td>
            <td ><?php echo $getlist[$count][5]?></td>
            <td style="color: #b21f2d;  font-weight: 500; text-align: center">

                <i title="Xóa tài khoản" id="<?php echo $getlist[$count][0]?>" class="fas fa-window-close" onClick="deleteitemn(this.id)" class="btn btn-danger   " ></i>
                <i title="Sửa thông tin tài khoản" id="<?php echo $getlist[$count][0] ?>" class="fas fa-pen-square" onclick="editInfoUser(this.id,'<?php echo $getlist[$count][3]?>','<?php echo $getlist[$count][4]?>','<?php echo $getlist[$count][5]?>')"></i>
                <img onclick="editPassUser(<?php echo $getlist[$count][0]?>)" class="img-editpass" title="Chỉnh sửa mật khẩu tài khoản" src="../upload/img/img.png" style="width: 23px; height: auto; margin-top: -7px">
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
        <p style="font-size: 16px;">Bạn có thực sự muốn xóa tài khoản này!</p>
        <hr style="margin-top: -7px; margin-bottom: 7px">
        <button class="btn btn-danger" style="float: right; margin-left: 10px; padding: 2px; font-size: 14px" id="huydelete">Hủy</button>
        <form style="float: right">
            <input name="select" value="account-management" style="display: none">
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
            <input type="hidden" id = "editid" name="id" value="" style="display: none">
            <span style="font-weight: 400; ">Họ tên</span><br>
            <input id="name" class="form-control-sm" type="text" aria-invalid="name" name="name" required value="" style="width: 100%; border: solid 1px #333">
            <br> <br><span style="font-weight: 400">Số điện thoại</span><br>
            <input  class="form-control-sm" id="phonenumber" type="text" name="phonenumber" required value="" style="width: 100%; border: solid 1px #333">
            <br><br><span style="font-weight: 400">Địa chỉ</span><br>
            <input class="form-control-sm" id="address" type="text" name="address" required value="" style="width: 100%; border: solid 1px #333">
            <p></p>
            <button   class="btn btn-info" id="xacnhanedit" name="act" value="edit" style="float: right; padding: 2px 5px">Xác nhận</button>
        </form>
    </dialog>
    <script>function editInfoUser(clicked_id, hoten,sodienthoai,diachi)
    {
        var xacnhan = document.getElementById('editit');
        var huyedit = document.getElementById('huyedit');

        document.getElementById('editid').value = clicked_id;
        document.getElementById('name').value = hoten;
        document.getElementById('address').value = diachi;
        document.getElementById('phonenumber').value = sodienthoai;

        huyedit.addEventListener('click', function() {
            xacnhan.close();
            xacnhan.style.display='none';
        });
        xacnhan.showModal();
        xacnhan.style.display='block';
    }</script>

    <dialog id="editpassit" style="padding: 15px 10px;border: none; width: 500px;  box-shadow: 0px 0px 15px 0px #aaa; border-radius: 5px; display: none;position: fixed; top:50%;left: 50%;  transform: translate(-50%,-50%);">
        <i class="fas fa-window-close"  class="btn btn-danger"  id="huyeditpass" style="float: right; color: #c82333"></i>
        <p style="font-size: 21px; font-weight: 400">Sửa đổi mật khẩu User</p>
        <hr style="margin-top: -5px; margin-bottom: 5px">
        <form method="post" action="#" style="text-align: left">
            <input type="hidden" id = "editpassid" name="id" value="" style="display: none">
            <span style="font-size: 12px; color: #aaa;">(Chức năng này sử dụng để đổi lại mật khẩu cho User, nó cần thiết khi User yêu cầu cung cấp lại mật khẩu)</span>
            <br><span style="font-weight: 400; ">Nhập mật khẩu cho User</span><br>
            <input id="pass" class="form-control-sm" type="text" aria-invalid="pass" name="pass" required value="" style="width: 100%; border: solid 1px #333">
            <br><br>
            <button   class="btn btn-info" id="xacnhanedit" name="act" value="editpass" style="float: right; padding: 2px 5px">Thay đổi</button>

        </form>
        </form>
    </dialog>
    <script>function editPassUser(clicked_id)
        {
            var xacnhan = document.getElementById('editpassit');
            var huyedit = document.getElementById('huyeditpass');

            document.getElementById('editpassid').value = clicked_id;

            huyedit.addEventListener('click', function() {
                xacnhan.close();
                xacnhan.style.display='none';
            });
            xacnhan.showModal();
            xacnhan.style.display='block';
        }</script>

</div>
