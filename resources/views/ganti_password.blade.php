@extends("/layouts.admin")
@section("title","Reset Password")

@section("content")
<div class="container">
	<div class="row">
		<div class="col-md m-3">
				<div class="card card-info card-outline">
			<div class="card-header">
				Ganti Password
			</div>
			<div class="card-body">
				@if (Session::has('message'))
                        <div class="alert {{Session::get('alert')}} alert-dismissible ml-1 mr-1 mt-1" id="alertMessageTime">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            @if(Session::get('alert')=="alert-danger")
                            <i class="icon fas fa-ban"></i>
                            @else
                            <i class="icon fas fa-check"></i>
                            @endif

                        <small> {{ Session::get('message') }}</small>
                        </div>
						@endif
				<form method="post" action="@if(Auth::user()->hasRole("admin")) {{route('admin.gantiPassword.update')}} @endif">
					            @csrf

					                <div class="card-body">
					                  <div class="form-group">
					                    <label for="password_baru">Password Baru </label>
					                    <input type="password" class="form-control" name="password" class="@error('password') is-invalid @enderror" id="password_baru" placeholder="Enter email" required="required">
					                    @error('password')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
					                  </div>
					                  <div class="form-group">
					                    <label for="confirm_password">Ulangi Password</label>
					                    <input type="password" class="form-control" name="password_confirmation" class="" id="confirm_password" placeholder="Password" required="required">

					                  </div>

					                </div>
					                <!-- /.card-body -->

					                <div class="card-footer">
					                  <button type="submit" class="btn btn-primary">Update</button>
					                </div>
					              </form>
			</div>
		</div>
		</div>
	</div>
</div>

@endsection

@section("javascript_footer")
<script type="text/javascript">
	$(function(){
		setTimeout(function(){$("#alertMessageTime").fadeOut("slow");},3000)
	})

</script>
@endsection
