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
            apologize("You must provide a city name.");
    
        else
        {
            // initializing current page and number of pages
            $page = 0;
            $pages = 1;
        
            // convert city name  to lowercase
            $_POST["city"] = htmlspecialchars(strtolower($_POST["city"]));
            
            // scrape data from each page
            while($pages--)
            {
                // change page
                $page++;
                
                // scrape data from shikha.com
                $string = file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($_POST["city"])."-{$page}");
        
                if($string === false)
                    apologize("Please enter a valid city name");
                
                if($page == 1)
                {
                    // counting toal number of pages
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
            
             // querying the infrastructure table for facilities of respective college
            $query = "SELECT facilities FROM infrastructure WHERE college_id !=0";
            $bool = mysqli_query($link,$query);
             
             if($bool === false )
                die("ERROR: Could not execute $query. " . mysqli_error($link));
            
            $i =0;
            while($row = mysqli_fetch_array($bool,MYSQLI_ASSOC))
            {
                $infra[$i++] = $row;
            }
            
            // freeing memory
            mysqli_free_result($bool);
                
            // selecting data from mysql table
            $query = "SELECT * FROM college_info WHERE 1";
            $bool = mysqli_query($link,$query);
            
            if($bool === false )
                 die("ERROR: Could not execute $query. " . mysqli_error($link));
              
             $i=0;   
            while($row = mysqli_fetch_array($bool,MYSQLI_ASSOC))
                $result[$i++] = $row;
            
            mysqli_free_result($bool);
            
            //close connection
            mysqli_close($link);

            // render results
            render("result.php",["title" => "result","infra" => $infra,"result" => $result]);
        }
    }
?>