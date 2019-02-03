@if (count($errors))
    @foreach ($errors as $error)
    <div class="callout alert">
        {{ $error }}
   </div>
    @endforeach
@endif
@if (session('status'))
    <div class="callout success">
         {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="callout alert">
         {{ session('error') }}
    </div>
@endif