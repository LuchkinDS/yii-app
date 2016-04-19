Задание:

Развернуть yii2-advanced

Сделать backend, в котором есть два раздела:
- Список пользователей - таблица всех зарегистрированных пользователей, с фильтром по email. Есть возможность отредактировать пользовательские данные и указать роль пользователя (пользователь, администратор)
- Список новостей - таблица всех новостей сайта с фильтром по названию. Есть возможность добавить/отредактировать новость. Поля "заголовок" и "текст". Для редактирования текста новости использовать какой-либо WYSIWYG 

Сделать frontend, содержащий:
- функционал регистрации и авторизации (уже реализован в yii2-advanced)
- список новостей с заголовком и текстом
- обновления на странице новостей должны подгружаться автоматически (т.е. добавили новость в админке - появилась без перезагрузки на странице новостей)

Примечание
- Все таблицы создавать через миграции
- Стили и JS для списка новостей на фронтенде загружать при помощи AssetBundle
- WYSIWYG должен быть установлен через composer 
- код вести в репозитории git, функционал желательно опубликовать в публичном репозитории на github

---- app init

composer update
yii migrate
yii migrate --migrationPath=@yii/rbac/migrations
yii rbac/init

---- publisher server - index.js

var http = require('http').Server();
var io = require('socket.io')(http);
var port = 3000;

io.on('connection', function(socket){
  	console.log('a user connected');
  	socket.on('disconnect', function(){
	    console.log('user disconnected');
	});
	socket.on('post', function (data) {
       	console.log(data);
       	io.emit('post', data);
    });
});

http.listen(port, function(){
  	console.log('listening on *:' + port);
});