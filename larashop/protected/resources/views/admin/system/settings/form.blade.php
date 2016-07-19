<div class="tab-content">
  <div class="tab-pane active" id="tab_1">
      <div class="box-body">
        <div class="form-group">
          <label><span style="color: red;">*</span> Store Name</label>
          {!! Form::text('store_name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label><span style="color: red;">*</span> Store Owner</label>
          {!! Form::text('store_owner', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label><span style="color: red;">*</span> Store Url</label>
          {!! Form::text('store_url', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label><span style="color: red;">*</span> Address</label>
          {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 5]) !!}
        </div>
        <div class="form-group">
          <label><span style="color: red;">*</span> Email</label>
          {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label><span style="color: red;">*</span> Phone</label>
          {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label> Fax</label>
          {!! Form::text('fax', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Logo</label>
          {!! Form::file('logo') !!} <br/>
          @if (isset($data) && $data->logo)
          @if($data->logo)
          {!! Html::image('assets/backend/images/logo/' . $data->logo, '', ['width' => '150px', 'height' => '100px']) !!}
          @else
          {!! Html::image('assets/backend/images/logo/no-images.png') !!}
          @endif
          @endif
        </div>
      </div>
  </div>
  <div class="tab-pane" id="tab_2">
      <div class="box-body">
        <div class="form-group">
          <label><span style="color: red;">*</span> Meta Tag Title</label>
          {!! Form::text('meta_title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Meta Tag Description</label>
          {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'rows' => 5]) !!}
        </div>
        <div class="form-group">
          <label>Meta Tag Keywords</label>
          {!! Form::text('meta_keyword', null, ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
          <label>Invoice Prefix</label>
          {!! Form::text('model', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Order Status</label>
          {!! Form::select('order_status', $orderStatus, null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
        <div class="form-group">
          <label>Processing Order Status</label>
          {!! Form::select('processing_order_status', $processingOrderStatus, null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
        <div class="form-group">
          <label>Complete Order Status</label>
          {!! Form::select('complete_order_status', $completeOrderStatus, null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
      </div>
  </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Save</button>
</div>