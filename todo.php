<?php



$items = array();

function get_input($upper = FALSE) {
    if ($upper) {
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
        $list_string .= "[$num]  TODO item {$num} - $value" . PHP_EOL;

    }
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

 do {
     // Echo the list produced by the function
     echo list_items($items). PHP_EOL;  

      // Show the menu options
     echo '(N)ew item, (R)emove item, (Q)uit, (S)ort, (O)pen, s(A)ve : ';

         // Get the input from user
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
         // Adds entry to list array
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
    break;

    case 'R':
         echo 'Enter item number to remove: ';
         $key = get_input();
         unset($items[$key - 1]);
         $items = array_values($items);
	break;
}

} while ($input != 'Q');

 	echo "Goodbye!\n";

 exit(0);


 ?>
