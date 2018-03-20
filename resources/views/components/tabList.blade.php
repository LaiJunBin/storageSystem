<div class="row">
    <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist">
            @foreach ($classNames as $className)
                {{-- @if ($loop->first)
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-{{$classNumbers[$loop->index]}}" role="tab"
                    aria-controls="home">{{$className}}</a>
                @else
                    <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-{{$classNumbers[$loop->index]}}" role="tab"
                    aria-controls="home">{{$className}}</a>
                @endif --}}
                <a class="list-group-item list-group-item-action @if ($loop->first)
                    active
                @endif" id="list-home-list" data-toggle="list" href="#list-{{$classNumbers[$loop->index]}}" role="tab"
                    aria-controls="home">{{$className}}</a>
            @endforeach
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="nav-tabContent">
            @foreach ($classNumbers as $classNumber)
                {{-- @if ($loop->first)
                    <div class="tab-pane fade show active" id="list-{{$classNumber}}" role="tabpanel" aria-labelledby="list-home-list">{{$classNumber}}</div>
                @else
                    <div class="tab-pane fade show" id="list-{{$classNumber}}" role="tabpanel" aria-labelledby="list-home-list">{{$classNumber}}</div>
                @endif --}}
                <div class="tab-pane fade show @if ($loop->first)
                    active
                @endif" id="list-{{$classNumber}}" role="tabpanel" aria-labelledby="list-home-list">{{$classNumber}}</div>
            @endforeach
        </div>
    </div>
</div>