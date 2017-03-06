<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title ?></title>
</head>
<body>
    <div>
       <table>
        <?php
            
            // querying database
            $bool = mysqli_query($link,$query);
            if($bool === false )
                 die("ERROR: Could not execute $query. " . mysqli_error($link));
            
            while($row1 = mysqli_fetch_array($bool))
            {
                // use result
                //$rows1 = mysqli_use_result($link);
                 
                // fetching rows one at a time
              //  $row1 = mysqli_fetch_row($rows1);
                $id = $row1[0];
                
                
                    
                // print each college's details one by one
               // print("<tr>");
                print("<tr><th>{htmlspecialchars($row1[0]}:</th></tr>");
                print("<tr><th> {$row1[1]}</th></tr>");
            //    print("</tr>");
                print("<tr>Address: {$row1[2]}</tr>");
                print("<tr>Reviews {$row1[3]}</tr>");
                
                // freeing memory
                
                
                // querying the infrastructure table for facilities of respective college
              /*  $query2 = "SELECT facilities FROM infrastructure WHERE college_id = \"".$id."\"";
                $bool = mysqli_real_query($link,$query2);
                if(!$bool)
                    echo "ERROR: Could not execute $query2. " . mysqli_error($link);
                    
                // printing data from facilities table
                print("<tr>");
                do
                {
                    $rows2 = mysqli_use_result($link);
                    
                    if($rows2 == false)
                        break;
                    
                    $row2 = mysqli_fetch_row($rows2);
                    print("<th>{row2[2]},<\th>");
                    
                }while(mysqli_next_result($link))
                
                print("<tr>");*/
            }
        
            
       

    ?>
    </table>
   
    
</div>
   
    

</body>
</html>