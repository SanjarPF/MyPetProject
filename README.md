# 🧠 MyPetApplication — Laravel Microservices Playground

[![PHPUnit](https://github.com/<your-username>/MyPetApplication/actions/workflows/tests.yml/badge.svg)](https://github.com/<your-username>/MyPetApplication/actions)
[![Laravel Pint](https://img.shields.io/badge/code_style-pint-FF2D20?style=flat&logo=laravel)](https://laravel.com/docs/10.x/pint)
[![Larastan](https://img.shields.io/badge/static_analysis-larastan-0D47A1?style=flat&logo=php)](https://github.com/nunomaduro/larastan)

## 📌 Описание

MyPetApplication — исследовательский Laravel-проект, построенный по принципам **чистой архитектуры**, **Porto-паттерна** (Containers/Ship), с изолированными функциональными модулями: авторизация, клиентский скоринг, уведомления и др. Каждый модуль — как отдельный микросервис внутри одного монолита.

---

## 🧱 Стек технологий

- **Laravel 12 / PHP 8.2**
- **Docker (Multi-stage build)**
- **RabbitMQ** (очереди + Horizon)
- **Redis** (кеш + pub/sub)
- **MySQL 8**
- **Meilisearch** (поиск)
- **Selenium + Mailpit** (только в dev-среде)
- **GitHub Actions** (CI)

---

## 🧭 Архитектура

- **Porto Pattern** — структура Containers/Ship, каждый модуль изолирован.
- **DDD-influenced** — слои: Actions, Tasks, Services, DTOs, Repositories.
- **Событийная модель** — `Event → Listener → Job`, с очередями в RabbitMQ.
- **Расширяемость** — легко добавлять новые "контейнеры" без нарушения существующей логики.
- **Без фронтенда** — тестирование через Postman и интеграционные тесты.

---

## 🚀 Запуск проекта

### ⚙️ Требования

- Docker + Docker Compose
- Make
- (опционально) Laravel Sail для локальной отладки

### 🧪 Быстрый старт (разработка)

```bash
cp .env.example .env
make init-dev
make up
make migrate-seed
