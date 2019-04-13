<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>

<div class="container">
    <form >
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

    <!-- <div class = "card bg-light mb-3" style = "width: 30rem; padding: 15px;">
        <form class="form-signin" action = "<?=PROOT?>register/login" method = "post">
            <h2 class="form-signin-heading text-center">Please sign in</h2>
            <label for="username" class="sr-only">User Name</label>
            <input type="text" name = "username" id="username" class="form-control" placeholder="User name" required autofocus>
            <label for="password" class="sr-only">Password</label>
            <input type="password" name = "password" id="password" class="form-control" placeholder="Password" required>
            <div class="checkbox">
            <label for ="remember_me">
                <input type="checkbox" id= "remember_me" name = "remember_me" value="remember-me"> Remember me
            </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
        <div class = "text-right">
            <a href="<?=PROOT?>register/register" class= "text-primary">Register</a>
        </div>
    </div> -->

    <!-- <div class = "col-md-6 col-md-offset-3 well">
        <form class= "form" action = "<?=PROOT?>register/login" method = "post">
            <div class = "form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id = "username" class="form-control">
            </div>
            <div class = "form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id = "password" class="form-control">
            </div>
            <div>
                <label for="remember_me">Remember Me <input type="checkbox" id = "remember_me" name = "remember_me" value = "on"></label>            
            </div>
        </form>
    </div> -->
<?php $this->end(); ?> 