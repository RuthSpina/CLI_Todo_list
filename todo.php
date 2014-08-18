<?php

//array that holds list of things
$items = array();
$key = 1;
//this is the loop
do{
	//iterate through list items
	foreach($items as $key => $item) {
		$key++;
		//display each item and a new line
		echo "[{$key}] {$item}\n";
	}

	//show the menu options
	echo '(N)ew item, (R)emove item, (Q)uit : ';

	//get the input from user
	$input = trim(fgets(STDIN));

	//check from actionable input
	if ($input == 'N' || $input =='n') {
		//ask for entry
		echo 'Enter item: ';
		//add entry to list array
		$items [] = trim(fgets(STDIN));
	}elseif ($input == 'R'|| $input =='r') {
		//remove which item?
		echo 'Enter item number to remove: ';
	//get array key
	$key = trim(fgets(STDIN));
        // Remove from array
        unset($items[$key]);
    }
// Exit when input is (Q)uit
} while (($input != 'Q') && ($input != 'q'));

// Say Goodbye!
	echo "Goodbye!\n";

// Exit with 0 errors
exit(0);	
	
