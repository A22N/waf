<?php
// Get ALL User
function getAllUser($conn)
{
    $sql = "SELECT ID, FullName, Username, Time_create, Role FROM account ORDER BY Time_create DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}
// Delete by ID
function deleteByIdUser($conn, $id): void
{
    $sql = "DELETE FROM account where ID= ?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);
    if ($res) {
        $em = "Xóa thành công!";
        header("Location: user.php?success=" . base64_encode($em));
        exit;
    } else {
        $em = "Xóa Thất Bại!";
        header("Location: user.php?error=" . base64_encode($em));
        exit;
    }
}
//Get Name By ID
function getUserNameByID($conn, $id)
{
    $sql = "SELECT Username FROM account WHERE ID =?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch();
    return $data["Username"];
}
