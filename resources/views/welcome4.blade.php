@extends('layouts.app')
@push('css')
    
  <link rel="stylesheet" href="/dropzone/dropzone.min.css">

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
        <div class="col-sm-3 col-lg-1">
        </div>
        <div class="col-sm-6 col-lg-10">
          <div class="card" style="border: 2px dashed black; background:none">
            <div class="card-body">
              <h3 class="card-title">Local File</h3>
              <span class="bg-secondary text-white avatar">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-files"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
              </span>
              <br/>
              <p class="text-secondary">
                <h2>Select your files for upload</h2>

                <small>File size limit: 1 GB</small></p>
                
                <div id="actions" class="row text-center">
                  <div class="col-lg-12 text-center">
                      <span class="btn btn-outline-primary fileinput-button">
                        <i class="fas fa-plus"></i>
                        <span>Add files</span>
                      </span>
                      <button type="submit" class="btn btn-success col start">
                        <i class="fas fa-upload"></i>
                        <span>Start upload</span>
                      </button>
                  </div>

                  <button type="reset" class="btn btn-warning col cancel" style="visibility: hidden">
                    <i class="fas fa-times-circle"></i>
                    <span>Cancel upload</span>
                  </button>
                </div>

              <div class="table table-striped files" id="previews">
                <div id="template" class="row" style="padding-top:10px">
                  <div class="card">
                    <div class="card-body" style="margin:0px 0px; padding-left:0px; padding-right:0px;">

                      <div class="row" style="margin: 0px 0px;">
                        <div class="col-1"  style="margin: 0px 0px; padding-left:0px; padding-right:0px; vertical-align:middle">
                          <img src="/icon/file.png" width="60%">
                        </div>
                        <div class="col-10" style="text-align: left">
                            <p class="mb-0">
                              <span class="lead" data-dz-name style="font-weight: bold;font-size:12px;"></span>
                              (<span data-dz-size></span>)
                              <p data-dzc-id></p>
                            </p>
      
                            <div class="fileupload-process w-100">
                              <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="--tblr-progress-height:0.9rem">
                                <div class="progress-bar progress-bar-success" style="width:1%;" data-dz-uploadprogress></div>
                              </div>
                            </div>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                        </div>
                        <div class="col-1">
                          <div class="btn-group" style="padding-top:15px">
                            <a href="#"  data-dz-remove id="ahref">
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </a>
                          </div>
                          <a class="btn btn-primary start" style="visibility: hidden">
                          </a>
                          {{-- <button data-dz-remove class="btn btn-warning cancel"  style="visibility: hidden">
                            <i class="fas fa-times-circle"></i>
                            <span>Cancel</span>
                          </button> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-sm-3 col-lg-1">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3 col-lg-0"></div>
        <div class="col-sm-6 col-lg-8">
          
          <small class="text-center">If you have any question or something goes wrong, please contact our support team with contact form.</small>
        </div>
        <div class="col-sm-3 col-lg-0"></div>
      </div>
      
    </div>
  </div>
@endsection

@push('js')
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
      uploadMultiple:false, 
      parallelUploads:2,
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

      success: function(file, response) {
              file.previewElement.id = 'asdas';
              console.log(file);
              document.querySelector('.'+response.filename > '#ahref').innerHTML = 'asu';
            },

    })
  
    myDropzone.on("addedfile", function(file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
    })
    // Update the total progress bar
    myDropzone.on("uploadprogress", function(progress) {
        console.log(progress.upload.progress);


        $('#'+ $(progress.previewElement).find("[data-dzc-id]").attr('id')).html(progress.upload.bytesSent);
      document.querySelector(".progress-bar").innerHTML = Math.round(progress.upload.progress) + "%";
    })

  
    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        //$('.progress-bar').html(Date()+ '    ' +progress);
       //document.querySelector(".progress-bar").style.width = progress + "%";
    })
  
    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      //document.querySelector("#total-progress").style.opacity = "1"
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })
  

      myDropzone.on("queuecomplete", function(file, res) {
          if (myDropzone.files[0].status != Dropzone.SUCCESS ) {
              console.log('yea baby');
          } else {
            console.log('cry baby');
          }
      });

  
    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    // document.querySelector("#actions .cancel").onclick = function() {
    //   myDropzone.removeAllFiles(true)
    // }
    // DropzoneJS Demo Code End
</script>
@endpush