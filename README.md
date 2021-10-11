# AquaStore

Thank you for the opportunity to share what I have been exposed to over the years, it is a real pleasure to me.
I have a few things to note.

The back-end is done with Laravel 8 (the latest), to get started:

- Clone this repository (via http to avoid auth)
- cd aquastore (or the base of the repository) run composer install
- copy .env.example file to .env and update the **db configuration**, (I did this with MySQL)
- run `php artisan key:gen`
- you can also set the debug flag to false.
- run `php artisan migrate:fresh --seed` to create database tables and fill them with dummy or default data found in `database/seeders/` dir

## Usage instructions

I have exposed a few API endpoints

1. Public endpoints
   - `/fish` - method = GET: will return all the fish in the AquaStore.
   - `/aquariums` - method = GET: will return all the aquariums in the AquaStore.
2. Protected endpoints
   - `/fish` - method = POST: this will create a fish, required fields are `common_name, species, color, fins`
   - `/fish/{id}` - method = POST **with hidden field `_method=PATCH`** this method will update the given fish

To interact with the protected endpoints you'll need a token, to get a token please send a `POST` request to `/get-token` with `email, password` fields to login and email is `api@aquastore.app` password: `Aqu@$t0r3`, in Postman, in Authorization, set Type to Bearer Token and paste your `acccess_token` for all requests to the above protected endpoints
