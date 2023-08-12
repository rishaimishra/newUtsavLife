@extends('admin.layouts.app')
@section('title')
    <title>Go party | admin | Package edit</title>
@endsection
@section('left_part')
    @include('admin.includes.left_part')

    <link href="{{ URL::asset('public/croppie/croppie.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/croppie/croppie.min.css') }}" rel="stylesheet" />
    {{-- for datepicker --}}
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
@endsection
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <style type="text/css">
        .rm02 .form-group textarea {
            min-height: 70px;
        }

        .rm02 .form-group select,
        .rm02 .form-group input,
        .rm02 .form-group textarea {
            background: whitesmoke;
        }
    </style>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="wraper container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="pull-left page-title">Package edit </h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="{{ route('admin.dashboard') }}">Go party</a></li>
                            <li class="active"> Package edit </li>
                        </ol>
                    </div>
                </div>
                @include('admin.includes.message')

                <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <!-- Personal-Information -->
                            <div class="panel panel-default panel-fill">
                                <div class="panel-body rm02 rm04">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">edit Package</h3>
                                        <div class="add-btn "><a href="{{ route('admin.packages.list') }}"><i
                                                    class="icofont-minus-circle"></i> Back</a></div>
                                    </div>
                                    <form role="form" action="{{ route('admin.packages.update') }}" id="frm"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $package->id }}">
                                        <div class="form-group rm50">
                                            <label for="title">Service name</label>
                                            <select class="form-group select2" name="service_id[]" id="service_id" multiple>
                                                @foreach ($cat as $val)
                                                    <option value="{{ $val->id }}" @if(in_array($val->id,$services)) selected @endif> {{ $val->service }}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="clearfix"></div>
                                        <div class="form-group rm50">
                                            <label for="title">Package name</label>
                                            <input type="text" class="form-control" placeholder="Enter Package name"
                                                name="name" value="{{ $package->name }}">
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="form-group rm50">
                                            <label for="title">Package Description</label>
                                            <textarea class="form-control" placeholder="Enter Package description" id="editor" name="description">{{ $package->description }}</textarea>
                                        </div>


                                        <div class="clearfix"></div>
                                        <div class="form-group rm50">
                                            <label for="title">Price</label>
                                            <input type="number" class="form-control" placeholder="Enter Price"
                                                name="price" min="0" value="{{ $package->price }}">
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="form-group rm50">
                                            <label for="title">Discount Price</label>
                                            <input type="number" class="form-control" placeholder="Enter Discount Price"
                                                name="discount_price" min="0" value="{{ $package->discount_price }}">
                                        </div>


                                        <div class="clearfix"></div>
                                        <div class="form-group rm50">
                                            <label for="title">Unit</label>
                                            <input type="text" class="form-control" placeholder="Enter Discount Price"
                                                name="price_basis" value="{{ $package->unit }}">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="dynamic-fields-container">
                                            @if(count(explode(",",$package->video_url)) > 0)
                                            @foreach(explode(",",$package->video_url) as $index => $video_url)
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group rm50">
                                                        <label for="title">Video URL</label>
                                                        <input type="text" class="form-control" placeholder="Enter Video URL"
                                                            name="video_url[]" value="{{ $video_url }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    @if($index == 0)
                                                    <button type="button" class="btn btn-primary" style="margin-top:28px;" id="add-field-button">Add Field</button>
                                                    @else
                                                    <button type="button" class="btn btn-danger remove-field-button" style="margin-top:28px; background-color: red !important;">Remove</button>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group rm50">
                                                        <label for="title">Video URL</label>
                                                        <input type="text" class="form-control" placeholder="Enter Video URL"
                                                            name="video_url[]">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-primary" style="margin-top:28px;" id="add-field-button">Add Field</button>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group"style="margin-left: 30px !important;margin-top: 30px !important ">
                                            <label for="image">Thumbnail Image</label>
                                            <div class="clearfix"></div>
                                            <div class="fileUpload btn btn-primary cust_file clearfix">
                                                <span class="upld_txt"><i class="fa fa-upload upld-icon"
                                                        aria-hidden="true"></i>Upload Blog</span>
                                                <br>
                                                <input type="file" id="icon" name="image"
                                                    class="inputfile inputfile-1" accept="image/*">
                                                <input type="hidden" name="profile_picture" id="profile_picture">
                                            </div>

                                        </div>
                                        <div class="uplodimgfilimg ">
                                            <em><img src="" alt="" id="img2"></em>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <label for="">Additional Images</label>
                                            <input type="file" class="form-control" name="images[]" multiple>
                                        </div>
                                        {{--  <div class="form-group" style="margin-left: 30px;">
                                            <label for="Email">Previous Front Image</label>
                                            <div class="uplodimgfilimgs">
                                                @php
                                                    $explodeImages = explode(",",$package->image);
                                                @endphp
                                                @foreach($explodeImages as $image)
                                                <em><img src="{{ url('/') }}/storage/app/public/packages/{{ @$image }}"
                                                        alt=""
                                                        style="width: 150px !important; height: 150px !important"></em>
                                                @endforeach
                                            </div>
                                        </div>  --}}
                                        <div class="form-group" style="margin-left: 30px;">
                                            <label for="Email">Previous Thumbnail Image</label>
                                            <div class="uplodimgfilimgs">
                                                <em><img src="{{ url('/') }}/storage/app/public/packages/{{ @$package->image }}"
                                                        alt=""
                                                        style="width: 150px !important; height: 150px !important"></em>
                                            </div>
                                        </div>
                                        @if(!empty($package->additional_images))
                                        @php
                                            $explodeImages = explode(",",$package->additional_images);

                                        @endphp
                                        <div class="form-group" style="margin-left: 30px;">
                                            <label for="Email">Previous Additional Images</label>
                                            <div class="uplodimgfilimgs">
                                                @foreach($explodeImages as $image)
                                                <em><img src="{{ url('/') }}/storage/app/public/packages/{{ @$image }}"
                                                        alt=""
                                                        style="width: 150px !important; height: 150px !important"></em>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        <div class="clearfix"></div>
                                        <div class="col-lg-12" style="margin-top: 10px;">
                                            <button class="btn btn-primary waves-effect waves-light w-md"
                                                type="submit">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>
        <!-- content -->
        <div class="modal" tabindex="-1" role="dialog" id="croppie-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="croppie-div" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="crop-img">Save changes</button>
                        <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"
    integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg=="
    crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Replace 'editor' with the ID of your textarea element
        ClassicEditor.create(document.querySelector("#editor"))
            .then(editor => {
                console.log("CKEditor initialized successfully!");
            })
            .catch(error => {
                console.error("Error initializing CKEditor:", error);
            });
    });
</script>
<script>
    $(document).ready(function() {
        $('#frm').validate({
            rules: {

                service_id[]: {
                    required: true,
                },

                name: {
                    required: true,
                },

                description: {
                    required: true,
                },

                price: {
                    required: true,
                    min: 1,
                },

                discount_price: {
                    required: true,
                    min: 1,
                },

                price_basis: {
                    required: true,
                },

            },
            messages: {
                //  link:{
                //     required:" social link is mandatory",
                //     min:"Enter valid links"
                // }
            },

        });
    });
</script>
<script src="{{ URL::asset('public/croppie/croppie.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
{{-- blog front --}}
<script>
    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, {
            type: mime
        });
    }
    var uploadCrop;
    $(document).ready(function() {
        $(".js-example-basic-multiple").select2();
        if ($('.type').val() == 'C') {
            $(".s_h_hids").slideDown(0);
        } else {
            $(".s_h_hids").slideUp(0);
        }
        $(".ccllk02").click(function() {
            $(".s_h_hids").slideDown();
        });
        $(".ccllk01").click(function() {
            $(".s_h_hids").slideUp();
            $('.cmpy').val('');
        });
        $(".type-radio").change(function() {
            var t = $("input[name=type]:checked").val();
            if (t == "I") {
                $(".comany_name").css('display', 'none');
            } else {
                $(".comany_name").css('display', 'block');
            }
        });

        $('#croppie-modal').on('hidden.bs.modal', function() {
            uploadCrop.croppie('destroy');
        });
        $('#croppie-modal .close, #croppie-modal .close_btn').on('click', function() {
            $('#icon').val('');
        });
        $('#crop-img').click(function() {
            uploadCrop.croppie('result', {
                type: 'base64',
                format: 'png'
            }).then(function(base64Str) {
                $("#croppie-modal").modal("hide");
                //  $('.lds-spinner').show();
                let file = dataURLtoFile('data:text/plain;' + base64Str + ',aGVsbG8gd29ybGQ=',
                    'hello.png');
                console.log(file.mozFullPath);
                console.log(base64Str);
                // $('#file').val(base64Str);
                $('#profile_picture').val(base64Str);
                // $.each(file, function(i, f) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.uplodimgfilimg').append('<em><img  src="' + e.target.result +
                        '"><em>');
                };
                reader.readAsDataURL(file);
                //  });
                $('.uplodimgfilimg').show();
            });
        });

        $('#add-field-button').on('click', function() {
            addDynamicField();
        });

        function addDynamicField() {
            var dynamicField = $('<div class="row">'
                + '<div class="col-md-10">'
                + '<div class="form-group rm50">'
                + '<label for="title">Video URL</label>'
                + '<input type="text" class="form-control" placeholder="Enter Video URL" name="video_url[]" required>'
                + '</div>'
                + '</div>'
                + '<div class="col-md-2">'
                + '<button type="button" class="btn btn-danger remove-field-button" style="margin-top:28px; background-color: red !important;">Remove</button>'
                + '</div>'
                + '</div>');
            $('#dynamic-fields-container').append(dynamicField);
        }

        // Remove button click event (delegated to parent for dynamically added fields)
        $('#dynamic-fields-container').on('click', '.remove-field-button', function() {
            $(this).closest('.row').remove();
        });

    });
    $("#icon").change(function() {
        $('.uplodimgfilimg').html('');
        let files = this.files;
        console.log(files);
        let img = new Image();
        if (files.length > 0) {
            let exts = ['image/jpeg', 'image/png', 'image/gif'];
            let valid = true;
            $.each(files, function(i, f) {
                if (exts.indexOf(f.type) <= -1) {
                    valid = false;
                    return false;
                }
            });
            if (!valid) {
                alert('Please choose valid image files (jpeg, png, gif) only.');
                $("#icon").val('');
                return false;
            }
            // img.src = window.URL.createObjectURL(event.target.files[0])
            // img.onload = function () {
            //     if(this.width > 250 || this.height >160) {
            //         flag=0;
            //         alert('Please upload proper image size less then : 250px x 160px');
            //         $("#file").val('');
            //         $('.uploadImg').hide();
            //         return false;
            //     }
            // };
            $("#croppie-modal").modal("show");
            uploadCrop = $('.croppie-div').croppie({
                viewport: {
                    width: 530,
                    height: 320,
                    type: 'square'
                },
                boundary: {
                    width: $(".croppie-div").width(),
                    height: 400
                }
            });
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.upload-demo').addClass('ready');
                // console.log(e.target.result)
                uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            //  $('.uploadImg').append('<img width="100"  src="' + reader.readAsDataURL(this.files[0]) + '">');
            //  $.each(files, function(i, f) {
            //      var reader = new FileReader();
            //      reader.onload = function(e){
            //          $('.uploadImg').append('<img width="100"  src="' + e.target.result + '">');
            //      };
            //      reader.readAsDataURL(f);
            //  });
            //  $('.uploadImg').show();
        }
    });
</script>
@endsection
