// login & signup forms
const login = document.getElementById("login");
const signup = document.getElementById("signup");

//  toggle btns
const toggleLogin = document.getElementById("toggleLogin");
const toggleSignup = document.getElementById("toggleSignup");
const toggleBg = document.getElementById("btn");

// toggle Sign up
const openSignup = () => {
  signup.style.left = "0";
  login.style.left = "-450px";
  toggleBg.style.left = "110px";
  toggleSignup.style.color = "white";
  toggleLogin.style.color = "black";
};

// toggle login
const openLogin = () => {
  login.style.left = "0";
  signup.style.left = "450px";
  toggleBg.style.left = "0";
  toggleLogin.style.color = "white";
  toggleSignup.style.color = "black";
};
