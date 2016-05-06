@extends('layouts.app')

@section('content')
<div class="app-current-proj-outer-wrap">
    <div class="container" id="app-current-proj-wrap">
        <div class="row">
            <div class="col-md-12 inner-wrap">
                <div class="col-md-6 item-wrap">
                    <span class="b2">Current Projects</span><span> | 3 Projects</span>
                </div>
                <div class="col-md-6 item-wrap">
                    <a href="{{ route('getCreateProject') }}"><button class="btn btn-success new-proj-btn">New Project</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
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
                                            <p class="b2">Added on {{ Date::parse($bom->created_at)->format('F j, Y') }}</p>
                                            <div class="b2" id="bom-status-color">{{ ucwords(preg_replace(['/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'], ' $0', $bom->status)) }}</div>
                                        </div>
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
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
