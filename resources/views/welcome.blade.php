{{-- @extends('layouts.app')

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

                <small>File size limit: 1 GB</small></p>

                <button type="button" class="btn btn-outline-primary fileup-btn">
                    Browse file...
                    <input type="file" id="upload-1">
                </button>
                
                    <br/>
                    <br/>
                <div id="upload-1-queue" class="queue card-body" style="text-align: left"></div>

            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-2">
        </div>

        
      </div>
      <div class="row text-center">
        <div class="col-lg-12">
          <small>If you have any question or something goes wrong, please contact our support team with contact form.</small>
        </div>
      </div>
      
    </div>
  </div>
@endsection --}}

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="/dropzone/dropzone.min.css">
<body>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Dropzone.js <small><em>jQuery File Upload</em> like look</small></h3>
            </div>
            <div class="card-body">
              <div id="actions" class="row">
                <div class="col-lg-6">
                  <div class="btn-group w-100">
                    <span class="btn btn-success col fileinput-button">
                      <i class="fas fa-plus"></i>
                      <span>Add files</span>
                    </span>
                    <button type="submit" class="btn btn-primary col start">
                      <i class="fas fa-upload"></i>
                      <span>Start upload</span>
                    </button>
                    <button type="reset" class="btn btn-warning col cancel">
                      <i class="fas fa-times-circle"></i>
                      <span>Cancel upload</span>
                    </button>
                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                  <div class="fileupload-process w-100">
                    <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table table-striped files" id="previews">
                <div id="template" class="row mt-2">
                  <div class="col-auto">
                      <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                  </div>
                  <div class="col d-flex align-items-center">
                      <p class="mb-0">
                        <span class="lead" data-dz-name></span>
                        (<span data-dz-size></span>)
                      </p>
                      <strong class="error text-danger" data-dz-errormessage></strong>
                  </div>
                  <div class="col-4 d-flex align-items-center">
                      <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                      </div>
                  </div>
                  <div class="col-auto d-flex align-items-center">
                    <div class="btn-group">
                      <button class="btn btn-primary start">
                        <i class="fas fa-upload"></i>
                        <span>Start</span>
                      </button>
                      <button data-dz-remove class="btn btn-warning cancel">
                        <i class="fas fa-times-circle"></i>
                        <span>Cancel</span>
                      </button>
                      <button data-dz-remove class="btn btn-danger delete">
                        <i class="fas fa-eye"></i>
                        <span>View</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and information about the plugin.
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>

<!-- dropzonejs -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="/dropzone/dropzone.min.js"></script>
<script>
    
    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false
  
    // Dropzone.option.myDropzone = {
    //     maxFilesize:500
    // }
    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)
  
    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: "/upload", // Set the url
      thumbnailWidth: 80,
      chunking: true,
      forceChunking: true,
      chunkSize: 1000000,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews", // Define the container to display the previews
      clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.,
      
      maxFilesize: 5000,
      headers:  {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
      init: function() {
          this.on("addedfile", file => {
            console.log("A file has been added");
          });
        },
    })
  
    myDropzone.on("addedfile", function(file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
    })
  
    myDropzone.on("success", function(file) {
      console.log(file);
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })
  
    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1"
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })
  
    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress, response) {
      document.querySelector("#total-progress").style.opacity = "0"
    })
  
    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
  </script>
</body>
</html>