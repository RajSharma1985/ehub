@extends('admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <!-- Main content -->
        <section class="content">
            <a href="{{ URL::to('question/create') }}" class="btn btn-primary btn-lg pull-right">Add Question</a>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SNo.</th>
                                    <th>Question</th>
                                    <th>Section</th>
                                    <th>Subject</th>
                                    <th>Topic</th>
                                    <th>Sub Topic</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questions as  $indexKey => $item)
                                    <tr>
                                        <td>{{$indexKey + 1}}</td>
                                        <td>{{$item->question_name}}</td>
                                        <td>{{$item->section_name}}</td>
                                        <td>{{$item->subject_name}}</td>
                                        <td>{{$item->topic_name}}</td>
                                        <td>{{$item->sub_topic_name}}</td>
                                        <td>{{ ($item->status) ? 'Active' : 'Deactive' }}</td>
                                        <td> <a href="{{ route('subtopic.edit', ['id' => $item->_id]) }}" class="btn btn-success btn-md">Edit</a></td>
                                        <td><form action="{{ url('/subtopic', ['id' => $item->id]) }}" method="post">
                                                <input class="btn btn-danger btn-md" type="submit" value="Delete" />
                                                @method('delete')
                                                @csrf
                                            </form></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $questions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection


