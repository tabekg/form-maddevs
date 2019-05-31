# Forum MadDevs (backend)

## Requirements

Use the package manager [composer](https://getcomposer.org/) to install the required packages.

```bash
cd backend && composer require
```

Create ``backend/.env`` file using ``backend/.env.example``.

## API documentation (JSON)

### /api/v1/`user/register` - User register
- **Method**: `POST`
- **Params**:
    - username (required)
    - email (required|email)
    - password (required|string|min:6|max:30)
- **Response**:
    - status (success | user_exists | error | invalid_params)
    - data (`USER_OBJECT`)

### /api/v1/`user/login` - User login
- **Method**: `POST`
- **Params**:
    - email (required)
    - password (required)
- **Response**:
    - status (success | incorrect | invalid_params)
    - data (`USER_OBJECT`)

### /api/v1/`user/check` - Check user authorization
Header with Authorization `remember_token`.
- **Method**: `POST`
- **Response (code: 200|401)**:
    - status (success | unauthorized)
    - data (`USER_OBJECT`)

### /api/v1/`topic` - Get topics list
- **Method**: `GET`
- **Params**:
    - take (integer)
    - skip (integer)
- **Response (code: 200|401)**:
    - status (success | unauthorized)
    - data (`TOPICS_ARRAY`)

### /api/v1/`topic` - Create new topic
- **Method**: `POST`
- **Params**:
    - title (required|string|max:250)
- **Response (code: 200|401)**:
    - status (success | topic_exists | error | invalid_params | unauthorized)
    - data (`TOPIC_OBJECT`)

### /api/v1/`topic` - Update a topic
- **Method**: `PUT`
- **Params**:
    - id (required|integer)
    - title (required|string|max:250)
- **Response (code: 200|401)**:
    - status (success | topic_not_found | error | invalid_params | access_denied | unauthorized)
    - data (`TOPIC_OBJECT`)

### /api/v1/`topic` - Delete a topic
- **Method**: `DELETE`
- **Params**:
    - id (required|integer)
- **Response (code: 200|401)**:
    - status (success | topic_not_found | error | invalid_params | access_denied | unauthorized)
    - data ()

### /api/v1/`post` - Get posts list
- **Method**: `GET`
- **Params**:
    - topic (required|integer)
    - take (integer)
    - skip (integer)
- **Response (code: 200|401)**:
    - status (success | topic_not_found | invalid_params | unauthorized)
    - data (`POSTS_ARRAY`)

### /api/v1/`post` - Create new post
- **Method**: `POST`
- **Params**:
    - topic (required|integer)
    - text (required|string|max:10000)
- **Response (code: 200|401)**:
    - status (success | post_exists | topic_not_found | error | invalid_params | unauthorized)
    - data (`POST_OBJECT`)

### /api/v1/`post` - Update a post
- **Method**: `PUT`
- **Params**:
    - id (required|integer)
    - text (required|string|max:10000)
- **Response (code: 200|401)**:
    - status (success | post_not_found | error | invalid_params | access_denied | unauthorized)
    - data (`POST_OBJECT`)

### /api/v1/`post` - Delete a post
- **Method**: `DELETE`
- **Params**:
    - id (required|integer)
- **Response (code: 200|401)**:
    - status (success | post_not_found | error | invalid_params | access_denied | unauthorized)
    - data ()