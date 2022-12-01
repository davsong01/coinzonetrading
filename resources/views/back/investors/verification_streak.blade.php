@if(auth()->user()->role == 'investor')
@if(empty(auth()->user()->investor->means_of_identification))
<div class="alert alert-danger" style="background-color:#ff0500" role="alert" style="width: 100%;">
      <i class="fa fa-times" aria-hidden="true"></i> Your account is unverified! You need to upload a valid means of validation.</strong> <a style="color:#000" target="_blank" href="{{ route('profile') }}">Click here to upload ID</a>
</div>
@endif

@if(auth()->user()->investor->means_of_identification != auth()->user()->investor->approved_identification)
<div class="alert alert-warning" role="alert" style="width: 100%;">
     Your account is unverified! Your uploaded means of identification is currently undergoing verification.
</div>
@endif
@endif