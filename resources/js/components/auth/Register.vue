<template>
  <div>
    <div class="flex-center position-ref full-height">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-4">
            <div id="logo-container" class="text-white text-center mb-3">SIGN UP</div>
            <div class="col-md-12 col-md-offset-1 p-0">
              <form>
                <div class="form-group">
                  <input class="form-control" type="text" name='name' placeholder="name"
                  value="" required autofocus/>

                  <span class="text-danger" role="alert">
                    <strong></strong>
                  </span>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" name='email' placeholder="email"
                  value="" required autofocus/>
                  <span class="text-danger" role="alert">
                    <strong></strong>
                  </span>
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" name='password' placeholder="password"
                  value="" required autofocus/>

                  <span class="text-danger" role="alert">
                    <strong></strong>
                  </span>
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" name='password_confirmation' placeholder="Password Confirmation"
                  value="" required autofocus/>
                  <span class="text-danger" role="alert">
                    <strong></strong>
                  </span>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> I agree to the <a href="#" class="btn-link">Terms and Conditions</a>
                  </label>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-outline-info btn-block">Sign Up</button>
                  <router-link :to="{name : 'login'}" class="btn btn-outline-success btn-block login">Login</router-link>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
