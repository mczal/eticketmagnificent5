<!-- Name -->
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="order-name" class="col-sm-2 control-label">Name</label>

    <div class="col-sm-6">
        <input type="text" name="name" id="order-name" class="form-control" value="{{ app('request')->input('name') }}">
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Email -->
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="order-email" class="col-sm-2 control-label">Email</label>

    <div class="col-sm-6">
        <input type="email" name="email" id="order-email" class="form-control" value="{{ app('request')->input('email') }}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- Handphone -->
<div class="form-group{{ $errors->has('handphone') ? ' has-error' : '' }}">
    <label for="order-handphone" class="col-sm-2 control-label">Handphone</label>

    <div class="col-sm-6">
        <input type="text" name="handphone" id="order-handphone" class="form-control" value="{{ app('request')->input('handphone') }}"/>
        @if ($errors->has('handphone'))
            <span class="help-block">
                <strong>{{ $errors->first('handphone') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- TICKET TYPE -->
<div class="form-group{{ $errors->has('ctfest1') ? ' has-error' : '' }}">
    <label for="order-ctfest1" class="col-sm-2 control-label">Ticket Type</label>
<br>
    <div class="col-sm-6">

      <label class="col-sm-2 control-label">FESTIVAL</label>
      @if ($errors->has('ctfest1'))
          <span class="help-block">
              <strong>{{ $errors->first('ctfest1') }}</strong>
          </span>
      @endif
      <input type="number" name="ctfest1" id="order-ctfest1" class="form-control" value="0"/>
      <label class="col-sm-2 control-label">VIP A</label>
      @if ($errors->has('ctvipa2'))
          <span class="help-block">
              <strong>{{ $errors->first('ctvipa2') }}</strong>
          </span>
      @endif
      <input type="number" name="ctvipa2" id="order-ctvipa2" class="form-control" value="0"/>
      <label class="col-sm-2 control-label">VIP B</label>
      @if ($errors->has('ctvipb3'))
          <span class="help-block">
              <strong>{{ $errors->first('ctvipb3') }}</strong>
          </span>
      @endif
      <input type="number" name="ctvipb3" id="order-ctvipb3" class="form-control" value="0"/>
      <label class="col-sm-2 control-label">VVIP</label>
      @if ($errors->has('ctvvip4'))
          <span class="help-block">
              <strong>{{ $errors->first('ctvvip4') }}</strong>
          </span>
      @endif
      <input type="number" name="ctvvip4" id="order-ctvvip4" class="form-control" value="0"/>
    </div>
</div>

<!-- ID Number
<div class="form-group{{ $errors->has('id_no') ? ' has-error' : '' }}">
    <label for="order-id_no" class="col-sm-2 control-label">ID Number</label>

    <div class="col-sm-6">
        <input type="text" name="id_no" id="order-id_no" class="form-control" value="{{ isset($order->id_no) ? $order->id_no : old('id_no') }}">
        @if ($errors->has('id_no'))
            <span class="help-block">
                <strong>{{ $errors->first('id_no') }}</strong>
            </span>
        @endif
    </div>
</div>-->

<!-- Quantity
<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
    <label for="order-quantity" class="col-sm-2 control-label">Quantity</label>

    <div class="col-sm-2">
        <input type="number" name="quantity" id="order-quantity" class="form-control" value="{{ isset($order->quantity) ? $order->quantity : old('quantity') }}">
        @if ($errors->has('quantity'))
            <span class="help-block">
                <strong>{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
    </div>
</div>
-->
