<?php
session_start();

	# Database Connection File
	include "config.php";

    # Validation helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";


    /** 
	  If all Input field
	  are filled
	**/
	if (isset($_POST['book_id'])          &&
        isset($_POST['book_title'])       &&
        isset($_POST['book_description']) &&
        isset($_POST['book_author'])      &&
        isset($_POST['book_category'])    &&
        isset($_FILES['book_cover'])      &&
        isset($_FILES['file'])            &&
        isset($_POST['current_cover'])    &&
        isset($_POST['current_file'])) {

		/** 
		Get data from POST request 
		and store them in var
		**/
		$id          = $_POST['book_id'];
		$title       = $_POST['book_title'];
		$description = $_POST['book_description'];
		$author      = $_POST['book_author'];
		$category    = $_POST['book_category'];
        
         /** 
	      Get current cover & current file 
	      from POST request and store them in var
	    **/

        $current_cover = $_POST['current_cover'];
        $current_file  = $_POST['current_file'];

        #simple form Validation
        $text = "Book title";
        $location = "admin/edit_book.php";
        $ms = "id=$id&error";
		is_empty($title, $text, $location, $ms, "");

		$text = "Book description";
        $location = "admin/edit_book.php";
        $ms = "id=$id&error";
		is_empty($description, $text, $location, $ms, "");

		$text = "Book author";
        $location = "admin/edit_book.php";
        $ms = "id=$id&error";
		is_empty($author, $text, $location, $ms, "");

		$text = "Book category";
        $location = "admin/edit_book.php";
        $ms = "id=$id&error";
		is_empty($category, $text, $location, $ms, "");

        /**
          if the admin try to 
          update the book cover
        **/
          if (!empty($_FILES['book_cover']['name'])) {
          	  /**
		          if the admin try to 
		          update both 
		      **/
		      if (!empty($_FILES['file']['name'])) {
		      	# update both here

		      	# book cover Uploading
		        $allowed_image_exs = array("jpg", "jpeg", "png");
		        $path = "cover";
		        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

		        # book cover Uploading
		        $allowed_file_exs = array("pdf", "docx", "pptx");
		        $path = "files";
		        $file = upload_file($_FILES['file'], $allowed_file_exs, $path);
                
                /**
				    If error occurred while 
				    uploading
				**/
		        if ($book_cover['status'] == "error" || 
		            $file['status'] == "error") {

			    	$em = $book_cover['data'];

			    	/**
			    	  Redirect to '../edit-book.php' 
			    	  and passing error message & the id
			    	**/
			    	header("Location: admin/edit_book.php?error=$em&id=$id");
			    	exit;
			    }else {
                  # current book cover path
			      $c_p_book_cover = "uploads/cover/$current_cover";

			      # current file path
			      $c_p_file = "uploads/files/$current_file";

			      # Delete from the server
			      unlink($c_p_book_cover);
			      unlink($c_p_file);

			      /**
		              Getting the new file name 
		              and the new book cover name 
		          **/
		           $file_URL = $file['data'];
		           $book_cover_URL = $book_cover['data'];

		            # update just the data
		          	$sql = "UPDATE books
        SET title=?, author_id=?, description=?, category_id=?, cover=?, file=?
        WHERE id=?";
        $stmt = $conn->prepare($sql);
    
        // Bind parameters
        $stmt->bind_param("ssssssi", $title, $author, $description, $category, $book_cover_URL, $file_URL, $id);
    
        // Execute the statement
        $res = $stmt->execute();
				    /**
				      If there is no error while 
				      updating the data
				    **/
				     if ($res) {
				     	# success message
				     	$sm = "Successfully updated!";
						header("Location: admin/edit_book.php?success=$sm&id=$id");
			            exit;
				     }else{
				     	# Error message
				     	$em = "Unknown Error Occurred!";
						header("Location: admin/edit_book.php?error=$em&id=$id");
			            exit;
				     }


			    }
		      }else {
		      	# update just the book cover

		      	# book cover Uploading
		        $allowed_image_exs = array("jpg", "jpeg", "png");
		        $path = "cover";
		        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);
                
                /**
				    If error occurred while 
				    uploading
				**/
		        if ($book_cover['status'] == "error") {

			    	$em = $book_cover['data'];

			    	/**
			    	  Redirect to 'admin/edit_book.php' 
			    	  and passing error message & the id
			    	**/
			    	header("Location: admin/edit_book.php?error=$em&id=$id");
			    	exit;
			    }else {
                  # current book cover path
			      $c_p_book_cover = "uploads/cover/$current_cover";

			      # Delete from the server
			      unlink($c_p_book_cover);

			      /**
		              Getting the new file name 
		              and the new book cover name 
		          **/
		           $book_cover_URL = $book_cover['data'];

		            # update just the data
					$sql = "UPDATE books
					SET title=?, author_id=?, description=?, category_id=?, cover=?, file=?
					WHERE id=?";
					$stmt = $conn->prepare($sql);
				
					// Bind parameters
					$stmt->bind_param("ssssssi", $title, $author, $description, $category, $book_cover_URL, $file_URL, $id);
				
					// Execute the statement
					$res = $stmt->execute();

				    /**
				      If there is no error while 
				      updating the data
				    **/
				     if ($res) {
				     	# success message
				     	$sm = "Successfully updated!";
						header("Location: admin/edit_book.php?success=$sm&id=$id");
			            exit;
				     }else{
				     	# Error message
				     	$em = "Unknown Error Occurred!";
						header("Location: admin/edit_book.php?error=$em&id=$id");
			            exit;
				     }


			    }
		      }
          }
          /**
          if the admin try to 
          update just the file

          **/
          else if(!empty($_FILES['file']['name'])){
          	# update just the file
            
            # book cover Uploading
	        $allowed_file_exs = array("pdf", "docx", "pptx");
	        $path = "files";
	        $file = upload_file($_FILES['file'], $allowed_file_exs, $path);
            
            /**
			    If error occurred while 
			    uploading
			**/
	        if ($file['status'] == "error") {

		    	$em = $file['data'];

		    	/**
		    	  Redirect to 'admin/edit_book.php' 
		    	  and passing error message & the id
		    	**/
		    	header("Location: admin/edit_book.php?error=$em&id=$id");
		    	exit;
		    }else {
              # current book cover path
		      $c_p_file = "uploads/files/$current_file";

		      # Delete from the server
		      unlink($c_p_file);

		      /**
	              Getting the new file name 
	              and the new file name 
	          **/
	           $file_URL = $file['data'];

	            # update just the data
				$sql = "UPDATE books
				SET title=?, author_id=?, description=?, category_id=?, cover=?, file=?
				WHERE id=?";
				$stmt = $conn->prepare($sql);
			
				// Bind parameters
				$stmt->bind_param("ssssssi", $title, $author, $description, $category, $book_cover_URL, $file_URL, $id);
			
				// Execute the statement
				$res = $stmt->execute();

			    /**
			      If there is no error while 
			      updating the data
			    **/
			     if ($res) {
			     	# success message
			     	$sm = "Successfully updated!";
					header("Location: admin/edit_book.php?success=$sm&id=$id");
		            exit;
			     }else{
			     	# Error message
			     	$em = "Unknown Error Occurred!";
					header("Location: admin/edit_book.php?error=$em&id=$id");
		            exit;
			     }


		    }
	      
          }else {
          	# update just the data
          	$sql = "UPDATE books
        SET title=?, author_id=?, description=?, category_id=?, cover=?, file=?
        WHERE id=?";
        $stmt = $conn->prepare($sql);
    
        // Bind parameters
        $stmt->bind_param("ssssssi", $title, $author, $description, $category, $book_cover_URL, $file_URL, $id);
    
        // Execute the statement
        $res = $stmt->execute();

		    /**
		      If there is no error while 
		      updating the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully updated!";
				header("Location: admin/edit_book.php?success=$sm&id=$id");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: admin/edit_book.php?error=$em&id=$id");
	            exit;
		     }
          } 
	}else {
      header("Location: admin/index.php");
      exit;
	}
?>