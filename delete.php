<?php include('header.php')?>
<?php include('connect.php')?>

<?php 
$id=$_GET['id'];
$q=$connection->prepare("DELETE FROM student WHERE id=?");
$q->bind_param('i',$id);
$q->execute();

?>

<?php include('footer.php')?>