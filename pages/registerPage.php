<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<body>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black" style="height: 80vh;">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">

                  <h4 class="mt-1 mb-5 pb-1">Login to your account</h4>
                </div>

                <form action="../functions/register.php" method="post">
                <input type="hidden" name="action" value="add">
                <div data-mdb-input-init class="form-outline mb-4">
                <input class="form-control shadow-none" type="text" name="name" id="name" placeholder="Name" required>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                  <input class="form-control shadow-none" type="text" name="studentId" id="studentId" placeholder="Student Id" required>
                  </div>


                  <div data-mdb-input-init class="form-outline mb-4">
                  <select class="form-control shadow-none" name="accountType" id="accountType" style="border-bottom: black solid 2px; " required>
                                <option value="">Select account type</option>
                                <option value="student">Student</option>
                                <option value="admin">Admin</option>
                            </select>
                            </div>
              

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" class="form-control shadow-none" name="email" id="email" required
                      placeholder="Email address" />
                    
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="password" class="form-control shadow-none" id="password" placeholder="Password" required/>
              
                  </div>

                  <div class="text-center pt-1 mb-1 pb-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="form-control btn btn-dark btn-block fa-lg  mb-3" type="submit" name="btn-login">Register</button>
                  
                  </div>
                  </form>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Already have an account?</p>
                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-dar"><a href="../pages/login.php" class="text-dark">Login</a></button>
                  </div>

               

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center position-relative" style="height: 80vh;">
              <img src="../assets/loginIMG.png" alt="Background Image" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;">
              <div class="bg-dark" style="opacity: 0.5; width: 100%; height: 100%; position: absolute; top: 0; left: 0;"></div>
              <div class="h1 px-3 py-4 p-md-5 mx-md-4 text-white position-relative" style="font-size: 80px; z-index: 1; text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;">
                  Let's Create an Account
              </div>
          </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    
</body>
</html>

<style>

  
input.form-control {
  border: none;
  border-bottom: black solid 2px; 
  background: none; 
}


input.form-control:focus {
  border-bottom: solid 2px; 
  outline: none;
  background: none; 
}
    .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
</style>