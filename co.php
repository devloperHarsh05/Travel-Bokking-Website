<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Contact |Wonder Wolrd Page</title>
  <link rel="stylesheet" href="co.css">
  <link rel="stylesheet" href="cust.css">
  <script src="help.php"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="item">
      <div class="contact">
        <div class="frist-text d-grid">
            Let's get in touch
            <img class="image" src="image/man.jpg" alt="">
            <label>Connect With Us:</label>
            <a href="#" class="text-muted"><span>Shubham Koshiya</span></a>
            <a href="#" class="text-muted"><span>Email:wonderworldtravel.india@gmail.com</span></a>
            <a href="#" class="text-muted"><span>Mo: 9087654321</span></a>
        </div>
        </div>
        <div class="submit-form">
            <h4 class="contact-text textr">contact us</h4>
           <form id="contact-form answer" method="POST" action="help.php">
            <div class="input-box">
                <input type="text" class="input" id="name" name="name" required>
                <label class="label-text" for="name">Full Name</label>
            </div>
            <div class="input-box">
                <input type="email" class="input" id="email" name="email" required>
                <label class="label-text" for="email">Email address</label>
            </div>
            <div class="input-box">
                <input type="text" class="input" id="subject" name="subject" required>
                <label class="label-text" for="subject">Subject</label>
            </div>
            <div class="input-box">
                <textarea class="input" id="message" name="message" rows="5" required></textarea>
                <label class="label-text" for="message">Message</label>
            </div>
            <button type="submit" name="submit" class="btn">Submit</button>
          </form>
      </div>
    </div>
    </div>
  </div>
</body>
</html>
