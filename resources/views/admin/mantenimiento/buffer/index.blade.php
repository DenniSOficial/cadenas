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
                <li class="breadcrumb-item active">Metodología de Ensayo</li>
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
              <h3 class="card-title">Metodología de Ensayo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('mantenimiento.buffer.create') }}" class="btn btn-primary">Registrar</a>
              <table id="tblCadenaCustodia" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Parametro</th>
                  <th>Tipo</th>
                  <th>Material de Referencia</th>
                  <th>Marca</th>
                  <th>Lote</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php $nr = 1; ?>
                  @foreach ($buffers as $buffer)
                      <tr>
                          <td>{{ $nr }}</td>
                          @switch($buffer->Parametro)
                              @case('PH')
                                  <td>Potenciometro</td>        
                                  @break
                              @case('OD')
                                  <td>Oxímetro</td>        
                                  @break
                              @case('CL')
                                  <td>Cloro</td>        
                                  @break
                              @case('TB')
                                  <td>Turbiedad</td>
                                  @break
                              @case('CE')
                                  <td>Conductímetro</td>      
                                  @break
                              @default
                                <td>{{ $buffer->Parametro }}</td>        
                          @endswitch
                          @switch($buffer->Tipo)
                              @case('A')
                                  <td>Ajuste</td>
                                  @break
                              @case('C')
                                  <td>Control</td>
                                  @break
                              @default
                                <td>{{ $buffer->Tipo }}</td>        
                          @endswitch
                          
                          <td>{{ $buffer->MaterialReferencia  }}</td>
                          <td>{{ $buffer->Marca }}</td>
                          <td>{{ $buffer->Lote }}</td>
                          <td> @include('admin.mantenimiento.buffer.delete', ['buffer' => $buffer]) </td>
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

  <script type="text/javascript">

    $('.show_confirm').click(function(event) {

          var form =  $(this).closest("frmDeleteMetodologia");
          console.log('form:::', form);
          event.preventDefault();

          Swal.fire({
            title: 'Sistemas Análiticos Generales',
            text: "¿Está seguro de eliminar la cadena?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, elimínalo!'
          }).then((result) => {
            console.log('result:::', result);
            if (result.isConfirmed) {
                $('form#frmDeleteMetodologia').submit();
            }
          });
      });
      
  </script>

@endsection