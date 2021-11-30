<?php
    $dbhost= "localhost";
    $dbusername= "root";
    $dbpassword = "";
    $dbname = "websysfinal";
    
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
        echo "Connection failed!";
    }
    
    // if(isset($_POST['uploadfilesubmit'])){
    //     $filename= $_FILES['uploadfile']['name'];
    //     $filetmpname= $_FILES['uploadfile']['tmp_name'];
    //     $folder= 'imagesuploaded/';
    //     move_uploaded_file($filetmpname, $folder.$filename);
    //     $sql= "INSERT INTO `found` (`imagename`) VALUES ('$filename')";
    //     $qry= mysqli_query($conn, $sql);
    //     if($qry){
    //         echo "image uploaded";
    //     }
    // }
    

    $added= NULL;
    if(isset($_POST['addItem'])){
        $addItem= $_POST['addItem'];
        if($addItem){
            $filename= $_FILES['uploadfile']['name'];
            $filetmpname= $_FILES['uploadfile']['tmp_name'];
            $folder= 'imagesuploaded/';
            move_uploaded_file($filetmpname, $folder.$filename);
            $item= $_POST['item'];
            $description= $_POST['description'];
            $name= $_POST['name'];
            $sqlAddItem= "INSERT INTO `found` (`item`, `image`, `description`, `name`) VALUES ($item, $filename, $description, $name)";
            $added= $conn->query($sqlAddItem);
        }
    }
?>

<!--found holds item (key), image, description, and name-->
<!DOCTYPE html>
    <body>
        <div class= "table">
            <?php
                if($added->num_rows > 0){
                    echo "<table>
                        <tr>
                        <th>Item</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Name</th>
                    </tr>";
                    //output data of each row
                    while($row= $added->fetch_assoc()){
                        echo "<tr>"
                        ."<td>" . $row["item"] . "</td>"
                        ."<td>" . $row["image"] . "</td>"
                        ."<td>" . $row["description"] . "</td>"
                        ."<td>" . $row["name"] . "</td>"
                        ."</tr>";
                    }
                    echo"</table>";
                }else{
                    echo"0 results";
                }
            ?>
        </div>
        <form class= "addItem" action="" method="post" enctype="multipart/form-data">
            <span>Item Name: </span> <input type="varchar" name="item" value="" />
            <span>Image: </span> <input type="file" name="uploadfile"/>
            <!--how do I formatthe submit to upload both files and info? can keep the same?-->
            <span>Description: </span> <input type="varchar" name="description" value=""/>
            <span>Your name: </span> <input type="varchar" name="name" value=""/>
            <input type="submit" name="uploadfilesubmit" value="upload" />

        </form>
    </body> 
</html>