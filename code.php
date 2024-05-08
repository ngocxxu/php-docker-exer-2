<?php
include "index.php";

// ***** 1. TẠO KHÁCH HÀNG *****
if (isset($_POST['them_kh'])) {
  // Nhan du lieu tu form
  $makh = $_POST['makh'];
  $tenkh = $_POST['tenkh'];
  $diachi = $_POST['diachi'];

  $sql = "INSERT INTO KHACHANG(MAKH,TENKH,DIACHI) VALUES ('$makh', '$tenkh', '$diachi')";

  $query = mysqli_query($con, $sql);
  if ($query) {
    echo "<h3>Them KH thanh cong</h3>";
  }
}

// ***** 2. LẤY DANH SÁCH SẢN PHẨM THEO NGÀY *****
if (isset($_GET["ngaydat"])) {
  $ngaydat = date('Y-m-d', strtotime($_GET['ngaydat']));

  $sql = "SELECT *
            FROM DONHANG DH
            JOIN KHACHANG KH ON DH.MAKH = KH.MAKH
            WHERE DH.NGAYDAT = '$ngaydat'";

  $query = mysqli_query($con, $sql);

  $products = array();

  while ($row = $query->fetch_assoc()) {
    $products[] = $row;
  }

  echo json_encode($products);
}

// ***** 3. XÓA SẢN PHẨM *****
if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
  $madh = $_POST['madh'];
  $sql = "DELETE FROM DONHANG DH WHERE DH.MADH = '$madh'";
  $query = mysqli_query($con, $sql);
}

// ***** 4. LẤY DANH SÁCH SP THEO TÊN KH *****
if (isset($_GET["tenkh"])) {
  $tenkh = $_GET['tenkh'];

  $sql = "SELECT *
            FROM DONHANG DH
            JOIN KHACHANG KH ON DH.MAKH = KH.MAKH
            WHERE KH.TENKH = '$tenkh'";

  $query = mysqli_query($con, $sql);

  $products = array();

  while ($row = $query->fetch_assoc()) {
    $products[] = $row;
  }

  echo json_encode($products);
}
