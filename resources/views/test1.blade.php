<form action="{{route('test')}}" method="get">
    <input type="date" name="test3">
    <input type="text" name="test2">
    <select name="test1">
        <option value="step1">step1</option>
        <option value="step2">step2</option>
    </select>
    <button type="submit">Submit</button>
</form>

<div class="row">
    <form action="#">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tạo nhanh chuyến xe</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <h5 class="card-title">Thông tin tuyến đường</h5>
                            <div class="form-group row">
                                <div class="form-group col-lg-6">
                                    <label>Tuyến đi</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Tuyến về</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-lg-6">
                                    <label>Thời gian di chuyển</label>
                                    <input type="text" placeholder="Thời gian di chuyển" name="time_move" id="time-move"
                                        class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Khoảng cách</label>
                                    <input type="text" placeholder="Khoảng cách" name="" id=""
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-lg-12">
                                    <label>Xe không hoạt động 1 ngày trước tuần bắt đầu</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-lg-6">
                                    <label>Danh sách xe tuyến đi</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Danh sách xe tuyến về</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <h5 class="card-title">Thông tin thời gian</h5>
                            <div class="form-group row">
                                <label>Năm</label>
                                <div class="form-group">
                                    <select class="select col-md-12" id="year"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-lg-6">
                                    <label>Tuần bắt đầu</label>
                                    <div class="col-lg-12">
                                        <select class="select col-md-12" id="week-start"></select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Tuần kết thúc</label>
                                    <div class="col-lg-12">
                                        <select class="select col-md-12" id="week-end"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-lg-6">
                                    <label>Ngày bắt đầu</label>
                                    <div class="col-lg-12">
                                        <input type="text" placeholder="Ngày bắt đầu" name="date_start" id="date-start"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Ngày kết thúc</label>
                                    <div class="col-lg-12">
                                        <input type="text" placeholder="Ngày kết thúc" name="date_end" id="date-end"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label>Khoảng thời gian giữa 2 chuyến xe</label>
                                <div class="col-lg-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="col-md-12" type="text" id="time_two_buses" 
                                            style="height: 40px; border: 1px solid #ddd; text-align: center;"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-lg-6">
                                    <label>Giờ bắt đầu trong ngày</label>
                                    <div class="form-group">
                                        <input class="col-md-12" type="text" id="time_start_day"" 
                                        style="height: 40px; border: 1px solid #ddd; text-align: center;"> 
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Giờ kết thúc trong ngày</label>
                                    <div class="form-group">
                                        <input class="col-md-12" type="text" id="time_end_day"" 
                                        style="height: 40px; border: 1px solid #ddd; text-align: center;"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>