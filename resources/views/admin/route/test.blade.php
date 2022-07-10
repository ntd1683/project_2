<form action="{{route('admin.cities.store')}}" id="form-create-city" method="post">
    @csrf
    <div class="row form-row">
        <div class="col-12">
            <div class="form-group">
                <label>Tên Thành Phố</label>
                <select class="form-control" name="name" id="select-city">
                    <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                </select>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block"> Sửa Đổi</button>
    </div>
</form>
