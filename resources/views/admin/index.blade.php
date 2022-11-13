@extends('admin.layout.master')
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/datatables/datatables.min.css')}}">
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        #form_statistical {
            position: absolute;
            z-index: 99;
            top: 5px;
            left: 10px;
        }

        .class-statistical {
            padding: 5px;
            border: 0px;
            border-radius: 10px;
            background-color: #86DDF3;
            opacity: 0.8;
        }

        .class-statistical:hover {
            opacity: 1;
            cursor: pointer;
        }
        ul.pagination {
            margin-bottom: 1rem!important;
            justify-content: center!important;
        }

        tr{
            text-align:center;
        }

        h4.card-title{
            text-align:center;
        }
    </style>
@endpush
@section('content')
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
                                        <i class="far fa-user"></i>
                                    </span>
                                <div class="dash-widget-info">
                                    <h3>{{$customer_counters}}</h3><!-- Number user -->
                                    <h6 class="text-muted">Khách Hàng</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
{{--                                        <i class="fas fa-user-shield"></i>--}}
                                        <i class="fas fa-user-circle"></i>
                                    </span>
                                <div class="dash-widget-info">
                                    <h3>{{$driver_counters}}</h3>
                                    <h6 class="text-muted">Tài xế</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
                                        <i class="fas fa-car"></i>
                                    </span>
                                <div class="dash-widget-info">
                                    <h3>{{$car_counters}}</h3>
                                    <h6 class="text-muted">Xe</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-primary">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                <div class="dash-widget-info">
                                    <h3>${{$revenue}}</h3>
                                    <h6 class="text-muted">Doanh Thu</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">

                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">Top Khách Hàng </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center" id="table-customers-revenue">
                                    <thead>
                                    <tr>
                                        <th>Tên Khách Hàng</th>
                                        <th>Giới Tính</th>
                                        <th>Ngày Sinh</th>
                                        <th>Đã Chi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h4 class="card-title">Các Tuyến Phổ Biến</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center" id="table-route-commons">
                                    <thead>
                                    <tr>
                                        <th>Tên Tuyến</th>
                                        <th>Số Lượng Đơn Của Tuyến</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <figure class="highcharts-figure" style="position:relative">
                <form id="form_statistical"  onsubmit="return false">
                    @csrf
                    <select id="statistical" class="class-statistical" name="data">
                        <option value="1" selected>30 Ngày</option>
                        <option value="2">12 Tháng</option>
                    </select>
                    <button onclick="btn_statistical()" class="class-statistical">Duyệt</button>
                </form>
                <div id="container"></div>
            </figure>
@push('js')
    <script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- highchart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        var statistical_data = 1;
        var statistical_title = '30 ngày';
        function btn_statistical(){
            const statistical_select = document.getElementById('statistical');
            statistical_data = statistical_select.options[statistical_select.selectedIndex].value;
            if (statistical_data == 1) {
                statistical_title = '30 ngày';
            } else if (statistical_data == 2) {
                statistical_title = '12 tháng';
            }
            ajax_statistical();
        }

        function ajax_statistical(){

            console.log(statistical_title);
            const obj = $("#form_statistical");
            const formData = new FormData(obj[0]);
            console.log(statistical_data);
            $.ajax({
                type:"POST",
                url: "{{route('admin.bills.api.revenue')}}",
                data:formData,
                dataType: "json",
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                success: function (response) {
                    console.log('check');
                    const arrX = Object.keys(response);
                    const arrY = Object.values(response);
                    let title_hightchart = "Doanh thu " + statistical_title + " gần nhất" ;

                    Highcharts.chart('container', {

                        title: {
                            text: title_hightchart
                        },

                        yAxis: {
                            title: {
                                text: 'Doanh Thu'
                            }
                        },

                        xAxis: {
                            categories: arrX
                        },

                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },

                        plotOptions: {
                            series: {
                                label: {
                                    connectorAllowed: false
                                },
                            }
                        },

                        series: [{
                            name: 'Doanh thu',
                            data: arrY
                        }],

                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    legend: {
                                        layout: 'horizontal',
                                        align: 'center',
                                        verticalAlign: 'bottom'
                                    }
                                }
                            }]
                        }
                    });
                }
            });
        }
        $(document).ready(function () {
            ajax_statistical();
            console.log('chekc1');
            let table_customers_revenue = $('#table-customers-revenue').DataTable({
                destroy: true,
                dom: 'ltrp',
                lengthMenu:[5,10,15,30],
                select: true,
                processing: true,
                serverSide: true,
                order: [[3, 'desc']],
                ajax: '{!! route('admin.bills.api.customers_revenue') !!}',
                columns: [
                    {data: 'name_customer', name: 'name_customer'},
                    {data: 'gender_customer', name: 'gender_customer'},
                    {data: 'birthdate_customer', name: 'birthdate_customer'},
                    {data: 'revenue', name: 'revenue'},
                ],
            });
            let table_route_commons = $('#table-route-commons').DataTable({
                destroy: true,
                dom: 'ltrp',
                lengthMenu:[5,10,15],
                order: [[1, 'desc']],
                select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.tickets.api.route_commons') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'count', name: 'count'},
                ],
            });
            table_customers_revenue.draw();
            table_route_commons.draw();

            console.log('chekc2');
        });

    </script>
@endpush
@endsection
