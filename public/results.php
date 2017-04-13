<?php

    // configuration
    require("../includes/helpers.php");
    
    // if ($_SERVER["REQUEST_METHOD"] == "GET")
     {
        // querying the infrastructure table for facilities of all colleges
        $infra = query("SELECT college_id,facilities FROM infrastructure ");
                
        // preparing query and selecting data from table college_info
        $result = query("SELECT * FROM college_info");
                
        // render(output) results
        render("result.php",["title" => "result","infra" => $infra,"result" => $result]);
     }
?>