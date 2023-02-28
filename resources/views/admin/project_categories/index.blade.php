@extends('layouts.main')

@section('title')
Quản lý danh mục dự án
@endsection

@section('page_title')
Quản lý danh mục dự án
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/nested.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.nestable.css') }}">
@endsection
@section('buttons')
<a href="{{ route('project_categories.create') }}" class="btn btn-outline-success btn-sm" class="btn btn-info"><i class="fa fa-plus"></i> Thêm mới</a>
@endsection
@section('content')
<div ng-cloak>
  <div class="row" ng-controller="PostCategory">
    <div class="col-12">
      <div class="card">
        <div class="nested-box">
          <div class="col-lg-12 row-button">
            <menu id="nestable-menu">
              <button type="button" class="btn-outline-primary btn-sm" data-action="expand-all">Mở rộng <i class="fa fa-plus"></i></button>
              <button type="button" class="btn-outline-danger btn-sm" data-action="collapse-all">Thu gọn <i class=" fa fa-minus"></i></button>
            </menu>
            <input type="hidden" id="id">
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="wrap bg-white">
              <div class="cf nestable-lists">
                <div class="dd" id="nestable">
                  @php
                  $query = $categories;
                  $ref = [];
                  $items = [];
                  foreach ($query as $data) {
                  $thisRef = &$ref[$data->id];
                  $thisRef['parent_id'] = $data->parent_id;
                  $thisRef['name'] = $data->name;
                  $thisRef['slug'] = $data->slug;
                  $thisRef['id'] = $data->id;

                  if($data->parent_id == 0) {
                  $items[$data->id] = &$thisRef;
                  } else {
                  $ref[$data->parent_id]['child'][$data->id] = &$thisRef;
                  }
                  }
                  function get_menu($items,$class = 'dd-list') {
                  $html = "<ol class=\"".$class."\" id=\"menu-id\">";
                    foreach($items as $key=>$value) {
                    $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'">
                      <div class="dd-handle dd3-handle"></div>
                      <div class="dd3-content"> <span id="label_show'.$value['id'].'">'.$value['name'].'</span>
                        <span class="span-right">

                          <a class="edit-button" href="'. route('project_categories.edit',$value['id']) .'" id="'.$value['id'].'" label="'.$value['name'].'"><i class="fas fa-pencil-alt"></i></a>
                          <a class="del-button confirm" href="'. route('project_categories.delete',$value['id']) .'" id="'.$value['id'].'"><i class="fa fa-trash"></i></a></span>
                      </div>';
                      if(array_key_exists('child',$value)) {
                      $html .= get_menu($value['child'],'child');
                      }
                      $html .= "
                    </li>";
                    }
                    $html .= "</ol>";
                  return $html;
                  }
                  print get_menu($items);
                  @endphp
                </div>
              </div>
              <p></p>
              <input type="hidden" id="nestable-output">
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/jquery.nestable.js') }}"></script>
<script>
  $(document).ready(function()
  {

    var updateOutput = function(e)
    {
      var list   = e.length ? e : $(e.target),
      output = list.data('output');
      if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
          } else {
            output.val('JSON browser support required for this demo.');
          }
        };

    // activate Nestable for list 1
    $('#nestable').nestable({
      group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    $('#nestable-menu').on('click', function(e)
    {
      var target = $(e.target),
      action = target.data('action');

      if (action === 'expand-all') {
        $('.dd').nestable('expandAll');
      }

      if (action === 'collapse-all') {
        $('.dd').nestable('collapseAll');
      }

    });
  });
</script>

<script>
  $(document).ready(function(){
    $("#load").hide();

    $('.dd').on('change', function() {
      $("#load").show();
      var dataString = {
        data : $("#nestable-output").val(),
      };
      console.log(dataString);
      var baseURL = window.location.origin;
      $.ajax({
        type: "POST",
        url: baseURL + '/admin/project-categories/nested-sort',
        data: {dataString},
        cache : false,
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        success: function (response) {
          if(response.success) {
            toastr.success(response.message);
          } else {
            toastr.warning(response.message);
          }
        },
        error: function () {
            toastr.error('Đã có lỗi xảy ra');
        },
        complete: function () {
            $scope.loading.submit = false;
            $scope.$applyAsync();
        },
      });

    });

    $(document).on("click",".edit-button",function() {
      var id = $(this).attr('id');
      var label = $(this).attr('label');
      var link = $(this).attr('link');
      $("#id").val(id);
      $("#label").val(label);
      $("#link").val(link);
    });
  });

  app.controller('PostCategory', function ($rootScope, $scope, $http) {
      $scope.loading = {};
      $scope.form = {}
      $scope.show_home_page = [
          {'name': 'show', 'value': '1'},
          {'name': 'hide', 'value': '0'},
      ];
  });
</script>
@include('partial.confirm')
@endsection
