<div class="tab-content">
  <div class="tab-pane active" id="tab_1">
      <div class="box-body">
        <div class="form-group">
          <label><span style="color: red;">*</span> Category Name</label>
          {!! Form::text('category_name', null, ['class' => 'form-control']) !!}
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
      </div>
  </div>
  <div class="tab-pane" id="tab_2">
      <div class="box-body">
        <div class="form-group">
          <label>Parent</label>
          {!! Form::select('level', array(0 => '') + $parent->toArray(), null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Image</label>
          {!! Form::file('meta_image') !!} <br/>
          @if (isset($data) && $data->meta_image)
          @if($data->meta_image)
          {!! Html::image('assets/backend/images/categories/' . $data->meta_image) !!}
          @else
          {!! Html::image('assets/backend/images/categories/no-images.png') !!}
          @endif
          @endif
        </div>
        <div class="form-group">
          <label>Sort Order</label>
          {!! Form::text('order', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          <label>Status</label>
          {!! Form::select('status', ['A' => 'Enabled', 'N' => 'Disabled'], null, ['class' => 'form-control']) !!}
        </div>
      </div>
  </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Save</button>
</div>