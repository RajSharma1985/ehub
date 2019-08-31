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
                        <h3 class="box-title">Add Topic</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('topic.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Topic Name English <span style="color: red">*</span></label>
                                <input type="text" class="form-control required"  name="topic_name_en_us" placeholder="Enter Topic Name In English">
                                @if ($errors->has('topic_name_en_us'))
                                    <div class="error">{{ $errors->first('topic_name_en_us') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Topic Name Hindi <span style="color: red">*</span></label>
                                <input type="text" class="form-control required"  name="topic_name_hindi" placeholder="Enter Topic Name In Hindi">
                                @if ($errors->has('topic_name_hindi'))
                                    <div class="error">{{ $errors->first('topic_name_hindi') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Topic Description English <span style="color: red">*</span></label>
                                <textarea id="topic_desc_en_us"  name="topic_desc_en_us" placeholder="Enter Topic Description In English" rows="10" cols="80">

                                </textarea>
                                @if ($errors->has('topic_desc_en_us'))
                                    <div class="error">{{ $errors->first('topic_desc_en_us') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Topic Description Hindi <span style="color: red">*</span></label>
                                <textarea id="topic_desc_hindi"  name="topic_desc_hindi" placeholder="Enter Topic Description In " rows="10" cols="80">

                                </textarea>
                                @if ($errors->has('topic_desc_hindi'))
                                    <div class="error">{{ $errors->first('topic_desc_hindi') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status <span style="color: red">*</span></label>
                                {{--<input type="text" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">--}}
                                <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    @foreach($status as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <div class="error">{{ $errors->first('status') }}</div>
                                @endif
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
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

@endsection


