@extends('layouts.master')

@section('content')
    
<div class="col-12">
    <div class="row row-cards">
      <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-server"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M7 8l0 .01" /><path d="M7 16l0 .01" /></svg>
                 </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">
                  Used Storage
                </div>
                <div class="text-secondary">
                    
                    {{round($usedStorage)}} MB of unlimited
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-files"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">
                  Total Files
                </div>
                <div class="text-secondary">
                  {{$totalFiles}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-x -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">
                  {{strtoupper(Auth::user()->name)}}
                </div>
                <div class="text-secondary">
                  Standart Account
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-shield-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.998 2l.118 .007l.059 .008l.061 .013l.111 .034a.993 .993 0 0 1 .217 .112l.104 .082l.255 .218a11 11 0 0 0 7.189 2.537l.342 -.01a1 1 0 0 1 1.005 .717a13 13 0 0 1 -9.208 16.25a1 1 0 0 1 -.502 0a13 13 0 0 1 -9.209 -16.25a1 1 0 0 1 1.005 -.717a11 11 0 0 0 7.531 -2.527l.263 -.225l.096 -.075a.993 .993 0 0 1 .217 -.112l.112 -.034a.97 .97 0 0 1 .119 -.021l.115 -.007zm3.71 7.293a1 1 0 0 0 -1.415 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">
                  Upgrade
                </div>
                <div class="text-secondary">
                  Click Here
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="col-lg-12">
  
  <div class="row">
    <div class="col-sm-2">
      <button id="browseFile" class="btn btn-outline-primary btn-block">Upload File...</button>
    </div>
    <div class="col-sm-10">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="text-truncate">
                  <strong id="namaFile"></strong> 
                </div>
                <div class="text-secondary">
                  <div class="progress" style="--tblr-progress-height: 0.7rem;">
                    <div class="progress-bar" style="width: 0%" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" aria-label="0% Complete">
                      <span class="visually-hidden">0% Complete</span>
                    </div>
                  </div>
                  <small id="linkPreview"></small>
                  <div class="resumable-list"></div>
                </div>
              </div>
              <div class="col-auto align-self-center my-link">
                <a href="#" class="removeButton">
                </a>
              </div>
            </div>

            <div>
              
            </div>
            <div class="card-actions">
            </div>
          </div>
        </div>
    </div>
  </div>

</div>
<div class="col-lg-12">
    <div class="card">
        <div class="table table-vcenter table-mobile-md card-table">
          <table class="table table-vcenter card-table">
            <thead>
              <tr>
                <th><input class="form-check-input m-0 align-middle" type="checkbox"> </th>
                <th>Title</th>
                <th>Size</th>
                <th>Download</th>
                <th class="w-1"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $key=> $item)    
                  <tr>
                    <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                    <td class="text-secondary">
                      <a href="#" class=""><strong>{{$item->original_file}}</strong></a>
                    </td>
                    <td class="text-secondary"><a href="#" class="text-reset"> {{round($item->size/1000/1000)}} MB</a></td>
                    <td class="text-secondary">
                      {{$item->download}}
                    </td>
                    <td>
                        <div class="dropdown">
                            <a href="#" class="link-secondary" data-bs-toggle="dropdown"><!-- Download SVG icon from http://tabler-icons.io/i/dots -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M19 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="/view/{{$item->short_file}}" target="_blank@">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-open"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 19l2.757 -7.351a1 1 0 0 1 .936 -.649h12.307a1 1 0 0 1 .986 1.164l-.996 5.211a2 2 0 0 1 -1.964 1.625h-14.026a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v2" /></svg>
                                View
                              </a>
                              <a class="dropdown-item" href="/user/file/delete/{{$item->id}}" onclick="return confirm('Are you sure you want to delete this item?');">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                Delete
                              </a>
                            </div>
                        </div>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <br/>
        {{$data->links()}}
    </div>
    
  </div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Resumable JS -->
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

<script type="text/javascript">

    let browseFile = $('#browseFile');
    let cancelFile = $('#cancelFile');
    
    let resumable = new Resumable({
        target: '{{ route('files.upload.large') }}',
        query:{_token:'{{ csrf_token() }}'} ,// CSRF token
        fileType: [],
        maxFileSize:100000 * 1024 * 1024,
        headers: {
            'Accept' : 'application/json'
        },
        
        testChunks: false,
        throttleProgressCallbacks: 1,
    });
    resumable.assignBrowse(browseFile[0]);
    
    resumable.on('fileAdded', function (file) { // trigger when file picked
        showProgress();
        $('#namaFile').text(file.fileName);

        $('.my-link').html('<a href="#" class="removeButton"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>');
        //$('.removeButton').html('<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>');
        $(".removeButton").on("click", function ()
        {
          if (confirm("Are you sure delete this item?")) {
            file.cancel();  
            location.reload();
          }
          return false;
        });
        resumable.upload() // to actually start uploading.

        
    });
    resumable.on('fileProgress', function (file) { 
        $('#linkPreview').text('...');
        $('#browseFile').attr('disabled', true);
        $('#browseFile').text('Uploading....');// trigger when file progress update
        console.log(file);
        updateProgress(Math.floor(file.progress() * 100));
    });
    
    resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
        response = JSON.parse(response)
        $('#browseFile').text('Browse Another File..');
        $('#browseFile').attr('disabled', false);
        location.reload();
        // $('#namaFile').text(response.filename);
        // $('#linkPreview').text(response.path);
        // $('#videoPreview').attr('src', response.path);
        // $('.my-link').html('<a href='+response.path+'><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-open"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 19l2.757 -7.351a1 1 0 0 1 .936 -.649h12.307a1 1 0 0 1 .986 1.164l-.996 5.211a2 2 0 0 1 -1.964 1.625h-14.026a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v2" /></svg></a>');
        // $('.card-footer').show();
    });

    resumable.on('fileError', function (file, response) { // trigger when there is any error
        alert('file uploading error.')
    });


    let progress = $('.progress');
    function showProgress() {
        progress.find('.progress-bar').css('width', '0%');
        progress.find('.progress-bar').html('0%');
        progress.find('.progress-bar').removeClass('bg-success');
        progress.show();
    }

    function updateProgress(value) {
        progress.find('.progress-bar').css('width', `${value}%`)
        progress.find('.progress-bar').html(`${value}%`)
    }

    function hideProgress() {
        progress.hide();
    }
    
</script>
@endpush