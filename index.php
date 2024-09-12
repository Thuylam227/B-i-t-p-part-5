<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
// Bài tập trang 6
// 1. Thêm dữ liệu vào bảng

$dbh = mysqli_connect('localhost', 'root', 'melody'); 
    // Kết nối với MySQL Server

    if (!$dbh)     
    die("Unable to connect to MySQL: " . mysqli_connect_error()); 
    // Thông báo lỗi nếu kết nối thất bại 
    
    if (!mysqli_select_db($dbh, 'my_personal_contacts'))     
    die("Unable to select database: " . mysqli_connect_error()); 
    // Thông báo lỗi nếu chọn CSDL thất bại
    
    $sql_stmt = "INSERT INTO `my_contacts` (`full_names`,`gender`,`contact_no`,`email`,`city`,`country`)"; 
    $sql_stmt .= "VALUES('Poseidon','Mail','541',' poseidon@sea.oc ','Troy','Ithaca')"; 
    
    $result = mysqli_query($dbh, $sql_stmt); // Thực thi câu lệnh SQL
    
    if (!$result) {
        die("Adding record failed: " . mysqli_connect_error()); 
        // Thông báo lỗi nếu thực thi câu lệnh thất bại
    } else {
        echo "Poseidon has been successfully added to your contacts list";
    }

    mysqli_close($dbh); // Đóng kết nối CSDL 



// 2. Cập nhật dữ liệu vào bảng
$dbh = mysqli_connect('localhost', 'root', 'melody'); 
// Kết nối tới MySQL Server

if (!$dbh)    
die("Unable to connect to MySQL: " . mysqli_connect_error()); 
// Thông báo lỗi nếu kết nối thất bại 

if (!mysqli_select_db($dbh,'my_personal_contacts'))     
die("Unable to select database: " . mysqli_connect_error()); 
// Thông báo lỗi nếu chọn CSDL thất bại

$sql_stmt = "UPDATE `my_contacts` SET `contact_no` = '785',`email` = 'poseidon@ocean.oc'";
$sql_stmt .= "WHERE `id` = 5";

$result = mysqli_query($dbh,$sql_stmt);
// Thực thi câu lệnh SQL

if (!$result) {
    die("Deleting record failed: " . mysqli_connect_error());
    // Thông báo lỗi nếu thực thi thất bại
} else {
    echo "ID number 5 has been successfully updated";
}

mysqli_close($dbh); //close the database connection
// 3. Xóa dữ liệu
$dbh = mysqli_connect('localhost', 'root', 'melody'); 
    // Kết nối với MySQL Server
    
    if (!$dbh)     
    die("Unable to connect to MySQL: " . mysqli_connect_error()); 
    // Thông báo lỗi nếu kết nối thất bại
    
    if (!mysqli_select_db($dbh,'my_personal_contacts'))     
    die("Unable to select database: " . mysqli_connect_error()); 
    // Thông báo lỗi nếu chọn CSDL thất bại
    
    $id = 4; 
    // ID của Venus trong CSQL
    
    $sql_stmt = "DELETE FROM `my_contacts` WHERE `id` = $id"; 
    // Câu lệnh SQL Delete
    
    $result = mysqli_query($dbh,$sql_stmt); 
    // Thực thi câu lệnh SQL
    
    if (!$result) {
        die("Deleting record failed: " . mysqli_connect_error());
        // Thông báo lỗi nếu thực thi thất bại 
    } else {
        echo "ID number $id has been successfully deleted";
    }
    
    mysqli_close($dbh); // Đóng kết nối CSDL
    
// 4. Hiển thị dữ liệu
$dbh = mysqli_connect('localhost', 'root', '', 'melody');
// Kết nối tới MySQL server

if (!$dbh)
    die("Unable to connect to MySQL: " . mysqli_connect_error());
// Nếu kết nối thất bại thì đưa ra thông báo lỗi

$sql_stmt = "SELECT * FROM my_contacts";
// Câu lệnh select

$result = mysqli_query($dbh, $sql_stmt);
// Thực thi câu lệnh SQL

if (!$result)
    die("Database access failed: " . mysqli_connect_error());
// Thông báo lỗi nếu thực thi thất bại

$rows = mysqli_num_rows($result);
// Lấy số hàng trả về

if ($rows) {
    while ($row = mysqli_fetch_array($result)) {
        echo 'ID: ' . $row['id'] . '<br>';
        echo 'Full Names: ' . $row['full_names'] . '<br>';
        echo 'Gender: ' . $row['gender'] . '<br>';
        echo 'Contact No: ' . $row['contact_no'] . '<br>';
        echo 'Email: ' . $row['email'] . '<br>';
        echo 'City: ' . $row['city'] . '<br>';
        echo 'Country: ' . $row['country'] . '<br><br>';
    }
}

mysqli_close($dbh); // Đóng kết nối CSDL

// Bài tập trang 14
// Sử dụng PDO thêm dữ liệu vào bảng 
try {
    // Kết nối đến cơ sở dữ liệu
    $pdo = new PDO('mysql:host=localhost;dbname=melody', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Thiết lập chế độ lỗi

    // Câu lệnh SQL để thêm dữ liệu
    $sql = "INSERT INTO my_contacts (full_names, gender, contact_no, email, city, country) 
            VALUES (:full_names, :gender, :contact_no, :email, :city, :country)";

    $stmt = $pdo->prepare($sql);

    // Liên kết tham số
    $stmt->bindParam(':full_names', $full_names);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':contact_no', $contact_no);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':country', $country);

    // Gán giá trị cho các tham số
    $full_names = 'Apollo';
    $gender = 'Male';
    $contact_no = '555';
    $email = 'apollo@mount.olympus';
    $city = 'Olympus';
    $country = 'Greece';

    $stmt->execute();

    echo "Dữ liệu đã được thêm thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
//cập nhật dữ liệu vào bảng
try {
    // Kết nối đến cơ sở dữ liệu
    $pdo = new PDO('mysql:host=localhost;dbname=melody', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu lệnh SQL để cập nhật dữ liệu
    $sql = "UPDATE my_contacts SET contact_no = :contact_no WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    // Liên kết tham số
    $stmt->bindParam(':contact_no', $contact_no);
    $stmt->bindParam(':id', $id);

    // Gán giá trị cho các tham số
    $contact_no = '999';
    $id = 1;

    $stmt->execute();

    echo "Dữ liệu đã được cập nhật thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
//Xoá dữ liệu ở bảng sử dụng PDO
try {
    // Kết nối đến cơ sở dữ liệu
    $pdo = new PDO('mysql:host=localhost;dbname=melody', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu lệnh SQL để xoá dữ liệu
    $sql = "DELETE FROM my_contacts WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    // Liên kết tham số
    $stmt->bindParam(':id', $id);

    // Gán giá trị cho tham số
    $id = 1;

    $stmt->execute();

    echo "Dữ liệu đã được xoá thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
// Hiển thị dữ liệu
try {
    // Kết nối đến cơ sở dữ liệu
    $pdo = new PDO('mysql:host=localhost;dbname=melody', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu lệnh SQL để truy vấn dữ liệu
    $sql = "SELECT * FROM my_contacts";

    $stmt = $pdo->query($sql);

    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($contacts as $contact) {
        echo "ID: " . $contact['id'] . "<br>";
        echo "Name: " . $contact['full_names'] . "<br>";
        echo "Gender: " . $contact['gender'] . "<br>";
        echo "Contact No: " . $contact['contact_no'] . "<br>";
        echo "Email: " . $contact['email'] . "<br>";
        echo "City: " . $contact['city'] . "<br>";
        echo "Country: " . $contact['country'] . "<br><br>";
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

?>

</body>
</html>