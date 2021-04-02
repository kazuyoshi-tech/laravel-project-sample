@php (config(['adminlte.plugins.Chartjs.active'=>true]))
@extends('adminlte::page')

@section('title', '企業情報管理')

@section('content_header')
<h1>企業情報管理</h1>
@stop

@section('content')
<p>企業情報を管理します</p>

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">企業情報登録フォーム</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>

  </div>


  <!-- /.card-header -->
  <div class="card-body">
    <form action="{{ route('exhibitor_admin.exhibitors.update', [$slug]) }}" method="post" onsubmit="return false;">

      @csrf

      <div class="row">
        <div class="col-5 col-sm-3">
          <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile"
              role="tab" aria-controls="vert-tabs-profile" aria-selected="false">基本情報</a>
            <a class="nav-link" id="vert-tabs-images-tab" data-toggle="pill" href="#vert-tabs-images" role="tab"
              aria-controls="vert-tabs-images" aria-selected="false">画像</a>
            <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab"
              aria-controls="vert-tabs-settings" aria-selected="false">動画</a>
            <a class="nav-link" id="vert-tabs-attachment-files-tab" data-toggle="pill"
              href="#vert-tabs-attachment-files" role="tab" aria-controls="vert-tabs-attachment-files"
              aria-selected="false">添付ファイル</a>
          </div>
        </div>
        <div class="col-7 col-sm-9">
          <div class="tab-content" id="vert-tabs-tabContent">
            <div class="tab-pane fade show active" id="vert-tabs-profile" role="tabpanel"
              aria-labelledby="vert-tabs-profile-tab">
              @include('exhibitor_admin.products.form.basic_data')
            </div>
            <div class="tab-pane fade" id="vert-tabs-images" role="tabpanel" aria-labelledby="vert-tabs-images-tab">
              @include('exhibitor_admin.products.form.images')
            </div>
            <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
              @include('exhibitor_admin.products.form.videos')
            </div>
            <div class="tab-pane fade" id="vert-tabs-attachment-files" role="tabpanel"
              aria-labelledby="vert-tabs-attachment-files-tab">
              @include('exhibitor_admin.products.form.attachment_files')
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#modal-sm">保存</button>
      </div>

      <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">確認メッセージ</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>企業情報を保存します。よろしいですか？&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
              <button type="submit" class="btn btn-primary" onclick="submit();">保存する</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </form>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->



@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@append

@section('js')
{{--
@component('components.modal.delete')
--}}
@component('components.adminlte.form.advanced_modal_message')
@endcomponent
@append