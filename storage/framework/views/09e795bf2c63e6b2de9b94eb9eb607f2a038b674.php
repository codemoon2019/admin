<!DOCTYPE html>
<html lang="en">
  
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e('Pure Happilife Admin'); ?></title>
    <!--favicon-->
    <!--<link rel="icon" href="<?php echo e(config('app.url')); ?>images/favicon-32x32.png" type="image/png"/>-->
    <?php echo $__env->make('incs.header_file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<!--header-->
		<header class="top-header">
			<nav class="navbar navbar-expand">
				<div class="left-topbar d-flex align-items-center">
					<a href="javaScript:;" class="toggle-btn">	<i class="bx bx-menu"></i>
					</a>
					<div class="">
						<img src="<?php echo e(config('app.url')); ?>images/logo.png" class="logo-icon" alt="">
					</div>
				</div>
				<div class="flex-grow-1 search-bar">
				</div>
				<div class="right-topbar ml-auto">
					<ul class="navbar-nav">
						<li class="nav-item dropdown dropdown-lg">
							<div class="dropdown-menu dropdown-menu-right">
							
								<div class="header-message-list">
								
								</div>
								<a href="javaScript:;">
									<div class="text-center msg-footer">View All Messages</div>
								</a>
							</div>
                        </li>
                        
						<li class="nav-item dropdown dropdown-lg">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javaScript:;" data-toggle="dropdown">	<i class="bx bx-bell vertical-align-middle"></i>
								<!--<span class="msg-count">8</span>-->
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="javaScript:;">
									<div class="msg-header">
										<!--<h6 class="msg-header-title">8 New</h6>-->
										<p class="msg-header-subtitle">Application Notifications</p>
									</div>
								</a>
								<div class="header-notifications-list">

									<a class="dropdown-item" href="javaScript:;">
										<div class="media align-items-center">
											<div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
											</div>
											<div class="media-body">
												<h6 class="msg-name">New Orders <span class="msg-time float-right">2 min
													ago</span></h6>
												<p class="msg-info">You have recived new orders</p>
											</div>
										</div>
									</a>
									

								</div>
								<a href="/notification">
									<div class="text-center msg-footer">View All Notifications</div>
								</a>
							</div>
						</li>
						<li class="nav-item dropdown dropdown-user-profile">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javaScript:;" data-toggle="dropdown">
								<div class="media user-box align-items-center">
									<div class="media-body user-info">
										<p class="user-name mb-0"><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?></p>
										<p class="designattion mb-0"><?php echo e(auth()->user()->userType->description); ?></p>
									</div>
									<img src="<?php echo e(auth()->user()->profile_picture_url == '' ? 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' : config('app.url').auth()->user()->profile_picture_url); ?> " class="user-img avatar" alt="user avatar">
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">	<a class="dropdown-item" href="/my-profile"><i
										class="bx bx-user"></i><span>Profile</span></a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!--end header-->
		<!--page-wrapper-->
		<div class="page-wrapper">
			<!--sidebar-wrapper-->
			<div class="sidebar-wrapper" data-simplebar="true">
				<div class="sidebar-header">
					<a href="javaScript:;" class="toggle-btn"> <i class="bx bx-menu"></i>
					</a>
					<div class="">
						<img src="<?php echo e(config('app.url')); ?>images/logo.png" class="logo-icon-2" alt="" />
					</div>
				</div>
				
				<?php if(auth()->user()->user_type == 1): ?>
					<!--navigation-->
					<ul class="metismenu" id="menu">
						<li class="menu-label">Dashboard</li>
						<li>
							<a href="/">
								<div class="parent-icon"><i class="bx bx-home"></i>
								</div>
								<div class="menu-title">Home</div>
							</a>
						</li>
						<li>
							<a class="has-arrow" href="javaScript:;">
								<div class="parent-icon"><i class="bx bx-file"></i>
								</div>
								<div class="menu-title">Orders</div>
							</a>
							<ul class="">
								<li> <a href="/order/new"><i class="bx bx-right-arrow-alt"></i>Order list</a> </li>
								<!--<li> <a href="/order/history"><i class="bx bx-right-arrow-alt"></i>Order history</a> </li>-->
							</ul>
						</li>
						<li>
							<a class="has-arrow" href="javaScript:;">
								<div class="parent-icon"><i class="bx bx-package"></i>
								</div>
								<div class="menu-title">Products</div>
							</a>
							<ul class="">
								<li> <a href="/product/create-product"><i class="bx bx-right-arrow-alt"></i>Create products</a> </li>
								<li> <a href="/product/inventory"><i class="bx bx-right-arrow-alt"></i>Product Inventory</a> </li>
							</ul>
						</li>
						<li>
							<a href="/system/system-users">
								<div class="parent-icon"><i class="bx bx-group"></i>
								</div>
								<div class="menu-title">System Users</div>
							</a>
						</li>
						<li>
							<a href="/system/driver">
								<div class="parent-icon"><i class="bx bx-grid-alt"></i>
								</div>
								<div class="menu-title">Driver</div>
							</a>
						</li>
						<li>
							<a href="/system/website-blogs">
								<div class="parent-icon"><i class="bx bx-message-square-detail"></i>
								</div>
								<div class="menu-title">Website Blogs</div>
							</a>
						</li>
						<li>
							<a href="/system/emails">
								<div class="parent-icon"><i class="bx bx-envelope"></i>
								</div>
								<div class="menu-title">Emails</div>
							</a>
						</li>
						<li>
							<a href="/system/signup-emails">
								<div class="parent-icon"><i class="bx bx-envelope"></i>
								</div>
								<div class="menu-title">Signup Emails</div>
							</a>
						</li>
						<li>
							<a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<div class="parent-icon"><i class="bx bx-power-off"></i>
								</div>
								<div class="menu-title">Sign Out</div>
							</a>
							<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
								<?php echo e(csrf_field()); ?>

							</form>
						</li>
					</ul>
					<!--end navigation-->
				<?php endif; ?>

				<?php if(auth()->user()->user_type == 2): ?>
					<!--navigation-->
					<ul class="metismenu" id="menu">
						<li class="menu-label">Account</li>
						<li>
							<a href="/">
								<div class="parent-icon"><i class="bx bx-home"></i>
								</div>
								<div class="menu-title">My Task</div>
							</a>
						</li>
						<li>
							<a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-driver').submit();">
								<div class="parent-icon"><i class="bx bx-power-off"></i>
								</div>
								<div class="menu-title">Sign Out</div>
							</a>
							<form id="logout-form-driver" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
								<?php echo e(csrf_field()); ?>

							</form>
						</li>
					</ul>
					<!--end navigation-->
				<?php endif; ?>

			</div>
			<!--end sidebar-wrapper--><?php /**PATH C:\Users\Rhom\Desktop\al files\purefolder\purehappilifeadmin\resources\views/incs/header.blade.php ENDPATH**/ ?>