// 必要なモジュールをインポート
const webpack = require("webpack");
const { merge } = require("webpack-merge");
const common = require("./webpack.common.js");
const TerserPlugin = require("terser-webpack-plugin");

// プラグインの設定
const limitChunkCountPlugin = new webpack.optimize.LimitChunkCountPlugin({
  maxChunks: 1, // 最大チャンク数を1に制限
  // チャンク数はコードを分割する個数のこと。コード分割を行わず、1つのファイルにまとめる。
});

const terserPlugin = new TerserPlugin({
  extractComments: false, // コメントを削除
  terserOptions: {
    compress: {
      drop_console: true, // コンソール出力を削除
    },
  },
});

module.exports = merge(common, {
  mode: "production", // 本番モード
  plugins: [limitChunkCountPlugin], // プラグインの追加
  optimization: {
    minimize: true, // 最小化を有効化
    minimizer: [terserPlugin], // コードの最小化処理。不要な空白やコメントを取り除く。
  },
  performance: {
    hints: false, // パフォーマンスの警告を無効化
  },
});
