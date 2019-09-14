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
                        <h3 class="box-title">Assigned Topics</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('assigntopics.update',$subject->_id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="box-body">
                            <div class="subject-info-box-1">
                                <label>Total Topics</label>
                                <select multiple="multiple" name="total_selections[]" id='lstBox1' class="form-control">
                                    <optgroup value="Testing">
                                 @foreach($topics as $key=>$value)
                                    <option selected value="{{$value->_id}}">{{$value->topic_name}}</option>
                                    @endforeach
                                    </optgroup>
                                </select>
                            </div>

                            <div class="subject-info-arrows text-center">
                                <input type='button' id='btnAllRight' value='>>' class="btn btn-default" /><br />
                                <input type='button' id='btnRight' value='>' class="btn btn-default" /><br />
                                <input type='button' id='btnLeft' value='<' class="btn btn-default" /><br />
                                <input type='button' id='btnAllLeft' value='<<' class="btn btn-default" />
                            </div>

                            <div class="subject-info-box-2">
                                <label>Assigned Topics</label>
                                <select multiple="multiple" name="assigned_selections[]" id='lstBox2' class="form-control">
                                <optgroup value="Testing">
                                 @foreach($assignTopics as $key=>$value)
                                    <option selected value="{{$value->_id}}">{{$value->topic_name}}</option>
                                    @endforeach
                                    </optgroup>
                                </select>
                                @if ($errors->has('assigned_selections'))
                                    <div class="error">{{ $errors->first('assigned_selections') }}</div>
                                @endif
                            </div>

                            <div class="clearfix"></div>
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
    <style>
        .subject-info-box-1,
        .subject-info-box-2 {
            float: left;
            width: 45%;
        }
        select {
            min-height: 400px;
            padding: 0;
        }
        option {
            padding: 4px 10px 4px 10px;
        }

        option:hover {
            background: #EEEEEE;
        }
        .subject-info-arrows {
            float: left;
            width: 10%;
            margin-top: 150px;
        }
        input {
            width: 70%;
            margin-bottom: 5px;
        }

    </style>

@endsection


