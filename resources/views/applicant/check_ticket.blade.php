@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.toast.min.css')}}">
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #33313B !important;
            border: 0px !important;
            margin-left: 18px !important;
        }
    </style>
@endpush
@section('content')
    <section class="ftco-section" style="padding: 3em 0em 0em 0em !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Kiểm Tra Vé Xe</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="search-wrap-1 search-wrap-notop ftco-animate p-4">
                        <form action="{{route('applicant.booking')}}" class="search-property-1" method="get" id="form_check_ticket">
                            <div class="row">
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Số Điện Thoại</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="fas fa-phone" style="transform: rotate(90deg) scaleX(1);"></span></div>
                                            <input type="phone" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-items-end">
                                    <div class="form-group">
                                        <label for="#">Mã Vé</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="fas fa-ticket-alt"></span></div>
                                            <input type="text" name="code_ticket" id="code_ticket" class="form-control" placeholder="Nhập mã số vé">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg align-self-end">
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input type="submit" value="Kiểm Tra Vé" class="form-control btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pt" style="padding-bottom:0px !important;">
        <div class="container">
            <div class="row">
                <div class="col ftco-animate">
                    <div class="project-wrap">
                        <div class="check-ticket-row-4">
                            <div class="check-ticket-step-left">
                                <div class="check-ticket-step-1">Bước 1. Nhập thông tin vé</div>
                                <div class="check-ticket-step-image"><img
                                        src="https://static.vexere.com/Files/images/longvanlimousine/check-ticket-1.png"
                                        alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ftco-animate">
                    <div class="project-wrap">
                        <div class="check-ticket-step-right">
                            <div class="check-ticket-step-2">Bước 2. Kiểm tra vé</div>
                            <div class="check-ticket-step-image"><img
                                    src="https://static.vexere.com/Files/images/longvanlimousine/check-ticket-2.png"
                                    alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('js')
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        $(function() {
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            $.toast({
                heading: 'Error',
                text: '{{ $error }}',
                icon: 'error',
                position: 'top-right',
                showHideTransition: 'slide',
            });
            @endforeach
            @endif
            @if (session()->has('success'))
            $.toast({
                heading: 'Import Success',
                text: '{{session()->get('success')}}',
                icon: 'success',
                position: 'top-right',
                showHideTransition: 'slide',
            });
            @endif
            @if (session()->has('error'))
            $.toast({
                heading: 'Error',
                text: '{{session()->get('error')}}',
                icon: 'error',
                position: 'top-right',
                showHideTransition: 'slide',
            });
            @endif
        });
    </script>
@endpush
@endsection
