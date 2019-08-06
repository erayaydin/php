<?php
$category = Application::$db->db->query("SELECT * FROM categories WHERE id = '".$_GET['book']."'")->fetch(PDO::FETCH_OBJ);
Application::$db->db->query("DELETE FROM categories WHERE id = '".$category->id."'");
redirect("index.php?panel=admin&module=category&action=index");