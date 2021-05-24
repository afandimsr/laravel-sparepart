@extends("../layouts.admin")
@section("title","Dashboard")
@section("content")

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">

        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">

        <!-- solid sales graph -->
        <div class="card mt-2">
            <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-tachometer-alt mr-1"></i>
                Dasboard
            </h3>

            <div class="card-tools">
                <button type="button" class="btn bg-transparent btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn bg-transparent btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                @if(Auth::user()->hasRole("admin") )
                <div class="row">
                    <div class="col-lg-6 col-6">
                    <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                            <h3>{{$countPenjualans}}</h3>

                            <p>Penjualan</p>
                            </div>
                            <div class="icon">
                            <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                        <h3>{{$countBarangs}}</h3>

                        <p>Sparepart</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                </div>
                @elseif(Auth::user()->hasRole("dosen"))
                    <h1>Akses untuk Dosen</h1>
                @else
                    <h1>Akses untuk mahasiswa</h1>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-transparent">
            <div class="row">

                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

