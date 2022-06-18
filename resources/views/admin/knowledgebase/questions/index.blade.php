@extends('layouts.admin')'
@include('partials/admin.knowledgebase.nav', ['activeTab' => 'questions'])

@section('title')
    Knowledgebase Questions
@endsection

@section('content-header')
    <h1>Knowledgebase Questions<small>All questions in the knowledgebase.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Knowledgebase</li>
    </ol>
@endsection

@section('content')
    @yield('knowledgebase::nav')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Knowledgebase Questions</h3>
                    <div class="box-tools">
                        <a href={{ route('admin.knowledgebase.questions.new') }}><button type="button" class="btn btn-sm btn-primary">New</button></a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{$question->id}}</td>
                                <td>{{$question->subject}}</td>
                                <td>{{$question->category}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.knowledgebase.questions.edit', $question->id) }}"><i class="fa fa-wrench"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
