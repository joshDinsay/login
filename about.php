<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>POS Page</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    margin: 0;
    padding: 0;
}
.navbar {
    margin-bottom: 0;
    border-bottom: 2px solid #6c757d;
}

.navbar-brand, .nav-link {
    font-weight: 500;
    font-size: 1rem;
}

.navbar-nav .nav-link {
    transition: color 0.3s ease, background-color 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #ffffff;
    background-color: #ff6347;
    border-radius: 5px;
}

.main-image {
width: 60%;           /* Reduce width */
max-width: 400px;     /* Set maximum width */
border-radius: 10px;
margin: 20px auto;
display: block;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
transition: transform 0.3s ease, box-shadow 0.3s ease;
}


.main-image:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.description {
    margin-bottom: 30px;
    text-align: center;
    font-size: 1.1rem;
}

.image-container {
    margin-top: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2rem;
}

p {
    text-align: center;
}

</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand ps-3" href="#about.php">About Us</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Sales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pos.php">POS</a>
        </li>
    </ul>
</div>
</nav>
<div class="container mt-4">
<h1>Welcome to the POS Page</h1>
<p>Explore our features and offerings below:</p>

<div class="image-container">
    <img src="images/lechon_baboy.jpg" alt="Lechon Baboy" class="main-image">
    <p class="description">Lechon Baboy: A Filipino tradition, featuring a slow-roasted suckling pig stuffed with aromatic herbs and spices, offering a crispy and juicy delight.</p>

    <img src="images/lechon_baka.jpg" alt="Lechon Baka" class="main-image">
    <p class="description">Lechon Baka:Lechon Baka is a Filipino dish that involves roasting an entire cow or a large portion of beef over an open flame or in a large oven.</p>

    <img src="images/lechon_kambing.jpg" alt="Lechon Kambing" class="main-image">
    <p class="description">Lechon Kambing: Lechon Kambing is similar to Lechon Baka, but instead of beef, it uses goat meat. </p>

    <img src="images/lechon_paella.jpg" alt="Lechon Paella" class="main-image">
    <p class="description">Lechon Paella: Lechon Paella is a fusion dish that combines the traditional Filipino roasted pork (lechon) with the Spanish-inspired rice dish, paella.</p>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
