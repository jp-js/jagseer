<div class="form-group col-4{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
    {!! Form::text('name', $product->name ?? null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group col-4{{ $errors->has('Qty') ? ' has-error' : ''}}">
    {!! Form::label('qty', 'Qty: ', ['class' => 'control-label']) !!}
    {!! Form::text('qty', $product->qty ?? null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group col-4{{ $errors->has('Price') ? ' has-error' : ''}}">
    {!! Form::label('price', 'Price: ', ['class' => 'control-label']) !!}
    {!! Form::text('price', $product->price ?? null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group col-12{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('description', 'Description: ', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', $product->description ?? null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group  col-12{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('image', 'Image: ', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary bg-primary']) !!}
</div>
