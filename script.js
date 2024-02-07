// Toggle password visibility
const userPassword = document.querySelector("#password");
const togglePassword = document.querySelector("#togglePassword");

togglePassword.addEventListener("click", function () {
  if (this.checked === true) {
    userPassword.setAttribute("type", "text");
  } else {
    userPassword.setAttribute("type", "password");
  }
});