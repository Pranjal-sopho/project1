<?php

    // configuration
    require("../includes/helpers.php"); 

    // if user reached page via a GET request
    if ($_SERVER["REQUEST_METHOD"] == "GET")
        render("form.php", ["title" => "Form"]);
    
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["city"]))
            apologize("You must provide a city name");
    
        else
        {
            // convert city name  to lowercase 
            $_POST["city"] = strtolower($_POST["city"]);
            
            // initializing current page and number of pages
            $page = 0;
            $pages = 1;
        
            // scrape data from each page
            while($pages--)
            {
                // next page
                $page++;
                
                // scrape data from shiksha.com
                $string = @file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($_POST["city"])."-{$page}");
        
                if($string === false)
                    apologize("Please enter a valid city name");
                
                if($page === 1)
                {
                    // counting total number of pages
                    preg_match_all('/class=" linkpagination">/',$string,$result);
                    $pages = sizeof($result[0]);
                }

                // passing the string for scraping data  and storing in database
                get_college_info($string,$page);
                
                // delay for 1s
                sleep(1);
            } 
            
            // attempting to connect to mysql server
            $link = mysqli_connect("127.0.0.1", "pranjal123321", "zrrJ8zNEdpuTwuty", "project1");
            
            // querying the infrastructure table for facilities of all colleges
            $query = "SELECT college_id,facilities FROM infrastructure ";
            $bool = mysqli_query($link,$query);
             
             if($bool === false )
                apologize("ERROR: Could not execute $query. " . mysqli_error($link));
            
            // fetching the retrieved data and storing it in array $infra
            $i =0;
            while($row = mysqli_fetch_array($bool,MYSQLI_ASSOC))
                $infra[$i++] = $row;
            
            // freeing memory
            mysqli_free_result($bool);
                
            // preparing query and selecting data from table college_info
            $query = "SELECT * FROM college_info";
            $bool = mysqli_query($link,$query);
            
            if($bool === false )
                 apologize("ERROR: Could not execute $query. " . mysqli_error($link));
             
            // storing the fetched data in $result  
            $i=0;   
            while($row = mysqli_fetch_array($bool,MYSQLI_ASSOC))
                $result[$i++] = $row;
            
            mysqli_free_result($bool);
            
            //close connection
            mysqli_close($link);

            // render(output) results
            render("result.php",["title" => "result","infra" => $infra,"result" => $result]);
        }
    }
?>