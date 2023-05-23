// for login form

// for validating login form on submit
// loginPassword is initialized in LoginForm.js
const loginForm = document.querySelector(".login-form");
const loginUsername = document.getElementById("login-username");
const loginPassword = document.getElementById("login-password");
const loginUsernameError = document.querySelector(".login-username-err");
const loginPasswordError = document.querySelector(".login-password-err");

const otp = document.getElementById("otp");
const otpError = document.querySelector(".otp-err");

const validateOtpSubmit = () =>{
  let otpValue = otp.value.trim();
  const otpCheck = /^\d{5}$/;

  if (otpValue === "") {
    swal("oops!", "Please enter OTP!", "error");
    return false;
  } else if (!otpCheck.test(otpValue)) {
    swal("oops!", "invalid OTP, it must be 5 digits!", "error");
    return false;
  }

  document.querySelector('#preloader').classList.remove('d-none');
  document.querySelector('#preloader').classList.add('d-block');
  return true;
}

const submitResendOtpForm = () =>{
  document.querySelector('#preloader').classList.remove('d-none');
  document.querySelector('#preloader').classList.add('d-block');
  return true;
}

const validateLoginSubmit = () => {
  let loginUsernameValue = loginUsername.value.trim();
  const loginUsernameCheck = /^[\S+]{4,}$/;
  let loginPasswordValue = loginPassword.value.trim();
  const loginPasswordCheck = /^.{8,16}$/;

  if (loginUsernameValue === "") {
    swal("oops!", "username or email is required!", "error");
    return false;
  } else if (!loginUsernameCheck.test(loginUsernameValue)) {
    swal("oops!", "invalid username or email!", "error");
    return false;
  } else if (loginPasswordValue === "") {
    swal("oops!", "password is required!", "error");
    return false;
  } else if (!loginPasswordCheck.test(loginPasswordValue)) {
    swal("oops!", "invalid password length!", "error");
    return false;
  }

  document.querySelector('#preloader').classList.remove('d-none');
  document.querySelector('#preloader').classList.add('d-block');
  return true;
};

// for validating login username on blur
loginUsername.addEventListener("blur", () => {
  let loginUsernameValue = loginUsername.value.trim();
  const loginUsernameCheck = /^[\S+]{4,}$/;

  if (loginUsernameValue === "") {
    loginUsernameError.textContent = "**username is required";
  } else if (!loginUsernameCheck.test(loginUsernameValue)) {
    loginUsernameError.textContent = "**invalid username or email";
  }
});

// for validating login password on blur
loginPassword.addEventListener("blur", () => {
  let loginPasswordValue = loginPassword.value.trim();
  const loginPasswordCheck = /^.{8,16}$/;

  if (loginPasswordValue === "") {
    loginPasswordError.textContent = "**password is required";
  } else if (!loginPasswordCheck.test(loginPasswordValue)) {
    loginPasswordError.textContent = "**invalid password length";
  }
});

const FocusEvent = (input) => {
  input.addEventListener("focus", (e) => {
    console.log("focus");
    e.target.parentNode.nextElementSibling.textContent = "";
  });
};

FocusEvent(loginUsername);
FocusEvent(loginPassword);

// for validating login form on submit

const signupForm = document.querySelector(".signup-form");
const username = document.getElementById("username");
const usernameError = document.querySelector(".username-err");
const email = document.getElementById("email");
const emailError = document.querySelector(".email-err");
const password = document.getElementById("password");
const passwordError = document.querySelector(".password-err");
const confirmPassword = document.getElementById("confirm-password");
const confirmPasswordError = document.querySelector(".confirm-password-err");
const course = document.getElementById("course");
const courseError = document.querySelector(".course-err");
const gender = document.getElementById("gender");
const genderError = document.querySelector(".gender-err");


const validateSignupSubmit = () => {
  let usernameValue = username.value.trim();
  const usernameCheck = /^[a-zA-Z][a-zA-Z0-9_]{2,14}[a-zA-Z0-9]$/;
  let emailValue = email.value.trim();
  const emailCheck =
    /^(?!.*\.\.)[a-zA-Z0-9.]{3,}@[a-zA-Z0-9]+([.][a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/;
  let passwordValue = password.value.trim();
  const passwordCheck = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,16}$/;
  let confirmPasswordValue = confirmPassword.value.trim();

  // console.log(e.target)

  if (usernameValue === "") {
    swal("oops!", "username is required!", "error");
    return false;
  } else if (!usernameCheck.test(usernameValue)) {
    swal("oops!", "invalid username!", "error");
    return false;
  } else if (emailValue === "") {
    swal("oops!", "email is required!", "error");
    return false;
  } else if (!emailCheck.test(emailValue)) {
    swal("oops!", "invalid email!", "error");
    return false;
  } else if (course.value == 0) {
    courseError.textContent = "**please choose course";
    swal("oops!", "please choose course!", "error");
    return false;
  } else if (passwordValue === "") {
    swal("oops!", "password is required!", "error");
    return false;
  } else if (!passwordCheck.test(passwordValue)) {
    swal("oops!", "password is too weak!", "error");
    return false;
  } else if (confirmPasswordValue === "") {
    swal("oops!", "confirm password is required!", "error");
    return false;
  } else if (confirmPasswordValue !== passwordValue) {
    swal("oops!", "both passwords are not matching!", "error");
    return false;
  }

  document.querySelector('#preloader').classList.remove('d-none');
  document.querySelector('#preloader').classList.add('d-block');
 

  return true;
};

// for validating signup username on blur
username.addEventListener("blur", () => {
  let usernameValue = username.value.trim();
  const usernameCheck = /^[a-zA-Z][a-zA-Z0-9_]{2,14}[a-zA-Z0-9]$/;
  const startWithletters = /^[a-zA-Z][a-zA-Z0-9_]*$/;
  const usernameLength = /^.{4,16}$/;
  const restrictUsername = /^[a-zA-Z0-9_]+$/;
  const cantEndWithUderscore = /^\w+[a-zA-Z0-9]$/;

  if (usernameValue === "") {
    usernameError.textContent = "**username is required";
  } else if (!restrictUsername.test(usernameValue)) {
    usernameError.textContent =
      "**can contain letters, numbers, digits and underscore only";
  } else if (!startWithletters.test(usernameValue)) {
    usernameError.textContent = "**username must start with letters only";
  } else if (!usernameLength.test(usernameValue)) {
    usernameError.textContent = "**length must be between 4 to 16";
  } else if (!cantEndWithUderscore.test(usernameValue)) {
    usernameError.textContent = "**can't end with underscore";
  } else if (!usernameCheck.test(usernameValue)) {
    usernameError.textContent = "**invalid username";
  }
});

// for validating signup email on blur
email.addEventListener("blur", () => {
  let emailValue = email.value.trim();
  const emailCheck =
    /^(?!.*\.\.)[a-zA-Z0-9.]{3,}@[a-zA-Z0-9]+([.][a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/;

  if (emailValue === "") {
    emailError.textContent = "**email is required";
  } else if (!emailCheck.test(emailValue)) {
    emailError.textContent = "**invalid email";
  }
});

// for validating signup course

course.addEventListener("change", () => {
  courseError.textContent = "";
});


// for validating signup password on blur
password.addEventListener("blur", () => {
  console.log(password);
  let passwordValue = password.value.trim();
  const passwordCheck = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,16}$/;
  const atLeastOneUppercase = /^(?=.*[A-Z]).+$/;
  const atLeastOneLowercase = /^(?=.*[a-z]).+$/;
  const atLeastOneNumber = /^(?=.*[0-9]).+$/;
  const passwordLength = /^.{8,16}$/;

  if (passwordValue === "") {
    console.log(passwordError);
    passwordError.textContent = "**password is required";
  } else if (!atLeastOneUppercase.test(passwordValue)) {
    passwordError.textContent =
      "**password must have at least one uppercase letter";
  } else if (!atLeastOneLowercase.test(passwordValue)) {
    passwordError.textContent =
      "**password must have at least one lowercase letter";
  } else if (!atLeastOneNumber.test(passwordValue)) {
    passwordError.textContent = "**password must have at least one number";
  } else if (!passwordLength.test(passwordValue)) {
    passwordError.textContent = "**length must be between 8 to 16";
  } else if (!passwordCheck.test(passwordValue)) {
    passwordError.textContent = "**invalid password";
  }
});

// for validating signup confirm password on blur
confirmPassword.addEventListener("blur", () => {
  let confirmPasswordValue = confirmPassword.value.trim();
  let passwordValue = password.value.trim();
  if (confirmPasswordValue === "") {
    confirmPasswordError.textContent = "**password is required";
  } else if (confirmPasswordValue !== passwordValue) {
    confirmPasswordError.textContent = "**both passwords are not matching";
  }
});

FocusEvent(username);
FocusEvent(email);
FocusEvent(password);
FocusEvent(confirmPassword);

// for username
// ^[a-zA-Z][a-zA-Z0-9_]{2,14}[a-zA-Z0-9]$
// generate javascript regex for check username is greater that 4 letters and less than 16 letters and must start with letters only and it can contains small letters capital letters and numbers and underscore and must end with letters or numbers

// must start with letters //^[a-zA-Z][a-zA-Z0-9_]*$
// length should be between 4 ton 16 //^.{4,16}$
// can contain letters numbers and digits only //^[a-zA-Z0-9_]+$
// can't end with uderscrore // ^\w+[a-zA-Z0-9]$

// for password
// ^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,16}$
// password must contain one uppercase one lowecase and one digit and rest all special characters are allowed but not compulsion

// password must be between 8 to 16 // ^.{8,16}$
// password must have at least one uppercase // ^(?=.*[A-Z]).{8,16}$

// for email
// ^(?!.*\.\.)[a-zA-Z0-9.]{3,}@[a-zA-Z0-9]+([.][a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$
// at least 3 letter should be there before @ symbol
// can start with letters numbers and . symbol
// at least 3 letter should be there after @ symbol
// after . symbol at the end at least 2 letters should be there
// two . symbol in row are not allowed
// should not be end with . symbol
