# Amazon Linux 2のコンテナイメージをDocke上で動かす
https://qiita.com/revsystem/items/32715cbdb0b3f1bb53b5

- DockerfileのFROM以外をコメントアウトしbuild実行

コマンドを実行
docker image build -t amzn2-awscliv2 .

コマンド実行でエラー
```
ERROR [stage-1 6/6] RUN git clone https://github.com/tfutils/tfenv.git ~/.tfenv     && echo 'export PATH="$HOME/.tfenv/bin:$PATH"' | tee -a ~/.bash_profile     && tfenv in
```

Dockerfileのあるディレクトリに移動してから起動していないのが原因
docker/phpに移動しビルド実行する

- Dockerを起動
docker compose up -d

mokumoku-projectがrestartingになっている
14行目に以下を追記
tty: true

もう一度Dockerを起動する
docker compose ps　でステータスが　Running　になっていることを確認

docker-compose exec mokumoku-project bash
