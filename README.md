# Гостевая книга

Пример гостевой книги без использования php-фреймворков (PHP 7.4)
 
Структура страницы:

1) Форма добавления записей в гостевую книгу по ajax-запросу.

        Поля формы:
            - Имя
            - E-mail
            - Сообщение
        
        Требования к форме:
            - Все поля формы являются обязательными для заполнения
            - Проверять корректность заполнения e-mail (проверку делаем только на стороне backend)
    
2) Под формой вывести 5 последних записей из гостевой книги. Записи хранить в БД MySQL или SQLite.

 
Структура таблицы гостевой книги:

```sql
CREATE TABLE `guest_book` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`dtime` DATETIME NOT NULL,
`name` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
`email` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
`body` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
PRIMARY KEY (`id`),
INDEX `dtime` (`dtime`)
) COLLATE='utf8_unicode_ci' ENGINE=InnoDB;
```
