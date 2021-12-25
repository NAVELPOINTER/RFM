<?php

include 'index.php';

$changer_dir = getcwd();
$arr_item_iter = $_POST['hidden_arr_item'];
$new_directory = array($changer_dir, "/", $arr_item_iter);
$f_new_directory = join("",$new_directory);
if(chdir($f_new_directory)==true){
    echo "<script>
        document.location.href='./$arr_item_iter';
    </script>";
}else{
    echo "<script>
        alert('failed!');
    </script>";
}

