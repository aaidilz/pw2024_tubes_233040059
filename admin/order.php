<?php

require '../config/protected.php';
require '../app/controller/OrderController.php';
require '../layout/admin/header.php';

$controller = new OrderController($conn);


