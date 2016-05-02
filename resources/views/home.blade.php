@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

                @if( $projects->isEmpty() )
                    @include('partials.first_login_partial')
                    @include('create_project')
                @else
                    <h2>Current Project's</h2>
                    @foreach($projects as $project)
                        <div class="row project-grid-item">
                            <div class="b2 project-title">{{ $project->name }}</div>
                            <div class="row">
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
                                    <a class="add" href="{{ route('getCreateProject', [$project->id]) }}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
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
