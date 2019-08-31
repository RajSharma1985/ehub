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
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SNo.</th>
                                    <th>Section Name</th>
                                    <th>Subjects</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignSubjects as  $indexKey => $item)
                                    <tr>
                                        <td>{{$indexKey + 1}}</td>
                                        <td>{{$item->getSection->section_name}}</td>
                                        <td> <a href="{{ route('assignsubjects.edit', ['id' => $item->_id]) }}" class="btn btn-success btn-md">Edit</a></td>
                                        <td><a href="{{ route('assignsubjects.edit', ['id' => $item->_id]) }}" class="btn btn-success btn-md">Assign Subjects</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $assignSubjects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection


