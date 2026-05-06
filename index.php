<?php
// Configuration
$siteConfig = [
    'name' => 'zeyu butyy',
    'tagline' => 'K-Beauty Redefined',
    'email' => 'hello@zeyubutyy.com',
    'whatsapp' => '0798751265',
    'instagram' => 'zeinah_3345',
    'location' => 'Dubai, UAE'
];

// Products with Korean-inspired aesthetics (only products with images)
$products = [
    [
        'id' => 1,
        'name' => 'Glass Skin Serum',
        'description' => 'Achieve that coveted Korean glass skin',
        'price' => 45.00,
        'image' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=600&h=600&fit=crop',
        'category' => 'skincare',
        'badge' => 'BESTSELLER',
        'color' => '#FFB6C1'
    ],
    [
        'id' => 2,
        'name' => 'Velvet Lip Tint',
        'description' => 'Long-lasting gradient lips',
        'price' => 28.00,
        'image' => 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=600&h=600&fit=crop',
        'category' => 'makeup',
        'badge' => 'NEW',
        'color' => '#FF6B9D'
    ],
    [
        'id' => 3,
        'name' => 'Snail Mucin Essence',
        'description' => 'Deep hydration & repair',
        'price' => 38.00,
        'image' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=600&h=600&fit=crop',
        'category' => 'skincare',
        'badge' => 'VIRAL',
        'color' => '#C8B8FF'
    ],
    [
        'id' => 4,
        'name' => 'Cushion Foundation',
        'description' => 'Dewy finish SPF 50+',
        'price' => 42.00,
        'image' => 'https://images.unsplash.com/photo-1631730494960-9a8b0815b76a?w=600&h=600&fit=crop',
        'category' => 'makeup',
        'badge' => 'HOT',
        'color' => '#FFD4A3'
    ],
    [
        'id' => 5,
        'name' => 'Cherry Blossom Toner',
        'description' => 'Brightening & soothing',
        'price' => 32.00,
        'image' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfbc8?w=600&h=600&fit=crop',
        'category' => 'skincare',
        'badge' => '',
        'color' => '#FFB3D9'
    ],
    [
        'id' => 6,
        'name' => '9-Color Palette',
        'description' => 'Korean gradient eyeshadow',
        'price' => 48.00,
        'image' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=600&h=600&fit=crop',
        'category' => 'makeup',
        'badge' => 'LIMITED',
        'color' => '#E5D4FF'
    ]
];

// Gallery images
$galleryImages = [
    'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&h=400&fit=crop',
    'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=400&h=400&fit=crop',
    'https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?w=400&h=400&fit=crop',
    'https://images.unsplash.com/photo-1515688594390-b649af70d282?w=400&h=400&fit=crop'
];

$messageSent = false;
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        $messageSent = true;
    } else {
        $errorMessage = 'Please fill in all fields';
    }
}

$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

// Filter products: by category AND must have images
$filteredProducts = array_filter($products, function($p) use ($selectedCategory) {
    $hasImage = !empty($p['image']);
    $correctCategory = $selectedCategory === 'all' || $p['category'] === $selectedCategory;
    return $hasImage && $correctCategory;
});

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo $siteConfig['name']; ?> | <?php echo $siteConfig['tagline']; ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #FF6B9D;
      --secondary: #C8B8FF;
      --accent: #FFD4A3;
      --dark: #1A1A2E;
      --light: #FFF5F7;
      --glass-bg: rgba(255, 255, 255, 0.1);
      --glass-border: rgba(255, 255, 255, 0.2);
      --shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body {
      font-family: 'Space Grotesk', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #ffd4a3 100%);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
      color: var(--dark);
      overflow-x: hidden;
      min-height: 100vh;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Floating shapes */
    .floating-shapes {
      position: fixed;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
      pointer-events: none;
    }
    .shape {
      position: absolute;
      opacity: 0.1;
      animation: float 20s infinite;
    }
    .shape:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
    .shape:nth-child(2) { top: 70%; left: 80%; animation-delay: 5s; }
    .shape:nth-child(3) { top: 40%; left: 90%; animation-delay: 10s; }
    .shape:nth-child(4) { top: 80%; left: 20%; animation-delay: 15s; }
    
    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      33% { transform: translateY(-30px) rotate(120deg); }
      66% { transform: translateY(30px) rotate(240deg); }
    }

    /* Glassmorphism Header */
    header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      padding: 1.5rem 3rem;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--glass-border);
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.4s ease;
    }
    header.scrolled {
      padding: 1rem 3rem;
      background: rgba(255, 255, 255, 0.15);
      box-shadow: var(--shadow);
    }

    .logo {
      font-family: 'Syne', sans-serif;
      font-size: 2rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-decoration: none;
      position: relative;
    }
    .logo::after {
      content: '✨';
      position: absolute;
      right: -30px;
      top: 0;
      animation: sparkle 2s infinite;
    }
    @keyframes sparkle {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.5; transform: scale(1.2); }
    }

    nav {
      display: flex;
      gap: 2.5rem;
      align-items: center;
    }
    nav a {
      color: var(--dark);
      text-decoration: none;
      font-weight: 600;
      font-size: 0.95rem;
      position: relative;
      transition: all 0.3s;
    }
    nav a::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      transition: width 0.3s;
    }
    nav a:hover::after {
      width: 100%;
    }

    /* Hero Section - Korean Style */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 8rem 2rem 4rem;
      position: relative;
      z-index: 1;
    }
    .hero-content {
      max-width: 1400px;
      width: 100%;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }
    .hero-text h1 {
      font-family: 'Syne', sans-serif;
      font-size: 5rem;
      font-weight: 800;
      line-height: 1;
      margin-bottom: 1.5rem;
      background: linear-gradient(135deg, #fff 0%, var(--light) 50%, var(--accent) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    .hero-text p {
      font-size: 1.3rem;
      color: rgba(255,255,255,0.9);
      margin-bottom: 2.5rem;
      line-height: 1.6;
    }
    .location-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.7rem;
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      border: 2px solid var(--glass-border);
      padding: 0.8rem 1.5rem;
      border-radius: 50px;
      color: white;
      font-weight: 600;
      margin-bottom: 2rem;
      box-shadow: var(--shadow);
    }
    .cta-group {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
    }
    .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 1.2rem 3rem;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 700;
      font-size: 1.1rem;
      border: none;
      cursor: pointer;
      transition: all 0.4s;
      box-shadow: 0 10px 30px rgba(255,107,157,0.4);
      position: relative;
      overflow: hidden;
    }
    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
      transition: left 0.5s;
    }
    .btn-primary:hover::before {
      left: 100%;
    }
    .btn-primary:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(255,107,157,0.5);
    }
    .btn-secondary {
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      color: white;
      padding: 1.2rem 3rem;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 700;
      font-size: 1.1rem;
      border: 2px solid var(--glass-border);
      cursor: pointer;
      transition: all 0.4s;
    }
    .btn-secondary:hover {
      background: rgba(255,255,255,0.2);
      transform: translateY(-5px);
    }

    /* 3D Product Showcase */
    .hero-visual {
      position: relative;
      height: 600px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .floating-product {
      position: absolute;
      width: 300px;
      height: 300px;
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      border: 2px solid var(--glass-border);
      border-radius: 30px;
      box-shadow: var(--shadow);
      animation: floatProduct 6s ease-in-out infinite;
      overflow: hidden;
    }
    .floating-product img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .floating-product:nth-child(1) {
      top: 10%;
      left: 10%;
      animation-delay: 0s;
      z-index: 3;
    }
    .floating-product:nth-child(2) {
      top: 50%;
      right: 0;
      animation-delay: 2s;
      z-index: 2;
    }
    .floating-product:nth-child(3) {
      bottom: 10%;
      left: 20%;
      animation-delay: 4s;
      z-index: 1;
    }
    @keyframes floatProduct {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }

    /* Section Styles */
    .section {
      padding: 6rem 2rem;
      max-width: 1400px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }
    .section-header {
      text-align: center;
      margin-bottom: 4rem;
    }
    .section-tag {
      display: inline-block;
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      border: 2px solid var(--glass-border);
      padding: 0.6rem 1.5rem;
      border-radius: 50px;
      color: white;
      font-weight: 600;
      font-size: 0.9rem;
      margin-bottom: 1rem;
    }
    .section-title {
      font-family: 'Syne', sans-serif;
      font-size: 3.5rem;
      font-weight: 800;
      color: white;
      text-shadow: 0 10px 40px rgba(0,0,0,0.1);
      margin-bottom: 1rem;
    }
    .section-subtitle {
      color: rgba(255,255,255,0.9);
      font-size: 1.2rem;
    }

    /* Filter Buttons */
    .filter-container {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 3rem;
      flex-wrap: wrap;
    }
    .filter-btn {
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      border: 2px solid var(--glass-border);
      color: white;
      padding: 0.9rem 2rem;
      border-radius: 50px;
      cursor: pointer;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.4s;
      text-decoration: none;
      display: inline-block;
    }
    .filter-btn:hover, .filter-btn.active {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-color: transparent;
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(255,107,157,0.4);
    }

    /* Products Grid - Asymmetric Korean Style */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2.5rem;
    }
    .product-card {
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      border: 2px solid var(--glass-border);
      border-radius: 30px;
      overflow: hidden;
      transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      box-shadow: var(--shadow);
    }
    .product-card:nth-child(2n) {
      transform: translateY(30px);
    }
    .product-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: 0 20px 60px rgba(0,0,0,0.2);
      border-color: rgba(255,255,255,0.4);
    }
    .product-card:nth-child(2n):hover {
      transform: translateY(15px) scale(1.02);
    }
    .product-image-wrapper {
      position: relative;
      height: 350px;
      overflow: hidden;
      background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
    }
    .product-image-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s;
    }
    .product-card:hover .product-image-wrapper img {
      transform: scale(1.15);
    }
    .product-badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 0.5rem 1.2rem;
      border-radius: 50px;
      font-weight: 700;
      font-size: 0.8rem;
      z-index: 2;
      box-shadow: 0 5px 15px rgba(255,107,157,0.4);
    }
    .product-wishlist {
      position: absolute;
      top: 15px;
      right: 15px;
      width: 45px;
      height: 45px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
      z-index: 2;
    }
    .product-wishlist:hover {
      transform: scale(1.1);
      background: var(--primary);
      color: white;
    }
    .product-info {
      padding: 2rem;
    }
    .product-category {
      color: var(--primary);
      font-weight: 600;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 0.5rem;
    }
    .product-title {
      font-family: 'Syne', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: white;
      margin-bottom: 0.7rem;
    }
    .product-desc {
      color: rgba(255,255,255,0.8);
      font-size: 0.95rem;
      margin-bottom: 1.2rem;
      line-height: 1.5;
    }
    .product-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .product-price {
      font-family: 'Syne', sans-serif;
      font-size: 1.8rem;
      font-weight: 800;
      color: var(--accent);
    }
    .add-to-cart {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      border: none;
      padding: 1rem 2rem;
      border-radius: 50px;
      cursor: pointer;
      font-weight: 700;
      transition: all 0.4s;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .add-to-cart:hover {
      transform: scale(1.1);
      box-shadow: 0 10px 30px rgba(255,107,157,0.5);
    }

    /* Gallery - Masonry Style */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-auto-rows: 300px;
      gap: 1.5rem;
    }
    .gallery-item {
      border-radius: 20px;
      overflow: hidden;
      position: relative;
      cursor: pointer;
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      border: 2px solid var(--glass-border);
    }
    .gallery-item:nth-child(1) { grid-column: span 2; grid-row: span 2; }
    .gallery-item:nth-child(4) { grid-column: span 2; }
    .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s;
    }
    .gallery-item:hover img {
      transform: scale(1.1);
    }
    .gallery-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
      opacity: 0;
      transition: opacity 0.4s;
      display: flex;
      align-items: flex-end;
      padding: 2rem;
    }
    .gallery-item:hover .gallery-overlay {
      opacity: 1;
    }
    .gallery-text {
      color: white;
      font-family: 'Syne', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
    }

    /* Contact Section */
    .contact-wrapper {
      max-width: 800px;
      margin: 0 auto;
      background: var(--glass-bg);
      backdrop-filter: blur(30px);
      border: 2px solid var(--glass-border);
      border-radius: 40px;
      padding: 4rem;
      box-shadow: var(--shadow);
    }
    .form-group {
      margin-bottom: 2rem;
    }
    .form-group label {
      display: block;
      color: white;
      font-weight: 600;
      margin-bottom: 0.7rem;
      font-size: 1rem;
    }
    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 1.2rem;
      background: rgba(255,255,255,0.1);
      border: 2px solid var(--glass-border);
      border-radius: 15px;
      color: white;
      font-family: inherit;
      font-size: 1rem;
      transition: all 0.3s;
    }
    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--primary);
      background: rgba(255,255,255,0.15);
    }
    .form-group input::placeholder,
    .form-group textarea::placeholder {
      color: rgba(255,255,255,0.6);
    }
    .form-group textarea {
      min-height: 150px;
      resize: vertical;
    }

    /* Footer */
    footer {
      background: rgba(0,0,0,0.2);
      backdrop-filter: blur(20px);
      border-top: 1px solid var(--glass-border);
      padding: 4rem 2rem 2rem;
      text-align: center;
      position: relative;
      z-index: 1;
      margin-top: 6rem;
    }
    .footer-content {
      max-width: 1200px;
      margin: 0 auto;
    }
    .footer-logo {
      font-family: 'Syne', sans-serif;
      font-size: 2.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 1.5rem;
    }
    .social-links {
      display: flex;
      justify-content: center;
      gap: 1.5rem;
      margin: 2rem 0;
    }
    .social-links a {
      width: 55px;
      height: 55px;
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      border: 2px solid var(--glass-border);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.5rem;
      transition: all 0.4s;
      text-decoration: none;
    }
    .social-links a:hover {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      transform: translateY(-5px) rotate(360deg);
      border-color: transparent;
    }
    .contact-info {
      margin: 1.5rem 0;
      color: rgba(255,255,255,0.8);
    }
    .contact-info p {
      margin: 0.5rem 0;
    }
    .contact-info a {
      color: white;
      text-decoration: none;
      font-weight: 600;
    }
    .footer-text {
      color: rgba(255,255,255,0.7);
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid var(--glass-border);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .hero-content { grid-template-columns: 1fr; }
      .hero-visual { display: none; }
      .hero-text h1 { font-size: 3.5rem; }
      .products-grid { grid-template-columns: repeat(2, 1fr); }
      .gallery-grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 250px; }
      .gallery-item:nth-child(1), .gallery-item:nth-child(4) { grid-column: span 1; grid-row: span 1; }
    }
    @media (max-width: 768px) {
      header { padding: 1rem; }
      nav { gap: 1.5rem; }
      .hero-text h1 { font-size: 2.5rem; }
      .section-title { font-size: 2.5rem; }
      .products-grid { grid-template-columns: 1fr; }
      .product-card:nth-child(2n) { transform: translateY(0); }
      .contact-wrapper { padding: 2rem 1.5rem; }
      .gallery-grid { grid-template-columns: 1fr; }
    }

    /* Loading Animation */
    .loader {
      position: fixed;
      inset: 0;
      background: linear-gradient(135deg, #667eea, #764ba2);
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.5s;
    }
    .loader.hidden {
      opacity: 0;
      pointer-events: none;
    }
    .loader-text {
      font-family: 'Syne', sans-serif;
      font-size: 3rem;
      font-weight: 800;
      color: white;
      animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.5; transform: scale(0.95); }
    }
  </style>
</head>
<body>

  <!-- Loader -->
  <div class="loader" id="loader">
    <div class="loader-text"><?php echo $siteConfig['name']; ?></div>
  </div>

  <!-- Floating Shapes -->
  <div class="floating-shapes">
    <div class="shape">✨</div>
    <div class="shape">💫</div>
    <div class="shape">🌸</div>
    <div class="shape">✨</div>
  </div>

  <!-- Header -->
  <header id="header">
    <a href="#" class="logo"><?php echo $siteConfig['name']; ?></a>
    <nav>
      <a href="#products">Products</a>
      <a href="#gallery">Gallery</a>
      <a href="#contact">Contact</a>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <div class="location-badge">
          <i class="fas fa-map-marker-alt"></i>
          <span><?php echo $siteConfig['location']; ?></span>
        </div>
        <h1>K-Beauty Revolution</h1>
        <p>Discover the secret to glass skin and trend-setting makeup. Authentic Korean beauty products curated just for you.</p>
        <div class="cta-group">
          <a href="#products" class="btn-primary">
            <i class="fas fa-shopping-bag"></i> Shop Now
          </a>
          <a href="#contact" class="btn-secondary">
            <i class="fas fa-comment-dots"></i> Get In Touch
          </a>
        </div>
      </div>
      <div class="hero-visual">
        <div class="floating-product">
          <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&h=400&fit=crop" alt="Product">
        </div>
        <div class="floating-product">
          <img src="https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=400&h=400&fit=crop" alt="Product">
        </div>
        <div class="floating-product">
          <img src="https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=400&fit=crop" alt="Product">
        </div>
      </div>
    </div>
  </section>

  <!-- Products Section -->
  <section class="section" id="products">
    <div class="section-header">
      <div class="section-tag">✨ TRENDING NOW</div>
      <h2 class="section-title">Best Sellers</h2>
      <p class="section-subtitle">Handpicked Korean beauty favorites</p>
    </div>

    <div class="filter-container">
      <a href="?category=all" class="filter-btn <?php echo $selectedCategory === 'all' ? 'active' : ''; ?>">All</a>
      <a href="?category=skincare" class="filter-btn <?php echo $selectedCategory === 'skincare' ? 'active' : ''; ?>">Skincare</a>
      <a href="?category=makeup" class="filter-btn <?php echo $selectedCategory === 'makeup' ? 'active' : ''; ?>">Makeup</a>
    </div>

    <div class="products-grid">
      <?php if (empty($filteredProducts)): ?>
        <div style="grid-column: 1/-1; text-align: center; color: white; padding: 4rem; background: var(--glass-bg); backdrop-filter: blur(10px); border-radius: 30px; border: 2px solid var(--glass-border);">
          <i class="fas fa-box-open" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.5;"></i>
          <h3 style="font-family: 'Syne', sans-serif; font-size: 2rem; margin-bottom: 1rem;">No Products Available</h3>
          <p>Check back soon for new arrivals!</p>
        </div>
      <?php else: ?>
        <?php foreach ($filteredProducts as $product): ?>
        <div class="product-card">
          <div class="product-image-wrapper">
            <?php if (!empty($product['badge'])): ?>
            <span class="product-badge"><?php echo htmlspecialchars($product['badge']); ?></span>
            <?php endif; ?>
            <div class="product-wishlist">
              <i class="far fa-heart"></i>
            </div>
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name'] ?? 'Product'); ?>" loading="lazy">
          </div>
          <div class="product-info">
            <div class="product-category"><?php echo htmlspecialchars(ucfirst($product['category'])); ?></div>
            <h3 class="product-title"><?php echo htmlspecialchars($product['name'] ?? 'Product'); ?></h3>
            <p class="product-desc"><?php echo htmlspecialchars($product['description'] ?? ''); ?></p>
            <div class="product-footer">
              <span class="product-price">$<?php echo number_format($product['price'] ?? 0, 2); ?></span>
              <button class="add-to-cart" onclick="orderProduct('<?php echo htmlspecialchars($product['name'] ?? 'Product'); ?>')">
                <i class="fas fa-cart-plus"></i> Add
              </button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="section" id="gallery">
    <div class="section-header">
      <div class="section-tag">📸 INSTA WORTHY</div>
      <h2 class="section-title">Beauty Gallery</h2>
      <p class="section-subtitle">Real results, real beauty</p>
    </div>
    <div class="gallery-grid">
      <?php foreach ($galleryImages as $image): ?>
      <div class="gallery-item">
        <img src="<?php echo htmlspecialchars($image); ?>" alt="Gallery" loading="lazy">
        <div class="gallery-overlay">
          <div class="gallery-text">#zeyubutyy</div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="section" id="contact">
    <div class="section-header">
      <div class="section-tag">💌 LET'S TALK</div>
      <h2 class="section-title">Get In Touch</h2>
      <p class="section-subtitle">We'd love to hear from you</p>
    </div>
    <div class="contact-wrapper">
      <?php if ($messageSent): ?>
        <div style="background: rgba(76, 175, 80, 0.2); border: 2px solid #4caf50; padding: 1.5rem; border-radius: 15px; color: white; margin-bottom: 2rem; text-align: center;">
          <i class="fas fa-check-circle"></i> Message sent successfully!
        </div>
      <?php elseif ($errorMessage): ?>
        <div style="background: rgba(244, 67, 54, 0.2); border: 2px solid #f44336; padding: 1.5rem; border-radius: 15px; color: white; margin-bottom: 2rem; text-align: center;">
          <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($errorMessage); ?>
        </div>
      <?php endif; ?>
      
      <form method="POST" action="">
        <input type="hidden" name="contact_form" value="1">
        <div class="form-group">
          <label><i class="fas fa-user"></i> Your Name</label>
          <input type="text" name="name" required placeholder="Kim Minji" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        </div>
        <div class="form-group">
          <label><i class="fas fa-envelope"></i> Email</label>
          <input type="email" name="email" required placeholder="hello@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>
        <div class="form-group">
          <label><i class="fas fa-comment"></i> Message</label>
          <textarea name="message" required placeholder="Tell us what you're looking for..."><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">
          <i class="fas fa-paper-plane"></i> Send Message
        </button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <div class="footer-logo"><?php echo $siteConfig['name']; ?></div>
      <div class="contact-info">
        <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($siteConfig['location']); ?></p>
        <p><i class="fab fa-whatsapp"></i> <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $siteConfig['whatsapp']); ?>"><?php echo htmlspecialchars($siteConfig['whatsapp']); ?></a></p>
        <p><i class="fab fa-instagram"></i> <a href="https://instagram.com/<?php echo preg_replace('/[@\s]/', '', $siteConfig['instagram']); ?>" target="_blank">@<?php echo htmlspecialchars($siteConfig['instagram']); ?></a></p>
      </div>
      <div class="social-links">
        <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $siteConfig['whatsapp']); ?>" target="_blank" title="WhatsApp">
          <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://instagram.com/<?php echo preg_replace('/[@\s]/', '', $siteConfig['instagram']); ?>" target="_blank" title="Instagram">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="mailto:<?php echo htmlspecialchars($siteConfig['email']); ?>" title="Email">
          <i class="fas fa-envelope"></i>
        </a>
      </div>
      <p class="footer-text">
        &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($siteConfig['name']); ?>. All rights reserved.<br>
        <span style="font-size: 0.9rem;">Crafted with 💖 K-Beauty Love</span>
      </p>
    </div>
  </footer>

  <script>
    // Remove loader
    window.addEventListener('load', () => {
      setTimeout(() => {
        document.getElementById('loader').classList.add('hidden');
      }, 1500);
    });

    // Header scroll effect
    window.addEventListener('scroll', () => {
      const header = document.getElementById('header');
      if (window.scrollY > 100) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Order via WhatsApp
    function orderProduct(productName) {
      const message = `Hi! I'm interested in: ${productName} 💕`;
      const whatsappUrl = `https://wa.me/0798751265?text=${encodeURIComponent(message)}`;
      window.open(whatsappUrl, '_blank');
    }

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });

    // Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe elements
    document.querySelectorAll('.product-card, .gallery-item').forEach((el, index) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
      observer.observe(el);
    });

    // Wishlist toggle
    document.querySelectorAll('.product-wishlist').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.stopPropagation();
        const icon = this.querySelector('i');
        if (icon.classList.contains('far')) {
          icon.classList.remove('far');
          icon.classList.add('fas');
          this.style.background = '#FF6B9D';
          this.style.color = 'white';
        } else {
          icon.classList.remove('fas');
          icon.classList.add('far');
          this.style.background = 'white';
          this.style.color = '#FF6B9D';
        }
      });
    });
  </script>
</body>
</html>