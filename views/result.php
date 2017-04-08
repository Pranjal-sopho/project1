<table class="tab">
     <tr>
		<th>College Name</th>
        <th>Address</th>
        <th>Facilities</th>
        <th>Reviews</th>        
     </tr> 

    <?php
    $length1 = sizeof($result);
    
    // print each college's details one by one
    $i=0;
    $j=0;
    while($length1--)
    {
        print("<tr>");
        print("<td>{$result[$i]["Name"]}</td>");
        print("<td>{$result[$i]["Address"]}</td>");
        print("<td>");
       
        while($result[$i]["Serial_number"] === $infra[$j]["college_id"])
            print("{$infra[$j++]["facilities"]} &emsp;");
        
        print("</td>");
        print("<td>{$result[$i++]["Reviews"]}</td>");
        print("</tr>");
    }
        
    ?>
</table>

   
    
