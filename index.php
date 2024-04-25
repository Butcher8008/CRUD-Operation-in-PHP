<?php include('header.php') ?>
<?php include('connect.php') ?>
<div id="container">
    <h2 >Students</h2>
    <button type="button" id="addButton" ><a href="insert.php">ADD</a></button>
</div>
<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <td>id</td>
            <td>Name</td>
            <!-- <td>Password</td> -->
            <td>Date Of Birth</td>
            <td>Comment</td>
            <td>Gender</td>
            <td>Update</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM student";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            # code...
            die("Sorry result not found " . mysqli_error($connection));
        } else {
            # code...
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['Name']?></td>
                    <td><?php echo $row['Date_Of_Birth']?></td>
                    <td><?php echo $row['Text']?></td>
                    <td><?php echo $row['Gender_Male']?></td>
                    <td><button type="button" id="addButton"><a href="Update.php?id=<?php echo $row['id']?>">Update</a></button></td>
                    <td><button type="button" id="addButton"><a href="delete.php?id=<?php echo $row['id']?>">Delete</a></button></td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>
<?php include('footer.php') ?>