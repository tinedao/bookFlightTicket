<?php
    include 'layout/header.php';
    include 'config/connect.php';
    include 'layout/navbar.php';
?>

<style>
    
    .bgContact{
        background-image: url('assets/img/contact.jpg');
        background-repeat: inherit;
        background-size: cover;
        background-position: center;
        position: fixed;
        height: 100vh;
        width: 100%;
        top: 96.61px;
        filter: brightness(30%);
        text-align: center;
        z-index: -1;
    }

body {
  color: #fff;
  font-size: 15px;
  margin: 0; }

input, textarea, select, button {
  color: #fff;
  font-size: 15px; }

p, h1, h2, h3, h4, h5, h6, ul {
  margin: 0; }

img {
  max-width: 100%; }

ul {
  padding-left: 0;
  margin-bottom: 0; }

a:hover {
  text-decoration: none; }

:focus {
  outline: none;
background: #39459b; }

.wrapper {
  min-height: 100vh;
  display: flex;
  align-items: center;
  background-size: cover; 
    padding-top: 80px;
}

.inner {
  max-width: 758px;
  margin: auto;
  background: #39459b;
  border: 10px solid #0d99d7;
  padding: 77px 99px 87px;
  box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
  -ms-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
  -o-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2); }

textarea {
  resize: none; }

h3 {
  text-transform: uppercase;
  font-size: 45px;
  font-family: "Montserrat-Bold";
  text-align: center;
  margin-bottom: 12px; }

p {
  text-align: center;
  padding: 0 10px;
  margin-bottom: 55px;
  line-height: 1.8; }

.form-group {
  position: relative;
  display: block;
  margin-bottom: 48px; }
  .form-group span {
    font-size: 15px;
    color: #00ade6;
    position: absolute;
    top: 11px;
    transition: all .2s ease;
    transform-origin: 0 0;
    cursor: text; }
  .form-group span.border {
    height: 2px;
    display: block;
    position: absolute;
    width: 100%;
    left: 0;
    top: 41px;
    transform: scaleX(0);
    transition: all .15s ease;
    background: #fff; }

.form-control {
  border: none;
  color: white;
  overflow: hidden;
  border-bottom: 2px solid #00ade6;
  display: block;
  width: 100%;
  height: 43px;
  font-size: 15px;
  background: none;
  font-family: "Montserrat-SemiBold"; }
  .form-control:focus, .form-control:valid {
    border-bottom: 2px solid #fff; }
    .form-control:focus + span, .form-control:valid + span {
      transform: translateY(-22px) scale(0.8); }
      .form-control:focus + span + .border, .form-control:valid + span + .border {
        transform: scaleX(1); }

textarea.form-control {
  padding-top: 10px;
  padding-bottom: 10px; }

button {
  border: none;
  width: 162px;
  height: 51px;
  border: 2px solid #fff;
  margin: auto;
  margin-top: 60px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
  background: none;
  color: #fff;
  text-transform: uppercase;
  font-family: "Montserrat-SemiBold";
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  position: relative;
  -webkit-transition-property: color;
  transition-property: color;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s; }
  button i {
    margin-left: 10px;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-transition-duration: 0.1s;
    transition-duration: 0.1s;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out; }
  button:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #2098D1;
    -webkit-transform: scaleX(0);
    transform: scaleX(0);
    -webkit-transform-origin: 0 50%;
    transform-origin: 0 50%;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out; }
  button:hover {
    border-color: transparent; }
    button:hover:before {
      -webkit-transform: scaleX(1);
      transform: scaleX(1); }
    button:hover i {
      -webkit-transform: translateX(4px);
      transform: translateX(4px); }

@media (max-width: 767px) {
  h3 {
    font-size: 38px; }

  p {
    font-size: 14px;
    padding: 0; }

  .inner {
    padding: 27px 20px 37px;
    border: none;
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -ms-box-shadow: none;
    -o-box-shadow: none; }

  .wrapper {
    background: #39459b;
    border: 10px solid #0d99d7; } }

.form-control:focus {
    background:none;
    box-shadow: none;
    color: white;
}

</style>
<div class="bgContact"></div>
        <div class="wrapper">
            <div class="inner">
                <form action="" method="post">
                    <h3>Contact Us</h3>
                    <p>Please share your feedback with us. Your feedback is important to us and will help us to improve our service. We appreciate your time and effort in providing us with your thoughts and suggestions.</p>
                    <label class="form-group">
                        <input type="text" class="form-control" required="" name="name">
                        <span>Your Name</span>
                        <span class="border"></span>
                    </label>
                    <label class="form-group">
                        <input type="text" class="form-control" required="" name="email" >
                        <span for="">Your Email</span>
                        <span class="border"></span>
                    </label>
                    <label class="form-group">
                        <textarea name="message" id="" class="form-control" required=""></textarea>
                        <span for="">Your Message</span>
                        <span class="border"></span>
                    </label>
                    <button type="submit">Submit
                        
                    </button>
                </form>
            </div>
        </div>
        
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $email = $_POST["email"];
                $name = $_POST["name"];
                $message = $_POST["message"];
                $sql = "INSERT INTO contactus (email, name, message) VALUES (?, ?, ?)";
                if($stmt = $conn->prepare($sql)){
                    $stmt->bind_param("sss", $email, $name, $message);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        
    include 'layout/footer.php';
?>

