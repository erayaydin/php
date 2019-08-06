<?php

$book = Application::$db->db->query("SELECT * FROM books WHERE id = '".$_GET['book']."'")->fetch(PDO::FETCH_OBJ);

$cr = Application::$db->db->prepare("INSERT INTO borrows(book_id,user_id,status,reservation_date,borrow_date,return_date,price) VALUES(:book,:user,2,:date,null,null,0)");
$cr->execute([
    "book" => $book->id,
    "user" => Application::$auth->user->id,
    "date" => date("Y-m-d")
]);

redirect("index.php?panel=student&module=book&action=index");