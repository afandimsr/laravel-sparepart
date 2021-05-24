@extends("../../layouts.admin")
@section("title","Daftar penjualan")

@section("css")
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('AdminLte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('AdminLte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLte3/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{--asset('AdminLte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')--}}">
@endsection
@section("content")
<section class="content">
	<div class="container-fluid mt-2">
		<div class="row ">
			<div class="col-md-12">

				<div class="card card-info card-outline">
					<div class="card-header d-flex">
						<div class="page-title mr-3">
							Daftar penjualan
						</div>
						<div class="tambah-user text-right">
							<button id="tambah-user" class="btn btn-sm btn-primary " data-action="@role('admin') {{route('admin.penjualan_barang.store')}} @elserole('dosen') {{route('dosen.penjualan_barang.store')}} @endrole" data-toggle="modal" data-target="#modal-tambah-penjualan"><i class="fas fa-plus"></i>   Tambah</button>
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


						<table id="penjualan_barang" class="table table-bordered table-striped">
		                  <thead>
		                  <tr>
                            <th width="5%" >No</th>
                            <th>Nama Konsumen</th>
                            <th>Nama Barang</th>
                            <th>Harga satuan</th>
                            <th>Jumlah</th>
                            <th>Harga Total</th>

		                    <th>Aksi</th>
		                  </tr>
		                  </thead>
		                  <tbody>
		                  	@foreach($penjualans as $penjualan)
		                  	<tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>
                                   {{$penjualan->nama_konsumen}}
                                </td>
                                <td> {{$penjualan->nama_barang}}</td>
                                <td> {{$penjualan->harga_jual}}</td>
                                <td> {{$penjualan->jumlah}}</td>
                                <td>@php
                                    $total = $penjualan->harga_jual * $penjualan->jumlah;
                                    echo $total;
                                @endphp</td>
                                <td>

                                <form action="@role('admin') {{route('admin.penjualan_barang.destroy',$penjualan->id_penjualan)}}  @endrole" method="post" style="display: inline;">
                                    @csrf
                                    @method("delete")
                                    <button type="submit"  class="btn btn-sm btn-danger detail_penjualan" ><i class="fa fa-trash" ></i></button>

                                </form>
                                <a href="{{route('admin.penjualan_barang.edit',$penjualan->id_penjualan)}}" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>

			                    </td>
			                 </tr>
		                  	@endforeach

		                  </tbody>
		                  <tfoot>
		                  <tr>
		                    <th width="5%" >No</th>
                            <th>Nama Konsumen</th>
                            <th>Nama Barang</th>
                            <th>Harga satuan</th>
                            <th>Jumlah</th>
                            <th>Harga Total</th>
		                    <th>Aksi</th>
		                  </tr>
		                  </tfoot>
		                </table>
					</div>

				</div>
			</div>
		</div>
		<!-- add modal barang -->
		<div class="modal fade" id="modal-tambah-penjualan">
	        <div class="modal-dialog modal-md">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h4 class="modal-title">Tambah Data penjualan Barang </h4>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>
	            <div class="modal-body">
	              <form action="{{route('admin.penjualan_barang.store')}}"  id="FormModal" method="POST">
                      @csrf

                      <div class="form-group">
                        <label for="tanggal_faktur">Tanggal Faktur</label>
                        <input type="text" readonly class="disabled form-control" value="{{\Carbon\Carbon::parse(date("d F Y, h:m:s"))->locale("id")->isoformat("LL") }}" >
                        {{-- <div class="input-group date" id="tanggal_faktur" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#tanggal_faktur" name="tanggal_faktur" required/>
                            <div class="input-group-append" data-target="#tanggal_faktur" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div> --}}
                            @error('tanggal_faktur')
                                <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_konsumen">Nama Konsumen</label>
                        <input type="text" value="{{old("nama_konsumen")}}" class="form-control @error('nama_konsumen') is-invalid @enderror" id="nama_konsumen" name="nama_konsumen" placeholder="Nama Konsumen" required>


                            @error('nama_konsumen')
                                <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                            @enderror
                    </div>
              		<div class="form-group">
                        <label for="id_barang">Nama Barang</label>
                        <select class="form-control select3 @error('id_barang') is-invalid @enderror" style="width: 100%;" id="nama_barang" name="id_barang" required>
                            <option value="">Pilih</option>
                            @foreach ($barangs as $barang)
                                <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                            @endforeach

                          </select>


							@error('id_barang')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
							@enderror
					 </div>
					 <div class="form-group">
					    <label for="jumlah">Jumlah</label>
                     <input type="number" value="{{ old('jumlah') }}"  class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="exp 10" required>
					    	@error('jumlah')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
							@enderror
					 </div>
					 {{-- <div class="form-group">
					    <label for="deskripsi">Deskripsi </label>
					    <textarea class="textarea @error('deskripsi') is-invalid @enderror"  placeholder="lusin, buah "
                    style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="deskripsi" id="deskripsi" required></textarea>

					    	@error('deskripsi')
							    <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                            @enderror
                        <input type="hidden" name="status" value="dipinjam">
					 </div> --}}


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

    $("#jumlah").attr("disabled",true);
    $("#deskripsi").attr("disabled",true);
    $("body").on("change","#nama_barang",function(e){
        let checkPilihBarang = e.target.value;
        if(checkPilihBarang==""){
        $("#jumlah").attr("disabled",true);
        $("#deskripsi").attr("disabled",true);
        }else{
        $("#jumlah").attr("disabled",false);
        $("#deskripsi").attr("disabled",false);


        }

    });


    $("body").on("change","#jumlah",function(e){
        var getPilihIdBarang = $("#nama_barang").find(":selected").val();
        //  console.log(getPilihBarang);
        let jumlah = e.target.value;
        $.ajax({
            url: `penjualan_barang/checkStokBrg/${getPilihIdBarang}`,
            type :"get",

            success:function(data){
                // console.log(data.jumlah-jumlah);
                if(data.jumlah-jumlah<0){
                    swal({
                            title: "Notice",
                            text: `jumlah Stok Barang Adalah ${data.jumlah}`,
                            icon: "error",
                            button: "OK",
                        });
                    $("#jumlah").val(data.jumlah);

                }
            }
        })

    });
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
