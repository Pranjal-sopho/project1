<table class="tab">
     <tr>
		<th>College Name</th>
        <th>Address</th>
        <th>Facilities</th>
        <th>Reviews</th>        
     </tr> 

    <?php
    $length1 = sizeof($result);
     $length2 = sizeof($infra);  
    // print each college's details one by one
    $i=0;
    $j=0;
    while($length1--)
    {
        print("<tr>");
        print("<td>{$result[$i]["Name"]}</td>");
        print("<td>{$result[$i]["Address"]}</td>");
        print("<td>");
       
       while($length2--)
        {
            print("{$infra[$j++]["facilities"]} &emsp;");
            if($infra[$j]["facilities"] === "Library")
            break;
        }
        
        print("</td>");
        print("<td>{$result[$i++]["Reviews"]}</td>");
        print("</tr>");
    }
        
    ?>
</table>
   
    
