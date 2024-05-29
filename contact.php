<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unicounsel</title>
    <link rel="shortcut icon" type="image/png" href="images/Icon.png">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;1,600&family=Lora:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

    <!-- css file link -->
    <link rel="stylesheet" href="lStyle.css">
    <!-- font awesome cdn link 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> -->
    <!-- bootstrap cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

</head>

<body class="index-page scrolled" data-aos-easing="ease-in-out" data-aos-duration="600" data-aos-delay="0">
<!-- start of header section  -->
<header id="header" class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-3 shadow p-3 mb-5 bg-body fixed-top">
  <div class="container-md container-xl position-relative d-flex align-items-center">
  <a href="landing_page.php" class="logo d-flex me-auto align-items-center">
            <img src="images/Icon.png" width="55" height="55">
            <h2 class="sitename fw-bold mx-1 me-4 mt-2"> Unicounsel</h2>
        </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item fs-6 px-2 mt-1 fw-bold">
          <a class="nav-link active" href="landing_page.php">Home</a>
        </li>
        <li class="nav-item fs-6 px-2 mt-1 fw-bold">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item fs-6 px-2 mt-1 fw-bold">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item fs-6 px-2 mt-1 fw-bold">
          <a class="nav-link" current="page" href="#">Contact</a>
        </li>
      </ul>
      <a href="login.php" class="btn-logIn px-4 py-2 fs-6 me-1 mt-1 fw-bold">Log In </a>
      <a href="create_account.php" class="btn-signUp px-4 py-3 fs-6 mt-1">Sign Up</a>
  </div>
  </div>
</nav>
</div>
</header>

<main class="main"></main>

<footer id="footer" class="footer bg-secondary-subtle">
<div class="container pt-4 pb-2 mt-5">
<div class="words" data-aos="fade-up" data-aos-delay="100">
  <p class="words text-center text-black pt-0">ABERIN & BARRO | BSIS 2A © <span class="fw-light"> Copyright </span> <strong class="px-1 sitename">Unicounsel</strong> <span class="fw-light"> All Rights Reserved</span></p>
    
    </div>
    </div>

  </footer>

  <!-- js file link -->
  <script src="script.js"></script>

<!-- chatbot by botpress start -->

<script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
<script>
    window.botpressWebChat.init({
        "composerPlaceholder": "Chat with Helpy",
        "botConversationDescription": "This chatbot was built surprisingly fast with Botpress",
        "botId": "dd916935-6b3e-4ead-ada1-abd5ebc6a51c",
        "hostUrl": "https://cdn.botpress.cloud/webchat/v1",
        "messagingUrl": "https://messaging.botpress.cloud",
        "clientId": "dd916935-6b3e-4ead-ada1-abd5ebc6a51c",
        "webhookId": "6429d989-0fa5-47a5-bd66-38349650f8de",
        "lazySocket": true,
        "themeName": "prism",
        "botName": "Helpy",
        "avatarUrl": "data:image/webp;base64,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",
        "frontendVersion": "v1",
        "useSessionStorage": true,
        "enableConversationDeletion": true,
        "showPoweredBy": true,
        "theme": "prism",
        "themeColor": "#30a46c"
    });
</script>
<!-- chatbot by botpress end -->

</body>

</html>