@if (Session::has('success_message'))
    <!-- Form Success Message -->
    <div class="alert alert-success">
        {!! Session::get('success_message') !!}
    </div>
@endif
