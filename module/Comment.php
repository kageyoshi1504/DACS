<?php


class Comment
{
    private $connect;

    public function __construct()
    {
        require_once "ConnectDatabase.php";
        $this->connect = new connectDatabase();
        $this->connect = $this->connect->connect();
    }


    public function getlistCommentByProductId($id_product)
    {
        if (!$this->connect) {
            return false;
        } else {
            $data = array(array());
            $sql = "SELECT * from comment where id_product = '$id_product'";
            $getcmt = mysqli_query($this->connect, $sql);
            if (mysqli_num_rows($getcmt) <= 0) {
                return array();
            }
            else {
                $dem=0;
                while ($line = mysqli_fetch_assoc($getcmt)){
                    $id_user = $line['id_user'];
                    $sql ="SELECT name FROM user where id = '$id_user'";
                    $getUser = mysqli_query($this->connect,$sql);
                    $data[$dem][0] =  $line['cmt'];
                    $data[$dem][1] = mysqli_fetch_assoc($getUser)['name'];
                    $data[$dem][2] = $line['comment_time'];
                    $dem++;
                }
            }
            return $data;
        }
        return array();
    }
    public function getlistComment()
    {
        if (!$this->connect) {
            return false;
        } else {
            $data = array(array());
            $sql = "SELECT * from comment";
            $getcmt = mysqli_query($this->connect, $sql);
            if (mysqli_num_rows($getcmt) <= 0) {
                return array();
            }
            else {
                $dem=0;
                while ($line = mysqli_fetch_assoc($getcmt)){
                    $id_user = $line['id_user'];
                    $sql ="SELECT name FROM user where id = '$id_user'";
                    $getUser = mysqli_query($this->connect,$sql);
                    $id_sanpham = $line['id_product'];
                    $sql ="SELECT ten FROM sanpham where id = '$id_sanpham'";
                    $getProduct = mysqli_query($this->connect,$sql);
                    $data[$dem][0] =  $line['cmt'];
                    $data[$dem][1] = mysqli_fetch_assoc($getUser)['name'];
                    $data[$dem][2]  = mysqli_fetch_assoc($getProduct)['ten'];
                    $data[$dem][3] = $line['id'];
                    $data[$dem][4] = $line['comment_time'];

                    $dem++;
                }
            }
            return $data;
        }
        return array();
    }

    public function deleteCommentByID($id)
    {
        if (!$this->connect) {
            return false;
        } else {
            $sql = "delete from comment where id = $id";
            mysqli_query($this->connect, $sql);
            return true;
        }
        return false;
    }
    public function addNewComment($id_product,$id_user,$cmt){
        if (!$this->connect) {
            return false;
        } else {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $current_time = date('Y-m-d H:i:s');
            $sql = "INSERT INTO comment value (null ,'$id_user','$id_product','$cmt' , '$current_time')";
            mysqli_query($this->connect, $sql);
            return true;
        }
        return false;
    }
}
