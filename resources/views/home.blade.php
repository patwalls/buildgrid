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
                                    <div class="info-card">
                                        <div class="info-card-header">
                                            <a href="{{ route('getShowBom', [$bom->id]) }}" class="b2">{{ $bom->name }}</a>
                                            <a id="archive-icon" class="archive-icon" tabindex="0" role="button" data-href="{{route('setArchiveBom', $bom->id)}}" data-toggle="popover" title="Are you sure?" data-placement="top" data-container="body" data-content=''>
                                                <i class="b2 ion-ios-trash-outline"></i>
                                            </a>
                                            <p class="b4" onclick="location.href='{{ route('getShowBom', [$bom->id]) }}'"><span>Last Updated:</span> {{ $bom->updated_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="info-card-body" onclick="location.href='{{ route('getShowBom', [$bom->id]) }}'"></div>
                                        @if($bom->status == 'accepted')
                                            <div class="info-card-footer info-footer-accepted">
                                                <p><i class="ion-checkmark-round"></i> Accepted</p>
                                            </div>
                                        @else
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
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                        <div class="col-sm-6 col-md-3">
                            <div class="new-project-wrap">
                                <a class="add" href="{{ route('getAddBomToProject', [$project->id]) }}">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <a id="add-new-bom" href="{{ route('getAddBomToProject', [$project->id]) }}">Add BOM</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
