<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table table-striped">

        <tbody>
            <?php
              
                $id = $_POST['eid'];
                
                $conn = mysqli_connect('localhost', 'root', '', 'asikislam') or die("Connection Fialed!");

                $updateData = "SELECT * FROM `info` WHERE Id = $id";

                $showQuery = mysqli_query($conn, $updateData);

                while($fetchData = mysqli_fetch_assoc($showQuery)){
            ?>
            <div class="update_header">
                <h1 class="mt-5">Update Aplication</h1>
            </div>
            <div class="container">
                <!-- Id input hidden -->
                <div class="form-outline">
                    <input type="hidden" name="id" id="edit_id" class="form-control"
                        value="<?php echo $fetchData['Id'];?>">
                </div>
                <!-- First Name input -->
                <div class="form-outline mt-4">
                    <label for="firstName" class="mb-2">First Name :</label>
                    <input type="text" id="edit_fname" value="<?php echo $fetchData['fname']; ?>"
                        class="form-control" />
                </div>

                <!-- Last Name input -->
                <div class="form-outline mt-4">
                    <label for="lastName" class="mb-2">Last Name :</label>
                    <input type="text" id="edit_lname" value="<?php echo $fetchData['lname']; ?>"
                        class="form-control" />
                </div>

                <!-- Submit button -->
                <div class="form-outline input_btn">
                    <button type="button" class="btn btn-primary btn-block m-4" id="update_btn">Update New</button>
                </div>
            </div>
            <?php
                } 
            ?>

        </tbody>
    </table>
</body>

</html>