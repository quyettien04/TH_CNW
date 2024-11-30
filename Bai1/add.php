<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_hoa = $_POST['ten_hoa'];
    $mo_ta = $_POST['mo_ta'];
    $file_name = $_FILES['file_anh']['name'];

    // Di chuyển tệp tải lên vào thư mục 'uploads/'
    $target_dir = 'image/';
    $target_file = $target_dir . basename($file_name);
    move_uploaded_file($_FILES['file_anh']['tmp_name'], $target_file);

    // Kết nối cơ sở dữ liệu
    require_once 'connect.php';

    // Chèn dữ liệu vào cơ sở dữ liệu
    $themsql = "INSERT INTO hoa (TenHoa, MoTa, Anh) VALUES ('$ten_hoa', '$mo_ta', '$file_name')";
    
    if (mysqli_query($conn, $themsql)) {
        // Quay lại trang danh sách sản phẩm
        header("Location: list_hoa.php");
        exit();
    } else {
        echo "Có lỗi khi thêm dữ liệu vào cơ sở dữ liệu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Add Form</h1>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tenhoa">Tên Loại Hoa:</label>
                <input type="text" id="tenhoa" name="ten_hoa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mota">Mô Tả:</label>
                <input type="text" id="mota" name="mo_ta" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fileInput">Ảnh:</label>
                <input type="file" id="fileInput" name="file_anh" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Hoa</button>
        </form>
    </div>
</body>
</html>
