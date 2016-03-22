@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if( $projects->isEmpty() )
                @include('partials.first_login_partial')
            @else
                <span class="b2">Current BOM's</span>
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
            @endif
        </div>
    </div>
</div>

@endsection
