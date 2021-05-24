@extends("../../layouts.admin")
@section("title","Edit Barang")

@section("content")
<section class="content">
	<div class="container-fluid mt-2">
		<div class="row ">
			<div class="col-md-12">
				<div class="card card-info card-outline">
					<div class="card-header d-flex">
						<div class="page-title mr-3">
							Edit Barang &nbsp;<button class="btn btn-warning">{{$barang->nama_barang}}</button>
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

                        <form action="{{route('admin.manajemen_barang.update',$barang->id)}}" enctype="multipart/form-data" id="FormModal" method="POST">
                            @csrf
                            @method("put")
                            <div class="form-group">
                              <label for="nama_barang">Nama Barang</label>
                              <input type="text"  class="form-control @error('nama_barang') is-invalid @enderror"  id="nama_barang" value="{{$barang->nama_barang}}" name="nama_barang" placeholder="Nama Barang">

                                  @error('nama_barang')
                                      <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                                  @enderror
                           </div>
                           <div class="form-group">
                              <label for="harga_jual">Harga Jual</label>
                              <input type="number" value="{{ $barang->harga_jual }}" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual" name="harga_jual" placeholder="exp 50000">
                                  @error('harga_jual')
                                      <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                                  @enderror
                           </div>
                           <div class="form-group">
                              <label for="harga_beli">Harga Beli </label>
                              <input type="number" value="{{ $barang->harga_beli }}" class="form-control @error('harga_beli') is-invalid @enderror" placeholder="Place some text here" name="harga_beli" id="harga_beli">

                                  @error('harga_beli')
                                      <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                                  @enderror
                           </div>
                           <div class="form-group">
                              <label for="satuan">Satuan</label>
                              <input type="text" value="{{ $barang->satuan }}" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" placeholder="satuan">
                              @error('satuan')
                                      <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                              @enderror
                           </div>
                           <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori"  class="form-control  @error('kategori') is-invalid @enderror" required>
                                    @foreach ($kategoris as $kategori)

                                        <option value="{{$barang->kategori}}" @if($kategori->id == $barang->kategori) selected @else @endif>{{$kategori->nama_kategori}}</option>

                                    @endforeach
                                </select>
                                @error('kategori')
                                        <span class="text-danger ml-2"><p>*<small>{{ $message }}</small></p></span>
                                @enderror
                         </div>

                           <div class="form-group">
                              <label for="gambar">Gambar</label>
                              <input type="file" value="{{ old('gambar') }}" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" placeholder="gambar">
                              <input type="hidden" name="gambar1" id="gambar1" value="{{$barang->gambar}}">
                              @error('gambar')
                                      <div class="p2 ml-2 text-danger"><small>*{{ $message }}</small></div>
                              @enderror
                           </div>
                           <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>

	            	        </form>



					</div>

				</div>
			</div>
		</div>

	</div>


</section>

@endsection


