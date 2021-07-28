# sesame2-www-template
PHPの軽量フレームワーク[sesame]のWEBパートのテンプレートです。
事前に[sesame]をダウンロードしてください。

使い方
1. 「~/www/index.php」を開き3行目あたりの「"/../../.sesame/init.php";」の参照を修正してください。
2. 「~/www/.app/db/db-conf-*.php」を自身のDB環境の接続情報に変更してください。
3. 「~/www/.app/db/create/*.sql」を自身のDBへ適応してください。
4. ブラウザから「www」のディレクトリのURLを指定して起動することを確認してください。
5. ブラウザから「~/www/api/init」を選択し、DBに初期データをINSERTしてください。

