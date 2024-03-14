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
                                data-target="#share-project"><i class="fas fa-share-square"></i> Bagikan Proyek
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
                                            <td>{{ $item->match_date }}</td>
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
</div>
<div class="modal fade" id="share-project">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bagikan Proyek</h4>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="updateBtn" name="shareProject" class="btn btn-primary">Bagikan Proyek</button>
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