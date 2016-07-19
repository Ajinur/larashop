<div class="tab-content">
  <div class="tab-pane active" id="tab_1">
      <div class="box-body">
        <div class="form-group">
          <label><span style="color: red;">*</span> Product Name</label>
          {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Description</label>
          {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'editor1', 'rows' => 10, 'cols' => 80]) !!}
        </div>
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
        @if(isset($tags))
        <div class="form-group">
          <label><span style="color: red;">*</span> Product Tags</label> <br/>
            @foreach ($tags as $tag)
            {!! Form::checkbox("tags[$tag->id]", $tag->id, null, array($tag->checked ? 'checked' : null)) !!} {!! $tag->tag !!}
            &nbsp;&nbsp;&nbsp;&nbsp;
            @endforeach
        </div>
        @endif
      </div>
  </div>
  <div class="tab-pane" id="tab_2">
      <div class="box-body">
        <div class="form-group">
          <label>Image</label>
          {!! Form::file('image') !!} <br/>
          @if (isset($data) && $data->image)
          @if($data->image)
          {!! Html::image('assets/frontend/images/products/' . $data->image) !!}
          @else
          {!! Html::image('assets/frontend/images/products/no-images.png') !!}
          @endif
          @endif
        </div>
        <div class="form-group">
          <label>Model</label>
          {!! Form::text('model', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Price</label>
          {!! Form::text('price', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Quantity</label>
          {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Length Type</label>
          {!! Form::select('length_type', $length, null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
        <div class="form-group">
          <label>Weight</label>
          {!! Form::text('weight', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Weight Type</label>
          {!! Form::select('weight_type', $weight, null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
        <div class="form-group">
          <label>Status</label>
          {!! Form::select('status', ['A' => 'Enabled', 'N' => 'Disabled'], null, ['class' => 'form-control']) !!}
        </div>
      </div>
  </div>
  <div class="tab-pane active" id="tab_3">
      <div class="box-body">
        <div class="form-group">
          <label>Manufacturer</label>
          {!! Form::select('brand_id', array('' => '') + $brand->toArray(), null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Categories</label>
          {!! Form::select('category_id', array('' => '') + $category->toArray(), null, ['class' => 'form-control']) !!}
        </div>
      </div>
  </div>
  
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Save</button>
</div>