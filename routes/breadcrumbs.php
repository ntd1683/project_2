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

//Trang Chủ > Nhân viên > Chỉnh sửa
Breadcrumbs::for('edit_user', function ($trail, $user) {
    $trail->parent('user');
    $trail->push('Sửa', route('admin.users.edit', $user->id));
});

//Trang Chủ > Nhân viên > Trang Cá Nhân
Breadcrumbs::for('show_user', function ($trail) {
    $trail->parent('home');
    $trail->push('Trang Cá Nhân', route('admin.profile'));
});

// Trang Chủ > Lịch Trình
Breadcrumbs::for('route', function ($trail) {
    $trail->parent('home');
    $trail->push('Tuyến Đi', route('admin.routes.index'));
});
