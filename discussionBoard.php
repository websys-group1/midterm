<?php

$dbhost="localhost";
$dbusername= "root";
$dbpassword= "";
$dbname= "websysfinal";
// ^ this is just what I called my db in phpmyadmin (im currently still locked out of it though)

$conn= new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(!$conn){
    echo "connection failed";
}

$discussionInfo= "SELECT * FROM `discussion`";
//this is querying all of the info from a table in the websysfinal database called duscussion
//(if dont want to change code, name the table in the db discussion)
$final_discussionInfo= $conn->query($discussionInfo);
//code for adding text/email/date to the table below
$added= NULL;
if(isset($_POST['addText'])){
    $addText= $_POST['addText'];
    if($addText){
        //name the first column 'text' in the database (the info the user submits)
        $text= $_POST['text'];
        //name the second column 'email' in the database
        $email= $_POST['email'];
        //name the third column 'date' in the database
        $date= $_POST['date'];
        $sqlAddText= "INSERT INTO `discussion` (`text`, `email`, `date`) VALUES ($text, $email, $date)";
        $added= $conn->query($sqlAddText);
    } 
}
?>



<!DOCTYPE html>
    <header>
        <h2>Discussion Board!</h2>
        <h4>Submit any chat below for other users to see</h4>
        <h5>Be mindful of what information you release</h5>
    </header>
    <body>
        <div class= "table">
            <?php 
                if($final_discussionInfo->num_rows > 0){
                    echo "<table>
                    <tr>
                    <th>Text</th>
                    <th>Email</th>
                    <th>Date</th>
                    </tr>";
                    while($row= $final_discussionInfo->fetch_assoc()){
                        echo "<tr>"
                        ."<td>". $row["text"] . "</td>"
                        ."<td>". $row["email"] . "</td>"
                        ."<td>". $row["date"] . "</td>"
                        ."</tr>";
                    }
                    echo "</table>";
                }else{
                    echo "0 results";
                }
                //im not sure if lines 66-84 are necessary, and i'm leaning towards no
                //if you could take a look at them and decide or help decide to delte or keep it
                //once it is running and hosted, that would be great
                if($added){
                    if($added->num_rows > 0){
                        echo "<table>
                        <tr>
                        <th>Text</th>
                        <th>Email</th>
                        <th>Date</th>
                        </tr>";
                        while($row= $added->fetch_assoc()){
                            echo "<tr>"
                            ."<td>". $row["text"] . "</td>"
                            ."<td>". $row["email"] . "</td>"
                            ."<td>". $row["date"] . "</td>"
                            ."</tr>";
                        }
                        echo "</table>";
                    }else{
                        echo "0 results";
                    }
                }

            ?>
        </div>
        <form class= "addText" action="" method="post" enctype="multlipart/form-data">
            <span>Insert Text: </span> <input type= "varchar" name="text" value=""/>
            <span>Insert Email: </span> <input type= "varchar" name="email" value=""/>
            <span>Insert Date: </span> <input type= "varchar" name="date" value=""/>
            <button type="submit" formaction="?" formmethod="post">Submit</button>
        </form>
        <?php
        $conn->close();
        ?>
    </body>
</html>
