
        {!! Form::model($evaluation, ['method' => 'PUT','route' => ['site_comment_submit', $evaluation->id], 'class' => 'form-horizontal', 'id' => 'site_comment-'.$site_index, 'name' => 'site_comment-'.$site_index]) !!}

            <div class="col-md-12 form-group{{ $errors->has('site_comment') ? ' has-error' : '' }}">
                {{ Form::label('site_comment', 'Σχόλια - Παρατηρήσεις - Προτάσεις για τον Ιστότοπο') }}

                {{ Form::textarea('site_comment', null, ['rows' => 3, 'cols' => '50','class' => 'form-control', 'id' => 'site_comment-'.$site_index, 'placeholder' => 'Προαιρετικά σχόλια για τον Ιστότοπο.']) }}                                            

                @if ($errors->has('site_comment'))
                    <span class="help-block">
                        <strong>{{ $errors->first('site_comment') }}</strong>
                    </span>
                @endif                                            
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    {{ Form::button('Υποβολή Σχολίου', ['type' => 'submit', 'class' => 'btn btn-info btn-block']) }}
                </div>
            </div>                                         

        {{ Form::close() }}
