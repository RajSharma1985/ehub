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
                        <h3 class="box-title">Add Question</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('question.store') }}" method="POST">
                        @csrf
                        <div class="box-body">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Select Section <span style="color: red">*</span></label>
                                <select class="form-control" name="section_id" id="section_id">
                                    <option value="">Select Section</option>
                                    @foreach($sections as $key=>$value)
                                        <option value={{$value->_id}}>{{$value->section_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('section_id'))
                                    <div class="error">{{ $errors->first('section_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Subject <span style="color: red">*</span></label>
                                <select class="form-control" name="subject_id" id="subject_id">
                                    <option value="">Select Section</option>
                                   
                                </select>
                                @if ($errors->has('subject_id'))
                                    <div class="error">{{ $errors->first('subject_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Topic <span style="color: red">*</span></label>
                                <select class="form-control" name="topic_id" id="topic_id">
                                    <option value="">Select Topic</option>
                                   
                                </select>
                                @if ($errors->has('topic_id'))
                                    <div class="error">{{ $errors->first('topic_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Sub Topic <span style="color: red">*</span></label>
                                <select class="form-control" name="sub_topic_id" id="sub_topic_id">
                                    <option value="">Select Sub Topic</option>
                                   
                                </select>
                                @if ($errors->has('sub_topic_id'))
                                    <div class="error">{{ $errors->first('sub_topic_id') }}</div>
                                @endif
                            </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Question Title English <span style="color: red">*</span></label>
                                <textarea id="question_title_en_us"  name="question_title_en_us" placeholder="Enter question title in english " rows="10" cols="80">

                                </textarea>
                                @if ($errors->has('question_title_en_us'))
                                    <div class="error">{{ $errors->first('question_title_en_us') }}</div>
                                @endif
                    </div>
                    <div class="form-group">
                            <label for="exampleInputEmail1">Question Title Hindi <span style="color: red">*</span></label>
                            <textarea id="question_title_hindi"  name="question_title_hindi" placeholder="Enter question title in hindi " rows="10" cols="80">

                            </textarea>
                            @if ($errors->has('question_title_hindi'))
                                <div class="error">{{ $errors->first('question_title_hindi') }}</div>
                            @endif
                    </div>

                    <div class="form-group">
                            <label for="exampleInputEmail1">Question Description English <span style="color: red">*</span></label>
                            <textarea id="question_desc_en_us"  name="question_desc_en_us" placeholder="Enter question description in hindi " rows="10" cols="80">

                            </textarea>
                            @if ($errors->has('question_desc_en_us'))
                                <div class="error">{{ $errors->first('question_desc_en_us') }}</div>
                            @endif
                    </div>

                    <div class="form-group">
                            <label for="exampleInputEmail1">Question Description Hindi <span style="color: red">*</span></label>
                            <textarea id="question_desc_hindi"  name="question_desc_hindi" placeholder="Enter question description in hindi " rows="10" cols="80">

                            </textarea>
                            @if ($errors->has('question_desc_hindi'))
                                <div class="error">{{ $errors->first('question_desc_hindi') }}</div>
                            @endif
                    </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Question Type <span style="color: red">*</span></label>
                                {{--<input type="text" class="form-control required"  name="section_name_en_us" placeholder="Enter Section Name In English">--}}
                                <select class="form-control" name="question_type">
                                    <option value="">Select Type</option>
                                    @foreach($questionType as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('question_type'))
                                    <div class="error">{{ $errors->first('question_type') }}</div>
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
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script>
    $( document ).ready(function() {
        $('#section_id').change(function(){
        $('#subject_id option').remove();
        $('#topic_id option').remove();
        $('#sub_topic_id option').remove();
        $.ajax({
                url : '{{ route( 'getsubjects' ) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "section_id": $(this).val()
                    },
                type: 'get',
                dataType: 'json',
                success: function( result )
                {
                   if(result.status == 'success'){
                    $('#subject_id').append($('<option>', {value:'', text:'Select Subject'}));
                     $.each( result.data, function(k, v) {
                         $('#subject_id').append($('<option>', {value:v._id, text:v.subject_name}));
                    });
                   }else{
                       alert(result.message);
                   }
                    
                },
                error: function()
                {
                    //handle errors
                    alert('error...');
                }
            });
   
        });

        $('#subject_id').change(function(){
        $('#sub_topic_id option').remove();
        $.ajax({
                url : '{{ route( 'gettopics' ) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "subject_id": $(this).val()
                    },
                type: 'get',
                dataType: 'json',
                success: function( result )
                {
                    if(result.status == 'success'){
                    $('#topic_id').append($('<option>', {value:'', text:'Select Topics'}));
                     $.each( result.data, function(k, v) {
                         $('#topic_id').append($('<option>', {value:v._id, text:v.topic_name}));
                    });
                   }else{
                       alert(result.message);
                   }
                    
                },
                error: function()
                {
                    //handle errors
                    alert('error...');
                }
            });
   
        });

        $('#topic_id').change(function(){
        $('#sub_topic_id option').remove();
        $.ajax({
                url : '{{ route( 'getsubtopics' ) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "topic_id": $(this).val()
                    },
                type: 'get',
                dataType: 'json',
                success: function( result )
                {
                    if(result.status == 'success'){
                    $('#sub_topic_id').append($('<option>', {value:'', text:'Select Sub Topics'}));
                     $.each( result.data, function(k, v) {
                         $('#sub_topic_id').append($('<option>', {value:v._id, text:v.sub_topic_name}));
                    });
                   }else{
                       alert(result.message);
                   }
                    
                },
                error: function()
                {
                    //handle errors
                    alert('error...');
                }
            });
   
        });
     });
    
    </script>
@endsection


