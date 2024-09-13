@extends('layouts.master')

@section('content')
<div class="col-lg-12">
    @if(session()->has('message'))
    <div class="alert alert-important alert-success alert-dismissible" role="alert">
        <div class="d-flex">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
          </div>
          <div>
            {{ session()->get('message') }}
          </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
    @endif
</div>
<div class="col-md-12 col-lg-12">
    <div class="card bg-primary-lt">
      <div class="card-body">
        <h3 class="card-title">Verification Email Sent</h3>
        <p class="text-secondary">
        Dear {{Auth::user()->name}}, <br/>

        We have sent a verification email to  <strong><u>{{Auth::user()->email}}</u></strong>. Please check your inbox and follow the instructions to verify your email address. <br/>

        If you do not see the email in your inbox, please check your spam or junk folder. You can also request a new verification email by <a href="/email/verification-notification" class="btn btn-sm btn-primary send-mail"> click here </a>
        </p>
      </div>
    </div>
</div>
@endsection

@push('js')

<script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
<script>
    $(document).ready(function() {
      $(".send-mail").click(function() {
        $(".send-mail").addClass("disabled");
      });
    });
</script>
@endpush