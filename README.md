# 🛍️ Market — интернет-магазин на Laravel + Vue.js

Проект состоит из **бекенда на Laravel** и **фронтенда на Vue.js**. Используются:
- Laravel 10 (PHP 8+)
- Vue 2 (CLI)
- MySQL
- Vuex, Vue Router, Axios

---

## 📁 Структура проекта

```
Market/
├── backend/        # Laravel-приложение
├── frontend/       # Vue.js SPA (Vue CLI)
└── .gitignore
```

---

## 🚀 Запуск проекта

### 1. Клонируйте репозиторий

```bash
git clone git@github.com:ваш-пользователь/Market.git
cd Market
```

---

## 🧱 Backend (Laravel)

### 2. Установите зависимости

```bash
cd backend
composer install
```

### 3. Скопируйте `.env` и настройте

```bash
cp .env.example .env
```

Укажите настройки базы данных:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=market
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Генерация ключа

```bash
php artisan key:generate
```

### 5. Миграции и наполнение

```bash
php artisan migrate --seed
```

### 6. Запуск сервера

```bash
php artisan serve
```

По умолчанию: http://localhost:8000

---

## 🎨 Frontend (Vue)

### 7. Установите зависимости

```bash
cd ../frontend
npm install
```

### 8. Создайте `.env` файл

```bash
echo "VUE_APP_API_URL=http://localhost:8000/api" > .env
```

### 9. Запуск фронтенда

```bash
npm run serve
```

Откроется на http://localhost:8080

---

## 🧾 Возможности проекта

- Каталог товаров
- Корзина (на основе `session_id`)
- Оформление заказа
- Загрузка товаров через сиды
- API + Vue SPA
- Готово к доработке с админкой и PDF/Excel-выгрузкой

---

