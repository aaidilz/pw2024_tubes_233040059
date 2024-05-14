<!DOCTYPE html>
<html lang="en">

<?php include 'layout/home/header.php'; ?>

<body class="bg-dark">
  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">
          <div class="px-5 ms-xl-4 text-warning">
            <i class="fas fa-layer-group fa-2x me-3 pt-5 mt-xl-4 text-warning"> STACKED</i>
          </div>
          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5 text-white">
            <form action="#" method="POST">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="form2Example18" class="form-control form-control-lg" name="username" placeholder="Username" />
                <label class="form-label" for="form2Example18">Username</label>
              </div>
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form2Example28" class="form-control form-control-lg" name="password" placeholder="Password" />
                <label class="form-label" for="form2Example28">Password</label>
              </div>
              <div class="pt-1 mb-4">
                <button type="submit" class="btn btn-info btn-lg btn-block">Login</button>
              </div>
              <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>
            </form>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="/public/img/login-screen.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>
</body>

</html>