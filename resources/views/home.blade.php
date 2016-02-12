@extends('layouts.app')

@section('content')

    <style>

        .info-card {
            width: 100%;
            border: 1px solid rgb(215, 215, 215);
            margin-bottom: 20px;
            overflow: hidden;
            min-height: 200px;
            border-radius: 10px;
        }

        .info-card-header {
            display: block;
            bottom: 15px;
            position: absolute;
            padding: 15px;
        }

        .info-card-header a {
            font-weight: 700;
            font-size: 18px;
        }


        .add i {
            font-size: 80px;
            display: block;
            height: 200px;
            border: 2px dashed lightblue;
            border-radius: 10px;
            width: 100%;
            padding-top: 60px;
            text-align: center;
            font-weight: normal;
        }

        .add p{
            margin: 15px 0;
            text-decoration: underline;
        }

        .spaced {
            margin-top: 60px;
        }

    </style>


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="row">
                <h2>Current BOM's</h2>
            </div>

            @if( $projects->isEmpty() )
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Notice:</strong> You don't have any projects yet.
                </div>
            @endif

            @foreach($projects as $project)
                <div class="row">

                    <h3>{{ $project->name }}</h3>

                    @foreach($project->boms->chunk(4) as $chunk)
                        <div class="row">
                            @foreach($chunk as $bom)
                                <div class="col-sm-6  col-md-3">
                                    <div class="info-card">
                                        <div class="info-card-header">
                                            <a href="{{ route('ShowBom', [$bom->id]) }}">{{ $bom->name }}</a>
                                            <p>Added on {{ Date::parse($bom->created_at)->format('F j, Y') }}</p>
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
                            <a class="add" href="{{ route('CreateProject') }}">
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
