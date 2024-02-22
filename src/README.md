# Template_EJS_Sass

## 環境

* Node.js 16系、18系


## Gulpfile.jsの設定
### EJSの場合

* browserSyncの
  * "server"のコメントを外す
  * "proxy"をコメントにする
```JavaScript
const browserSyncFunc = (done) => {
  browserSync.init({
    notify: false,
    // WordPress時にコメントにする
    server: "../dist/",
    // WordPress時にコメントを外す
    // proxy: "http://localhost.local/", //MAMPやLocalで利用するアドレスを指定
    files: [`../${themeName}/**/*.php`],
  });
  done();
};
```

### WordPressの場合

* 定数 themeName に WordPressのテーマ名を設定する

```JavaScript
const themeName = "wpTheme"; // WordPress theme name
```

* browserSyncの
  * "server"をコメントにする
  * "proxy"のコメントを外す
  * "proxy" に ローカル上で起動するURLを設定する(MAMPやLocal等)

```JavaScript
const browserSyncFunc = (done) => {
  browserSync.init({
    notify: false,
    // WordPress時にコメントにする
    server: "../dist/",
    // WordPress時にコメントを外す
    // proxy: "http://localhost.local/", //MAMPやLocalで利用するアドレスを指定
    files: [`../${themeName}/**/*.php`],
  });
  done();
};
```
## 起動方法

* srcフォルダに移動
```
cd src
```

* nodeのバージョンを確認
  * 該当のバージョンであることを確認する
```
node -v
```

* node modulesをインストール
```
npm i
```

* Gulpを起動
  * EJSの場合：http://localhost:3000
  * WPの場合：MAMP等で設定したURL、http://localhost:3000 どちらでも良い
```
npx gulp
```

### ファイル構成
* src：開発用フォルダ
  * ejs：EJSファイル
  * images：画像ファイル
  * js：JavaScriptファイル
  * sass：Sassファイル
* dist：ビルドファイル、npm iしたあとに作成される
  * css：CSSファイル
  * images：画像ファイル
  * js：JavaScriptファイル
  * EJSで生成したHTMLファイルはdistフォルダ直下に格納される
* wpTheme：WP用ファイル、npm iしたあとに作成される
  * assets：WP用アセットファイル
    * css：CSSファイル
    * images：画像ファイル
    * js：JavaScriptファイル