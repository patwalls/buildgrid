@extends('layouts.app')

@section('content')
<div class="app-current-proj-outer-wrap">
    <div class="container" id="app-current-proj-wrap">
        <div class="row">
            <div class="col-md-12 inner-wrap">
                <div class="col-md-6 item-wrap">
                    <span class="b2">Current Projects</span><span> | @if(count( $projects ) == null ) No Projects @elseif (count( $projects ) == 1) Project  @else {{ count( $projects ) }} Projects @endif</span>
                </div>
                <div class="col-md-6 item-wrap">
                    <a href="{{ route('getCreateProject') }}"><button class="btn btn-success new-proj-btn">New Project</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container footer-align">
    <div class="row">
        <div class="col-md-12">
            @if( $projects->isEmpty() )
                @include('partials.first_login_partial')
                @include('create_project')
            @else
                @foreach($projects as $project)
                    <div class="row project-grid-item">
                        <div class="col-md-12">
                            <div class="b2 project-title">{{ $project->name }}</div>
                        </div>
                        @foreach($project->boms->chunk(4) as $chunk)
                            @foreach($chunk as $bom)
                                <div class="col-sm-6 col-md-3">
                                    <div class="info-card" onclick="location.href='{{ route('getShowBom', [$bom->id]) }}'">
                                        <div class="info-card-header">
                                            <a href="{{ route('getShowBom', [$bom->id]) }}" class="b2">{{ $bom->name }}</a>
                                            <p class="b4"><span>Last Updated:</span> {{ getDaysAgo($bom->updated_at) }}</p>
                                        </div>
                                        @if( count($bom->responses) == null )
                                            <div class="info-card-footer">
                                                <p>No Responses</p>
                                            </div>
                                        @elseif ( count($bom->responses) == 1 )
                                            <div class="info-card-footer info-footer-updates">
                                                <p> <span class="red-counter">{{ count($bom->responses) }}</span> Response</p>
                                            </div>
                                        @else
                                            <div class="info-card-footer info-footer-updates">
                                                <p> <span class="red-counter">{{ count($bom->responses) }}</span> Responses</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                        <div class="col-sm-6 col-md-3">
                            <div class="new-project-wrap">
                                <a class="add" href="{{ route('getCreateProject', [$project->id]) }}">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <a id="add-new-bom" href="{{ route('getCreateProject', [$project->id]) }}">Add BOM</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
