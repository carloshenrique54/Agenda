<?php

require 'sessao.php';

if (empty($_SESSION['usuario'])) {
    header('Location: index.php');
}