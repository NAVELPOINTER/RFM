<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $parent_folder = $_POST['parent_folder'];
    $parent_folder_new = str_replace("http://127.0.0.1", "/opt/lampp/htdocs", $parent_folder);
    $folder_to_create = $_POST['folder_name'];

   $i_path = array($parent_folder_new, $folder_to_create);

   $new_path = join("", $i_path);

    $folder_creation = mkdir($new_path, 0777);
    if($folder_creation==false)
    {
        echo "<script>
            alert('Could not create folder at location $parent_folder_new');
            window.location.href('../html/new_folder.html');
        </script>";
    }else{
        $index = array($new_path, "/", "index.php");
        $directory_changer = array($new_path, "/", "directory_changer.php");
        $index_path = join("", $index);
        $directory_changer_path = join("", $directory_changer);

        $file_index = fopen($index_path, 'w+');
        $file_directory_changer = fopen($directory_changer_path, 'w+');

        copy("../folders/index.php", $index_path);
        copy("../folders/directory_changer.php", $directory_changer_path);

        echo "<script>
            alert('Folder created successfully!');
            window.location.href('$new_path');
        </script>";
    }
}


