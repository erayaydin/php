<?php

Application::$session->delete("auth");
redirect("index.php");