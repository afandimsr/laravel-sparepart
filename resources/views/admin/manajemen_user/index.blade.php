@extends("../../layouts.admin")
@section("title","Manajemen User")
@section("javascript_header")
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('AdminLte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('AdminLte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section("content")
<section class="content">
	<div class="container-fluid mt-2">
		<div class="row ">
			<div class="col-md-12">
				<div class="card card-info card-outline">
							<div class="card-header d-flex">
								<div class="page-title mr-3">
									Manajemen User
								</div>
								<div class="tambah-user text-right">
									<button id="tambah-user" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#modal-manajemen-user"><i class="fas fa-plus"></i>Tambah</button>
								</div>
							</div>
							<div class="card-body">
								@if (Session::has('message'))
							          <div class="alert {{Session::get('alert')}} alert-dismissible ml-1 mr-1" id="alertMessageTime">
							            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							                @if (Session::get('alert')=="alert-danger")
							                <i class="icon fas fa-ban"></i>
							                @else
							                <i class="icon fas fa-check"></i>
							                @endif

							            {{ Session::get('message') }}
							          </div>
							    @endif


								<table id="manajemen_user" class="table table-bordered table-striped">
				                  <thead>
				                  <tr>
				                    <th width="5%" >No</th>
				                    <th>Nama</th>
				                    <th>NIM/NIP</th>
				                    <th>No Hp</th>
				                    <th>Role</th>
				                    <th>Aksi</th>
				                  </tr>
				                  </thead>
				                  <tbody>
				                  	@foreach($users as $user)
				                  	<tr>
					                    <td class="text-center">{{$loop->iteration}}</td>
					                    <td>{{$user['name']}}
					                    </td>
					                    <td>{{$user['cd_user']}}</td>
					                    <td>{{$user['no_hp']}}</td>
					                    <td>
					                    	@if($user->getRoleNames()[0] == "pengelola")
					                    		<button class="btn btn-xs bg-gradient-success"> Pengelola</button>
					                    	@elseif($user->getRoleNames()[0] == "dosen")
					                    	<button class="btn btn-xs bg-gradient-info">Dosen</button>

					                    	@elseif($user->getRoleNames()[0] == "mahasiswa")
                                                <button class="btn btn-xs bg-gradient-warning"> Mahasiswa</button>
                                            @else
                                            <button class="btn btn-xs bg-gradient-danger">Undifined</button>
					                    	@endif
					                	</td>

					                    <td>
					                    	<a href="{{route('admin.manajemen_user.edit',$user['id'])}}" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i></a>
					                    	<button class="btn btn-sm btn-warning" id="gantiPassword"  data-action="{{ route('admin.manajemen_user.update',$user->id) }}" data-id="{{$user->id}}" data-nama="{{$user->name}}" data-toggle="modal" data-target="#modal-ganti-password"><i class="fas fa-key"></i></button>
                    						<Button  class="btn btn-sm btn-danger" id="remove-pelaporan" data-id="{{ $user->id }}" data-action="{{ route('admin.manajemen_user.destroy',$user->id) }}"><i class="fa fa-trash" ></i></Button>
					                    </td>
					                 </tr>
				                  	@endforeach

				                  </tbody>
				                  <tfoot>
				                  <tr>
				                    <th width="5%" >No</th>
				                    <th>Nama</th>
				                    <th>NIM/NIP</th>
				                    <th>No. Hp</th>
				                    <th>Role</th>
				                    <th>Aksi</th>
				                  </tr>
				                  </tfoot>
				                </table>
							</div>

				</div>
			</div>
		</div>
		<!-- add modal user -->
	<div class="modal fade" id="modal-manajemen-user">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah User </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('admin.manajemen_user.store')}}" id="tambah-user" method="POST">
              	@csrf
              		<div class="form-group">
					    <label for="nama">Nama</label>
					    <input type="text" class="form-control @error('nama') is-invalid @enderror"  id="nama" value="{{ old('nama') }}" name="nama" placeholder="Nama">

							@error('nama')
							    <div class="alert alert-danger"><p><small>{{ $message }}</small></p></div>
							@enderror
					 </div>
					 <div class="form-group">
					    <label for="cd_user">NIP/NIM</label>
					    <input type="text" value="{{ old('cd_user') }}" class="form-control @error('cd_user') is-invalid @enderror" id="cd_user" name="cd_user" placeholder="NIP/NIM">
					    	@error('cd_user')
							    <div class="alert alert-danger"><p><small>{{ $message }}</small></p></div>
							@enderror
					 </div>
					 <div class="form-group">
					    <label for="no_hp">No Hp</label>
					    <input type="text" value="{{ old('no_hp') }}" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" placeholder="No. Hp">
					    @error('no_hp')
							    <div class="alert alert-danger"><p><small>{{ $message }}</small></p></div>
						@enderror
					 </div>
					 <div class="form-group">
					    <label for="email">Email</label>
					    <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
					    	@error('email')
							    <div class="alert alert-danger"><p><small>{{ $message }}</small></p></div>
							@enderror
					 </div>
					 <div class="form-group">
					    <label for="username">Username</label>
					    <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username">
					    @error('username')
							    <div class="alert alert-danger"><p><small>{{ $message }}</small></p></div>
						@enderror
					 </div>
					 <div class="form-group">
					    <label for="password">Password</label>
					    <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
					    @error('password')
							    <div class="alert alert-sm alert-danger"><p><small>{{ $message }}</small></p></div>
						@enderror
					 </div>
					 <div class="form-group">
					 	<label for="">Sebagai</label>
					 	<div class="form-check">
						  <input class="form-check-input" type="radio" name="role" id="admin" value="1" >
						  <label class="form-check-label"  for="admin">
						    Admin
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="role" id="dosen" value="2" >
						  <label class="form-check-label" for="dosen">
						    Dosen
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="role" id="mahasiswa" value="3" checked="checked">
						  <label class="form-check-label" for="mahasiswa">
						    Mahasiswa
						  </label>
						</div>
					 </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
         </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	</div>
	<!-- ganti password -->
	<div class="modal fade" id="modal-ganti-password">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ganti Password <strong><span id="nama_user">Undifined</span></strong></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

               <form action="" method="post" id="FormGantiPassword">
                                @csrf
                                @method('PUT')

					                <div class="card-body">
					                  <div class="form-group">
					                    <label for="password_baru">Password Baru </label>
					                    <input type="hidden" name="id" id="user_id">
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
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
              <button type="submit" class="btn btn-primary btn-gantipassword">Simpan</button>
            </div>
            </form>
         </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	</div>
</section>
@endsection

@section("javascript_footer")
<!-- DataTables -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('AdminLte3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLte3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminLte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
  	$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $("#manajemen_user").DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
      	"emptyTable" : " Tidak Ada Data Ditemukan",
      	"infoEmpty":"Ditampilkan 0 dari 0 data",
      	"infoFiltered":   "(Difilter dari _MAX_ total data)",
      	"lengthMenu":     "Tampilkan _MENU_ data",
      	"search" :"Cari :",
      	 "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ data User",
      	"paginate": {
	        "first":      "First",
	        "last":       "Last",
	        "next":       "Selanjutnya",
	        "previous":   "Sebelumnya"
        },
        "zeroRecords":    "Tidak Ada Data Ditemukan ",
      },


    });
    setTimeout(function(){ $("#alertMessageTime").fadeOut("slow"); }, 5000);
   // remove with sweetalert
    $("body").on("click","#remove-pelaporan",function(){
        var current_object = $(this);
        swal({
            title: "Yakin ingin Hapus?",
            text: "User ini akan dihapus dari sistem",
            icon: "error",
            buttons: ["Batal","OK" ],
            dangerMode: true,

        })
        .then((willDelete) => {
            if (willDelete) {
                        var action = current_object.attr('data-action');
                        var token = $('meta[name="csrf-token"]').attr('content');
                        var id = current_object.attr('data-id');
                        // const Toast = Swal.mixin({
                        //     toast: true,
                        //     position: 'top-end',
                        //     showConfirmButton: false,
                        //     timer: 5000
                        //     });

                        $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                        $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                        $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                        $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                        $('body').find('.remove-form').submit();
                        // Toast.fire({
                        //     icon: 'success',
                        //     title: 'Berhasil',
                        //     text: "Data Berhasil Dihapus",
                        // })
                        swal({
                            title: "Berhasil",
                            text: "Data Berhasil Dihapus",
                            icon: "success",
                            button: "OK",
                        });
                }
            else {
                swal("Data tidak dihapus");
            }
        });
    });

    $("body").on("click","#gantiPassword",function(){

    	let id= $(this).data("id");
    	let nama = $(this).data("nama");
    	// console.log(nama);
    	let action = $(this).data("action");

    	$("#user_id").val(id);
    	$("#nama_user").text(nama);
        $("#FormGantiPassword").attr('action',action);




    });
    $(".btn-gantipassword").on("click",function(){
        let id = $("#user_id").val();
        let action = $("#FormGantiPassword").attr("action");
        let password = $("#password_baru").val();
        let confirm_password = $("#confirm_password").val();
        if(password.match(confirm_password)){
                $.ajax({
                    url : action,
                    data : $("#FormGantiPassword").serialize(),
                    method :"POST",
                    success : function(){
                        alert("Password Berhasil Diganti");
                    }
                })
        }else{
            window.alert("Password tidak sama, Tolong Masukkan Kembali !");
            window.location.href ="/admin/manajemen_user";
        }

    });
    $("#BtnGantiPassword").on("click",function(){
    	$.ajax({
          data: $('#FormGantiPassword').serialize(),
          url: "{{ route('admin.gantiPasswordModal') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#FormGantiPassword').trigger("reset");
              $('#modal-ganti-password').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#BtnGantiPassword').html('Save Changes');
          }
    });
    });



  });
</script>
@endsection
