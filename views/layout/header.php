<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <script type="text/javascript" src="<?=base_url?>client/js/index.js" defer></script>
    <title>Ecommerce</title>
</head>
<body>
<div class="page-container">
    <div id="content-wrap">
    <!-- Header  -->
    <header class="header">
         <div class="main-header">
             <div class="ecommerce-menu">
                <div class="logo">
                    <h2><a href="<?=base_url?>">LOGO</a></h2>
                </div>
                <div class="menu-items">
                    <?php $categories = Utils::showCategories(); 
                        while($category = $categories->fetch_object()): ?>
                        <p><a href="<?=base_url?>category/display&id=<?=$category->id;?>"><?=$category->name?></a></p>
                        <?php endwhile;?>                                    
                </div>
             </div>
             <div class="user-menu">
                 <div class="user-profile">
                    <?php if(isset($_SESSION['identity'])): ?>
                    <i class="user far fa-user"></i>
                    <?php else: ?>
                        <i class="user far fa-user hidden"></i>
                    <?php endif; ?>
                    <div class="profile-hover-menu hidden">
                        <ul>
                            <?php if(isset($_SESSION['admin'])): ?>
                                <li><a href="<?=base_url?>category/index">Manage Categories</a> </li>
                                <li><a href="<?=base_url?>product/manage">Manage Products</a> </li>
                                <li><a href="<?=base_url?>order/manage">Manage Orders</a></li>
                                <?php endif; ?>
                                <li><a href="<?=base_url?>order/myOrders">My orders</a></li>
                            <li><a href="<?=base_url?>user/logout">Log out</a></li>
                        </ul>
                    </div>
                 </div>
                 
                 <div class="login">
                    <?php if(isset($_SESSION['identity'])): ?>
                        <p>Welcome, <?=$_SESSION['identity']->first_name?>!</p>
                    <?php else: ?>
                    <p>Login</p>
                    <?php endif; ?>
                </div>
                <div class="search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="favorites">
                    <i class="far fa-heart"></i>
                </div>
                <div class="cart">
                    <?php $cartPath = base_url."cart/index"; ?>
                    <a href="<?=$cartPath?>"><i class="fas fa-shopping-cart"></i></a>                    
                </div>
             </div>
         </div>
    </header>