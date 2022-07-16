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

// Trang Chủ > Tuyến Xe
Breadcrumbs::for('route', function ($trail) {
    $trail->parent('home');
    $trail->push('Tuyến Xe', route('admin.routes.index'));
});

//Trang Chủ > Tuyến Xe > Thêm
Breadcrumbs::for('create_route', function ($trail) {
    $trail->parent('route');
    $trail->push('Thêm', route('admin.routes.create'));
});

//Trang Chủ > Tuyến Xe > Chỉnh sửa
Breadcrumbs::for('edit_route', function ($trail, $route) {
    $trail->parent('route');
    $trail->push('Sửa', route('admin.routes.edit', $route->id));
});

//Trang Chủ > Tuyến Xe > Xem chi tiết
Breadcrumbs::for('show_route', function ($trail, $route) {
    $trail->parent('route');
    $trail->push('Xem Chi Tiết', route('admin.routes.show', $route->id));
});

// Trang Chủ > Xe
Breadcrumbs::for('carriage', function ($trail) {
    $trail->parent('home');
    $trail->push('Danh sách xe', route('admin.carriages.show_cars'));
});

// Trang Chủ > Xe > Thêm
Breadcrumbs::for('carriage.create', function ($trail) {
    $trail->parent('carriage');
    $trail->push('Thêm', route('admin.carriages.create'));
});

// Trang Chủ > Xe > Sửa
Breadcrumbs::for('carriage.edit', function ($trail, $carriage) {
    $trail->parent('carriage');
    $trail->push('Sửa', route('admin.carriages.edit', $carriage->id));
});
