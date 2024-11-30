<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_hoa = $_POST['ten_hoa'];
    $mo_ta = $_POST['mo_ta'];
    $file_name_moi = $_FILES['file_anh_moi']['name'];
    $sid = $_POST['id'];

    // Di chuyển tệp tải lên vào thư mục 'uploads/'
    $target_dir = 'image/';
    $target_file = $target_dir . basename($file_name_moi);
    move_uploaded_file($_FILES['file_anh_moi']['tmp_name'], $target_file);

    // Kết nối cơ sở dữ liệu
    require_once 'connect.php';

    // Chèn dữ liệu vào cơ sở dữ liệu
    $updatesql = "UPDATE hoa SET TenHoa='$ten_hoa',MoTa='$mo_ta',Anh='$file_name_moi' WHERE id='$sid'";
    
    if (mysqli_query($conn, $updatesql)) {
        // Quay lại trang danh sách sản phẩm
        header("Location: list_hoa.php");
        exit();
    } else {
        echo "Có lỗi khi thêm dữ liệu vào cơ sở dữ liệu.";
    }
}
?>