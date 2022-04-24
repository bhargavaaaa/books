<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('public/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/assets/dist/js/adminlte.js')}}"></script>

<!-- Select2 -->
<script src="{{ asset('public/assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Datatables -->
<script src="{{ asset('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Jquery Validation -->
<script src="{{ asset('public/assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- sweetalert -->
<script src="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>

<!-- moment -->
<script src="{{ asset('public/assets/plugins/moment/moment.min.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('public/assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>

<!-- Ckeditor SCRIPTS -->
<script src="{{ asset('public/assets/plugins/ckeditor/ckeditor.js')}}"></script>

<script>
  $(document).ready(function() {

    @if(Session::has('message'))
    Swal.fire(
      '{{ $moduleName }}',
      '{!! session('message') !!}',
      'success'
    );
    @elseif(Session::has('failmessage'))
    Swal.fire(
      '{{ $moduleName }}',
      '{!! session('failmessage ') !!}',
      'error'
    );
    @endif

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      placeholder: 'Select',
      allowClear: true
    });

    $('.date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
  });
</script>
