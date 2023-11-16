<?php  

# Form validation function
function is_empty($var, $text, $location, $ms) {
	if (empty($var)) {
		 # Error message
		 $em = "The ".$text." is required";
		 header("Location: $location?$ms=$em");
		 exit;
	}
	return 0;
 }
 