<?php

require_once '../config/koneksi.php';

session_destroy();

header('location: ../login.php');
