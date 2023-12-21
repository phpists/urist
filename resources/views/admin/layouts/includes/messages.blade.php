<div class="validation_messages">
    @include('admin.layouts.includes.success_message')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
</div>





