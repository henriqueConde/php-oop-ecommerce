<?php

function controllers_autoload($classname){
    include 'controllers/'.$classname.'.php';
}

spl_autoload_register('controllers_autoload');