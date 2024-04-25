<?php include('header.php'); ?>
<?php include('connect.php') ?>

<form class="form-group" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    <label for="fname">Name</label>
    <input type="text" class="form-control" name="fname">

    <label for="fdob" style="display: block; margin-bottom: 10px;">
        Enter a date (YYYY-MM-DD):
    </label>
    <input type="date_create_from_format" name="fdob" id="fdob" class="form-control" pattern="\d{4}-\d{2}-\d{2}" required>

    <label for="fcomment">Comment</label>
    <textarea name="fcomment" class="form-control" id="" cols="30" rows="10"></textarea>

    <label for="gender-male">Male</label>
    <input checked type="checkbox" name="gender-male" id="">

    <label for="gender-female">Female</label>
    <input type="checkbox" name="gender-female" id="">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
$name = $text = '';
$gender_male =1;
$gender_female = 0;
$dob = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    // $password=$_POST['fpassword'];
    $text = $_POST['fcomment'];
    // $dob=$_POST['fdob'];
    if (!empty($_POST['fname'])) {
        # code...
        $name = $_POST['fname'];
    } else {
        # code...
        echo "<h1>Enter Name</h1>";
    }
    
    if (!empty($_POST['fdob'])) {
        # code...
        $dob = strtotime($_POST['fdob']);
        $dob=date("Y-m-d", $dob);
    } else {
        # code...
        echo "<h1>Enter date</>";
    }



    $checkarr = [
        'male' => isset($_POST['gender-male']),
        'female' => isset($_POST['gender-female']),
    ];

    $checkbox_count = 0;
    $selected_checkbox = '';

    foreach ($checkarr as $key => $value) {
        if ($value) {
            $checkbox_count++;
            $selected_checkbox = $key;
        }
    }

    if ($checkbox_count === 1) {
        // echo "Only one checkbox is selected: $selected_checkbox";
        if (!isset($_POST['gender-male'])) {
            # code...
            $gender_male = 0;
        } elseif (isset($_POST['gender-female'])) {
            $gender_female = 1;
        }
    } else {
        die("multipule selection");
    }
}



$q = $connection->prepare('INSERT INTO student (Name, Date_of_birth, Text, Gender_Male,Gender_Female) VALUES (?,?,?,?,?)');
$q->bind_param("sssss", $name,$dob, $text, $gender_male, $gender_female);
// $res=mysqli_query($connection, $q);
// $q->execute();
if ($q->execute()) {
    # code...
    echo "<h1>Student Added</>";
}

?>


<?php include('footer.php') ?>