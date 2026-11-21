<?php
spl_autoload_register('monChargeur');
function monChargeur($class)
{
  require "/src".$class.'.php'; 
}
?>
