@if (Session::has('error_message'))
    <!-- Form Error Message -->
    <div class="alert alert-danger">
        {!! Session::get('error_message') !!}
    </div>
@endif
