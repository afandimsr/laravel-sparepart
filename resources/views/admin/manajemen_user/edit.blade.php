@extends("../../layouts.admin")

@section("title","Ubah Data")

@section("content")
<div class="container ">
	<div class="row m-3">
		<div class="col-md-8">
			<div class="card card-orange card-outline">
				<div class="card-header">
					Ubah Data <button class=" btn btn-sm bg-gradient-info">{{$user['name']}}</button>

				</div>
				<div class="card-body d-flex">
					<div class="col-md-4 ">
					      <!-- Profile Image -->
						      <div class="card card-info card-outline justify-content-center">
						        <div class="card-body box-profile ">

						          <div class="text-center">

						          <img class="profile-user-img img-fluid img-circle" src="{{asset("img/profil/".$user["foto_profil"]."")}}" alt="User profile picture">
						          </div>

						            <h3 class="profile-username text-center">{{$user['name']}}</h3>
						          <ul class="list-group list-group-unbordered mb-3">
						            <li class="list-group-item">
						            <b>No hp</b> <a class="float-right">{{$user['no_hp']}}</a>
						            </li>
						            <li class="list-group-item">
						            <b>Email</b> <a class="float-right">{{$user['email']}}</a>
						            </li>

						          </ul>

						            <form action="@if(Auth::user()->role == 1) {{route('admin.manajemen_user.update',$user['id'])}} @endif"  method="POST" enctype="multipart/form-data">
						                @csrf
						                @method("put")
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
					          <form method="post" action="@if(Auth::user()->role == 1) {{route('admin.manajemen_user.update',$user['id'])}} @endif">
					            @csrf
					            @method("put")
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
					              <form method="post" action="@if(Auth::user()->hasRole("pengelola")) {{route('admin.manajemen_user.update',$user['id'])}} @endif">
					                @csrf
					                @method("put")
					                <div class="card-body">
					                  <div class="form-group">
					                    <label for="nama">Nama </label>
					                  <input type="text" value="{{$user->name}}" class="form-control @error('nama') is-invalid @enderror" name="nama" class="form-control" id="nama" required="required" placeholder="Nama">
					                    @error('nama')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
					                  </div>
					                  <div class="form-group">
					                    <label for="cd_user">NIP/NIM</label>
					                    <input type="text" value="{{$user->cd_user}}" class="form-control @error('cd_user') is-invalid @enderror" class="form-control" name="cd_user" id="cd_user" required="required" placeholder="NIP/NIP">
					                    @error('cd_user')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
					                </div>
					                  <div class="form-group">
					                    <label for="email">Email</label>
					                    <input type="email" value="{{$user->email}}" class=" form-control @error('email') is-invalid @enderror" class="form-control" name="email" id="email" required="required" placeholder="Email">
					                    @error('email')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
					                  </div>
					                  <div class="form-group">
					                    <label for="no_hp">No Hp</label>
					                    <input type="text" value="{{$user->no_hp}}" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"  id="no_hp" required="required" placeholder="No Hp">
					                    @error('no_hp')
					                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
					                    @enderror
					                  </div>
					                   <div class="form-group">
									 		<label for="">Sebagai</label>
										 	<div class="form-check">
											  <input class="form-check-input" type="radio" name="role" id="admin" value="1" {{($user->hasRole("pengelola" ) ? "checked" : "")}}>
											  <label class="form-check-label"   for="admin">
											    Admin
											  </label>
											</div>
											<div class="form-check">
											  <input class="form-check-input" type="radio" name="role" id="dosen"  value="2" {{($user->hasRole("dosen") ? "checked" : "")}}>
											  <label class="form-check-label" for="dosen">
											    Dosen
											  </label>
											</div>
											<div class="form-check">
											  <input class="form-check-input" type="radio" name="role" id="mahasiswa" value="3" {{($user->hasRole("mahasiswa") ? "checked" : "")}}>
											  <label class="form-check-label" for="mahasiswa">
											    Mahasiswa
										 	</label>
											</div>
					 				</div>

					                </div>
					                <!-- /.card-body -->

			                <div class="card-footer ">
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
