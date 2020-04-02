<?php
include('session.php');
?>

<?php
function users_online(){
    global $connection;
$session=session_id();
$time=time();
$time_out_in_seconds=60;
$time_out=$time-$time_out_in_seconds;
$query="select * from users_online where session='$session'";
$send_query=mysqli_query($connection,$query);
$count=mysqli_num_rows($send_query);
if($count==NULL){
    mysqli_query($connection,"insert into users_online(session,time) values ('$session','$time')");
}
else{
    mysqli_query($connection,"update users_online set time='$time' where session='$session'");
}
$users_online_count=mysqli_query($connection,"select * from users_online where time >'$time_out'");
return $count_user=mysqli_num_rows($users_online_count);
}

function insert_category(){
    global $connection;
    if(isset($_POST['submit'])){
    $cat_title=$_POST['cat_title'];
    if($cat_title=="" ||empty($cat_title))
    echo "this field cannot be empty ";
    else{
    $query="insert into category (cat_title) values ('$cat_title')";
    $result=mysqli_query($connection,$query);
    }
}
}
function allcategories(){
    global $connection;
   
    $query="select * from category";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result)){


    echo "<tr>";
        echo "<td> {$row['cat_id']}</td>";
        echo "<td> {$row['cat_title']}</td>";
        echo "<td><a href=categories.php?delete={$row['cat_id']}>Delete</td>";
        echo "<td><a href=categories.php?edit={$row['cat_id']}>Edit</td>";

        echo "</tr>";
    }
}
    function daleteCategories(){
        global $connection;
        if(isset($_GET['delete'])){
            $id=$_GET['delete'];
            $query="delete from category where cat_id='$id'";
            $result=mysqli_query($connection,$query);
            if(!$result)
            echo $mysqli_error();
            header("Location: categories.php");
        }
    }

?>