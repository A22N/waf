<?php
//Get All Category
function getAllCategory($conn)
{
    $sql = "SELECT * FROM category ORDER BY Time_Create DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}
//Get Name by ID
function getCategoryNamebyID($conn, $id)
{
    $sql = "SELECT Category_Name FROM category WHERE ID = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch();
    return $data["Category_Name"];
}

//Delete Category
function deleteByIdCategory($conn, $id): void
{
    $sql = "DELETE FROM category where ID= ?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);
    if ($res) {
        $em = "Xóa thành công!";
        header("Location: ../category.php?success=" . base64_encode($em));
        exit;
    } else {
        $em = "Lỗi không xác định!";
        header("Location: ../category.php?error=" . base64_encode($em));
        exit;
    }
}

//Get Post in Category
function getByIdDeep($conn, $id)
{
    $sql = "SELECT post.Post_ID,account.Username, post.Post_Tittle, post.Post_Content,category.Category_Name,post.Time_Create, post.Cover_Url, post_status.Status_Name
            FROM post INNER JOIN account ON post.Writer_ID = account.id INNER JOIN category ON post.Category_ID = category.id INNER JOIN post_status on post.Status_ID = post_status.Status_ID
            WHERE category.ID = ? ORDER BY post.Time_Create DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt->rowCount() >= 1) {
        $data = [];
        while ($row = $stmt->fetch()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return 0;
    }
}
