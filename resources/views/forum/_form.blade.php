@extends('layouts.video')
@section('content')

<div class="container">
	<div class="row">
	   	<div class="col-md-10 col-md-offset-1">
			<h2>發表文章</h2>
			<hr>
			<div id="forum_list" class="form-group">
				列表 
				@foreach($lists as $key => $list)
				{{ Form::select('list', array($key => $list)) }}
			</div>
			<div id="forum_title" class="form-group">
				標題 {{ Form::text('title', null, ['style' => 'width: 250px;']) }}
			</div>
			<div id="forum_type" class="form-group">
				分類 {{ Form::radio('type', '0') }} 分析
					{{ Form::radio('type', '1') }} 新聞
					{{ Form::radio('type', '0') }} 閒聊
			</div>
			<div id="forum_content" class="form-group">
				內容 {{ Form::textarea('content', null, ['class' => 'form-control']) }}
			</div>
			<div id="forum_img" class="form-group">
				{{ Form::file('img') }}
			</div>
			<div id="forum_predict" class="form-group" style="display: none;">
				賽事預測 {{ Form::radio('predict', '0', 'ture') }} 關閉
						{{ Form::radio('predict', '1') }} 開啟
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
</script>
@endsection
