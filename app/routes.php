<?php 


// Routes login and logout
$app->get('/', 'HomeController:index');
$app->post('/login', 'HomeController:login');
$app->post('/logout', 'HomeController:logout');

// Routes Setting
	// Menu
	$app->get('/sidemenu', 'generalControl:index');
	$app->get('/menu', 'generalControl:menu');
	$app->get('/get_parent_menu', 'generalControl:get_parent_menu');
	$app->post('/add_parent','generalControl:add_parent');
	$app->post('/edit_parent','generalControl:edit_parent');
	$app->post('/upd_parent','generalControl:upd_parent');
	$app->post('/del_parent','generalControl:del_parent');
	$app->get('/get_child_menu','generalControl:get_child_menu');
	$app->get('/chs_parent','generalControl:chs_parent');
	$app->post('/add_child','generalControl:add_child');
	$app->post('/edit_child','generalControl:edit_child');
	$app->post('/upd_child','generalControl:upd_child');
	$app->post('/del_child','generalControl:del_child');
	$app->get('/icon_info','generalControl:icon_info');

	// Headline
	$app->get('/headline','headlineControl:index');
	$app->get('/get_headline','headlineControl:get_headline');
	$app->post('/upd_status','headlineControl:upd_status');

//Routes Forms
	// Routes dashboard
	$app->get('/dashboard', 'dashboardControl:index');
	$app->post('/cont_slide', 'dashboardControl:cont_slide');
	$app->post('/get_post', 'dashboardControl:get_post');
	$app->post('/views_comment', 'dashboardControl:views_comment');
	$app->post('/post_comment', 'dashboardControl:post_comment');
	$app->post('/get_taxanomi_das', 'dashboardControl:taxonomomi_das');
	$app->get('/get_media', 'dashboardControl:get_media');
	$app->post('/count_comment', 'dashboardControl:count_comment');
	$app->post('/delete_comment', 'dashboardControl:delete_comment');
	$app->post('/button_like', 'dashboardControl:button_like');
	$app->get('/view_post', 'dashboardControl:view_post');
	$app->post('/t_view_post', 'dashboardControl:t_view_post');

	// Routes My Blog
	$app->post('/get_myblog', 'HomeController:get_myblog');
	$app->get('/myblog', 'HomeController:myblog');
	$app->post('/get_category', 'HomeController:get_category');
	$app->post('/post_blog', 'HomeController:post_blog');
	$app->post('/del_blog', 'HomeController:del_blog');
	$app->post('/edit_post', 'HomeController:edit_post');
	$app->post('/upd_blog', 'HomeController:upd_blog');
	$app->post('/uplFiles[/{id_post}]', 'HomeController:uplFiles');
	$app->get('/get_list_upl', 'HomeController:get_list_upl');
	$app->post('/delete_upl','HomeController:delete_upl');
	$app->get('/downFiles', 'HomeController:downFiles');
	$app->post('/coba_baseurl', 'HomeController:coba_baseurl');

//Routes My Profile
$app->get('/myprofile', 'myprofile:index');
$app->post('/get_profile', 'myprofile:get_profile');
$app->post('/upload_profile', 'myprofile:upload_profile');
$app->post('/change_foto', 'myprofile:change_foto');

// Routes Category
$app->get('/cat','categoryControl:index');
$app->post('/get_blog','categoryControl:get_blog');

// Routes Master Auth
$app->get('/auth', 'masterAuth:index');

//Routes UserAccount
$app->get('/user_account', 'UserAccount:index');
$app->post('/get_user', 'UserAccount:get_user');
$app->post('/update_status', 'UserAccount:update_status');
$app->post('/view_user', 'UserAccount:view_user');
$app->post('/edit_user', 'UserAccount:edit_user');
$app->post('/add_user', 'UserAccount:add_user');

// Others route
$app->get('/home','HomeController:home');
$app->get('/dt_tags', 'HomeController:dt_tags');
$app->get('/get_tags', 'HomeController:get_tags');