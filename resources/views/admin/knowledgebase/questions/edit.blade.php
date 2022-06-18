@extends('layouts.admin')'

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
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.knowledgebase.questions.update', $question->id) }}" method="POST">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">New Question</h3>
                    </div>
                    <div class="box-body row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subject" class="form-label">Question Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="{{ $question->subject }}">
                            </div>
                            <div class="form-group">
                                <label for="category">Question Category</label>
                                <select class="form-control" name="category" id="category">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id === $question->category) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="information">Question Information</label>
                                <textarea class="form-control" id="information" name="information">{{ $question->information }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {!! csrf_field() !!}
                {{ method_field('PATCH') }}
                <button type="submit" class="btn btn-sm btn-primary pull-right">Save</button>
            </form>
            <form action="{{ route('admin.knowledgebase.questions.delete', $question->id) }}" method="POST">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <script>
        function MinHeightPlugin(editor) {
            this.editor = editor;
        }

        MinHeightPlugin.prototype.init = function() {
            this.editor.ui.view.editable.extendTemplate({
                attributes: {
                    style: {
                        minHeight: '300px',
                        color: '#000'
                    }
                }
            });
        };

        ClassicEditor.builtinPlugins.push(MinHeightPlugin);
        ClassicEditor
            .create( document.querySelector( '#information' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
