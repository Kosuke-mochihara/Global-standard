// 必要なモジュールをインポート
const webpack = require("webpack");
const { merge } = require("webpack-merge");
const common = require("./webpack.common.js");

// プラグインの設定
const limitChunkCountPlugin = new webpack.optimize.LimitChunkCountPlugin({
  maxChunks: 1, // 最大チャンク数を1に制限
});

module.exports = merge(common, {
  mode: "development", // 開発モード
  devtool: "source-map", // ソースマップの設定 // ソースマップの設定
  cache: {
    type: "filesystem", // ファイルシステムをキャッシュタイプとして使用
    buildDependencies: {
      config: [__filename], // このファイルをビルド依存関係として追加
    },
  },
  plugins: [limitChunkCountPlugin], // プラグインの追加
  performance: {
    hints: false, // パフォーマンスの警告を無効化
  },
});
