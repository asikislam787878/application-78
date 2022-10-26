<table class="table table-striped">
    <tbody>
        <?php
                 $search = $_POST['search'];
                  
                  $conn = mysqli_connect('localhost', 'root', '', 'asikislam') or die("Connection Fialed!");

                  $showData = "SELECT * FROM `info` WHERE Id LIKE '%{$search}%' OR fname LIKE '%{$search}%' OR lname LIKE '%{$search}%'";
    
                  $showQuery = mysqli_query($conn, $showData);
    
                  while($fetchData = mysqli_fetch_assoc($showQuery)){
        ?>
        <tr>
            <th scope="row"><?php echo $fetchData['Id']; ?> </th>
            <td><?php echo $fetchData['fname']; ?></td>
            <td><?php echo $fetchData['lname']; ?></td>
        </tr>

        <?php
                  }
         ?>

    </tbody>
</table>