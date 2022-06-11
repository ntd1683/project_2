@extends('admin.layout.master')
@push('css')
    <link rel="stylesheet" href="{{asset('js1/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css1/bootstrap-datetimepicker.min.css')}}">
@endpush
@section('content')
    <div class="page-header">
        <div class="row" style="position:relative">
            <div class="col-auto text-right" style="
    position: absolute;
    right: 0;
    top: -61px;
">
                <a class="btn btn-white filter-btn" href="javascript:void(0);" id="filter_search">
                    <i class="fas fa-filter"></i>
                </a>
            </div>
        </div>
    </div>
    {{--  Fillter  --}}
    <div class="card filter-card" id="filter_inputs">
        <div class="card-body pb-0">
            <form>
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>Provider</label>
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>From Date</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label>To Date</label>
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Filter --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0 datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Provider Name</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Reg Date</th>
                                <th>Subscription</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-01.jpg">
                                        </a>
                                        <a href="#">Thomas Herzberg</a>
                                    </h2>
                                </td>
                                <td>832-212-0082</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="8afee2e5e7ebf9e2eff8f0e8eff8edcaeff2ebe7fae6efa4e9e5e7">[email&#160;protected]</a>
                                </td>
                                <td>12 Sep 2020</td>
                                <td>Enterprice</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-02.jpg">
                                        </a>
                                        <a href="#">Matthew Garcia</a>
                                    </h2>
                                </td>
                                <td>918-454-4561</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="3a575b4e4e525f4d5d5b4859535b7a5f425b574a565f14595557">[email&#160;protected]</a>
                                </td>
                                <td>7 Sep 2020</td>
                                <td>Standard</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-03.jpg">
                                        </a>
                                        <a href="#">Yolanda Potter</a>
                                    </h2>
                                </td>
                                <td>360-281-3619</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="cbb2a4a7aaa5afaabba4bfbfaeb98baeb3aaa6bba7aee5a8a4a6">[email&#160;protected]</a>
                                </td>
                                <td>20 Aug 2020</td>
                                <td>Basic</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-04.jpg">
                                        </a>
                                        <a href="#">Ricardo Flemings</a>
                                    </h2>
                                </td>
                                <td>631-374-3243</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="12607b717360767d747e777f7b7c756152776a737f627e773c717d7f">[email&#160;protected]</a>
                                </td>
                                <td>15 Aug 2020</td>
                                <td>Standard</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-05.jpg">
                                        </a>
                                        <a href="#">Maritza Wasson</a>
                                    </h2>
                                </td>
                                <td>979-844-9766</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="4825293a213c32293f293b3b2726082d30292538242d662b2725">[email&#160;protected]</a>
                                </td>
                                <td>1 Aug 2020</td>
                                <td>Basic</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-06.jpg">
                                        </a>
                                        <a href="#">Marya Ruiz</a>
                                    </h2>
                                </td>
                                <td>814-537-9709</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="660b07141f0714130f1c26031e070b160a034805090b">[email&#160;protected]</a>
                                </td>
                                <td>24 Jul 2020</td>
                                <td>Enterprice</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-07.jpg">
                                        </a>
                                        <a href="#">Richard Hughes</a>
                                    </h2>
                                </td>
                                <td>937-846-6789</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="e7958e848f8695838f92808f8294a7829f868a978b82c984888a">[email&#160;protected]</a>
                                </td>
                                <td>21 Jul 2020</td>
                                <td>Standard</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-08.jpg">
                                        </a>
                                        <a href="#">Nina Wilson</a>
                                    </h2>
                                </td>
                                <td>419-523-6835</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="630d0a0d02140a0f100c0d23061b020e130f064d000c0e">[email&#160;protected]</a>
                                </td>
                                <td>7 Jul 2020</td>
                                <td>Basic</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-09.jpg">
                                        </a>
                                        <a href="#">David Morrison</a>
                                    </h2>
                                </td>
                                <td>703-214-9351</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="a4c0c5d2cdc0c9cbd6d6cdd7cbcae4c1dcc5c9d4c8c18ac7cbc9">[email&#160;protected]</a>
                                </td>
                                <td>30 Jun 2020</td>
                                <td>Enterprice</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" alt=""
                                                 src="assets/img/provider/provider-10.jpg">
                                        </a>
                                        <a href="#">Linda Brooks</a>
                                    </h2>
                                </td>
                                <td>512-243-2686</td>
                                <td><a href="https://truelysell-admin.dreamguystech.com/cdn-cgi/l/email-protection"
                                       class="__cf_email__"
                                       data-cfemail="afc3c6c1cbcecdddc0c0c4dcefcad7cec2dfc3ca81ccc0c2">[email&#160;protected]</a>
                                </td>
                                <td>28 Jun 2020</td>
                                <td>Basic</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
        </script>
    @endpush
@endsection
