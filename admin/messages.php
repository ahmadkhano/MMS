<?php
include '../components/connect.php';

// Check if the delete parameter is set
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Prepare and execute delete query using PDO
    $delete_student = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
    if ($delete_student->execute([$delete_id])) {
        header('Location:messages.php');
        exit();
    } else {
        echo "<script>alert('Failed to delete message.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Messages</title>
</head>
<body id="page-top">
   <!-- Header Page Starts Here -->
   <?php include '../components/admin_header.php'; ?>
   <!-- Header Page End Here -->

   <!-- Users Message -->
   <div class="card shadow m-4">
      <h6 class="font-weight-bold text-center text-uppercase h6 mt-4">
         Customer Messages
      </h6>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Email Address</th>
                     <th>Phone</th>
                     <th>Message</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     // Assuming you have a database connection in $conn
                     $select_message = $conn->prepare("SELECT * FROM messages");
                     $select_message->execute();
                     // Check if the query was successful
                     if($select_message->rowCount() > 0) {
                           while($row = $select_message->fetch(PDO::FETCH_ASSOC)) {
                              echo "<tr>";                                 
                                 echo "<td>{$row['name']}</td>";
                                 echo "<td>{$row['email']}</td>";
                                 echo "<td>{$row['phone']}</td>";
                                 echo "<td>{$row['message']}</td>";
                                 echo "<td>
                                          <a href='messages.php?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Do You Want To Delete This Message?\");'>Delete</a>
                                    </td>";
                              echo "</tr>";
                           }
                     } else {
                           echo "<tr><td colspan='17' class='text-center'>No data found</td></tr>";
                     }
                  ?>
               </tbody>
               <tfoot>
                  <tr>
                     <th>Name</th>
                     <th>Email Address</th>
                     <th>Phone</th>
                     <th>Message</th>
                     <th>Action</th>
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
   </div>
   <!-- Users Message -->

   <!-- Footer Page Starts Here -->
   <?php include '../components/admin_footer.php'; ?>
</body>
</html>