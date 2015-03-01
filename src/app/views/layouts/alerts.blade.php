<div class="page-container">
    @if(Session::has('message') && Session::has('message-type'))
        <div class="alert alert-{{ Session::get('message-type') }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{ Session::get('message') }}
        </div>
    @endif
</div>