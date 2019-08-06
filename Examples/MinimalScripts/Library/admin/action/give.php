<?php
$borrow = Application::$db->db->query("SELECT * FROM borrows WHERE id = '".$_GET['action_id']."'")->fetch(PDO::FETCH_OBJ);
$prep = Application::$db->db->prepare("UPDATE borrows SET return_date = :return AND status = 1 WHERE id = '".$borrow->id."'");
$prep->execute([
    "return" => date("Y-m-d")
]);
redirect("index.php?panel=admin&module=action&action=index");