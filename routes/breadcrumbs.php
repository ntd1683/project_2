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
    $trail->push('Danh sách xe', route('admin.carriages.index'));
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

// Trang Chủ > Chuyến xe
Breadcrumbs::for('buses', function ($trail) {
    $trail->parent('home');
    $trail->push('Chuyến xe', route('admin.buses.index'));
});

// Trang Chủ > Chuyến xe > Thêm
Breadcrumbs::for('buses.create', function ($trail) {
    $trail->parent('buses');
    $trail->push('Thêm', route('admin.buses.create'));
});

// Trang Chủ > Chuyến xe > Sửa
Breadcrumbs::for('buses.edit', function ($trail, $bus) {
    $trail->parent('buses');
    $trail->push('Sửa', route('admin.buses.edit', $bus->id));
});

// Trang Chủ > Vé xe
Breadcrumbs::for('ticket', function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý vé xe', route('admin.tickets.index'));
});

//Trang Chủ > Tuyến Xe > Thêm
Breadcrumbs::for('create_ticket', function ($trail) {
    $trail->parent('ticket');
    $trail->push('Thêm', route('admin.tickets.create'));
});

//Trang Chủ > Tuyến Xe > Chỉnh sửa
Breadcrumbs::for('edit_ticket', function ($trail, $ticket) {
    $trail->parent('ticket');
    $trail->push('Sửa', route('admin.tickets.edit', $ticket->id));
});

//Trang Chủ > Tuyến Xe > Xem
Breadcrumbs::for('show_ticket', function ($trail, $ticket) {
    $trail->parent('Ticket');
    $trail->push('Xem', route('admin.tickets.show', $ticket->id));
});
