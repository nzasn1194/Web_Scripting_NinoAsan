function validateRegisterForm() {
  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confirm_password").value;
  let email = document.getElementById("email").value;

  // Email format check
  let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    alert("Invalid email format!");
    return false;
  }

  // Password match check
  if (password !== confirmPassword) {
    alert("Passwords do not match!");
    return false;
  }

  return true;
}

function validateLoginForm() {
  let username = document.getElementById("login_username").value;
  let password = document.getElementById("login_password").value;

  if (username.trim() === "" || password.trim() === "") {
    alert("All fields are required!");
    return false;
  }
  return true;
}
