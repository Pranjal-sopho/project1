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
            $bool1 = mysqli_real_query($link,$query);
            if($bool1 === false )
                echo "ERROR: Could not execute $query. " . mysqli_error($link);
            
            do
            {
                 $rows1 = mysqli_use_result($link);
                 
                // fetching rows one at a time
                $row1 = mysqli_fetch_row($rows1);
                $id = $row1[0];
                
                // querying the infrastructure table for facilities of respective college
                $query2 = "SELECT facilities FROM infrastructure WHERE college_id = $id";
                $bool = mysqli_real_query($link,$query2);
                if(!$bool)
                    echo "ERROR: Could not execute $query2. " . mysqli_error($link);
                    
                $rows = mysqli_use_result($link);
                $row = mysqli_fetch_row($rows);
                
                // print each college's details one by one
                print("<tr>");
                print("<th>Serial_number: {$row1[0]}</th>");
                print("<th>Name: {$row1[1]}</th>");
                print("</tr>");
                print("<tr>Address {$row1["2"]}</tr>");
                print("<tr>Reviews {$row1[3]}</tr>");
                
                    print("<tr>");
                    while(mysqli_next_result($link))
                    {
                        print("<td>,{$row[1]}, </td>");
                    }
                    print("</tr>");
            }while(mysqli_next_result($link))
        
            
       

    ?>
    </table>
   
    
</div>
   
    

</body>
</html>