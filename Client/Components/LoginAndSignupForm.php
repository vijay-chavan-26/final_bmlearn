<?php 
    include_once(__DIR__.'\..\php\conn.php');
?>

<div id="login-form-page" class="py-5 position-relative">
    <div class="form-wrapper mx-auto form-wrapper-width bg-white py-5 px-3 px-md-5 shadow">
        <div class="heading">
            <h1 class="title">Welcome to BMLearn</h1>
            <p class="slogan text-muted">One step ahead, to advance your career.</p>
        </div>
        <div class="login-option mt-5 p-3 bg-eee mx-5 row">
            <button class="login-btn custom-btn py-2 border-0 col-6 bg-theme-color">Login</button>
            <button class="signup-btn custom-btn py-2 border-0 col-6">Sign Up</button>
        </div>

        <div class="forms mt-4">
            <div class="login-form-container">
                <form action="./php/LoginForm.php" autocomplete="off" class="login-form" method="post" onsubmit="return validateLoginSubmit()">

                    <!-- input for username or email -->
                    <label for="login-username" class="text-333 mb-1">Username or Email</label>
                    <div class="login-username input-box bg-eee w-100 d-flex align-items-center mb-3">
                        <label for="login-username"><i class="fa-solid fa-user fa-icons ms-3"></i></label> <input
                            class="inputs py-3 w-100 px-3 login-input" id="login-username"
                            placeholder="Enter your Email id " name="login-username" autocomplete="off" autocorrect="off" autofocus
                            spellcheck="flase" type="text" readonly onfocus="this.removeAttribute('readonly')">
                    </div>
                    <p class="err login-username-err"></p>

                    <!-- input for Password -->
                    <label for="login-password" class="text-333 mb-1">Passwrod</label>
                    <div class="login-password input-box bg-eee w-100 d-flex align-items-center mb-3">
                        <label for="login-password"><i class="fa-solid fa-lock fa-icons ms-3"></i></label> <input
                            class="inputs py-3 w-100 px-3 login-input" id="login-password" placeholder="Enter your password"
                            name="login-password" autocomplete="off" type="password" readonly
                            onfocus="this.removeAttribute('readonly')">
                        <div class="login-password-eyes-icons">
                            <i class="fa-solid fa-eye me-3 login-password-eye"></i>
                            <i class="fa-solid fa-eye-slash me-3 d-none login-password-eye-close"></i>
                        </div>
                    </div>
                    <p class="err login-password-err"></p>


                    <input type="submit" value="Login" name="login"
                        class=" mt-4 login-submit-btn text-white py-3 border w-100">

                </form>
            </div>
            <div class="signup-form-container d-none">
                <form action="./php/signupForm.php" autocomplete="off" class="signup-form" method="post" onsubmit="return validateSignupSubmit()">

                    <!-- input for username -->
                    <label for="username" class="text-333 mb-1">Username</label>
                    <div class="username input-box bg-eee w-100 d-flex align-items-center mb-3">
                        <label for="username"><i class="fa-solid fa-user fa-icons ms-3"></i></label> <input
                            class="inputs py-3 w-100 px-3" id="username" placeholder="Enter your username" name="username"
                            autocomplete="off" autocorrect="off" spellcheck="flase" readonly
                            onfocus="this.removeAttribute('readonly')" type="text">
                    </div>
                    <p class="err username-err"></p>

                    <!-- input for Email -->
                    <label for="email" class="text-333 mb-1">Email</label>
                    <div class="email input-box bg-eee w-100 d-flex align-items-center mb-3">
                        <label for="email"><i class="fa-solid fa-envelope fa-icons ms-3"></i></label> <input
                            class="inputs py-3 w-100 px-3" id="email" placeholder="Enter your Email id" name="email"
                            autocomplete="off" autocorrect="off" spellcheck="flase" readonly
                            onfocus="this.removeAttribute('readonly')" type="email">
                    </div>
                    <p class="err email-err"></p>

                    <!-- input for Course -->
                    <label for="course" class="text-333 mb-1">Course</label>
                    <div class="course input-box bg-eee w-100 d-flex align-items-center mb-3">
                        <select name="course" class="py-3 w-100 px-3 form-control" id="course">
                            <option disabled="disabled" selected="selected" value="0">Choose Course</option>
                            <?php 
                                $result = mysqli_query($conn, "SELECT * FROM `course` ORDER BY course");
                                while($row=mysqli_fetch_array($result)){
                                    echo "<option value=".$row['id'].">".$row['course']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <p class="err course-err"></p>

                    <!-- input for Password -->
                    <label for="password" class="text-333 mb-1">Passwrod</label>
                    <div class="password input-box bg-eee w-100 d-flex align-items-center mb-3">
                        <label for="password"><i class="fa-solid fa-lock fa-icons ms-3"></i></label> <input
                            class="inputs py-3 w-100 px-3" id="password" placeholder=" Enter your password" name="password"
                            autocomplete="off" autocorrect="off" spellcheck="flase" readonly
                            onfocus="this.removeAttribute('readonly')" type="password">
                        <div class="password-eyes-icons">
                            <i class="fa-solid fa-eye me-3 password-eye"></i>
                            <i class="fa-solid fa-eye-slash me-3 d-none password-eye-close"></i>
                        </div>
                    </div>
                    <p class="err password-err"></p>

                    <!-- input for Confirm Password -->
                    <label for="confirm-password" class="text-333 mb-1">Confirm Passwrod</label>
                    <div class="confirm-password input-box bg-eee w-100 d-flex align-items-center mb-3">
                        <label for="confirm-password"><i class="fa-solid fa-lock fa-icons ms-3"></i></label> <input
                            class="inputs py-3 w-100 px-3" id="confirm-password" placeholder="Enter confirm password"
                            name="confirm-password" autocomplete="off" autocorrect="off" spellcheck="flase" readonly
                            onfocus="this.removeAttribute('readonly')" type="password">
                        <div class="confirm-password-eyes-icons">
                            <i class="fa-solid fa-eye me-3 confirm-password-eye"></i>
                            <i class="fa-solid fa-eye-slash me-3 d-none confirm-password-eye-close"></i>
                        </div>
                    </div>
                    <p class="err confirm-password-err"></p>

                    <input type="submit" value="Sign Up" name="signup"
                        class=" mt-4 signup-submit-btn text-white py-3 border w-100">

                </form>
            </div>
        </div>
    </div>
<div id="preloader" class="d-none">
    <div class="img text-center">
        <img src="./img/preloader.gif" alt="preloader img">
        <h4 class="mt-3 fa-fade">Loading...</h4>
    </div>

</div>

</div>