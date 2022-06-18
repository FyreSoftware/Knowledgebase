@section('knowledgebase::nav')
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom nav-tabs-floating">
                <ul class="nav nav-tabs">
                    <li @if($activeTab === 'config') class="active" @endif><a href={{ route('admin.knowledgebase') }}>Config</a></li>
                    <li @if($activeTab === 'categories') class="active" @endif><a href="{{ route('admin.knowledgebase.categories.index') }}">Categories</a></li>
                    <li @if($activeTab === 'questions') class="active" @endif><a href="{{ route('admin.knowledgebase.questions.index') }}">Questions</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
