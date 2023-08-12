@extends('admin.layouts.app')
@section('title')
    <title>
        Go party | admin | Packages</title>
@endsection
@section('left_part')
    @include('admin.includes.left_part')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style type="text/css">
        .modal-backdrop {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1030;
            background-color: #333333;
            opacity: 0.4;
        }

        table.dataTable tbody tr {
            background-color: #eee7ef;
        }
    </style>
@endsection
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Package List </h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Go party</a></li>
                            <li class="active">Packages</li>
                        </ol>
                    </div>
                </div>

                <div class="clearfix"></div>
                <!-- Start Widget -->
                <div class="row">
                    <div class="col-md-12">

                        <div class="clearfix"></div>
                        <div class="panel panel-default">
                            <div class="panel-heading rm02 rm04">
                                <div class="add-btn "><a href="{{ route('admin.packages.create') }}"><i
                                            class="icofont-plus-circle"></i> Add Packages</a></div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table id="example" class="cell-border">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">id</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Package Name</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Unit</th>
                                                        <th scope="col">status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($packages as $key => $package)
                                                    @php
                                                        $services = [];
                                                        foreach($package->packagesToService as $packagesToService)
                                                        {
                                                            $service = DB::table('services')->where('id', $packagesToService->service_id)->first()->service;
                                                            $services[] = $service;
                                                        }
                                                    @endphp
                                                        <tr>
                                                            <td data-label="Name">{{ @$package->id }}</td>

                                                            <td data-label="Name">{{ implode(",",$services) }}</td>
                                                            <td data-label="Name">{{ @$package->name }}</td>

                                                            <td data-label="Name">{{ @$package->price }}</td>
                                                            <td data-label="Name">{{ @$package->unit }}</td>
                                                            <td data-label="Mail ID">
                                                                @if (@$package->status == 'A')
                                                                    <p>Active</p>
                                                                @else
                                                                    <p>Deactive</p>
                                                                @endif
                                                            </td>
                                                            <td class="rm07">
                                                                <a href="javascript:void(0);" class="action-dots"
                                                                    id="action{{ $package->id }}"><img
                                                                        src="{{ url('/') }}/public/vandorAgentJsCss/assets/images/action-dots.png"
                                                                        alt=""
                                                                        onclick="fun({{ $package->id }})"></a>
                                                                <div class="show-actions"
                                                                    id="show-action{{ $package->id }}"
                                                                    style="display: none;"> <span class="angle"><img
                                                                            src="{{ url('/') }}/public/vandorAgentJsCss/assets/images/angle.png"
                                                                            alt=""></span>
                                                                    <ul>
                                                                        @if (@$package->status == 'A')
                                                                            <li><a
                                                                                    href="{{ route('admin.packages.deactive', $package->id) }}">Deactive</a>
                                                                            </li>
                                                                        @else
                                                                            <li><a
                                                                                    href="{{ route('admin.packages.active', $package->id) }}">Active</a>
                                                                            </li>
                                                                        @endif
                                                                        <li><a
                                                                                href="{{ route('admin.packages.edit', $package->id) }}">Edit</a>
                                                                        </li>
                                                                        <li><a  href="#" data-toggle="modal" data-target="#myModalview{{$package->id}}">View</a></li>
                                                                        <li><a onclick="return confirm('Are you sure want to delete this Package ?')"
                                                                                href="{{ route('admin.packages.delete', $package->id) }}">Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        <div class="modal" id="myModalview{{@$package->id}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Details of Package : {{@$package->name}}</h4>

                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">

                                                                        <h5>Services </h5>
                                                                        <p>{{ implode(",",$services) }}</p>

                                                                        <h5>Package Name </h5>
                                                                        <p>{{@$package->name}}</p>

                                                                        <h5>Service Image </h5>
                                                                        <em><img src="{{url('/')}}/storage/app/public/packages/{{@$package->image}}" alt="" style="width: 150px !important; height: 150px !important"></em>


                                                                        <h5> Status </h5>
                                                                        <p>@if(@$package->status=="A")
                                                                            <p>Active</p>
                                                                            @else
                                                                            <p>Deactive</p>
                                                                        @endif</p>

                                                                        <h5> Price </h5>
                                                                        <p>{{@$package->price}}</p>

                                                                        <h5> Discount Price </h5>
                                                                        <p>{{@$package->discount_price}}</p>

                                                                        <h5> Unity </h5>
                                                                        <p>{{@$package->unit}}</p>

                                                                        <h5>Created Date </h5>
                                                                        <p>{{@$package->created_at}}</p>

                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">


                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- container -->
        </div>
        <!-- content -->
    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
@section('footer')
    {{-- @include('admin.includes.footer') --}}
@endsection
@endsection
{{-- end content --}}
@section('script')
@include('admin.includes.script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    oTable = $('#example').DataTable({
        "bSort": true
    });
    $('#myInputTextField').keyup(function() {
        oTable.search($(this).val()).draw();
    })
</script>
<script>
    var resizefunc = [];
</script>
<script>
    function fun(id) {
        $('.show-actions').slideUp();
        $("#show-action" + id).show();
    }

    function Cancel(id) {
        $("#show-action" + id).hide();
    }
    $(document).mouseup(function(e) {
        var container = $(".show-actions");
        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });
</script>
@endsection
