<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List San Pham</title>

    <!-- Latest compiled and minified CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container">
        <a href="add.php" class="btn btn-success">Thêm Loại Hoa</a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Loại Hoa</th>
                    <th>Mô Tả</th>
                    <th>Ảnh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //ket noi csdl

                use LDAP\Result;

                require_once 'connect.php';

                //lenh query
                $select = "SELECT * FROM hoa";

                //thu thi lenh select
                $result = mysqli_query($conn, $select);

                //Duyet qua reasult va in ra
                while ($r = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $r['TenHoa']?></td>
                        <td><?php echo $r['MoTa']?></td>
                        <td><img src="image/<?php echo $r['Anh']?>" alt="" style="width: 120px; height: 180px;"></td>
                        <td>
                            <a href="edit.php?id=<?php echo $r['id']; ?>" class="btn btn-info">Sửa</a>
                            <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')" href="delete.php?sid=<?php echo $r['id']; ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>