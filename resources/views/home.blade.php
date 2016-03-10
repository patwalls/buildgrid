@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <span class="b2">Current BOM's</span>
            </div>
            @if( $projects->isEmpty() )
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Notice:</strong> You don't have any projects yet.
                </div>
            @endif
            @foreach($projects as $project)
                <div class="row project-grid-item">
                    <h2>{{ $project->name }}</h2>
                    @foreach($project->boms->chunk(4) as $chunk)
                        <div class="row">
                            @foreach($chunk as $bom)
                                <div class="col-sm-6 col-md-3">
                                    <div class="info-card">
                                        <div class="info-card-header">
                                            <a href="{{ route('getShowBom', [$bom->id]) }}" class="b2">{{ $bom->name }}</a>
                                            <p class="b2">Added on {{ Date::parse($bom->created_at)->format('F j, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @if($chunk->count() == 4)
                            </div>
                        <div class="row">
                        @endif
                        <div class="col-sm-6 col-md-3">
                            <a class="add" href="#">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        @if($chunk->count() == 4)
                            </div>
                        @endif

                        @if( $chunk->count() < 4)
                            </div>
                        @endif

                    @endforeach
                </div>
            @endforeach

            <div class="row spaced">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <a class="add" href="{{ route('getCreateProject') }}">
                            <i class="fa fa-plus"></i>
                            <p>New Project</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
