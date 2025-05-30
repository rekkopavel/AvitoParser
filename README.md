# Avito Parser & Telegram Notifier

Этот проект представляет собой парсер для сайта Avito, который извлекает данные о товарах по заданным запросам и отправляет уведомления о новых товарах через Telegram. Проект разработан с использованием фреймворка Laravel.

## Основные особенности

- **Парсинг Avito**: Извлечение информации о товарах с сайта Avito по заданным запросам.
- **Telegram уведомления**: Уведомление подписчиков через Telegram, когда новые товары добавляются на сайт.
- **Запуск через консоль**: Запуск парсера с помощью команды Artisan в Laravel.
- **Асинхронная работа**: Использование Node.js для обработки запросов и извлечения HTML-страниц.
- **Управление подписчиками**: Возможность добавлять и управлять подписчиками для отправки уведомлений.

## Структура проекта

- **Parser** — сервис, который управляет процессом парсинга.
- **HtmlFetcher** — отвечает за извлечение HTML с сайта Avito с помощью Node.js.
- **HtmlParser** — парсит полученные страницы и извлекает информацию о товарах.
- **LogService** — сервис для логирования ошибок и информации.
- **TelegramChannel** — канал для отправки уведомлений через Telegram.
- **QueryRepository** — управляет запросами для парсинга, такие как города и URL.
- **Subscriber** — модель для управления подписчиками в базе данных.
- **Console Command** — команду можно запустить через Artisan для начала парсинга.

## Установка

//

## Как это работает

1. **Запросы**: В базе данных хранится список активных запросов, которые будут использоваться для парсинга. Каждый запрос содержит информацию о том, что и где искать на сайте Avito.
2. **Парсинг данных**: Для каждого запроса извлекаются данные с сайта, после чего они парсятся и сохраняются в базе данных.
3. **Уведомления**: После того как данные успешно парсены и сохранены, система проверяет наличие новых товаров и отправляет уведомления через Telegram всем подписчикам.

## Команды Artisan

- `parser:run` — Запускает процесс парсинга данных с сайта Avito.

## Лицензия

Этот проект лицензирован под [MIT License](LICENSE).

---

Этот README объясняет, как установить, настроить и запустить проект, а также как работать с его основными функциями и командами. Если вам нужно больше информации или есть вопросы, не стесняйтесь создать Issue в репозитории.
