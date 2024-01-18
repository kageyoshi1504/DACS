<div style="padding-left: 15px; padding-top: 10px; padding-right: 15px">
    <h4 style="margin-left: 5px">Lịch sử mua hàng</h4>
    <style>

        td,th{
            text-align:center;
        }

    </style>
    <table style="width: 100%; margin: 5px;">

        <thead style="height: 40px;background: #ccc;font-weight: 900; color: #000; font-size: 10px">
        <th style="font-weight: 900; color: #222; font-size: 12px; text-align:center;">STT</th>
        <th style="font-weight: 900; color: #222; font-size: 12px ; text-align:center;">TÊN SẢN PHẨM</th>
        <th style="font-weight: 900; color: #222; font-size: 12px;text-align:center">SỐ LƯỢNG MUA</th>
        <th style="font-weight: 900; color: #222; font-size: 12px; text-align:center">TỔNG THANH TOÁN</th>
        <th style="font-weight: 900; color: #222; font-size: 12px;text-align:center">HÌNH THỨC THANH TOÁN</th>
        <th style="font-weight: 900; color: #222; font-size: 12px;text-align:center">NGÀY ĐẶT HÀNG</th>
        <th style="font-weight: 900; color: #222; font-size: 12px;text-align:center">NGÀY GỬI HÀNG</th>
        <th style="font-weight: 900; color: #222; font-size: 12px; text-align:center">ĐỊA CHỈ NHẬN</th>
        <th style="font-weight: 900; color: #222; font-size: 12px;text-align:center">HÀNH ĐỘNG</th>
        </thead>
        <?php
        require_once '../controller/PurchaseHistory_Control.php';
        $purchaseHistory = new PurchaseHistory_Control();
        if(isset($_POST['deleid'])){
            $purchaseHistory->delePurchaseHistoryById();
        }
        $dataPurchase =  $purchaseHistory->getListPurchaseHistory();
        ?>

        <?php
        $dem=0;
       
            foreach($dataPurchase as $line){
                ?>
                <tr style="background:<?php if($dem%2 == 1) echo '#efefef'; else echo 'fcfcfc';?>">
                    <td style="font-weight: 600; text-align: center"><?php echo $dem+1?></td>
                    <td><?php echo $line['sanpham'] ?></td>
                    <td style="text-align: center; font-weight: 600"><?php echo $line['soluong'] ?></td>
                    <td style="color: #fd7e14"><?php echo number_format($line['thanhtoan'],0,',','.')?>đ</td>
                    <td><?php
                        if($line['hinhthucthanhtoan']==0) echo "<span style='color: #444444; padding: 0px 5px'>Tiền mặt</span>";
                        else if($line['hinhthucthanhtoan']==1) echo "<span style='color: #c69500; padding: 0px 5px'>Ngân hàng</span>";
                        else if($line['hinhthucthanhtoan']==2) echo "<span style='color: #ad006c; padding: 0px 5px'>Momo</span>";
                        ?></td>
                    <td>
                        <?php echo $line['ngaydat'] ?>
                    </td>
                    <td>
                        <?php echo $line['ngaygui'] ?>
                    </td>
                    <td>
                    <?php echo $line['diachigiaohang'] ?>
                        <!-- <textarea></textarea> -->
                    </td>
                    <td style="text-align: center">
                      <form method="post">
                          <input type="hidden" name="deleid" value="<?php echo $line['id'] ?>">
                          <button style="border: 0px">
                              <i title="Xóa lịch sử"  class="fas fa-window-close"></i>
                          </button>
                      </form>
                    </td>
                </tr>
                <?php
                $dem++;
            
            
        }
        ?>

        <script>
            var n=(parseInt(document.getElementById('num-rows').textContent));

        </script>
    </table>

</div>
