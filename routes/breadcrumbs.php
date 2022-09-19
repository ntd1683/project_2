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
    $trail->push('Xe', route('admin.carriages.index'));
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
    $trail->push('Chuyến xe', route('admin.buses.calendar'));
});

// Trang Chủ > Chuyến xe > danh sách
Breadcrumbs::for('buses.index', function ($trail) {
    $trail->parent('buses');
    $trail->push('Danh sách', route('admin.buses.index'));
});

// Trang Chủ > Chuyến xe > Thêm
Breadcrumbs::for('buses.create', function ($trail) {
    $trail->parent('buses');
    $trail->push('Thêm', route('admin.buses.create'));
});

// Trang Chủ > Chuyến xe > Thêm nhanh
Breadcrumbs::for('buses.quickCreate', function ($trail) {
    $trail->parent('buses');
    $trail->push('Thêm nhanh', route('admin.buses.quickCreate'));
});

// Trang Chủ > Chuyến xe > Xóa nhanh
Breadcrumbs::for('buses.quickDelete', function ($trail) {
    $trail->parent('buses');
    $trail->push('Xóa nhanh', route('admin.buses.quickDelete'));
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

//Trang Chủ > Vé xe > Thêm
Breadcrumbs::for('create_ticket', function ($trail) {
    $trail->parent('ticket');
    $trail->push('Thêm', route('admin.tickets.create'));
});

//Trang Chủ > Vé xe > Chỉnh sửa
Breadcrumbs::for('edit_ticket', function ($trail, $ticket) {
    $trail->parent('ticket');
    $trail->push('Sửa', route('admin.tickets.edit', $ticket->id));
});

//Trang Chủ > Vé xe > Xem
Breadcrumbs::for('show_ticket', function ($trail, $ticket) {
    $trail->parent('ticket');
    $trail->push('Xem', route('admin.tickets.show', $ticket->id));
});

// Trang Chủ > Khách hàng
Breadcrumbs::for('customers', function ($trail) {
    $trail->parent('home');
    $trail->push('Khách hàng', route('admin.customers.index'));
});

//Trang Chủ > Khách hàng > Xem
Breadcrumbs::for('show', function ($trail, $customer) {
    $trail->parent('customers');
    $trail->push('Xem', route('admin.customers.show', $customer->id));
});

// Trang Chủ > Địa điểm đón - trả
Breadcrumbs::for('locations', function ($trail) {
    $trail->parent('home');
    $trail->push('Địa điểm đón - trả', route('admin.locations.index'));
});

//Trang Chủ > Địa điểm đón - trả > Thêm
Breadcrumbs::for('create_location', function ($trail) {
    $trail->parent('locations');
    $trail->push('Thêm', route('admin.locations.create'));
});

//Trang Chủ > Địa điểm đón - trả > Sửa
Breadcrumbs::for('edit_location', function ($trail, $location) {
    $trail->parent('locations');
    $trail->push('Sửa', route('admin.locations.edit', $location->id));
});
