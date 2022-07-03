<?php

// Trang chủ
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang Chủ', route('admin.index'));
});

// Trang Chủ > Nhân viên
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push('Nhân Viên', route('admin.users.show_users'));
});

//Trang Chủ > Nhân viên > Thêm
Breadcrumbs::for('create_user', function ($trail) {
    $trail->parent('user');
    $trail->push('Thêm', route('admin.users.create'));
});

Breadcrumbs::for('edit_user', function ($trail, $user) {
    $trail->parent('user');
    $trail->push('Sửa', route('admin.users.edit', $user->id));
});

//// Home > Blog
//Breadcrumbs::for('blog', function ($trail) {
//    $trail->parent('home');
//    $trail->push('Blog', route('blog'));
//});
//
//// Home > Blog > [Category]
//Breadcrumbs::for('category', function ($trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category->id));
//});
//
//// Home > Blog > [Category] > [Post]
//Breadcrumbs::for('post', function ($trail, $post) {
//    $trail->parent('category', $post->category);
//    $trail->push($post->title, route('post', $post->id));
//});
