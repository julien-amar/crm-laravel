{{ Form::open(array('url' => 'mailings/create', 'class' => 'form-create', 'role' => 'form', 'files' => true)) }}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="mailingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Mailing</h4>
            </div>
            <div class="modal-body">
                {{ Form::hidden('clients', NULL, array('id' => 'clients')) }}

                <div class="form-group">
                    {{ Form::label('subject', trans('mailings.form.create.fields.subject')) }}
                    {{ Form::text('subject', NULL, array('class'=>'form-control', 'placeholder' => trans('mailings.form.create.fields.subject.default') )) }}
                </div>

                <div class="form-group">
                    {{ Form::label('operation_dropdown', trans('mailings.form.create.fields.operation')) }}
                    {{ Form::hidden('operation', NULL, array('id' => 'operation')) }}
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown" data-hidden-target="#operation">
                            {{ trans('mailings.form.create.fields.operation.default') }}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="soperation_dropdown">
                            @foreach($operations as $operation)
                                <li>
                                    <a tabindex="-1" data-value="{{ $operation }}">
                                        {{ trans('mailings.form.create.fields.operations.' . $operation) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('reference', trans('mailings.form.create.fields.reference')) }}
                    {{ Form::text('reference', NULL, array('class'=>'form-control', 'placeholder' => trans('mailings.form.create.fields.reference.default') )) }}
                </div>

                <div class="form-group">
                    {{ Form::label('message', trans('mailings.form.create.fields.message')) }}
                    {{ Form::textarea('message', NULL, array('class'=>'form-control', 'placeholder' => trans('mailings.form.create.fields.message.default') )) }}
                </div>

                <div class="form-group">
                    {{ Form::label('file[]', trans('mailings.form.create.fields.file')) }}

                    <a href="#" id="add-mailing" data-template="mailing" data-target="#add-mailing-template">
                        <i class="fa fa-plus"></i>
                    </a>

                    <ul id="add-mailing-template">
                    </ul>

                    <div id="template-mailing" style="display: none;">
                        <li>
                            {{ Form::file('file[]') }}
                        </li>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                {{ Form::button(trans('mailings.form.create.action.close'), array('class'=>'btn btn-default', 'data-dismiss' => 'modal'))}}
                {{ Form::submit(trans('mailings.form.create.action.send'), array('class' => 'btn btn-primary'))}}
            </div>
        </div>
    </div>
</div>
{{ Form::hidden('_token', csrf_token(), array()) }}
{{ Form::close() }}

<div class⁼"template-mailing">
    {{ Form::file('file[]') }}
</div>
