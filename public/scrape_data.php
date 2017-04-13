<?php

    // configuration
    require("../includes/helpers.php"); 
       
    // get the q parameter 
    preg_match('/.*(?=\+)/',$_GET["city"],$city);
    preg_match('/(?<=\+).*/',$_GET["city"],$page);
         
    
    // convert city name  to lowercase 
        $city = strtolower($city);
            
    // initializing current page and number of pages
    
   // $pages = 1;
            
           
            // scrape data from each page
          //  while($pages--)
            {
                // next page
                //$page++;
                
                // scrape data from shiksha.com
                $string = @file_get_contents("http://www.shiksha.com/b-tech/colleges/b-tech-colleges-".urlencode($city)."-{$page}");
        
                if($string === false)
                    apologize("Please enter a valid city name");
                
                if($page === 1)
                {
                    // counting total number of pages
                    preg_match_all('/class=" linkpagination">/',$string,$result);
                    $GLOBALS["pages"] = sizeof($result[0]);
                }
                
                else $GLOBALS["pages"]--;
                
                

                // passing the string for scraping data  and storing in database
                get_college_info($string,$page);
                
               if($GLOBALS["pages"]=== 0)
                    print("bravo");
               // wait for 2s before next request
               sleep(2);
            } 
            

?>