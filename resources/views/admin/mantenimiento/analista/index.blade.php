@extends('admin.layout.app')

@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Mantenimiento</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Mantenimiento</a></li>
                <li class="breadcrumb-item active">Análista</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Análista</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('mantenimiento.analista.create') }}" class="btn btn-primary">Registrar</a>
              <table id="tblCadenaCustodia" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>DNI</th>
                  <th>APELLIDO PATERNO</th>
                  <th>APELLIDO MATERNO</th>
                  <th>NOMBRES</th>
                  <th>FIRMA</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php $nr = 1; ?>
                  @foreach ($analistas as $analista)
                      <tr>
                          <td>{{ $nr }}</td>
                          <td>{{ $analista->Documento }}</td>
                          <td>{{ $analista->ApellidoPaterno }}</td>
                          <td>{{ $analista->ApellidoMaterno  }}</td>
                          <td>{{ $analista->NombreCompleto  }}</td>
                          <td>
                            @if(file_exists( public_path() . '\assets\img\analista\\' . $analista->Id . '.png' ))
                              <img src="{{ asset('/assets/img/analista/' . $analista->Id . '.png') }}" alt="" style="height: 80px; ">
                            @else
                              NO
                            @endif
                          </td>
                          <td> @include('admin.mantenimiento.analista.delete', ['analista' => $analista]) </td>
                      </tr>
                      <?php $nr++; ?>
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
  <!-- /.content -->
@endsection

@section('js')
    
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>


<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

<script>

    $(function () {
      $("#tblCadenaCustodia").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
      });
     
    });

    

  </script>

@endsection