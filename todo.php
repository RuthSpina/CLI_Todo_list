<?php



$items = array();
//open array to accomodate the items added/removed.
 


function get_input($upper = FALSE) 
 // Get STDIN (end user input) strip whitespace and newlines, 
 // and convert to uppercase if $upper is true
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

foreach($list as $num => $value) {
        $num++;
        // offset $num to add one and start list at 1
        //$num = $num + 1;
        $list_string .= "[$num]  TODO item {$num} - $value" . PHP_EOL;

    }
    
    //$list_string = [$num]  "TODO item {$num} - " 

        return $list_string;
}


function srt_type($input, $items){
    switch ($input) {
        case 'a':
            asort($items);
            break;

        case 'z':
            arsort($items);
            break; 

        case 'o':
            ksort($items);
            break;

        case 'r':
            krsort($items);
            break;  
    }
    return $items;
    //this returns the newly sorted $items according to the type chosen.
  }  

  function beg_end($items){
        // Ask for entry
        echo 'Would you like to add to the (B)eginning or (E)nd of the list? ';
         
        $input = get_input(TRUE);

        if($input == 'B'){
            echo 'Enter item: ';
            array_unshift($items, get_input());

        }else{
            echo 'Enter item: ';
            array_push($items, get_input());
        }

        return $items;
  }

  


function update_file($file_input, $items){
    var_dump($file_input);
    $handle = fopen($file_input, 'r');
    $content = trim(fread($handle, filesize($file_input)));
    fclose($handle); 
    $new_list = explode("\n", $content);
    $items = array_merge($new_list, $items);
    
    return $items;
}  

function save_input($file_path, $items){
    $file_save = file_exists($file_path);
    if($file_save) {
        echo "Type (Y) to confirm save or (X) to return to list" . PHP_EOL;
        $input = strtoupper(trim(fgets(STDIN)));
        if($input == 'X') {
             return;
        }
    } else {
        $handle = fopen($file_path, 'w');
        $items = implode("\n", $items);
        fwrite($handle, $items);  
        echo "FILE NOT FOUND, but was created and saved!" . PHP_EOL . PHP_EOL;
  
    }
    }     

            
   

/////// The loop!/////
 do {
     // Echo the list produced by the function
     echo list_items($items). PHP_EOL;  

      // Show the menu options
     echo '(N)ew item, (R)emove item, (Q)uit, (S)ort, (O)pen, s(A)ve : ';

         // Get the input from user
     // Use trim() to remove whitespace and newlines
     $input = get_input(TRUE);

switch ($input){
    case 'A':
      echo "Enter filepath: " . PHP_EOL;
      $file_path = get_input();
      save_input($file_path, $items);
      break;


    case 'O':
      echo "Enter filepath: " . PHP_EOL;
        $file_input = get_input();
        $items = update_file($file_input, $items);
        break;


    case 'N':

        $items = beg_end($items);
         // Add entry to list array
        break;
        
    case 'S':

         echo '(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: '; 
          //get sort type
          $input = get_input();

          //call in $items (this is the array) and $input (the sort type chosen) into sort function
          $items = srt_type($input,$items);
          //make it equal to $items - this now redefines $items as the newly sorted array.
          $items = array_values($items);
          //this ensures that numbering of items on list is numeric.
    break;

    case 'F':

        array_shift($items);
        //print_r($items);
    break;


   case 'L':
   
        array_pop($items);
        //print_r($items);
    break;

        
    case 'R':
         // Remove which item?
         echo 'Enter item number to remove: ';
         // Get array key
         $key = get_input();
         // Remove from array
         unset($items[$key - 1]);
         
         $items = array_values($items);
	break;
}

 	// Exit when input is (Q)uit
} while ($input != 'Q');

 

 	// Say Goodbye
 	echo "Goodbye!\n";

 	// Exit with 0 errors
 exit(0);


 ?>	
	
