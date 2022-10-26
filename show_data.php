<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">First Names</th>
            <th scope="col">Last Names</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
                  
                  $conn = mysqli_connect('localhost', 'root', '', 'asikislam') or die("Connection Fialed!");

                  $showData = "SELECT * FROM `info`";
    
                  $showQuery = mysqli_query($conn, $showData);
    
                  while($fetchData = mysqli_fetch_assoc($showQuery)){
        ?>
        <tr>
            <th scope="row"><?php echo $fetchData['Id']; ?> </th>
            <td><?php echo $fetchData['fname']; ?></td>
            <td><?php echo $fetchData['lname']; ?></td>
            <td>
                <button class="edit_btn btn btn-success btn-sm" data-eid="<?php echo $fetchData['Id']; ?>">Edit</button>
            </td>
            <td>
                <button class="delete_btn btn btn-danger btn-sm"
                    data-id="<?php echo $fetchData['Id']; ?>">Delete</button>
            </td>
        </tr>

        <?php
                  }
         ?>

    </tbody>
</table>