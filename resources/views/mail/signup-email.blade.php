Hello {{$email_data['name']}} 
<br>
Welcome to my website 
<br>
Please Click the below link to verify your email and activate your account
<br>
<a href="http://127.0.0.1:8000/verify?code={{$email_data['verification_code']}}">Click Here</a>
<br><br>
Thank You 
