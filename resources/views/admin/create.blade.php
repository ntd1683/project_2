@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm Nhân Viên</h4>
                </div>
                <form>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tên</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Số điện thoại</label>
                                <div class="col-md-10">
                                    <input type="phone" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Giới tính</label>
                                <div class="col-md-10 d-inline-flex">
                                    <div class="radio me-3">
                                        <label>
                                            <input type="radio" name="radio" name="gender"> Nam
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="radio" name="gender"> Nữ
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Email</label>
                                <div class="col-md-10">
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Ngày sinh</label>
                                <div class="col-md-10">
                                    <input type="date" class="form-control" name="birthdate">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Chức Vụ</label>
                                <div class="col-md-10">
                                    <select class="form-control">
                                        <option value="-1" Selected>Tất Cả</option>
                                        @foreach($levels as $level=>$value)
                                            <option value="{{$value}}">{{$level}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="address">Địa Chỉ</label>
                                    <input type="text" class="form-control" name="address" id="address">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="district">Quận/Huyện/Thành Phố</label>
                                    <select class="form-control" name="district" id="district">
                                        <option>-- Select --</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>option 3</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="povince">Tỉnh</label>
                                    <select class="form-control" name="povince" id="povince">
                                        <option>-- Select --</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>option 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button class="btn btn-primary" type="submit">Thêm Nhân Viên</button>
                                <a href="{{route('admin.users.show_users')}}" class="btn btn-link">Quay Lại</a>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
