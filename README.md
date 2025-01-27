<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Pré-requis

1. Lancer les migrations et les seeders avec la commande :
php artisan migrate:fresh --seed


2. Ajouter la configuration de passport avec la commande :
php artisan passport:client --password

Entrer : "Password User", 0

Récupérer : Client ID, client_secret

3. Sur postman : lancer la requête "post oauth token" avec ces paramètres :
- grant-type : password
- client_id : 1
- client_secret : client secret récupérer précédemment
- username : admin@admin.com
- password : password

Récupérer l'access_token

4. Ajouter la configuration de passport avec la commande :
php artisan passport:client --personal
Passport Client Personal


5. Remplacer le bearer token des requêtes postman par l'access_token récupéré


6. Désactiver l'envoi d'email à la création d'un nouvel utilisateur :

Commenter la ligne 27 dans AppServiceProvider.php : User::observe(UserObserver::class);


## Routes API et utilisations

⭐ : Les routes suivie de cette étoile sont des routes uniquement accessible par un admin. Dans Postman, il est nécessaire de renseigner l'access_token dans Authorization > Bearer token.

## Utilisateurs

#### Créer un utilisateur

```http
  POST /api/users/create
```
Accessible par tout le monde, même sans token.

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Requis**. Le nom de l'utilisateur |
| `email` | `string` | **Requis et unique**. L'email de l'utilisateur |
| `password` | `string` | **Requis**. Le mot de passe de l'utilisateur |

#### Récupérer les utilisateurs ⭐

```http
  GET /api/users
```

#### Récupérer un utilisateur spécifique par son ID ⭐

```http
  GET /api/users/${id}
```

#### Modifier un utilisateur par son ID ⭐

```http
  PATCH /api/users/${id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Optionel**. Le nouveau nom de l'utilisateur |
| `email` | `string` | **Optionel**. Le nouveau email de l'utilisateur |
| `password` | `string` | **Optionel**. Le nouveau mot de passe de l'utilisateur |
| `is_admin` | `boolean` | **Optionel**. Le grade is_admin |

#### Supprimer un utilisateur spécifique par son ID ⭐

```http
  DELETE /api/users/${id}
```

## Animes

#### Créer un anime ⭐

```http
  POST /api/animes
```


| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `title` | `string` | **Requis**. Le titre de l'anime |
| `description` | `string` | **Requis**. La description de l'anime |
| `imageURL` | `string` | **Requis**. URL de l'image de l'anime |
| `release_date` | `string` | **Requis**. La date de sortie de l'anime |
| `details` | `string` | **Optionel**. Des détails supplémentaires sur l'anime |

#### Récupérer les animes ⭐

```http
  GET /api/animes
```


#### Récupérer un anime spécifique par son ID ⭐

```http
  GET /api/animes/${id}
```


#### Modifier un anime par son ID ⭐

```http
  PATCH /api/animes/${id}
```


| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `title` | `string` | **Optionel**. Le titre de l'anime |
| `description` | `string` | **Optionel**. La description de l'anime |
| `imageURL` | `string` | **Optionel**. URL de l'image de l'anime |
| `release_date` | `string` | **Optionel**. La date de sortie de l'anime |
| `details` | `string` | **Optionel**. Des détails supplémentaires sur l'anime |

#### Supprimer un anime spécifique par son ID ⭐

```http
  DELETE /api/animes/${id}
```


## Musics

#### Récupérer les musiques ⭐

```http
  GET /api/musics
```


#### Récupérer une musique spécifique par son ID ⭐

```http
  GET /api/musics/${id}
```


#### Modifier une musique par son ID ⭐

```http
  PATCH /api/musics/${id}
```


| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `title` | `string` | **Optionel**. Le titre de la musique |
| `file` | `string` | **Optionel**. Le lien du fichier MP3 de la musique |
| `duration` | `string` | **Optionel**. La durée en seconde de la musique |
| `animes_id` | `string` | **Optionel**. L'ID de l'anime d'où provient la musique |

#### Supprimer une musique spécifique par son ID ⭐

```http
  DELETE /api/musics/${id}
```






