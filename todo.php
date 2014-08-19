<?php

//Create array to hold list of todo items

$items = array();
//List array items formatted for CLI
 

 // Get STDIN, strip whitespace and newlines, 
 // and convert to uppercase if $upper is true
 function get_input($upper = FALSE) 
{

    if ($upper) {
    	//if $upper == TRUE is a given with an if statement.
          $input = strtoupper(trim(fgets(STDIN)));
    }  

	else{
    $input = trim(fgets(STDIN));
	}
        
    return $input;
}


function list_items($list)
{
    $list_string = '';
    //$num = 1;

    foreach ($list as $num => $value) {
        $num++;
        // offset $num to add one and start list at 1
        //$num = $num + 1;
        $list_string .= "[$num]  TODO item {$num} - $value" . PHP_EOL;

    }
    
    //$list_string = [$num]  "TODO item {$num} - " 

        return $list_string;
}


 // The loop!
 do {
     // Echo the list produced by the function
     echo list_items($items);

      // Show the menu options
     echo '(N)ew item, (R)emove item, (Q)uit : ';

         // Get the input from user
     // Use trim() to remove whitespace and newlines
     $input = get_input(TRUE);



     // Check for actionable input
if ($input == 'N') 
{
         // Ask for entry
         echo 'Enter item: ';
         // Add entry to list array
        $items[] = get_input();
	} 
elseif ($input == 'R') {
         // Remove which item?
         echo 'Enter item number to remove: ';
         // Get array key
         $key = get_input();
         // Remove from array
         unset($items[$key - 1]);
         
         $items = array_values($items);
	}
 	// Exit when input is (Q)uit
} while ($input != 'Q');
 

 	// Say Goodbye!
 	echo "Goodbye!\n";

 	// Exit with 0 errors
 exit(0);


 ?>	
	
