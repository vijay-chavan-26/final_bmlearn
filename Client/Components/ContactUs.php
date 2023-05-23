
<?php
if(isset($_POST["submit"])){
	 $uname=$_POST["uname"];
	 $uemail=$_POST["uemail"];
   $unum=$_POST["unum"];
	 $umessage=$_POST["umessage"];
	 
	 $uname=strip_tags($uname);
	 $uemail=strip_tags($uemail);
   $unum=strip_tags($unum);
	 $umessage=strip_tags($umessage);
	 
	 include("./php/conn.php");
	 
	 echo"<br><br>";
	 $db_entry="INSERT into feedback(name,email,num,message)VALUES('$uname','$uemail','$unum','$umessage')";
	 if(mysqli_query($conn,$db_entry)){

        $_SESSION['status_message'] = 'Your Response has been successfully submitted!';
        $_SESSION['status_reaction'] = 'Wow!';
        $_SESSION['status'] = 'success';
        header("Location: contact.php");
        exit(0);
	 } else { 
		 echo mysqli_error($connection);
         $_SESSION['status_message'] = "Couldn't Submit Response, please try again!";
         $_SESSION['status_reaction'] = 'Oops!';
         $_SESSION['status'] = 'error';
         header("Location: contact.php");
         exit(0);
     }
} 

?>

  <div class="content">
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          

          <div class="row justify-content-center">
            <div class="col-md-6">
              
              <h3 class="contact-heading mb-4">Let's talk about everything!</h3>
              <p>Great to know about your interest in our web-application. We are certainly very excited to talk to you!!</p>

              <p><img src="./img/undraw-contact.svg" alt="Image" class="img-fluid"></p>


            </div>
            <div class="col-md-6">
              
              <form class="mb-5" method="post" id="contactForm" name="contactForm" action="Contact.php">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="uname" id="uname" placeholder="Your name"><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="uemail" id="uemail" placeholder="Email"><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="unum" id="unum" placeholder="Number">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group"><br>
                  <p>We would also like to know about your experience.. Please enter the feedback!!</p>
                    <textarea class="form-control" name="umessage" id="umessage" cols="30" rows="5" placeholder="Write your message"></textarea>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-12"><br>
                    <input type="submit" value="Send Message" class="btn btn-primary rounded-0 py-2 px-4" name="submit">
                  <span class="submitting"></span>
                  </div>
                </div>
              </form>

            
          </div>
        </div>
      </div>
    </div>

  </div>
