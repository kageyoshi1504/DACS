<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4>Đơn hàng chờ xử lý</h4>
    <style>
        th,td{
            text-align:center;
        }

    </style>
    <table style="width: 100%; margin: 5px;">

        <thead style="height: 40px;background: #ccc;font-weight: 900; color: #000; font-size: 10px">
        <th style="font-weight: 900; color: #222; font-size: 12px">STT</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">TÊN SẢN PHẨM</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">SỐ LƯỢNG MUA</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">TỔNG THANH TOÁN</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">HÌNH THỨC THANH TOÁN</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">ĐÃ THANH TOÁN</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">TÌNH TRẠNG GỬI HÀNG</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">NGÀY ĐẶT HÀNG</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">ĐỊA CHỈ NHẬN</th>
        <th style="font-weight: 900; color: #222; font-size: 12px">HÀNH ĐỘNG</th>
        </thead>
        <?php
        require_once '../controller/Purchase_Control.php';
        $purchase = new Purchase_Control();
        if(isset($_POST['duyetdon'])){
            $purchase->paymentBrowsing();
        }
        if(isset($_POST['dele'])){
            $purchase->deleteOder();
        }
        $dataPurchase =  $purchase->getListPurchaseUnprocessed();
        ?>

        <?php
        $dem=0;
        foreach($dataPurchase as $line){
            ?>
            <tr style="background:<?php if($dem%2 == 1) echo '#efefef'; else echo 'fcfcfc';?>">
                <td style="font-weight: 600; text-align: center"><?php echo $dem+1?></td>
                <td><?php echo $line['sanphham'] ?></td>
                <td style="text-align: center; font-weight: 600"><?php echo $line['soluong'] ?></td>
                <td style="color: #fd7e14"><?php echo number_format($line['thanhtoan'],0,',','.')?>đ</td>
                <td><?php
                    if($line['hinhthucthanhtoan']==0) echo "<span style='color: #444444; padding: 0px 5px'>Tiền mặt</span>";
                    else if($line['hinhthucthanhtoan']==1) echo "<span style='color: #c69500; padding: 0px 5px'>Ngân hàng</span>";
                    else if($line['hinhthucthanhtoan']==2) echo "<span style='color: #ad006c; padding: 0px 5px'>Momo</span>";
                    ?></td>
                <td style="text-align: center">
                    <?php
                    if($line['tinhtrangthanhtoan']==0) echo "<span style=' color: #c82333; padding: 0px 5px'>Chưa</span>";
                    else if($line['tinhtrangthanhtoan']==1) echo "<span style=' color: #28a745; padding: 0px 5px'>Đã</span>";
                    ?>
                </td>
                <td>
                    <?php
                    if($line['ttgiaohang']==0) echo "<span style=':color: #6f42c1; padding: 0px 5px'>Chưa</span>";
                    else if($line['ttgiaohang']==1) echo "<span style=':color: #2e9ad0; padding: 0px 5px'>Đã gửi</span>";
                    ?>
                </td>
                <td>
                    <?php echo $line['ngaymua'] ?>
                </td>
                <td>
                    <?php echo $line['diachigiaohang'] ?>
                </td>
                <td style="text-align: center">
                    <button title="Thanh toán" id="<?php echo $line['id'] ?>" onclick="Duyet(<?php echo $line['id'] ?>)" class="btn btn-info" style="font-size: 13px; padding: 2px 3px; margin-top: 5px" >
                        Duyệt thanh toán
                    </button>
                    <button title="Thanh toán" id="<?php echo $line['id'] ?>" onclick="deleteitemn(<?php echo $line['id'] ?>)" class="btn btn-outline-danger" style="font-size: 13px; padding: 2px 3px; margin-top: 5px" >
                        Hủy đơn hàng
                    </button>
                </td>
            </tr>
            <?php
            $dem++;
        }
        ?>
        <dialog id="xacnhanxoa" style="padding: 10px 15px;border: none; width: 400px;  box-shadow: 0px 0px 15px 0px #aaa; border-radius: 5px; display: none; position: fixed; top:50%;left: 50%;  transform: translate(-50%,-50%);">
            <div class="btn btn-danger" style="float: right; margin-left: 10px; padding: 2px; font-size: 14px; width: 25px" id="huydelete">X</div>
            <p style="font-size: 16px;">Đơn hàng này đang trong quá trình chờ xác nhận thanh toán, nếu bạn chắc chán xác nhận khách hàng chưa thanh toán hãy hủy đơn hàng này!</p>
            <hr style="margin-top: -7px; margin-bottom: 7px">
            <form style="float: right" method="post">
                <input name="select" value="unprocessed-order" style="display: none">
                <input id = "dele" name="dele" value="" style="display: none">
                <button style="padding: 2px; font-size: 14px" class="btn btn-info" id="xacnhandelete">Xác nhận hủy đơn hàng</button>
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
        <script>
            var n=(parseInt(document.getElementById('num-rows').textContent));

        </script>
    </table>
    <dialog id="duyet" style="padding: 10px 15px;border: none; width: 400px;  box-shadow: 0px 0px 15px 0px #aaa; border-radius: 5px; display: none; position: fixed; top:50%;left: 50%;  transform: translate(-50%,-50%);">
        <p style="font-size: 16px;">Đơn hàng này được thanh toán trả trước bằng MOMO hoặc Tài khoản ngân hàng, nếu bạn xác nhận khách hàng đã thanh toán cho đơn hàng này hãy duyệt đơn hàng này.</p>
        <b>Xác nhận đã thanh toán hoặc bấm hủy</b>
        <hr style="margin-top: 0px; margin-bottom: 7px">
        <button class="btn btn-danger" style="float: right; margin-left: 10px; padding: 2px; font-size: 14px" id="huyduyet">Hủy</button>
        <form style="float: right" method="post" action="#">
            <input name="select" value="unprocessed-order" style="display: none">
            <input id = "duyetdon" name="duyetdon" value="" style="display: none">
            <button style="padding: 2px; font-size: 14px" class="btn btn-info" id="xacnhandelete">Xác nhận đã thanh toán</button>
        </form>
    </dialog>
    <script>function Duyet(clicked_id)
        {
            var xacnhan = document.getElementById('duyet');
            var id =  document.getElementById(clicked_id);
            var huydelete = document.getElementById('huyduyet');
            var dele = document.getElementById('duyetdon');
            dele.value = clicked_id;
            huydelete.addEventListener('click', function() {
                xacnhan.style.display='none';
                xacnhan.close();
            });
            xacnhan.style.display='block';
            xacnhan.showModal();
        }</script>

</div>
