<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Successfully Updated</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <style>
        html, body.auth_class {
        background: #fff;
        height:100%!important;
}
.login-container {
  margin-top: 10%;
  border: 0px solid #CCD1D1;
  border-radius: 12px;
  box-shadow: 0 0px 28px 0 rgb(0 0 0 / 8%);
  max-width: 50%;
  background: #FFF;
  z-index: 1;
  position: relative;
}
img.triangleA {
  position: absolute;
  margin-left: -16px;
  width: 60px;
  border-radius: 12px 0px 0px 0px;
}
img.triangleB {
  position: absolute;
  right: 0px;
  bottom: 0px;
  width: 360px;
  z-index: 0;
}
.welcome_auth {
  align-items: center;
  display: flex;
  justify-content: center;
}
.auth_welcome a {
  font-weight: 400;
}
.auth_welcome {
  font-weight: 100;
  font-size: 1.5em;
  background: -webkit-linear-gradient( 45deg, #07dd97, #beffe7);
  background-size: 100%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-color: black;
  max-width: 170px;
}
a.auth_branding_in img {
  width: 38%;
  height: 60px;
  /* border-radius: 1000px; */
}

.login-form {
  /* background: #fbfbfb; */
  border-radius: 0px 12px 12px 0px;
  align-items: center;
  display: flex;
  justify-content: center;
}
.login_form_in {
  padding: 4em 1em;
  width: 60%;
}
.login-form h1 {
  font-size: 1.2em;
  max-width: 600px;
  margin: 0 auto;
  color: #969696;
  line-height: 1.5em;
  padding: 1.2em 0px .8em;
}
.lni {
  display: inline-block;
  font: normal normal normal 1em/1 'LineIcons';
  speak: none;
  text-transform: none;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.google_signup {
  margin-top: .8em;
}
.google_signup a {
  background: #DB4437;
  color: #FFF;
  display: block;
  text-align: center;
  padding: 12px 4px;
  border-radius: 5px;
}
.btn-primary {
  color: #fff;
  background-color: #5d00ff;
  border-color: #5d00ff;
}
.btn-primary:hover {
  color: #fff;
  background-color: #2900b7;
  border-color: #2900b7;
}
.google_signup a {
  background: #DB4437;
  color: #FFF;
  display: block;
  text-align: center;
  padding: 12px 4px;
  border-radius: 5px;
}
.google_signup a:hover {
  background: #d81505;
  color: #FFF;
}
.other_auth_links a:nth-child(2) {
  float: right;
}
a {
  text-decoration: none;
  color: #afafaf;
}
a:hover {
  text-decoration: none;
  color: #616161;
}    
.alert-success {
  background-color: rgb(190 255 231 / 33%);
  color: #07dd97;
  font-size: .9em;
}  

@media (max-width: 992px){
    .login-form {
    display: initial;
}
    .login_form_in {
    width: 100%;
}
}
@media (max-width: 617px){
    .login-container {
        max-width: 95%;
}
}
    </style>
</head>
<body>
    <div class="container login-container">
        <img class="triangleA" src="https://res.cloudinary.com/procraftstudio/image/upload/v1613965232/triangleA_lwqhnl.png" alt='Onestop triangle'>
      <div class="row">
        <div class="col-md-12 login-form">
            <div class="login_form_in">
                <div class="auth_branding">
                    <a class="auth_branding_in" href="#"><img src="https://ztrademm.com/static/media/Group_7.3ef3a8143eff3f4ce296ac84360406c5.svg" alt='Procraft Studio'></a>
                </div>
              <h1 class="auth_title text-left">Thank You</h1>
               <div class="alert alert-success bg-soft-primary border-0" role="alert">
                   Successfully Updated Your Password, Please try to log in again.
                </div>  
                                  
            </div>
        </div>       
      </div>
    </div>
    <img class="triangleB" src="https://res.cloudinary.com/procraftstudio/image/upload/v1613965232/triangleB_isffjy.png" alt='Onestop triangle'>
</body>
</html>