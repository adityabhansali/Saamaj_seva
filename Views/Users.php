<?php
require_once('../config.php');
require_once('header.php');
?>

<h2>User List</h2>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Country</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "ajax": {
            "url": "<?php echo Controllers; ?>users-data.php",
            "dataSrc": ""
        },
        "columns": [
            {"data": "fname"},
            {"data": "lname"},
            {"data": "email"},
            {"data": "phone"},
            {"data": "dob"},
            {"data": "gender"},
            {"data": "country"},
            {
                "data": null,
                "render": function(data, type, row) {
                    return '<a href="User-edit.php?userid=' + data.id + '">Edit</a>';
                }
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return '<a href="javascript:void(0)" onclick="confirmDelete(' + data.id + ')">Delete</a>';
                }
            }
        ]
    });
});
function confirmDelete(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        deleteUser(userId);
    }
}
function deleteUser(userId){
    $.ajax({
        url: "<?php echo Controllers; ?>users-delete.php",
        type: 'POST',
        data: { id: userId },
        success: function(response) {
            // Refresh DataTable after successful deletion
            $('#example').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error
        }
    });
}
</script>
<?php 
require_once('footer.php');
?>