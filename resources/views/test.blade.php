<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }} @isset($title)
            - {{$title}}
        @endisset
    </title>
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.toast.min.css')}}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,700;1,100&display=swap');
    </style>

    <link rel="stylesheet" href="{{asset('plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    </style>
</head>
<body>

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


    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/jquery.toast.min.js')}}"></script>

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
            console.log(statistical_data);
            const obj = $("#form_statistical");
            const formData = new FormData(obj[0]);
            $.ajax({
                type:"POST",
                url: "{{route('api.RevenueTest')}}",
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
        });
    </script>
</body>
</html>
