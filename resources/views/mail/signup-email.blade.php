<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>vERIFICATION</title>
    <style>
      .header, .footer{
        background-color: #003399;
        margin-top: 15px;
        text-align: center;
        padding: 15px 0px 15px 0px;
      }
      .footer{
        margin-top: 0px;
      }
      .f_block{
        text-align: center;
        padding: 15px 0px 15px 0px;
        background-color: #fff;
      }
      .f_block p{
        font-size: 17px;
        line-height: 30px;
        color: #1c1919;
      }
      .f_block .verify_button{
        padding: 15px;
      }
      .f_block .verify_button a{
        text-decoration: none;
        border: 1px solid;
        padding: 8px;
        border-radius: 4px;
        background: blue;
        color: white;
      }
      
      @media screen and (min-width: 767px) {
        .main{
        width: 70%!important;
        margin: 0px auto;
      }
    }
      body{
        background-color: #e5eaf5!important;
      }
      .s_block {
        text-align: center;
        padding: 15px 0px 0px 0px;
        background-color: #dbe0eb8f;
      }
      .s_block p {
        margin-bottom: 0px;
        line-height: 13px;
        font-size: 14px;
      }
      .social_icon {
        margin-top: 8px;
        margin-bottom: 8px;
      }
      .s_block a{
        color: #1c1919;
        text-decoration: none;
        font-size: 14px;
        transition: .3s ease all;
      }
      .s_block a:hover{
        font-weight: 400;
        transition: .3s ease all;
        text-decoration: underline;
      }
      .social_icon ul {
        padding: 0px;
        display: inline-flex;
        list-style: none;
        margin-top: 10px;
      }
      .social_icon li {
        margin-right: 13px;
      }
      .social_icon img:hover {
        margin-top: -5px;
        transition: .3s ease all;
      }
      .social_icon img{
        transition: .3s ease all;
      }
      .image img{
        height: 75px;
        width: 96%;
        object-fit: contain;
      }
      .social_icon {
         margin-top: 8px;
        margin-bottom: 0px;
      }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <div class="container main">
      <div class="container image">
        <img src="https://webstaging.ztrademm.com/static/media/Group_7.3ef3a8143eff3f4ce296ac84360406c5.svg" alt="">
      </div>
      <div class="container header">
        <img align="center" border="0" src="https://cdn.templates.unlayer.com/assets/1597218650916-xxxxc.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 15%;max-width: 150.8px;" width="150.8">
        <p style="font-size: 11px;line-height: 0px;color: #e5eaf5;margin-bottom: 0px;font-weight: 500;">
          THANKS FOR SIGNING UP
        </p>
        <p style="font-size: 18px;line-height: 10px;color: #e5eaf5;margin-bottom: 0px;font-weight: 500;">
          Verify Your E-mail Address
        </p>
      </div>
      
      <div class="container f_block">
        <p style="text-transform:uppercase">Hi <b>{{$email_data['name']}}</b></p>
        <p>You're almost ready to get started. Please click on the button below to verify your email address and enjoy exclusive cleaning services with us!</p>
        <div class="verify_button">
          <a href="http://127.0.0.1:8000/verify?code={{$email_data['verification_code']}}" class="btn btn-primary">Click Here To Verify</a>
        </div>
        <p style="margin-top:13px;margin-bottom:0">Thanks</p>
        <p style="margin:0px">The Company Team</p>
      </div>
      <div class="s_block">
        <p style="color:#003399;font-weight: 600;">Get In Touch</p>
        <p><a href="#">+11 111 333 4444</a></p>
        <p><a href="#">info@example.com</a></p>
        <div class="social_icon">
          <ul>
            <li><a href="#"><img src="https://cdn.tools.unlayer.com/social/icons/circle-black/facebook.png" alt="Facebook" title="Facebook" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important"></a></li>
            <li><a href="#"><img src="https://cdn.tools.unlayer.com/social/icons/circle-black/linkedin.png" alt="LinkedIn" title="LinkedIn" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important"></a></li>
            <li><a href="#"><img src="https://cdn.tools.unlayer.com/social/icons/circle-black/instagram.png" alt="Instagram" title="Instagram" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important"></a></li>
            <li><a href="#"><img src="https://cdn.tools.unlayer.com/social/icons/circle-black/youtube.png" alt="YouTube" title="YouTube" width="32" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important"></a></li>
          </ul>
        </div>
      </div>
      <div class="footer">
        <p style="font-size: 14px;color: #e5eaf5;margin-top: 0px;margin-bottom: 0px;font-weight: 500;">
          Copyrights © Company All Rights Reserved
        </p>
      </div>
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
