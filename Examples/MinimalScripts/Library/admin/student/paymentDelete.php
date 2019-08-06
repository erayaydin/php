<?php
$user = Application::$db->db->query("SELECT * FROM users WHERE id = '".$_GET['user']."'")->fetch(PDO::FETCH_OBJ);
$payment = Application::$db->db->query("SELECT * FROM payments WHERE id = '".$_GET['payment']."'")->fetch(PDO::FETCH_OBJ);
Application::$db->db->query("DELETE FROM payments WHERE id = '".$payment->id."'");
redirect("index.php?panel=admin&module=student&action=payment&user=".$user->id);