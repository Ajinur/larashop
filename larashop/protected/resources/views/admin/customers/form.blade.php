<div class="box-body">
  <div class="form-group">
    <label><span style="color: red;">*</span> Customer Group</label>
    {!! Form::select('customer_group', $customergroup, null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    <label><span style="color: red;">*</span> Full Name</label>
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    <label><span style="color: red;">*</span> Email</label>
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    <label><span style="color: red;">*</span> Phone</label>
    {!! Form::text('telepon', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
    <label><span style="color: red;">*</span> Address</label>
    {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 5]) !!}
  </div>
  <div class="form-group">
    <label><span style="color: red;">*</span> Province</label>
    {!! Form::select('provinsi', $provinsi, null, ['class' => 'form-control', 'placeholder' => '']) !!}
  </div>
  <div class="form-group">
    <label><span style="color: red;">*</span> City</label>
    {!! Form::select('kota', $kota, null, ['class' => 'form-control', 'placeholder' => '']) !!}
  </div>
  <div class="form-group">
    <label> Post Code</label>
    {!! Form::text('kodepos', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
