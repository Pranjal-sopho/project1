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
            $bool = mysqli_real_query($link,$query);
            if($bool === false )
                echo "ERROR: Could not execute $query. " . mysqli_error($link);
            
            do
            {
                // use result
                 $rows1 = mysqli_use_result($link);
                 
                // fetching rows one at a time
                $row1 = mysqli_fetch_row($rows1);
                $id = $row1[0];
                
                // querying the infrastructure table for facilities of respective college
                $query2 = "SELECT facilities FROM infrastructure WHERE college_id = \"".$id."\"";
                $bool = mysqli_real_query($link,$query2);
                if(!$bool)
                    echo "ERROR: Could not execute $query2. " . mysqli_error($link);
                    
                // print each college's details one by one
                print("<tr>");
                print("<th>Serial_number: {$row1[0]}</th>");
                print("<th>Name: {$row1[1]}</th>");
                print("</tr>");
                print("<tr>Address {$row1[2]}</tr>");
                print("<tr>Reviews {$row1[3]}</tr>");
                
                // printing data from facilities table
                print("<tr>");
                while(true )
                {
                    $rows2 = mysqli_use_result($link);
                    if($rows2 == false)
                        break;
                    $row2 = mysqli_fetch_row($rows2);
                    print("<th>{row2[2]},<\th>");
                }
                print("<tr>");
                
                // freeing memory
                 mysqli_free_result($rows1);
            }while(mysqli_next_result($link))
        
            
       

    ?>
    </table>
   
    
</div>
   
    

</body>
</html>