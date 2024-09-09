<?php
// GET ALL HISTORY
function getALLHistory($conn, $id)
{
    $sql = "SELECT account.Username,history.User,history.Post_Tittle, history.Category_Name, history.Time_Event, event.Event_Name FROM history INNER JOIN account ON history.User_ID = account.ID INNER JOIN event ON history.Event_ID = event.Event_ID WHERE account.ID = ? ORDER BY history.Time_Event DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}
