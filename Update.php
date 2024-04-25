<?php include('header.php') ?>
<?php include('connect.php') ?>
<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $q = $connection->prepare("SELECT * FROM student WHERE id=?");
    $q->bind_param("i", $id);
    $q->execute();

    $result = $q->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
?>

        <form class="form-group" action="Update.php?id=<?php echo $row['id']?>" method="post">
            <label for="fid">Id</label>
            <input type="text" class="form-control" name="fid" value="<?php echo $row['id'] ?>" readonly>

            <label for="fname">Name</label>
            <input type="text" class="form-control" name="fname" value="<?php echo $row['Name'] ?>">

            <label for="fdob" style="display: block; margin-bottom: 10px;">
                Enter a date (YYYY-MM-DD):
            </label>
            <input type="date" name="fdob" id="fdob" class="form-control" value="<?php echo $row['Date_Of_Birth'] ?>" required>

            <label for="fcomment">Comment</label>
            <textarea name="fcomment" class="form-control" id="fcomment" cols="30" rows="10"><?php echo $row['Text'] ?></textarea>

            <label for="gender-male">Male</label>
            <input <?php echo $row['Gender_Male'] == 1 ?  "checked" : "" ?> type="checkbox" name="gender-male" id="gender-male">

            <label for="gender-female">Female</label>
            <input <?php echo $row['Gender_Female'] == 1 ? "checked" : "" ?> type="checkbox" name="gender-female" id="gender-female">

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $idnew = $_POST['fid'];
            $text = $_POST['fcomment'];
            $name = $_POST['fname'];
            $dob = $_POST['fdob'];
            
            $gender_male = isset($_POST['gender-male']) ? 1 : 0;
            $gender_female = isset($_POST['gender-female']) ? 1 : 0;

            $q = $connection->prepare('UPDATE student SET Name=?, Date_Of_Birth=?, Text=?, Gender_Male=?, Gender_Female=? WHERE id=?');
            $q->bind_param("sssiii", $name, $dob, $text, $gender_male, $gender_female, $id);

            if ($q->execute()) {
                echo "<h1>Student Updated</h1>";
            } else {
                echo "<h1>Error updating student</h1>";
            }
        }
        ?>
<?php
    }
} else {
    echo "<h1>Student ID not provided</h1>";
}
?>
<?php include('footer.php') ?>
