@extends('layouts.app')
@push('css')
@endpush
@section('content')
    
<div class="page-body">
    <div class="container-xl">
      <div class="row">
        <div class="col-12 text-center">
          <br/><br/>
            <h1 style="font-family: Nunito;font-size:44px">Welcome!</h1><br/>
            <p>Make your Video with V-Player. Upload as much data as you want,<br/> download without speed limits and share files with friends without additional costs!</p>
        </div>
      </div><br/><br/>
      <div class="row text-center">
        <div class="col-sm-3 col-lg-2">
        </div>
        <div class="col-sm-6 col-lg-8">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Local File</h3>
              <span class="bg-secondary text-white avatar">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-files"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
              </span>
              <br/>
              <p class="text-secondary">
                <h2>Select your files for upload</h2>

                <small>File size limit: 100 MB <br/>Please Register to get unlimited upload<br/></small></p>
                
                
                <button id="browseFile" class="btn btn-outline-primary">Browse File...</button>
            </div>
            
          </div>
        </div>
        <div class="col-sm-3 col-lg-2">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3 col-lg-2"></div>
        <div class="col-sm-6 col-lg-8">
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
        <div class="col-sm-3 col-lg-2"></div>
      </div>
      <div class="row text-center">

      <small class="text-center">If. you have any question or something goes wrong, please contact our support team with contact form.</small>
      </div>
      
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
    
    resumable.on('fileAdded', function (file) {
      if((file.size / 1000 / 1000) > 100){
        alert('Max File Upload 100MB, please register to get unlimited')
        file.cancel();  
        location.reload();
      }else{
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
        resumable.upload() 
      }
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
        $('#namaFile').text(response.filename);
        $('#linkPreview').text(response.path);
        $('#videoPreview').attr('src', response.path);
        $('.my-link').html('<a href='+response.path+'><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-open"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 19l2.757 -7.351a1 1 0 0 1 .936 -.649h12.307a1 1 0 0 1 .986 1.164l-.996 5.211a2 2 0 0 1 -1.964 1.625h-14.026a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v2" /></svg></a>');
        $('.card-footer').show();
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