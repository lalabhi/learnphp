<html>
   
   <head>
      <title>Paging Using PHP</title>
   </head>
   
   <body>
      <?php
      error_reporting(E_ALL); ini_set('display_errors', 1);

         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = 'root';
         $db='loginapp';
         $rec_limit = 3;
         $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
         
         if(! $conn ) {
            die('Could not connect: ' . mysql_error());
         }
         //mysqli_select_db('loginapp');
         
         /* Get total number of records */
         $sql = "SELECT count(u_id) FROM details ";
         $retval = mysqli_query(  $conn,$sql );
         
         if(! $retval ) {
            die('Could not get data: ' . mysqli_error());
         }
         $row = mysqli_fetch_array($retval, MYSQL_NUM );
         $rec_count = $row[0];
         
         if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }
         
         $left_rec = $rec_count - ($page * $rec_limit);
         $sql = "SELECT * ". 
            "FROM details ".
            "LIMIT $offset, $rec_limit";
            
         $retval = mysqli_query(  $conn,$sql );
         
         if(! $retval ) {
            die('Could not get data: ' . mysqli_error());
         }
         
         while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
            echo "U ID :{$row['u_id']}  <br> ".
               "first NAME : {$row['fname']} <br> ".
               "Email : {$row['email']} <br> ".
               "Phoneno: {$row['phoneno']}<br>".
               "--------------------------------<br>";
         }
         
         if( $page > 0 ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page = $last\">Last 10 Records</a> |";
            echo "<a href = \"$_PHP_SELF?page = $page\">Next 10 Records</a>";
         }else if( $page == 0 ) {
            echo "<a href = \"$_PHP_SELF?page = $page\">Next 10 Records</a>";
         }else if( $left_rec < $rec_limit ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page = $last\">Last 10 Records</a>";
         }
         
         mysqli_close($conn);
      ?>
      
   </body>
</html>