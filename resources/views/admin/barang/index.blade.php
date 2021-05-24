@extends("../../layouts.admin")
@section("title","Daftar barang")

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
							Daftar Barang
						</div>
						<div class="tambah-user text-right">
							<button id="tambah-user" class="btn btn-sm btn-primary " data-action="" data-toggle="modal" data-target="#modal-tambah-barang"><i class="fas fa-plus"></i>   Tambah</button>
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

					            <small>{{ Session::get('message') }}</small>
					          </div>
					    @endif


						<table id="manajemen_barang" class="table table-bordered table-striped">
		                  <thead>
		                  <tr>
		                    <th width="5%" >No</th>
                            <th>Gambar</th>
		                    <th>Kode Barang</th>
		                    <th>Nama Barang</th>
		                    <th>Harga Jual</th>
		                    <th>Harga Beli</th>
		                    <th>Satuan</th>
		                    <th>Aksi</th>
		                  </tr>
		                  </thead>
		                  <tbody>
		                  	@foreach($barangs as $barang)
		                  	<tr>
			                    <td class="text-center">{{$loop->iteration}}</td>
                                <td><img src="{{asset('img/barang/')."/".$barang['gambar']}}" class="img-fluid img-circle  img-size-50">
			                    </td>
			                    <td>KD{{$barang->id}}</td>
			                    <td>{{$barang['nama_barang']}}</td>
			                    <td>{{$barang['harga_jual']}}</td>
			                    <td>{{$barang['harga_beli']}}</td>
			                    <td>{{$barang['satuan']}}</td>
			                    <td>
			                    	<a href="{{route('admin.manajemen_barang.edit',$barang['id'])}}" data-action="{{route('admin.manajemen_barang.update',$barang['id'])}}" class="btn btn-sm btn-success" id="btnEditBrg"> <i class="fa fa-edit"></i></a>

            						<button  class="btn btn-sm btn-danger" id="hapus_barang" data-id="{{ $barang->id }}" data-brg="{{$barang->nama_barang}}" data-action="{{ route('admin.manajemen_barang.destroy',$barang->id) }}"><i class="fa fa-trash" ></i></button>
			                    </td>
			                 </tr>
		                  	@endforeach

		                  </tbody>
		                  <tfoot>
		                  <tr>
                            <th width="5%" >No</th>
                            <th>Gambar</th>
                            <th>Kode Barang</th>
		                    <th>Nama Barang</th>
		                    <th>Harga Jual</th>
		                    <th>Harga Beli</th>
		                    <th>Satuan</th>
		                    <th>Aksi</th>
		                  </tr>
		                  </tfoot>
		                </table>
					</div>

				</div>
			</div>
		</div>
		<!-- add modal barang -->
		<div class="modal fade" id="modal-tambah-barang">
	        <div class="modal-dialog modal-md">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h4 class="modal-title">Tambah Barang </h4>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>
	            <div class="modal-body">
	              <form action="{{route('admin.manajemen_barang.store')}}" enctype="multipart/form-data" id="FormModal" method="POST">
	              	@csrf
              		<div class="form-group">
					    <label for="nama_barang">Nama Barang</label>
					    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"  id="nama_barang" value="{{ old('nama_barang') }}" name="nama_barang" placeholder="Nama Barang">

							@error('nama_barang')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
							@enderror
					 </div>
					 <div class="form-group">
					    <label for="harga_jual">Harga Jual</label>
					    <input type="number" value="{{ old('harga_jual') }}" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" placeholder="exp 50000">
					    	@error('harga_jual')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
							@enderror
					 </div>
					 <div class="form-group">
					    <label for="harga_beli">Harga Beli </label>
					    <input type="text" value="{{ old('harga_beli') }}" class="form-control @error('harga_beli') is-invalid @enderror" placeholder="Place some text here" name="harga_beli" id="harga_beli">

					    	@error('harga_beli')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
							@enderror
					 </div>
                     <div class="form-group">
					    <label for="satuan">Satuan</label>
					    <input type="text" value="{{ old('satuan') }}" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" placeholder="satuan">
					    @error('satuan')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
						@enderror
					 </div>
					 <div class="form-group">
					    <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="">Pilih</option>
                            @foreach ($kategoris as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>

                            @endforeach
                        </select>
					    {{-- <input type="text" value="{{ old('kategori') }}" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" placeholder="kategori"> --}}
					    @error('kategori')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
						@enderror
					 </div>
                     <div class="form-group">
					    <label for="gambar">Gambar</label>
					    <input type="file" value="{{ old('gambar') }}" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" placeholder="gambar">
					    @error('gambar')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
						@enderror
					 </div>

	            </div>
		            <div class="modal-footer justify-content-between">
		              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
		              <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
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
<script src="{{asset('AdminLte3/plugins/sweetalert2/sweetalert.min.js')}}"></script>
<script src="{{asset('AdminLte3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('AdminLte3/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('AdminLte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function ()
  {
  	$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $("#manajemen_barang").DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
      	"emptyTable" : " Tidak Ada Data Ditemukan",
      	"infoEmpty":"Ditampilkan 0 dari 0 data",
      	"infoFiltered":   "(Difilter dari _MAX_ total data)",
      	"lengthMenu":     "Tampilkan _MENU_ data",
      	"search" :"Cari :",
      	 "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ Barang",
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
    $("body").on("click","#hapus_barang",function(){
        var current_object = $(this);
        let nama_barang = $(this).data("brg");
        swal({
            title: "Yakin ingin Hapus?",
            text: `${nama_barang} ini akan dihapus dari sistem` ,
            icon: "error",
            buttons: ["Batal","OK" ],
            dangerMode: true,

        })
        .then((willDelete) => {
            if (willDelete) {
                var action = current_object.attr('data-action');
                        var token = $('meta[name="csrf-token"]').attr('content');
                        var id = current_object.attr('data-id');

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



    // $("body").on("click","#btnEditBrg",function(){

    // 	let action = $(this).data("action");

    // 	let nama_barang = $(this).data("brg");
    // 	let jumlah = $(this).data("jumlah");
    // 	let deskripsi = $(this).data("deskripsi");
    // 	// // let gambar = $(this).data("gambar");
    // 	let id = $(this).data("id");
    // 	// console.log(id);
    // 	// console.log(action);

    // 	// // var token = $('meta[name="csrf-token"]').attr('content');
    // 	// // console.log(action);


    // 	$(".modal-title").text(`Ubah Data ${nama_barang}`);
    // 	$("#btnSubmit").text("Simpan Perubahan");
    // 	$("#nama_barang").val(nama_barang);
    // 	$("#jumlah").val(jumlah);
    // 	$("#deskripsi").text(deskripsi);
    //     $("#FormModal").attr("action", action);
    //     $("#btnSubmit").attr("id","btnSubmitUpdate");





    // });
    // $("body").on("click","#btnSubmitUpdate",function(){
    //     let action = $("#FormModal").attr("action");
    //     $('body').find('#FormModal').append('<input name="_method" class="method_tipe" type="hidden" value="put">');
    // 		$.ajax({
    // 			url: action,
    // 			type : "POST",
    // 			data : $("#FormModal").serialize(),
    //             // dataType : "json",
    // 			success: function(){
    //                 swal({
    //                         title: "Berhasil",
    //                         text: "Data Berhasil Dirubah",
    //                         icon: "success",
    //                         button: "OK",
    //                     });
    //                 $('body').find('#FormModal').remove('input.method_tipe');
    //                 $("#btnSubmit").attr("id","btnSubmit");
    //                 // window.location.href ="/manajemen_barang";
    // 			},
    //             error : function(){
    //                 swal({
    //                         title: "Gagal",
    //                         text: "Data Gagal Dirubah",
    //                         icon: "error",
    //                         button: "OK",
    //                     });
    //             }
    // 		});
    // 	});

    // $("body").on("click","#tambah-user",function(){
    //     let action = $(this).data("action");
    //     // console.log(action);
    // 	$(".modal-title").text(`Tambah Barang`);
    // 	$('#FormModal').trigger("reset");
    // 	$("#deskripsi").text("");
    //     $("#FormModal").attr("action",action);
    //     $("#btnSubmitUpdate").attr("id","btnSubmit");
    // 	$("#btnSubmit").text("Tambah Data");



    // });
    // $("body").on("click","#btnSubmit",function(){
    //     let action = $("#FormModal").attr("action");
    //     // console.log(action);
    //     $.ajax({
    // 			url: action,
    // 			type : "POST",
    // 			data : $("#FormModal").serialize(),
    // 			success: function(){
    //                 swal({
    //                         title: "Berhasil",
    //                         text: "Data Berhasil Ditambahkan",
    //                         icon: "success",
    //                         button: "OK",
    //                     });

    // 			},
    //             error : function(){
    //                 swal({
    //                         title: "Gagal",
    //                         text: "Data Gagal Ditambahkan",
    //                         icon: "error",
    //                         button: "OK",
    //                     });

    //             }
    // 		});
    // });




});
</script>
@endsection
