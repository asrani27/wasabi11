@extends('layouts.master')
@push('css')
    <style>

    iframe { 
        width: 100%;
        aspect-ratio: 16 / 9;
    }
    </style>
@endpush
@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$data->original_file}}</h3>
        </div>
        <div class="card-body text-center">
            @if ($data->type === 'mp4' || $data->type === 'mkv')
                @if ($data->status_stream == null)
                <div class="text-secondary mb-3">Preparing For Video Streaming</div>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-indeterminate"></div>
                </div>
                @else
                <iframe style="width: 100%; height: 80%; overflow: hidden;" frameBorder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" src="/stream/{{$data->short_file}}"></iframe>
                @endif
            @else
            <div style="padding-top:10%; padding-bottom:10%"><strong>No Preview This File</strong></div>
            @endif
        </div>

        @if ($data->type === 'mp4' || $data->type === 'mkv')
        <div class="card-footer">
            <strong>Embed Code :</strong>
            <textarea class="form-control" disabled rows="4"><iframe height="360" width="640" frameBorder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" src="{{config('app.url')}}/stream/{{$data->short_file}}"></iframe>
            </textarea>
        </div>
        @endif
    </div>
</div>

<div class="col-md-4">
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">File Information</h3>
        </div>
        <div class="card-body">
            <div class="datagrid" style="--tblr-datagrid-item-width:8rem">
                <div class="datagrid-item">
                  <div class="datagrid-title">Upload Date</div>
                  <div class="datagrid-content">{{$data->created_at}}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Last Download</div>
                  <div class="datagrid-content">{{$data->last_download}}</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">File Size</div>
                  <div class="datagrid-content">{{round($data->size / 1000 /1000)}} MB</div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Type</div>
                  <div class="datagrid-content">{{$data->type}}</div>
                </div>
              </div>
        </div>

        <div class="card-footer text-end">
            <div class="d-flex">
                <strong>VIEWS</strong>
                <strong class="ms-auto" style="font-size:16px">{{$data->views}}</strong>
            </div>
        </div>
        <div class="card-footer text-end">
            <div class="d-flex">
                <strong>DOWNLOAD</strong>
                <strong class="ms-auto" style="font-size:16px">{{$data->download}}</strong>
            </div>
        </div>
        <div class="card-footer text-center">

            @if ($data->status_download == null)
            <div class="text-secondary mb-3">Preparing Link Download</div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-indeterminate"></div>
            </div>
            @else

            <a href="/download/{{$data->id}}" class="btn btn-lg btn-block btn-primary">DOWNLOAD NOW &nbsp; <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg></a>
            @endif
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush