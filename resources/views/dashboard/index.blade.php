@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-black-60">Dashboard</h3>
</div>

<!-- Main content -->
<section class="content" style="margin-top: 20px;">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-6" style="margin-bottom: 20px;">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>3000</h3>
                    <p>Token Akun Belum Digunakan</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-battery-full"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Red box -->
    <!-- DONUT CHART -->
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Proyek</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
@endsection