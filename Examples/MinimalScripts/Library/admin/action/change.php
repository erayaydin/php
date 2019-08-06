<?php
$borrow = Application::$db->db->query("SELECT * FROM borrows WHERE id = '".$_GET['action_id']."'")->fetch(PDO::FETCH_OBJ);
$prep = Application::$db->db->prepare("UPDATE borrows SET reservation_date = null, borrow_date = :borrow WHERE id = '".$borrow->id."'");
$prep->execute([
    "borrow" => date("Y-m-d")
]);
redirect("index.php?panel=admin&module=action&action=index");