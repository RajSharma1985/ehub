@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Sub Topic</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('subtopic.update',$subtopic->_id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Topic <span style="color: red">*</span></label>
                                {{--<input type="text" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">--}}
                                <select class="form-control" name="topic_name">
                                    <option value="">Select Topic</option>
                                    @foreach($topics as $key=>$value)
                                        <option value="{{$value->_id}}" {{ ($subtopic->topic_id == $value->_id) ? 'selected' : '' }}>{{$value->topic_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('topic_name'))
                                    <div class="error">{{ $errors->first('topic_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Topic Name English <span style="color: red">*</span></label>
                                <input type="text" value="{{$subtopic->sub_topic_name_lang['en_us']}}" class="form-control required"  name="sub_topic_name_en_us" placeholder="Enter Sub Topic Name In English">
                                @if ($errors->has('sub_topic_name_en_us'))
                                    <div class="error">{{ $errors->first('sub_topic_name_en_us') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Topic Name Hindi <span style="color: red">*</span></label>
                                <input type="text" class="form-control required"  value="{{$subtopic->sub_topic_name_lang['hindi']}}" name="sub_topic_name_hindi" placeholder="Enter Sub Topic Name In Hindi">
                                @if ($errors->has('sub_topic_name_hindi'))
                                    <div class="error">{{ $errors->first('sub_topic_name_hindi') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Topic Description English <span style="color: red">*</span></label>
                                <textarea id="sub_topic_desc_en_us"  name="sub_topic_desc_en_us" placeholder="Enter Sub Topic Description In English" rows="10" cols="80">
                                    {{$subtopic->sub_topic_desc_lang['en_us']}}
                                </textarea>
                                @if ($errors->has('sub_topic_desc_en_us'))
                                    <div class="error">{{ $errors->first('sub_topic_desc_en_us') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Topic Description Hindi <span style="color: red">*</span></label>
                                <textarea id="sub_topic_desc_hindi"  name="sub_topic_desc_hindi" placeholder="Enter Sub Topic Description In " rows="10" cols="80">
                                {{$subtopic->sub_topic_desc_lang['hindi']}}
                                </textarea>
                                @if ($errors->has('sub_topic_desc_hindi'))
                                    <div class="error">{{ $errors->first('sub_topic_desc_hindi') }}</div>
                                @endif
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<div class="col-md-4 text-center">--}}

                            {{--<div id="upload-demo"></div>--}}

                            {{--</div>--}}

                            {{--<div class="col-md-4" style="padding:5%;">--}}
                            {{--<strong>Select image to crop:</strong>--}}
                            {{--<input type="file" id="image">--}}
                            {{--<button class="btn btn-primary btn-block upload-image" style="margin-top:2%">Upload Image</button>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4">--}}

                            {{--<div id="preview-crop-image" style="background:#9d9d9d;width:300px;padding:50px 50px;height:300px;"></div>--}}

                            {{--</div>--}}
                            {{--</div>--}}



                            <div class="form-group">
                                <label for="exampleInputEmail1">Status <span style="color: red">*</span></label>
                                {{--<input type="text" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">--}}
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    @foreach($status as $key=>$value)
                                        <option value="{{$key}}" {{ ($key == $subtopic->status) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <div class="error">{{ $errors->first('status') }}</div>
                                @endif
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

                <!-- /.box -->

            </div>

        </section>
        <!-- /.content -->
    </div>
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">--}}

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>--}}
    {{--<script type="text/javascript">--}}
    {{--$.ajaxSetup({--}}
    {{--headers: {--}}
    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--}--}}

    {{--});--}}
    {{--var resize = $('#upload-demo').croppie({--}}
    {{--enableExif: true,--}}
    {{--enableOrientation: true,--}}
    {{--viewport: {--}}
    {{--width: 200,--}}
    {{--height: 200,--}}
    {{--type: 'circle'--}}
    {{--},--}}
    {{--boundary: {--}}
    {{--width: 300,--}}
    {{--height: 300--}}
    {{--}--}}
    {{--});--}}
    {{--$('#image').on('change', function () {--}}
    {{--var reader = new FileReader();--}}
    {{--reader.onload = function (e) {--}}
    {{--resize.croppie('bind',{--}}
    {{--url: e.target.result--}}
    {{--}).then(function(){--}}
    {{--console.log('jQuery bind complete');--}}

    {{--});--}}
    {{--}--}}
    {{--reader.readAsDataURL(this.files[0]);--}}

    {{--});--}}
    {{--$('.upload-image').on('click', function (ev) {--}}
    {{--resize.croppie('result', {--}}
    {{--type: 'canvas',--}}
    {{--size: 'viewport'--}}
    {{--}).then(function (img) {--}}
    {{--$.ajax({--}}
    {{--url: "{{route('upload.image')}}",--}}
    {{--type: "POST",--}}
    {{--data: {"image":img},--}}
    {{--success: function (data) {--}}
    {{--html = '<img src="' + img + '" />';--}}
    {{--$("#preview-crop-image").html(html);--}}
    {{--}--}}
    {{--});--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
@endsection


