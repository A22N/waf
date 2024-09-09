<?php
function getInfoUser($conn, $id)
{
    $sql = "SELECT * FROM account WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetch();
        return $data;
    } else {
        return 0;
    }
}
function checkPass($conn, $id, $pass)
{
    $sql = "SELECT Password FROM account WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetch();
        if (md5($pass) === $data['Password']) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}
