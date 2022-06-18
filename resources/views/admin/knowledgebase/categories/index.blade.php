@extends('layouts.admin')'
@include('partials/admin.knowledgebase.nav', ['activeTab' => 'categories'])

@section('title')
    Knowledgebase Categories
@endsection

@section('content-header')
    <h1>Knowledgebase Categories<small>Available categories in the knowledgebase.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Knowledgebase</li>
    </ol>
@endsection

@section('content')
    @yield('knowledgebase::nav')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Knowledgebase Categories</h3>
                    <div class="box-tools">
                        <a href={{ route('admin.knowledgebase.categories.new') }}><button type="button" class="btn btn-sm btn-primary">New</button></a>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.knowledgebase.categories.edit', $category->id) }}"><i class="fa fa-wrench"></i></a>
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

