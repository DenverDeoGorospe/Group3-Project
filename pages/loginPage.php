

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="assets/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Login Form</title>

</head>

<body>
    <div class="box">
        <div class="flip-card-inner">
            <div class="box-login">
                <ul>
                    <form action="../functions/verify.php" method="post">
                        <h1>LOGIN</h1>
                        <div class="email-login">
                            <input class="inpt" type="email" name="email" id="" placeholder="Email " required>

                        </div>

                        <div class="password-login">
                            <input class="inpt" type="password" name="password" id="password-login"
                                placeholder="Password" required>

                        </div>

                        <div class="forget">
                            <input type="checkbox" name="checkbox1" id="checkbox">
                            <label for="checkbox">Remember me</label>
                            <a href="#">Forget Password?</a>
                        </div>
                        <button type="submit" class="btn" name="btn-login">LOGIN</button>
                    </form>
                    <div class="register-link">
                        <p>Dont have an account? <a href="#" onclick="flip()">Sign Up</a></p>
                    </div>
                </ul>
            </div>

            <div class="box-signup">
                <ul>
                    <form action="../functions/register.php" method="POST">
                        <input type="hidden" name="action" value="add">
                        <h1>SIGN UP</h1>
                        <div class="user-signup">
                            <input class="inpt" type="text" name="name" id="name" placeholder="Name">

                        </div>

                        <div class="user-signup">
                            <input class="inpt" type="text" name="studentId" id="studentId" placeholder="Student Id">

                        </div>
                       

                        <div class="email-signup">
                            <input class="inpt" type="email" name="email" id="email" placeholder="Email " required>
                        </div>

                        <div class="password-signup">
                            <input class="inpt" type="password" name="password" id="password" placeholder="Password"
                                required>

                        </div>
                        <div class="user-signup">
                            <select class="inpt" name="accountType" id="accountType" required>
                                <option value="">Select account type</option>
                                <option value="student">Student</option>
                                <option value="admin">Admin</option>
                            </select>

                        </div>


                        <div class="forget">
                            <input type="checkbox" name="checkbox1" id="checkbox1">
                            <label for="checkbox1">Remember me</label>
                            <a href="#">Forget Password?</a>
                        </div>
                        <button type="submit" name="submit" class="btn">SIGN UP</button>

                    </form>
                    <div class="register-link">
                        <p>Already have an account? <a href="#" onclick="flipAgain()">Log In</a></p>
                    </div>
                </ul>
            </div>
        </div>
    </div>

</body>
<script src="assets/js/script.js"></script>


</html>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");

    body {
        font-family: "Poppins", sans-serif;
        background-color: gray;
        background-repeat: no-repeat;
        color: white;
        background-size: cover;
    }

    .box {
        background-color: transparent;
        width: 530px;
        height: 700px;
        perspective: 1000px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        border-radius: 25px;
        box-shadow: 0 4px 8px 10px rgba(0, 0, 0, 0.2);
    }

    /* .box:hover .flip-card-inner {
            transform: rotateY(-180deg);
        } */

    .box-login,
    .box-signup {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .box-login {
        width: 100%;
        height: 100%;
        font-size: 1.5rem;
        background: transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 25px;
        box-sizing: border-box;
        backdrop-filter: blur(10px);
        /* border: 1px solid white; */
        position: absolute;
    }

    .box-login h1 {
        letter-spacing: 2px;
    }

    .box-signup h1 {
        padding-top: 5px;
        letter-spacing: 2px;
    }

    .box-login ul {
        padding: 26px;
    }

    .box-signup ul {
        padding: 10px;
    }

    .box-login .inpt {
        width: 27rem;
        padding: 15px 10px;
        font-size: 1.4rem;
        border-radius: 15px;
        margin: 15px;
        background: transparent;
        outline: none;
    }

    input::placeholder {
        color: white;
        font-size: 1.2rem;
    }

    .btn {
        height: 3.2rem;
        width: 27rem;
        margin: 15px 15px 0 15px;
        padding: 10px;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
        border-radius: 50px;
        background: white;
        color: black;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-0.4rem);
    }

    .box-login form a {
        text-decoration: none;
        color: white;
        padding-left: 150px;
        font-size: 1rem;
    }

    label {
        font-size: 1rem;
        cursor: pointer;
    }

    .box-signup {
        color: white;
        transform: rotateY(180deg);
        width: 100%;
        height: 100%;
        font-size: 1.5rem;
        text-align: center;
        background: transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 25px;
        backdrop-filter: blur(10px);
        position: absolute;
    }

    .box input {
        color: white;
        border-radius: 0px;
        border: 1px solid white;
        /* border-bottom-color:white ; */
        /* padding: 20px 10px; */
        /* transition: 0.3s ease; */
    }

    .box input:focus {
        border: 2px solid orange;
    }

    .box-signup .inpt {
        width: 27rem;
        padding: 15px;
        font-size: 1.2rem;
        border-radius: 15px;
        margin: 10px;
        background: transparent;
        transition: 0.5s ease;
        outline: none;
    }

    .box-signup form a {
        /* display: flex; */
        text-align: right;
        text-decoration: none;
        color: white;
        padding-left: 155px;
        font-size: 1rem;
        /* transition: 0.5s ease; */
    }

    form a:active {
        color: orange;
    }

    .box-login .register-link {
        font-size: 1rem;
        /* margin-bottom: rem; */
        padding-bottom: 15px;
        font-style: italic;
    }

    .box-signup .register-link {
        font-size: 1rem;
        /* margin-bottom: 3rem; */
        padding-bottom: 30px;
        font-style: italic;
    }

    .register-link a {
        color: orange;
        transition: 0.5s ease;
    }

    .register-link a:active {
        color: orange;
    }

    .register-link a:hover {
        color: red;
        transform: scale(1.5);
    }

    .email-login i {
        /* content: "\eee1"; */
        position: absolute;
        top: 11rem;
        right: 3.5rem;
        cursor: pointer;
    }

    .password-login i {
        position: absolute;
        right: 3.5rem;
        top: 16.4rem;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .user-signup i {
        position: absolute;
        right: 3.8rem;
        top: 8.7rem;
        cursor: pointer;
    }

    .email-signup i {
        top: 13.3rem;
        position: absolute;
        right: 3.6rem;
        cursor: pointer;
    }

    .password-signup i {
        top: 17.9rem;
        position: absolute;
        right: 3.7rem;
        cursor: pointer;
        transition: 0.3s ease;
    }

    @media (max-width: 480px) {
        .box {
            width: 90%;
        }

        .box .inpt {
            width: 85%;
            font-size: 90%;
        }

        .box form a {
            padding-left: 1rem;
            font-size: 0.9rem;
        }

        .box-login ul {
            padding: 5px;
        }

        .btn {
            width: 80%;
        }
    }
</style>
<script>

    function flip() {

        document.querySelector('.flip-card-inner').style.transform = "rotateY(180deg)";

    }

    function flipAgain() {

        document.querySelector('.flip-card-inner').style.transform = "rotateY(0deg)";

    }


    let eye = document.getElementById("eye-login");
    let password = document.getElementById("password-login");

    eye.onclick = function () {
        if (password.type == "password") {
            password.type = "text";
            eye.className = "fa fa-eye";
            eye.style.color = "orange";
            // password.style.border =" 1px solid orange";


        } else {
            password.type = "password"
            eye.className = "fa fa-eye-slash";
            eye.style.color = "white";
            // password.style.border =" 1px solid white";


        }
    }


    let eye2 = document.getElementById("eye-signup");
    let password2 = document.getElementById("password-signup");

    eye2.onclick = function () {
        if (password2.type == "password") {
            password2.type = "text";
            eye2.className = "fa fa-eye";
            eye2.style.color = "orange";
            // password2.style.border =" 1px solid orange";



        } else {
            password2.type = "password"
            eye2.className = "fa fa-eye-slash";
            eye2.style.color = "white";
            // password2.style.border =" 1px solid white";


        }
    }



</script>