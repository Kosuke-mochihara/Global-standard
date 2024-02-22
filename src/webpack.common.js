// ルールの設定
const jsRules = {
  test: /\.js$/, // .jsファイルを対象
  exclude: /node_modules/, // node_modulesディレクトリを除外
  use: {
    loader: "babel-loader", // babel-loaderを使用
    options: {
      presets: [
        [
          "@babel/preset-env",
          {
            // useBuiltIns: "usage", // 必要なpolyfillのみをインポート
            // corejs: 3, // core-jsのバージョン
            targets: {
              ie: 11
            }
          },
        ],
      ],
      plugins: ["@babel/plugin-transform-runtime"], // babelプラグイン
    },
  },
};

module.exports = {
  output: {
    filename: "[name].js", // 出力ファイル名
  },
  module: {
    rules: [jsRules], // ルールを追加
  },
  resolve: {
    extensions: [".js"], // .js 拡張子を解決
  },
};
