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
            
            $string = "<div>
                            <a href=\"courses_offered.php\">click here</a> 
                      </div>";
        
            foreach ($rows as $row)
            {
                // extracting infra facilities of each college
                $query = "\"SELECT * FROM infrastructure WHERE serial number = ?\",$row\[\"Serial_number\"\]";
                $infrastructure = mysql_query($link,$query);
                
                if($infrastructure === false)
                {
                    echo "ERROR: Could not execute $query. " . mysqli_error($link);
                }
                
                // print each college's details one by one
                    print("<tr>");
                    print("<th>Serial_number: {$row["Serial_number"]}</th>");
                    print("<th>Name: {$row["Name"]}</th>");
                    print("</tr>");
                    print("<tr>Address {$row["Address"]}</tr>");
                    print("<tr>Year of establishment {$row["Year of establishment"]}</tr>");
                    print("<tr>For courses offered,{$string} </tr>");
                    print("<tr>");
                    foreach( $infrastructure as $infra)
                    {
                        print("<td>,{$infra["facilities"]}, </td>");
                    }
                    print("</tr>");
                    
                    print("<tr>Website link: {$row["Website"]}</tr>");
            }
        
            
       

    ?>
    </table>
   
    
</div>
   
    

</body>
</html>