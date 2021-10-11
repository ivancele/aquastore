# AquaStore

Thank you for the opportunity to share what I have been exposed to over the years, it is a real pleasure to me.
I have a few things to note.

The back-end is done with Laravel 8 (the latest), to get started (*or just use the running instance as noted below*):

- Clone this repository (via http to avoid auth)
- cd aquastore (or the base of the repository) run composer install
- copy .env.example file to .env and update the **db configuration**, (I did this with MySQL)
- run `php artisan key:gen`
- you can also set the debug flag to false.
- run `php artisan migrate:fresh --seed` to create database tables and fill them with dummy or default data found in `database/seeders/` dir (seeding might fail, re-run if it fails)

## Usage instructions

I have exposed a few API endpoints

1. Public endpoints
   - `/fish` - method = GET: will return all the fish in the AquaStore.
   - `/aquariums` - method = GET: will return all the aquariums in the AquaStore.
2. Protected endpoints
   - `/fish` - method = POST: this will create a fish, required fields are `common_name, species, color, fins`
   - `/fish/{id}` - method = POST **with hidden field `_method=PATCH`** this method will update the given fish

To interact with the protected endpoints you'll need a token, to get a token please send a `POST` request to `/get-token` with `email, password` fields to login and email is `api@aquastore.app` password: `Aqu@$t0r3`, in Postman, in Authorization, set Type to Bearer Token and paste your `acccess_token` for all requests to the above protected endpoints

## Running instance

I have taken the liberty to deploy the backend, it is up and running on `https://aquastore.njabuloi.co.za/` anyone can use Postman (or any other client) to query the API.

## Side notes

I have added a few database entries that I didn't use due to the time constraints.
The country can be passed as a get param on the URL `/aquariums?country=US`
I have also added a labels on *accessors* on laravel for Age, Temperature and Size

## Conclusion

It has been an absolute pleasure working on this fun project, I do not know much about fish, pets and aquariums, some facts were quiet interesting.

I am a self taught developer, I have been coding for a few years, I have been afraid to apply for dev jobs (this is the second time) because I have been afraid that I do not know enough, I hope to get constructive feedback on where I need to improve, I am more than willing to learn. I understand that some of my practices might not be the best in practices, however I do my best to write quality code, with the information I have and the experience.
