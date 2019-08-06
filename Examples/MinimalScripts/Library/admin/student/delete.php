<?php
$user = Application::$db->db->query("SELECT * FROM users WHERE id = '".$_GET['user']."'")->fetch(PDO::FETCH_OBJ);
Application::$db->db->query("DELETE FROM users WHERE id = '".$user->id."'");
redirect("index.php?panel=admin&module=student&action=index");