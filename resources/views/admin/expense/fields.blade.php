<table class="table table-bordered">
    @foreach($experse_types as $id => $experse)
    <tr>
        <th>{{ Form::label('expense['.$id.']', $experse) }}</th>
        <td class="p-0">{{ Form::text('expense['.$id.']', null, ['class' => 'form-control border-0'])}}</td>
    </tr>
    @endforeach
</table>

    <div class="form-group mb-0 clearfix">
        {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block']) }}
    </div><!--form-group-->


