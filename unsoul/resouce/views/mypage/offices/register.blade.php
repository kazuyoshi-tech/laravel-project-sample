<!DOCTYPE html>
<html lang="ja">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">

<title>マイページ 事業所追加画面|運SOUL</title>

<!-- # CSS area -->
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
<!-- # CSS area -->
</head>
<body class="corporation_list">
<div class="body_inner">

  <header>
    <div class="mypage_btn_wrap">
      <a class="mypage_btn">マイページ</a>
    </div>
  </header>

  <div class="container colom_flex"><!-- カラムの為のflexbox -->
    <!-- ▼ サイドバー -->
    <div class="sideber">
      <nav class="menu">
        <ul>
          <li><a href="{{ route('unsoul.labors.index') }}">労務システム</a></li>
          <li><a href="{{ route('unsoul.corporations.index') }}">法人管理</a></li>
          <li><a href="{{ route('unsoul.persons.index') }}">人 管理</a></li>
        </ul>

        <hr>

        <h3>マイページ</h3>
        <ul>
          <li><a href="{{ route('unsoul.mypage.edit_self') }}">本人情報</a></li>
        </ul>

        <hr>

        <h4>事業所</h4>
        <!-- TODO:事業所の登録から引っ張る -->
        <ul>
          <li><a href="{{ route('unsoul.mypage.corporations.edit') }}">本社</a></li>
          <li><a href="">大宮営業所</a></li>
        </ul>
        <hr class="dotted">

        <div class="regist_btn_wrap">
          <a href="{{ route('unsoul.mypage.offices.register') }}" class="regist_btn active">事業所追加</a>
        </div>

      </nav>
    </div>
    <!-- ▲ サイドバー -->

    <!-- ▼ メインコンテンツ -->
    <main>
      <div class="breadcrumb">
        <!-- ▼ パンくずリスト -->
        <ol itemscope itemtype="https://schema.org/BreadcrumbList">
          <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{ route('unsoul.home') }}">
              <span itemprop="name">ホーム</span>
            </a>
            <meta itemprop="position" content="1" />
          </li>

          <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a itemprop="item" href="{{ route('unsoul.mypage.offices.register') }}">
              <span itemprop="name">マイページ 事業所追加画面</span>
            </a>
            <meta itemprop="position" content="2" />
          </li>
        </ol>
      </div><!-- breadcrumb end -->
      <!-- ▲ パンくずリスト -->

      <!-- ▼ 登録画面 -->
      <section class="register_area">
        <h3>事業所追加画面</h3>
        <div class="area_inner">
{{--エラー表示用（暫定）--}}
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
          <form method="POST" action="{{ route('unsoul.mypage.offices.store') }}">
          @csrf
            <table class="no_border_table">
              <tbody>

                <tr>
                  <th colspan="2">事業所名</th>
                  <td colspan="3"><input type="text" name="name" value="{{ old('name') }}" required></td>
                </tr>

                <tr>
                  <th colspan="2">フリガナ</th>
                  <td colspan="3"><input type="text" name="phonetic" value="{{ old('phonetic') }}"></td>
                </tr>

                <tr>
                  <th rowspan="5">事務所住所</th>
                  <th>郵便番号</th>
                  <td colspan="3">
                    <input type="text" size="3" name="zip_code1" value="{{ old('zip_code1') }}">
                    -
                    <input type="text" size="4" name="zip_code2" value="{{ old('zip_code2') }}">
                  </td>
                </tr>

                <tr>
                  <th>都道府県</th>
                  <td colspan="3">
                    <select name="prefecture_id">
		            <option></option>
		            @foreach( $prefectures as $prefecture_id => $prefecture_name )
                        <option value="{{ $prefecture_id }}"
                            @if( old('prefecture_id') == $prefecture_id ) selected @endif
                        >
                            {{ $prefecture_name }}
                        </option>
                    @endforeach
                    </select>
                  </td>
                </tr>

                <tr>
                  <th>市区</th>
                  <td>
                    <input type="text" name="city" value="{{ old('city') }}">
                  </td>
                  <th>
                    町村
                  </th>
                  <td>
                    <input type="text" name="town" value="{{ old('town') }}">
                  </td>
                </tr>

                <tr>
                  <th>番地</th>
                  <td colspan="3">
                    <input type="text" name="street" value="{{ old('street') }}">
                  </td>
                </tr>

                <tr>
                  <th>建物</th>
                  <td colspan="3">
                    <input type="text" name="building" value="{{ old('building') }}">
                  </td>
                </tr>

            </table>

            <div class="register_btn_wrap">
              <button type="submit">追加</button>
              <button type="reset" class="reset_btn">キャンセル</button>
            </div>
          </form>
        </div>
      </section>
      <!-- ▲  登録画面 -->

    </main>
    <!-- ▲ メインコンテンツ -->
  </div><!-- colom_flex(カラムの為のflex)end -->

</div>
</body>
<!-- js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$('.reset_btn').on('click', function(){
  location.href = "{{ route('unsoul.home') }}";
});
<!-- js -->
</script>
</html>