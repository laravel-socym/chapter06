# 第二部 Chapter 6 / 認証・認可
 
## 対応表
 
 - [リスト6.1.4.3：デフォルトのログイン後の動作変更例](app/Http/Controllers/Auth/RegisterController.php)
 - [リスト6.1.5.1：キャッシュ併用認証ドライバ実装例](app/Auth/CacheUserProvider.php)
 - [リスト6.1.5.2：独自認証ドライバ登録方法](app/Providers/AuthServiceProvider.php)
 - [リスト6.1.5.3：独自認証ドライバ指定例](config/auth.php)
 - [リスト6.1.6.1：パスワードリセットの拡張例](app/Auth/Passwords/PasswordManager.php)
 - [リスト6.1.6.2：独自パスワードリセットクラスの登録方法](app/Providers/PasswordServiceProvider.php)
 
 - [リスト6.2.1.3：user_tokensテーブル作成](database/migrations/2018_09_01_180935_create_user_tokens_table.php)
 - [リスト6.2.2.1：UserSeederクラス記述例](database/seeds/UserSeeder.php)
 - [リスト6.2.3.2：tokenからユーザー情報を検索する処理例](app/DataProvider/Database/UserToken.php)
 - [リスト6.2.3.3：Authenticatableインターフェース実装クラス](app/Entity/User.php)
 - [リスト6.2.3.4：UserProviderインターフェースの実装](app/Auth/UserTokenProvider.php)
 - [リスト6.2.3.5：実装した認証プロバイダの登録](app/Providers/AuthServiceProvider.php)
 - [リスト6.2.3.6：config/auth.phpへの追記](config/auth.php)
 - [リスト6.2.4.1：コントローラにおけるトークン認証によるユーザー情報取得例](app/Http/Controllers/UserAction.php)
 - [リスト6.2.4.2：routes/api.phpへルート追加](routes/api.php)
 
 - [リスト6.3.2.1：Tymon\JWTAuth\Contracts\JWTSubjectインターフェース実装例](app/User.php)
 - [リスト6.3.2.2：jwtドライバの追加](config/auth.php)
 - [リスト6.3.4.1：TokenResponderクラス実装例](app/Http/Responder/TokenResponder.php)
 - [リスト6.3.4.2：ログインコントローラクラスの実装例](app/Http/Controllers/User/LoginAction.php)
 - [リスト6.3.4.5：jwtドライバを介したユーザー情報アクセス例](app/Http/Controllers/User/Jwt/RetrieveAction.php)
 
 - [リスト6.4.4.3：Amazon OAuth 認証ドライバ実装例](app/Foundation/Socialite/AmazonProvider.php)
 - [リスト6.4.4.4：Socialiteを拡張してドライバを追加](app/Providers/SocialiteServiceProvider.php)
 - [リスト6.4.4.5：amazonドライバの利用例](app/Http/Controllers/Register/RegisterAction.php)
 - [リスト6.4.3.1：通信内容をログとして出力する例 + amazonドライバ](app/Http/Controllers/Register/CallbackAction.php)
 
 - [リスト6.5.2.3：1つの認可処理を1つのクラスとして表現する例](app/Gate/UserAccess.php)
 - [リスト6.5.2.5：beforeメソッドを利用した認可処理ロギング](app/Providers/AuthServiceProvider.php)
 - [リスト6.5.2.12：PHP のビルトインクラスを使ったポリシークラス実装例](app/Policies/ContentPolicy.php)
 - [リスト6.5.2.13：ポリシークラスの利用例](app/Http/Controllers/User/RetrieveAction.php)
 
 - [リスト6.5.3.2：Bladeテンプレート例](resources/views/hello.blade.php)
 - [リスト6.5.3.3：認可を伴うプレゼンテーションロジック実装例](app/Foundation/ViewComposer/PolicyComposer.php)
 - [リスト6.5.3.4：View Composerの登録例](app/Providers/AppServiceProvider.php)
 
## For Docker

### setup 

```bash
$ docker-compose up -d
$ docker-compose run composer install --prefer-dist --no-interaction && composer app-setup
$ docker-compose exec php-fpm php artisan key:generate
$ docker-compose exec php-fpm php artisan migrate
$ docker-compose exec php-fpm php artisan db:seed
```

#### コンテナのキャッシュが残っている場合

```bash
$ docker-compose build --no-cache
```

### 発行されるトークンの確認方法

```bash
$ docker-compose exec mysql bash
```

dockerのmysqlコンテナ内で以下を実行します

```bash
# mysql -u homestead -p homestead
```

MySQLで次のクエリで取得できます

```bash
mysql> SELECT * FROM user_tokens WHERE user_id = 1;
```


## ユーザーアカウント

| メールアドレス | パスワード |
|-----------------|-------------|
| mail@example.com | password |
