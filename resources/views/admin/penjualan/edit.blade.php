@extends("../../layouts.admin")
@section("title","edit penjualan")


@section("content")
<section class="content">
	<div class="container-fluid mt-2">
		<div class="row ">
			<div class="col-md-12">

				<div class="card card-info card-outline">
					<div class="card-header d-flex">
						<div class="page-title mr-3">
							Edit penjualan
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
                        <form action="{{route('admin.penjualan_barang.update',$penjualan->id_penjualan)}}" method="POST">
                            @csrf
                            @method("put")
                            <div class="form-group">
                                <label for="nama_konsumen">Nama Konsumen</label>
                                <input type="text" value="{{$penjualan->nama_konsumen}}" class="form-control @error('nama_konsumen') is-invalid @enderror" id="nama_konsumen" name="nama_konsumen" placeholder="Nama Konsumen" required>


                                    @error('nama_konsumen')
                                        <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                                    @enderror
                            </div>
                              <div class="form-group">
                                <label for="id_barang">Nama Barang</label>
                                <select class="form-control @error('id_barang') is-invalid @enderror" style="width: 100%;" id="nama_barang" name="id_barang" required>
                                    <option value="">Pilih</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{$barang->id}}" @if($barang->id == $penjualan->id_barang) selected  @else  @endif>{{$barang->nama_barang}}</option>
                                    @endforeach

                                  </select>


                                    @error('id_barang')
                                        <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                                    @enderror
                             </div>
                             <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                             <input type="number" value="{{$penjualan->jumlah}}"  class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="exp 10" required>
                                    @error('jumlah')
                                        <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                                    @enderror
                             </div>





					</div>
                    <div class="modal-footer justify-content-between">

                        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                      </div>
                      </form>

				</div>
			</div>
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
<script src="{{asset('AdminLte3/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function ()
  {
    $('#tanggal_penjualan').datetimepicker({
    });
    $('.select2').select2(
        {
            "language": {
                "noResults": function(){
                    return "Data tidak ditemukan <a href='@role("pengelola") {{route("admin.manajemen_user.index")}} @elserole("dosen")  @endrole ' class='btn btn-sm btn-success'>Tambah data</a>";
                },

            },
            width: 'resolve',
            escapeMarkup: function (markup) {
                return markup;
            },
        }
    );
    $('.select3').select2(
        {
            "language": {
                "noResults": function(){
                    return "Data tidak ditemukan <a href='@role("pengelola") {{route("admin.manajemen_barang.index")}} @elserole("dosen") {{route("dosen.manajemen_barang.index")}}  @endrole ' class='btn btn-sm btn-success'>Tambah Barang/Barang</a>";
                },

            },
            escapeMarkup: function (markup) {
                return markup;
            }
        }
    );

  	$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    // $("#jumlah").attr("disabled",true);
    // $("#deskripsi").attr("disabled",true);
    // $("body").on("change","#nama_barang",function(e){
    //     let checkPilihBarang = e.target.value;
    //     if(checkPilihBarang==""){
    //     $("#jumlah").attr("disabled",true);
    //     $("#deskripsi").attr("disabled",true);
    //     }else{
    //     $("#jumlah").attr("disabled",false);
    //     $("#deskripsi").attr("disabled",false);


    //     }

    // });


    // $("body").on("change","#jumlah",function(e){
    //     var getPilihIdBarang = $("#nama_barang").find(":selected").val();
    //     //  console.log(getPilihBarang);
    //     let jumlah = e.target.value;
    //     $.ajax({
    //         url: `penjualan_barang/checkStokBrg/${getPilihIdBarang}`,
    //         type :"get",

    //         success:function(data){
    //             // console.log(data.jumlah-jumlah);
    //             if(data.jumlah-jumlah<0){
    //                 swal({
    //                         title: "Notice",
    //                         text: `jumlah Stok Barang Adalah ${data.jumlah}`,
    //                         icon: "error",
    //                         button: "OK",
    //                     });
    //                 $("#jumlah").val(data.jumlah);

    //             }
    //         }
    //     })

    // });
    $("#penjualan_barang").DataTable({
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







    $("body").on("click","#tambah-user",function(){
        let action = $(this).data("action");
        // console.log(action);
    	$(".modal-title").text(`Tambah Data penjualan Barang`);
    	$('#FormModal').trigger("reset");
    	$("#deskripsi").text("");
        $("#FormModal").attr("action",action);
        $("#btnSubmitUpdate").attr("id","btnSubmit");
    	$("#btnSubmit").text("Tambah Data");





    });





});
</script>
@endsection
