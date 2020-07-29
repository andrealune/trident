# Trident hiring test

## Usage
- `docker-compose up -d --build site`

- **nginx** - `:8080`
- **mysql** - `:3306`

## Run migrations

- `docker-compose run --rm artisan migrate` 

## Endpoints

- Register: POST - /api/register {name,email,password,password_confirmation}
- Login: POST - /api/login {email,password}
- Product store: POST - /api/products {name,detail} [Auth: token]
- Product list: GET - /api/products {name,detail} [Auth: token]
- Wishlist store: POST - /api/wishlists {name} [Auth: token]
- Wishlist add product: POST - /api/wishlists/add {wishlist_id,product_id} [Auth: token]

## Export wishlists CSV

- `docker-compose run --rm artisan wishlist:export` 

## Run test

- `docker-compose run --rm artisan test` 

