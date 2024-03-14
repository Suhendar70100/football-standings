@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Matches</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if(session('success'))
        <div class="container-fluid">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @error('club2_id')
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $message }}
            </div>
    @enderror
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="col-2 mb-2 btn btn-primary" data-toggle="modal"
                                data-target="#addMatch">Added Match
                            </button>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Match</th>
                                        <th>Match Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matches as $item)
                                        <tr>
                                            <td>{{ $item->club1->name }} <strong>({{ $item->score1 }})</strong> VS {{ $item->club2->name }} <strong>({{ $item->score2 }})</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($item->match_date)->isoFormat('D MMMM YYYY') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Match</th>
                                        <th>Match Date</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>Standings</h2>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Club</th>
                                        <th>Played</th>
                                        <th>Won</th>
                                        <th>Draw</th>
                                        <th>Lost</th>
                                        <th>Winning Goal</th>
                                        <th>Goal Lost</th>
                                        <th>Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($standings as $key => $standing)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $standing->club->name }}</td>
                                            <td>{{ $standing->played }}</td>
                                            <td>{{ $standing->won }}</td>
                                            <td>{{ $standing->drawn }}</td>
                                            <td>{{ $standing->lost }}</td>
                                            <td>{{ $standing->goals_for }}</td>
                                            <td>{{ $standing->goals_against }}</td>
                                            <td>{{ $standing->points }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<div class="modal fade" id="addMatch">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Added Match</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('matches.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Club Name 1</label>
                            <select class="form-control select2" name="club1_id" style="width: 100%;">
                                @foreach ($clubs as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Score Club 1</label>
                            <input type="number" required class="form-control" name="score1" placeholder="Score">
                        </div>
            
                        <div class="form-group">
                            <label>Club Name 2</label>
                            <select class="form-control select2" name="club2_id" style="width: 100%;">
                                @foreach ($clubs as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Score Club 2</label>
                            <input type="number" required class="form-control" name="score2" placeholder="Score">
                        </div>
                        <div class="form-group">
                            <label for="matchDate">Date Match</label>
                            <input type="date" required class="form-control" name="match_date" placeholder="Match Date">
                        </div>   
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                    <button type="submit" name="add" class="btn btn-primary">Submit</button>
                </div>
            </form>                 
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function () {
        $('.select2').select2()
    })
</script>
@endpush()