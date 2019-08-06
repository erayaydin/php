<?php
$book = Application::$db->db->query("SELECT * FROM books WHERE id = '".$_GET['book']."'")->fetch(PDO::FETCH_OBJ);
Application::$db->db->query("DELETE FROM books WHERE id = '".$book->id."'");
redirect("index.php?panel=admin&module=book&action=index");