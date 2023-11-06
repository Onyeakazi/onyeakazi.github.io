<?php 
    if(isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $checkBoxValue ) {
            $bulk_options = $_POST['bulk_options'];
            switch ($bulk_options) {
                case 'occupied':
                $query = "UPDATE our_lodges SET lodge_status = '{$bulk_options}' WHERE lodge_id = {$checkBoxValue} ";
                $check_box_update = mysqli_query($connection, $query);
                break;

                case 'available':
                $query = "UPDATE our_lodges SET lodge_status = '{$bulk_options}' WHERE lodge_id = {$checkBoxValue} ";
                $check_box_update = mysqli_query($connection, $query);
                break;

                case 'delete':
                $query = "DELETE FROM our_lodges WHERE lodge_id = {$checkBoxValue} ";
                $check_box_update = mysqli_query($connection, $query);
                break;
                
                default:
                # code...
                break;
            }
        }
    }
?>

    <form action="" method="post">
        <div id="bulkOptionContainer" class="col-xs-4" style=" padding:0px; margin-bottom:7px;">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Option</option>
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="delete">Delete</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="project.php?source=add_projects" class="btn btn-primary">Add New</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Project Name</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
            <?php 
                $query = "SELECT * FROM projects";
                $select_all_projects = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_projects)) {
                $project_id = $row['id'];
                $project_name = $row['project_name'];
                $project_image = $row['image'];
                $project_link = $row['link'];
                
                echo "<tr>";
            ?>

                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $lodge_id ?>'></td>;

                <?php

                echo "<td>$project_id</td>";
                echo "<td>$project_name</td>";
                echo "<td><img width='200' src='img/$project_image'></td>";
                echo "<td>$project_link</td>";
                echo "<td><a class='btn btn-success' href='project.php?source=edit_project&p_id={$project_id}'>Edit</a></td>";
                echo "<td><a class='btn btn-danger' href='project.php?delete={$project_id}'>Delete</a></td>";
                echo "</tr>";
                } ?>

            </tbody>
        </table>
    </form>

    <?php 
        if(isset($_GET['delete'])) {
            $project_id = $_GET['delete'];
            $query = "DELETE FROM projects WHERE id = $project_id";
            $delete_project = mysqli_query($connection, $query);
            header("Location: project.php");
        } 
    ?>