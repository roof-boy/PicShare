<?php
include '../config.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PicShare: Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">    
    <link rel="stylesheet" href="register.css">
</head>
<body class="mainDisplay">
    <div id="titleEffect"></div>
    <div class="container-lg regBox custom-width custom-height">
        <div class="row justify-content-space-between align-items-center">
            <div class="col-12 text-center">
                <h2>Registration</h2>
                <hr>
            </div>
            <div class="col-lg-12 col-md-6">
                <form id="registrationForm" action="register_controller.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="Username" class="form-label">Username</label>
                        <input type="text" name="usr" id="Username" placeholder="John_Doe" class="form-control" required>
                        <div class="invalid-feedback">Please enter a valid username.</div>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" name="psw" id="Password" placeholder="123456" class="form-control" minlength="8" maxlength="20" required>
                        <div class="invalid-feedback" id="password-validation">Password must be between 8 and 20 characters.</div>
                    </div>
                    <div class="mb-3">
                        <label for="E-mail" class="form-label">E-mail</label>
                        <input type="email" name="eml" id="E-mail" placeholder="example@gmail.com" class="form-control" required>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary custom-btn">Register</button>
                    </div>
                    <div class="mb-3">
                        <a class="link-offset-1 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="<?=BASE_URL . 'login/login.php' ?>">
                            Login Instead!
                          </a>
                    </div>
                    <div class="alert alert-success" style="display: none;" id="SuccessDiv">
                        Registration Successful!
                    </div>
                    <div class="alert alert-danger" style="display: none;" id="userFail">
                        This username is already registered
                    </div>
                    <div class="alert alert-danger" style="display: none;" id="EmailFail">
                        This e-mail is already registered
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
                // JavaScript to enable Bootstrap validation
                (function () {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });

            // Custom password validation
            var passwordInput = document.getElementById('Password');
            var passwordValidationMessage = document.getElementById('password-validation');

            passwordInput.addEventListener('input', function() {
                if (passwordInput.validity.patternMismatch) {
                    passwordValidationMessage.innerHTML = 'Password must be between 8 and 20 characters.';
                } else {
                    passwordValidationMessage.innerHTML = '';
                }
            });
        })();

        // Function to get a parameter value from the URL query string
    function getParameterByName(name) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Function to show or hide the div based on the parameter value from the URL
    function toggleDivVisibility() {
        var paramValue = getParameterByName('registration'); // Replace 'paramName' with your parameter name
        var successDiv = document.getElementById('SuccessDiv');
        var failDivUser = document.getElementById('userFail');
        var failDivEmail = document.getElementById('EmailFail');
        if (paramValue === 'true') {
            successDiv.style.display = 'block'; // Show the div
        } else if (paramValue === 'failedUser') {
            failDivUser.style.display = 'block'; // Show the div
        } else if (paramValue === 'failedEmail') {
            failDivEmail.style.display = 'block'; // Show the div
        } else {
            successDiv.style.display = 'none'; // Hide the divs
            failDivUser.style.display = 'none';
            failDivEmail.style.display = 'none';
        }
    }

    // Call the toggleDivVisibility function when the page loads
    window.onload = function() {
        toggleDivVisibility();
    };

    const textElement = document.getElementById('titleEffect');
  const text = "PicShare";
  let index = 0;

  function typeWriter() {
    if (index < text.length) {
      textElement.innerHTML += text.charAt(index);
      index++;
      setTimeout(typeWriter, 50); // Adjust typing speed here
    } else {
      setTimeout(blinkSlash, 500); // Start blinking slash when typing is complete
    }
  }

  function blinkSlash() {
    const currentText = textElement.innerHTML;
    if (currentText.endsWith('|')) {
      textElement.innerHTML = currentText.slice(0, -1);
    } else {
        textElement.innerHTML += '|';
    }
    setTimeout(blinkSlash, 500); // Adjust blinking speed here
  }

  typeWriter(); // Start typewriter effect
    </script>
</body>
</html>
