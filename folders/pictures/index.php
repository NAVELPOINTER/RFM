<html lang="en" dir="ltr">
<head>
    <title>Index page</title>
    <script src="https://kit.fontawesome.com/f615d2e945.js" crossorigin="anonymous"></script>
    <style>
        table{
            width: 100%;
        }
        table tr td a{
            color: #000000;
            text-decoration: none;
        }
        table tr:nth-child(even){
            background-color: #eeeaea;
        }
        table tr th{
            color: white;
            background: -moz-linear-gradient(#0033cc, #0059b3, #00ace6);
            padding: 10px 20px;
        }
        tr td i{
            color: #baba02;
            font-weight: bolder;
            font-size: 30px;
        }
        input[type='hidden']{
            width: 2%;
        }
        input[type='submit']{
            border: none;
            font-size: 16px;
        }
    </style>

</head>
<body>

<?php
    $dir = getcwd();
    $old_arr = scandir($dir, 0);
    unset($old_arr[0]);
    unset($old_arr[1]);
    $arr = array_values($old_arr);

    $length = count($arr);

    if($length < 1)
    {
        echo "<script>
            alert('This folder is empty!');
            window.location.href('$dir/../');
        </script>";
    }else
    {
?>
        <table>
            <tr>
                <th>Name</th>
                <th>Date Created</th>
                <th>Date Modified</th>
                <th>Item Count</th>
                <th>Type</th>
                <th>Size</th>
            </tr>
            <?php

                foreach($arr as $key=>$arr_item)
                {

            ?>
                    <tr>
                        <td>
                            <p>
                                <?php
                                if(is_dir($arr_item)==true){

                                    ?>
                                    <form action="directory_changer.php" method="POST">
                                        <i class="fa fa-folder-open" aria-hidden="true"></i>
                                        <input type="hidden" name="hidden_arr_item" id="hidden_arr_item" value="<?php echo $arr_item; ?>"/>
                                        <input type="submit" id="<?php echo $arr_item; ?>" value = "<?php echo $arr_item; ?>"/>
                                    </form>
                                    <?php
                                }else{
                                    ?>
                                    <i class="fa fa-file" aria-hidden="true" style="color: #02e8e2; margin-right: 15px"></i>
                                    <?php
                                    echo $arr_item;
                                }
                                ?>
                            </p>
                        </td>
                        <td>
                            <?php
                            if(is_file($arr_item)==true){
                                echo date("Y/m/d H:i:s", filectime($arr_item));
                            }else{
                                $stat = stat($arr_item);
                                echo date("Y/m/d H:i:s", $stat['ctime']);
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                                if(is_file($arr_item)==true){
                                    echo date("Y/m/d H:i:s", filemtime($arr_item));
                                }else{
                                    $stat = stat($arr_item);
                                    echo date("Y/m/d H:i:s", $stat['mtime']);
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                            if(is_dir($arr_item) == true)
                            {
                                chdir($arr_item);
                                $new_arr = scandir(getcwd());
                                echo (count($new_arr) - 2);
                                chdir($dir);
                            }else{
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td><?php if(is_dir($arr_item) == true){ echo "folder";}else{ echo filetype($arr_item);}?></td>
                        <td>
                            <?php
                            if(is_dir($arr_item) == true)
                            {
                                /*$new_dir = chdir($arr_item);

                                $new_arr = scandir($new_dir);
                                foreach($new_arr as $new_arr_item){

                                }
                                chdir($dir);*/
                                echo "--";
                            }else{
                                $size = filesize($arr_item);
                                $new_size = $size/1000;
                                echo $new_size."KB";
                            }
                            ?>
                        </td>
                    </tr>
            <?php

                }
            ?>
        </table>

<?php

    }
?>
</body>
</html>