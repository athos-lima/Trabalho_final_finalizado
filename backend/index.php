<?php
session_start();
if(isset($_SESSION['nao_autenticado'])):
endif;
unset($_SESSION['nao_autenticado']);
?>
