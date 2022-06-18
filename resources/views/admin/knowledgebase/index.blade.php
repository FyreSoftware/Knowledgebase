@extends('layouts.admin')'
@include('partials/admin.knowledgebase.nav', ['activeTab' => 'config'])

@section('title')
    Knowledgebase Config
@endsection

@section('content-header')
    <h1>Knowledgebase<small>A feature rich knowledgebase for Pterodactyl Panel.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Knowledgebase</li>
    </ol>
@endsection

@section('content')
    @yield('knowledgebase::nav')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.knowledgebase.update') }}" method="POST">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Knowledgebase Config</h3>
                    </div>
                    <div class="box-body row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="{{ true }}" @if($status) selected @endif>Enabled</option>
                                    <option value="{{ false }}" @if(!$status) selected @endif>Disabled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {!! csrf_field() !!}
                {{ method_field('PATCH') }}
                <button type="submit" class="btn btn-sm btn-primary pull-right">Save</button>
            </form>
        </div>
    </div>
@endsection
