# Laravel Workshop Handbook

## 1. Tanımlar

### 1.1 Framework?
Framework, üretken olmanıza yardımcı olmak amacıyla; genel kodların uygulama kodlarından ayrılmasını sağlayan bütün yapıdır. Bir veya daha fazla spesifik işleme odaklanmanız için iskelet yapı ve araçlar barındırır. Low-Level diye bahsettiğimiz daha temel kısımlar framework tarafından halledilir.

### 1.2 Web Framework?
Web Framework ise web geliştirme amaçlı hazırlanan iskelet ve araçları barındırır. Framework'ün "Web" odaklı halidir.

### 1.3 PSR Standartları?
PSR(PHP Standard Recommendation), PHP-FIG(PHP Framework Interop Group) tarafından belirlenmiş PHP standartlar bütünüdür. Java'nın JSR'ına benzer şekilde PHP üzerinde uyulması tavsiye edilen yazım ve kullanım şekilleridir. Çeşitli şekillerde yazım olduğu için belirli bir standartı takip etmek tüm geliştiriciler için iyi olacaktır.

- **PSR-0**, Otomatik yükleme(Autoloading) ile ilgili standartları belirtmektedir.
- **PSR-1**, Temel kodlama standartlarını belirlemektedir.
- **PSR-2**, Kodlama stillerini baz alan ve diğer yazılımcıların kodlarını okumamızda kolaylık sağlayacak temel standartları belirtir.
- **PSR-3**, Log araçları için temel bulunması gereken gereksinimleri belirtir.
- **PSR-4**, Otomatik yükleme için bir dosyanın bulunması gereken yeri ve otomatik yükleme adımları için gereksinimleri belirler. Diğer otomatik yükleme standartlarından biri ile beraber kullanılabilir. (Örn; PSR-0)
- **PSR-5**, PHP Dökümantasyon standartlarıdır. "phpDocumentor" aracı ile ilişkilidir. DocBlocklarda bulunması gereken tanımları belirtir.
- **PSR-6**, Cache ile ilgili arayüzlerde bulunması gereken gereksinimleri belirtir.
- **PSR-7**, HTTP Mesaj arayüzleri için RFC 7230 ve RFC 7231 HTTP protokol standartlarına göre uyulması gerekenleri belirtir.
- **PSR-8**, Objelerin birbirleriyle olan ilişkileri hakkında standartları belirtir. Taslak aşamasındadır.
- **PSR-9**, Güvenlik açıklamaları ile ilgili standarttır.
- **PSR-10**, Güvenlik tavsiyeleri ile ilgili standarttır. Yapı içerisinde açıkça güvenlik zaafiyetlerinin belirtilmesidir.
- **PSR-11**, Bağımlılık sızdırma amaçlı yapılan "Container" yapılarında bulunması gereken sistemi belirten standarttır.
- **PSR-12**, PSR-1'in devamı ve PSR-2'nin yeni hali olan bir standarttır. Kod yazımı ile ilgili uyulması gerekenleri belirtir.

### 1.4 Composer
PHP için **Bağımlılık** Yöneticisidir. Bir PHP yazılımı için gerekli olan kütüphane ve araçların yönetiminden sorumludur. Ek olarak, PHP uygulamalarının kurulumuna da yardımcıdır.

### 1.5 Symfony
Harici olarak kullanımı yüksek PHP parçalar ve kütüphanelerinden oluşan bir Web Application Frameworktür. İçerisinde bulunan parçalar şu şekildedir.

- **Asset**
- **BrowserKit**
- **Cache**
- **ClassLoader**
- **Config**
- **Console**
- **CssSelector**
- **Debug**
- **DependencyInjection**
- **DomCrawler**
- **Dotenv**
- **EventDispatcher**
- **ExpressionLanguage**
- **Filesystem**
- **Form**
- **Guard**
- **HttpFoundation**
- **HttpKernel**
- **Icu**
- **Intl**
- **Ldap**
- **Locale**
- **Lock**
- **OptionsResolver**
- **PHPUnit Bridge**
- **Polyfill APCu**
- **Polyfill Iconv**
- **Polyfill Intl Grapheme**
- **Polyfill Intl ICU**
- **Polyfill Intl Normalizer**
- **Polyfill Mbstring**
- **Polyfill PHP 5.4**
- **Polyfill PHP 5.5**
- **Polyfill PHP 5.6**
- **Polyfill PHP 7.0**
- **Polyfill PHP 7.1**
- **Polyfill PHP 7.2**
- **Polyfill Util**
- **Polyfill Xml**
- **Process**
- **PropertyAccess**
- **PropertyInfo**
- **Routing**
- **Security**
- **Serializer**
- **Stopwatch**
- **Templating**
- **Translation**
- **Validator**
- **VarDumper**
- **WebLink**
- **Workflow**
- **Yaml**

### 1.6 Query Builder
Query Builder, akıcı ve anlaşılır veritabanı sorgularını oluşturmak ve çalıştırmak için oluşturulan bir arayüzdür. 

### 1.7 Unit Test
Yazılım geliştirmenin bir adımı olan **Unit Test**, bir uygulamanın en küçük parçalarına yapılan testlerin ismidir. Unit Test'ler manuel yapılabileceği gibi otomatik olarak da yapılabilir. Aynı zamanda Unit Test, TDD metodolojisinin bir parçasıdır. Bu metodolojide, geliştiriciden önce hatalı unit testin yazılmasını ardından kodun yazılması ile beraber unit test başarılı olana kadar uygulamanın refactor edilmesini ister. 

### 1.8 CLI


### 1.9 Frontend Araçları

## 2. Kurulum

3 tür kuruluma da workshop içerisinde değinip ayrı ayrı kurulumlarını yapacağız.

### 2.1 Composer

```bash
composer create-project --prefer-dist laravel/laravel projeadi
```

### 2.2 Laravel Installer

```bash
composer global require "laravel/installer"
laravel new projeadi
```
 
### 2.3 Homestead

Virtualbox + Vagrant

## 3. Yapı

- app
  - Console
  - Events
  - Exceptions
  - Http
  - Jobs
  - Listeners
  - Mail
  - Notifications
  - Policies
  - Providers
  - Rules
- bootstrap
- config
- database
- public
- resources
- routes
- storage
- tests

## 4. Bir İsteğin Hayat Döngüsü

- Bootstrap
- Kernel
- Service
- Route

## 5. Dependency Injection ve Service Container

- Bind
- Make

## 6. Interfa.. Öhmm.. Contract

- Interface?
- Facade?
- Contract?

## 7. Basic

- Route
- Middleware
- Controller
- Request
- Response
- View (Blade)
- Request Class, Validation
- Log

## 8. Eloquent ORM

- ORM?
- Eloquent?
- Relationship

## 9. Laravel Mix - Frontend

- Less? Sass?
- Vue?
- Gulp? Grunt?.. Webpack?

## 10. Test

- Unit Test
- Browser Test

## 11. Paket Geliştirme

- Packalyst?
- Publish Data?
- Özel Servis (Custom Service)
  - Register ve Boot

## 12. Örnek Proje

Örnek bir proje yapacağız, lakin henüz konu ve arayüz belirli değil.

## 13. Paket Oluşturalım ve Yayınlayalım

Katılımcılardan yayınlamak üzere bir Laravel paketi oluşturmasını isteyeceğiz. Zamanın yeterli olması için aşağıdaki konularda paket seçimi yapabilirler.

- İstatistik Paketi
- Herhangi bir API'nin wrapper paketi
- Ayar paketi (Settings, Config vs)
- Gravatar Paketi
- Captcha Paketi
- CLI Paketi
- Lockscreen Paketi
- Bildirim(Notification) Paketi

--- 
> Duruma göre 5 ve 6 maddeleri sona alınabilir.