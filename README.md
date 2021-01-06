## IT220-authentications-sites
<div>
<img src=https://user-images.githubusercontent.com/60887509/103821362-0362d280-503c-11eb-82d6-e19ab26876d6.png width="750">
<div>
We can modyfy the data in the database in phpMyadmin through this website after passing a series of authentications. 
<br>
myfunctions.php: create functions that can be used in different files
<br>
logout.php: logging out phpMyadmin and the session for the website 

### 1. First authentication - captcha
captcha.php:  produces different captcha everytime the user enter the site <div>
captcha-verify.php: verify the captcha entered by the user with the true captcha

### 2. Second autentication + HTML form
auth-sticky.php: <div>
 - gatekeeper checking if the user pass the captcha challenge + <div>
 - connect to SQL + <div>
 - validate the grammar(REGEX) of ucid, password, acount, and delay + <div>
 - authenticate ucid and password, whether match with SQL + <div>
 - a html form below for user input 

### 3. Pin challenge
pin1.php: produce random pin and email to the user by fetching the email address in the database <div>
pin2.php: verify the pin entered by the user with the true pin

### 4. User Interface for modifying the data in database
service1.php: provide a HTML form with dropdown menu <div>
service2.php: execute different options chosen by the user using built functions
