<b>Начало</b>

    1. Используем Open Server 5.3.9 на Windows 10, кодинг на VS Code
    2. composer create-project --prefer-dist yiisoft/yii2-app-basic pichost.loc
    3. git init
    4. Создадим БД с помощью phpMyAdmin - “pichost”. Сравнение по-умолчанию utf8mb4
    5. Указываем настройки БД в конфигурации приложения - config/db.php - 'dsn' => 'mysql:host=localhost;dbname=pichost'
    6. Еще несколько настроек перед git commit:
        ◦ 'language' => 'ru-RU',
        ◦ 'name' => 'PicHost',
        ◦ Включаем urlManager - 'enablePrettyUrl' => true
        ◦ Интернационализация i18n - 'basePath' => '@app/messages'

<b>Создание схемы данных и миграций</b> - yii migrate/create create_picture_table

    public function safeUp()
    {
        $this->createTable('{{%picture}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Name'),
            'target' => $this->string()->notNull()->comment('Target'),
            'ext' => $this->string()->notNull()->comment('Extension'),
            'created_at' => $this->string()->comment('Creation Time'),
        ]);
    }

    yii migrate -- yes

<b>Создание модели при помощи Gii</b>

    Model Class Name — Picture

    Enable I18N — yes

<b>Создание CRUD при помощи Gii</b>

    Model Class - app\models\Picture
    Search Model Class - app\models\PictureSearch
    Controller Class - app\controllers\PictureController
    View Path - @app\views\picture

    Enable I18N — yes

<b>Загрузка картинок</b>

    Создадим модель формы UploadForm. Для свойства files задаем правило валидации maxFiles => 5
    и поддерживаемые форматы файлов bmp, png, jpg

    Метод upload формы вызывается из экшена контроллера, принимаем массив файлов из формы,
    затем регистрируем каждый файл в таблице pictures

    Метод checkName транслитирирует наименование файла и проверяет наличие файла на сервере, если находит, то
    добаляет инремент к названию, сохраняем в БД новую запись и, используя метод saveAs сохраняем файл физически
    с новым именем.

<b>/picture/index</b>

    Работа с Thumbnail осуществлюяется с помощью дополнения "yiisoft/yii2-imagine": "~2.2.0", установленного через composer
