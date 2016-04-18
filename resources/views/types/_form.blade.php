<!-- Type Name -->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="type-name" class="col-sm-1 control-label">Name</label>

    <div class="col-sm-6">
        <input type="text" name="name" id="type-name" class="form-control" value="{{ isset($type->name) ? $type->name : '' }}">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Type Price -->
<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    <label for="type-price" class="col-sm-1 control-label">Price</label>

    <div class="col-sm-3">
        <input type="text" name="price" id="type-price" class="form-control" value="{{ isset($type->price) ? $type->price : 0 }} ">
        @if ($errors->has('price'))
            <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Type Status -->
<div class="form-group">
    <label for="type-active" class="col-sm-1 control-label">Active</label>
    <div class="col-sm-3">
        <select class="form-control" name="active">
            <option value="0"{{ (isset($type->active) && $type->active == 0) ? ' selected' : '' }}>Not Active</option>
            <option value="1"{{ (isset($type->active) && $type->active == 1) ? ' selected' : '' }}>Active</option>
        </select>
    </div>
</div>
