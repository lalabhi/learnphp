<?php 
namespace Page;
class Templates{

    function createtable($result){
        echo"<br> <br> <br>";
        echo'<div class="container">';
        echo '<table  class="table table-striped">';
        
        echo "<tr> <th>u_id</th> <th>Name</th> <th>Email</th> <th>Phoneno</th> <th>active</th> <th>roles</th> <th>Update</th></tr>";
        while($row = mysqli_fetch_array( $result )) {
        
        
        
            // echo out the contents of each row into a table
            
            echo "<tr>";
            
            echo '<td>' . $row['u_id'] . '</td>';
            
            echo '<td>' . $row['fname'] . '</td>';
            
            echo '<td>' . $row['email'] . '</td>';
        
            echo '<td>' . $row['phoneno'] . '</td>';
        
            echo '<td>'.$row['active']. '</td>';
        
            echo '<td>' . $row['roles'] . '</td>';
            
            echo '<td><a href="edit.php?u_id=' . $row['u_id']. '">Edit</a></td>';//creating the link to edit each and every user
            
            echo "</tr>";
            
            }
            
            
            
            // close table>
            
            echo "</table>";
            echo "</div>";
        }
}