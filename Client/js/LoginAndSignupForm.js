const loginBtn = document.querySelector(".login-btn");
const signupBtn = document.querySelector(".signup-btn");
const loginFormContainer = document.querySelector(".login-form-container");
const signupFormContainer = document.querySelector(".signup-form-container");

const loginOption = document.querySelector(".login-option");

// for changing forms as per the click on login and signup

loginOption.addEventListener("click", (e) => {
  if (e.target === signupBtn) {
    console.log("clicked signup");
    loginFormContainer.classList.remove("d-block");
    loginFormContainer.classList.add("d-none");
    signupFormContainer.classList.remove("d-none");
    signupFormContainer.classList.remove("d-block");
    loginBtn.classList.remove("bg-theme-color");
    signupBtn.classList.add("bg-theme-color");
  } else if (e.target === loginBtn) {
    console.log("clicked login");
    signupFormContainer.classList.remove("d-block");
    signupFormContainer.classList.add("d-none");
    loginFormContainer.classList.remove("d-none");
    loginFormContainer.classList.remove("d-block");
    signupBtn.classList.remove("bg-theme-color");
    loginBtn.classList.add("bg-theme-color");
  }
});

// for toggling password hide show functionality

// eyes icons
const loginPasswordEye = document.querySelector(".login-password-eye");
const loginPasswordEyeClose = document.querySelector(
  ".login-password-eye-close"
);
const passwordEye = document.querySelector(".password-eye");
const passwordEyeClose = document.querySelector(".password-eye-close");
const confirmPasswordEye = document.querySelector(".confirm-password-eye");
const confirmPasswordEyeClose = document.querySelector(
  ".confirm-password-eye-close"
);


// icons parent div
const loginPasswordEyesIcons = document.querySelector(
  ".login-password-eyes-icons"
);
const passwordEyesIcons = document.querySelector(".password-eyes-icons");
const confirmPasswordEyesIcons = document.querySelector(
  ".confirm-password-eyes-icons"
);

const toggleEye = (e, passwordEye, passwordEyeClose, password) => {
  if (e.target === passwordEye) {
    passwordEye.classList.remove("d-block");
    passwordEye.classList.add("d-none");
    passwordEyeClose.classList.remove("d-none");
    passwordEyeClose.classList.remove("d-block");
    password.type = "text";
  } else if (e.target === passwordEyeClose) {
    passwordEyeClose.classList.remove("d-block");
    passwordEyeClose.classList.add("d-none");
    passwordEye.classList.remove("d-none");
    passwordEye.classList.remove("d-block");
    password.type = "password";
  }
};

loginPasswordEyesIcons.addEventListener("click", (e) => {
const loginPassword = document.getElementById("login-password");
toggleEye(e, loginPasswordEye, loginPasswordEyeClose, loginPassword);
});

passwordEyesIcons.addEventListener("click", (e) => {
const password = document.getElementById("password");
toggleEye(e, passwordEye, passwordEyeClose, password);
});

confirmPasswordEyesIcons.addEventListener("click", (e) => {
const confirmPassword = document.getElementById("confirm-password");
toggleEye(e, confirmPasswordEye, confirmPasswordEyeClose, confirmPassword);
});
