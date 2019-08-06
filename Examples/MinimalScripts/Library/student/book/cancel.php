<?php
$borrow = Application::$db->db->query("SELECT * FROM borrows WHERE id = '".$_GET['borrow']."'")->fetch(PDO::FETCH_OBJ);
Application::$db->db->query("DELETE FROM borrows WHERE id = '".$borrow->id."'");
redirect("index.php?panel=student&module=book2&action=index");