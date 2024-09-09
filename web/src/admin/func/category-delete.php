<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin" &&
    $_GET['ID']
) {
    include_once("./category.php");
    include_once("../../DB_Config/connectDB.php");
    $id = $_GET['ID'];
    $name = getCategoryNamebyID($conn, $id);
    $sql1 = "INSERT INTO history(User_ID,Category_Name,Event_ID) values (?,?,?)";
    $stmt = $conn->prepare($sql1);
    $stmt->execute([$_SESSION['ID'], $name, 10]);
    $category = deleteByIdCategory($conn, $id);
?>
<?php } else {
    header("Location:404.php");
    exit;
}
?>