<?php
session_start();
require_once 'configs/config.php';
require_once 'models/db.php';

header('Location:'.URL_FRONT_END.'/controllers/index_controller.php?action=index');