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
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,600;1,600&family=Lora:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

    <!-- css file link -->
    <link rel="stylesheet" href="lStyle.css">
    <!-- font awesome cdn link -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> -->
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
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item fs-6 px-2 mt-1 fw-bold">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item fs-6 px-2 mt-1 fw-bold">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <a href="login.php" class="btn-logIn px-4 py-2 fs-6 me-1 mt-1 fw-bold">Log In</a>
                <a href="create_account.php" class="btn-signUp px-4 py-3 fs-6 mt-1">Sign Up</a>
            </div>
        </div>
    </nav>
</header>

<main class="main">
    <!-- About Section -->

        <div class="container-a">
            <div class="row justify-content-center">
            <div class="col-lg-5 order-1 order-lg-2 ms-5" data-aos="fade-up" data-aos-delay="100">
                    <img src="images/pics/boy-interview.svg" class="img-fluid" height="900px" width="600px" alt="">
                </div>
                <div class="col-lg-6 order-2 order-lg-1 content">
                    <h1 class="section-title fw-bold mb-4">About Us</h1>
                    <p class="mb-4">Welcome to Unicounsel, your trusted partner in navigating the complexities of academic counseling. Our mission is to provide personalized, comprehensive support to students and families, helping them make informed decisions about their educational journeys.</p>
                    <p class="mb-4">Founded by experienced educators and counselors, Unicounsel offers a range of services including college application guidance, career counseling, and academic support. We believe that every student deserves access to the tools and resources necessary to achieve their educational goals.</p>
                    <p>Join us on a journey of discovery, growth, and success. Together, we can unlock your full potential and pave the way for a bright future.</p>
                </div>
            </div>
        </div>

</main>

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
        "avatarUrl": "data:image/webp;base64,UklGRggRAABXRUJQVlA4WAoAAAAwAAAA/wAA/wAASUNDUMgBAAAAAAHIAAAAAAQwAABtbnRyUkdCIFhZWiAH4AABAAEAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAACRyWFlaAAABFAAAABRnWFlaAAABKAAAABRiWFlaAAABPAAAABR3dHB0AAABUAAAABRyVFJDAAABZAAAAChnVFJDAAABZAAAAChiVFJDAAABZAAAAChjcHJ0AAABjAAAADxtbHVjAAAAAAAAAAEAAAAMZW5VUwAAAAgAAAAcAHMAUgBHAEJYWVogAAAAAAAAb6IAADj1AAADkFhZWiAAAAAAAABimQAAt4UAABjaWFlaIAAAAAAAACSgAAAPhAAAts9YWVogAAAAAAAA9tYAAQAAAADTLXBhcmEAAAAAAAQAAAACZmYAAPKnAAANWQAAE9AAAApbAAAAAAAAAABtbHVjAAAAAAAAAAEAAAAMZW5VUwAAACAAAAAcAEcAbwBvAGcAbABlACAASQBuAGMALgAgADIAMAAxADZBTFBIAwcAAAHwBW3b8rbZ/p26JWfGUqbBqcPMDGXmmto+GAbjDD38mNWUmUOL5YbLzBxODE8cBsNDQSswkS26zwXxfV/XeaxGxASQdvvNyCv1rlr/xfb97acu+QPMAf/FU+37t32+fpW3NG9GP8K11/T5T21pvMhpv9C4+amCqz1g9L6t6q39Yba0eXxz9a0eDAb+fk1zmG0aalqzeIjseuevPMB2N/e/kucR2vDKz7pZkd1fVQwT1+jqX01WqrmnepSgBlb8ZLKCzV0VA0TkzNvUzcoOfJDrlE5W3XFWfOdDwyQzd12QNRhYd71QHPdvY21u/b6f7P9m7s7jc5MTZay6PjvPduR0flkG9O5K7mNuahWcR9ur3vMt5a/zvO8OsuOMMEgzGPD61QncdPtzv7yHzpZc3N0VNRhvFZMrleM0msUesZ02mz30E5tB4aWkz02WFsU8+S3Lbbuq9eviHL7d7+++bIjtCtaU4Jboh8siqfueFsxOeZ7M92nNRzWT1DRFW0pMlySW6KSqStFgqraMVZmdsdJJLOc0BkaTZ2mjH1I5Hjb03UWOKunluOZnLqLksw5tH4vsA1+a43yQjLaVKd0Zkz7tw2OSlY6jzdvdNbW5LUsZfcsqrQh15oUc2F1Qyq7RZqOlx7aHbsy+2yk78v8cfneSKrYWslKm6o46p6vOOFOU+15v1aG4rDgzRmV1Tmd6RbF2guwna9lvclrw0ktZfLPaMNtmsk5SxDmjJtWsmmLOOZplu02w2czYvcznvF5pp9l0twa4o94RQAAAA==",
        "enableConversationDeletion": true,
        "showUserName": true,
        "showUserAvatar": true,
        "botMessageColor": "#00ff00",
        "userMessageColor": "#ff00ff"
    })
</script>
<!-- chatbot by botpress end -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script>
    AOS.init();
</script>

</body>
</html>
