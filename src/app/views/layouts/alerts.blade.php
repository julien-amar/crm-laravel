            <div class="page-container">
                @if(Session::has('message'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Warning!</strong> {{ Session::get('message') }}
                </div>
                @endif
            </div>