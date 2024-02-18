<?php

/**
 * Returns users list.
 * @param object DB connection object.
 * @return array Users.
 */
function getUsers($conn)
{
    $users = [];
    $selectSQL = "SELECT
            `admin_id`,
            `name`,
            `email`,
            `status`
        FROM `admin`
        ORDER BY `name` ASC";
    $result = mysqli_query($conn, $selectSQL);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $users[] = $row;
    }

    return $users;
}

require_once("header.php");
require_once("sidebar.php");
require_once("widget.php");
?>

<!-- Modal content-->
<div class="modal-content ">
    <div class="modal-header">
        <h4 class="modal-title"> <i class="fa  fa-dropbox fa-5" aria-hidden="true"></i>
            All Store Admin
        </h4>
    </div>
    <div class="modal-body">
        <a href="add-storeadmin.php">
            <button class="btn btn-primary" class="pull-left">
                <i class="fa fa-plus-circle fa-6" aria-hidden="true"></i> Add Store Admin
            </button>
        </a>
        <hr>
        <script language="JavaScript" type="text/javascript">
            function checkDelete(){
                return confirm('Are you sure you want to delete?');
            }
        </script>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="employee_data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $users = getUsers($conn);

                                    foreach ($users as $user) {
                                        $name = "{$user["name"]}";
                                        $status = ($user["status"]) ? "Active" : "Deactivated";
                                        echo "<tr>
                                                <td>$name</td>
                                                <td>{$user["email"]}</td>
                                                <td>{$status}</td>
                                                <td>
                                                    <a href='view-storeadmin.php?id={$user["admin_id"]}'>
                                                        <button class='btn btn-primary'>
                                                            View <i class='fa fa-eye' aria-hidden='true'></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href='edit-storeadmin.php?id={$user["admin_id"]}'>
                                                        <button class='btn btn-primary btn-success'>
                                                            <i class='fa fa-pencil' aria-hidden='true'></i>
                                                        </button>
                                                    </a>
                                                    <a href='delete-storeadmin.php?id={$user["admin_id"]}' class='btn btn-social-icon btn-google' onClick='return checkDelete()'>
                                                        <i class='fa fa fa-trash-o'></i>
                                                    </a>
                                                </td>
                                            </tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#employee_data').DataTable({
        "scrollX"       : true,
        "pagingType"    : "numbers",
        "processing"    : true,
        "searching"     : true,
        "ordering"      : true,
        "info"          : true,
        "autoWidth"     : false
    });
});
</script>
<?php require_once("scriptfooter.php"); ?>