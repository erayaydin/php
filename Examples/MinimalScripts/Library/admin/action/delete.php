<?php
$borrow = Application::$db->db->query("SELECT * FROM borrows WHERE id = '".$_GET['action_id']."'")->fetch(PDO::FETCH_OBJ);
Application::$db->db->query("DELETE FROM borrows WHERE id = '".$borrow->id."'");
redirect("index.php?panel=admin&module=action&action=index");