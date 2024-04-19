$(function() {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  // document.querySelector() メソッドを使用して、
  // <meta> タグの name 属性が "csrf-token" である要素を検索しています。
  // その要素の content 属性の値を取得して、csrfToken という定数に格納しています
  // ※constは定数宣言
  // 非同期通信となるためJavaScript内で取得しておく必要があるため
  // この記述でHTML内にセットされているCSRFトークンを取得できる
  $(".todo-status-button").change(function () {
    // todo-status-buttonというクラスが振られたタグに変更があった時に 続く処理が実行されます。
    // →チェックボックスのこと
    const content = $(this).val();
    // $(this)は、この関数内では変更されたチェックボックスのタグのこと
    // チェックボックスのvalue属性の値を取得してcontentに代入し
    const url = $(this).parent(".todo-status-form").attr("action");
    // 「変更されたチェックボックスのタグ」の親要素にあたる「todo-status-form」というクラスが付けられた要素を取得し、
    // そのaction属性の値を取得してurlに代入しています。
    

    // 非同期通信をするための記述
    // $ajax()は非同期通信をするための関数
    $.ajax(
      url,
      {
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken }
        // CSRFトークンをリクエストヘッダ（headers）に持たせてPOST通信
        // →ルートに送られ、Controllerで処理がされ

      }
    )

    // done()関数は通信が成功した時に上記のような処理が実行されます
    .done(function(data) {
      if (data.is_completed) {
        window.alert('「' + content + '」のToDoを完了にしました。');
      } else {
        window.alert('「' + content + '」のToDoの完了を取り消しました。');
      }
    })
    .fail(function() {
      window.alert('通信に失敗しました。');
    });
  });
  
});