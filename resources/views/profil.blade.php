@extends("/layouts.admin")
@section("title","Profil Saya")


@section("content")
<div class="container-fluid  mt-3">
    <div class="row">
    	<div class="col-md-12 ">
    		<div class="card card-info card-outline p-1 ml-4 mr-4 ">
	    			<div class="card-header">

		    			Profil Saya
	    			</div>
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
	    			<div class="card-body d-flex">

		    			<div class="col-md-4 ">
					      <!-- Profile Image -->
						      <div class="card card-info card-outline justify-content-center">
						        <div class="card-body box-profile ">

						          <div class="text-center">

						          <img class="profile-user-img img-fluid img-circle" src="{{asset("img/profil/".Auth::user()->foto_profil."")}}" alt="User profile picture">
						          </div>

						            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
						          <ul class="list-group list-group-unbordered mb-3">
						            <li class="list-group-item">
						            <b>No hp</b> <a class="float-right">{{Auth::user()->no_hp}}</a>
						            </li>
						            <li class="list-group-item">
						            <b>Email</b> <a class="float-right">{{Auth::user()->email}}</a>
						            </li>

						          </ul>

						            <form action="@if(Auth::user()->hasRole("admin")) {{route('admin.myProfil.update')}} @elseif(Auth::user()->hasRole("dosen")) {{route('dosen.myProfil.update')}} @else {{route('mahasiswa.myProfil.update')}} @endif"  method="POST" enctype="multipart/form-data">
						                @csrf
						                <div class="form-group justify-content-center">
						                    <div class="input-group">
						                    <input type="file" id="exampleInputFile" class="form-control @error('profile') is-invalid @enderror" name="profile">
						                    </div>
							                    @error('profile')
							                        <div class="alert text-danger mt-1"><small>{{ $message }}</small></div>
							                    @enderror
						                    <div class="input-group mt-1">
						                    <button type="submit" class="btn btn-primary">Update</button>
						                    </div>

						                </div>
						                </form>
						        </div>
						        <!-- /.card-body -->
						      </div>
	    				</div>
					    <div class="col-md-8 ">
					      <div class="card card-info card-tabs">
					        <div class="card-header p-0 pt-1">
					          <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
					            <li class="pt-2 px-3">
					              <h3 class="card-title">Profile</h3>
					            </li>
					            <li class="nav-item">
					              <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
					                href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
					                aria-selected="true">Ubah Password</a>
					            </li>
					            <li class="nav-item">
					              <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
					                href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile"
					                aria-selected="false">Ubah Profile</a>
					            </li>

					          </ul>
					        </div>
					        <div class="card-body">
					          <div class="tab-content" id="custom-tabs-two-tabContent">
					            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
					              aria-labelledby="custom-tabs-two-home-tab">
					          <form method="post" action="@if(Auth::user()->hasRole("admin")) {{route('admin.myProfil.update')}} @elseif(Auth::user()->hasRole("dosen")) {{route('dosen.myProfil.update')}} @else {{route('mahasiswa.myProfil.update')}} @endif">
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
					            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
					              aria-labelledby="custom-tabs-two-profile-tab">
					              <form method="post" action="@if(Auth::user()->hasRole("admin")) {{route('admin.myProfil.update')}} @elseif(Auth::user()->hasRole("dosen")) {{route('dosen.myProfil.update')}} @else {{route('mahasiswa.myProfil.update')}} @endif">
					                @csrf
					                <div class="card-body">
					                  <div class="form-group">
					                    <label for="nama">Nama </label>
					                  <input type="text" value="{{Auth::user()->name}}" class="form-control @error('nama') is-invalid @enderror" name="nama" class="form-control" id="nama" required="required" placeholder="Nama">
					                    @error('nama')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
					                  </div>
					                  <div class="form-group">
					                    <label for="cd_user"></label>
					                    <input type="text" value="{{Auth::user()->cd_user}}" class="form-control @error('cd_user') is-invalid @enderror" class="form-control" name="cd_user" id="cd_user" required="required" placeholder="NIP/NIP">
					                    @error('cd_user')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
					                </div>
					                  <div class="form-group">
					                    <label for="email">Email</label>
					                    <input type="email" value="{{Auth::user()->email}}" class=" form-control @error('email') is-invalid @enderror" class="form-control" name="email" id="email" required="required" placeholder="Email">
					                    @error('email')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
					                  </div>
					                  <div class="form-group">
					                    <label for="no_hp">No Hp</label>
					                    <input type="text" value="{{Auth::user()->no_hp}}" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"  id="no_hp" required="required" placeholder="No Hp">
					                    @error('no_hp')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
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
					        <!-- /.card -->
					      </div>
					    </div>
					</div>
	    	</div>
	    </div>
    </div>
</div>


@endsection

@section("javascript_footer")
<script type="text/javascript">
	$(function(){
		setTimeout(function(){ $("#alertMessageTime").fadeOut("slow"); }, 3000);
	})

</script>
@endsection
