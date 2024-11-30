<?php
//nhan du lieu tu form
$sid = $_GET['id'];
//ket noi csdl
require_once 'connect.php';

//lenh query
$editsql = "SELECT * FROM hoa WHERE id='$sid'";

//do du lieu vao result
$result = mysqli_query($conn,$editsql);
//lay du lieu tu result ra
$row = mysqli_fetch_assoc($result);

//hien thi thong tin len form
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
        <h1>Edit Form</h1>
        <form action="update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $sid; ?>">
            <div class="form-group">
                <label for="tenhoa">Tên Loại Hoa:</label>
                <input type="text" id="tenhoa" name="ten_hoa" value="<?php echo $row['TenHoa']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mota">Mô Tả:</label>
                <input type="text" id="mota" name="mo_ta" value="<?php echo $row['MoTa']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="anh_cu">Ảnh Cũ:</label>
                <img src="image/<?php echo $row['Anh']?>" alt="" style="width: 120px; height: 180px;">
            </div>
            <div class="form-group">
                <label for="fileInput">Ảnh Mới:</label>
                <input type="file" id="fileInput" name="file_anh_moi" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
