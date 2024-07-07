# Fillapost

Fill-A-Post is a social media management tool that allows you to schedule posts to (Linkedin) multiple social media platforms.

## Star History

<a href="https://star-history.com/#Akrista/fillapost&Timeline">
 <picture>
   <source media="(prefers-color-scheme: dark)" srcset="https://api.star-history.com/svg?repos=Akrista/fillapost&type=Timeline&theme=dark" />
   <source media="(prefers-color-scheme: light)" srcset="https://api.star-history.com/svg?repos=Akrista/fillapost&type=Timeline" />
   <img alt="Star History Chart" src="https://api.star-history.com/svg?repos=Akrista/fillapost&type=Timeline" />
 </picture>
</a>

## Installation

### Docker

-   Pull the image from Docker Hub
    ```console
    docker pull ghcr.io/akrista/fillapost:latest
    ```
-   Run the image
    ```console
    docker run -d -p 8000:8000 ghcr.io/akrista/fillapost:latest
    ```

### Docker Compose

### Build it yourself

-   Clone the repository
    ```console
    git clone https://github.com/Akrista/fillapost
    cd fillapost
    ```
-   Build the Image
    ```console
    docker-compose build
    ```
-   Run the docker-compose
    ```console
    docker-compose up -d --force-recreate
    ```

### Manual -- WIP

## Developing and Contributing

-   Fill-A-Post is built with a curated tech stack. Looking to be optimized for developer experience and ease of use to start coding:
    -   Laravel
    -   Filament
    -   TailwindCSS
    -   Docker

### Dev Enviroment Setup

#### Prerequisites

-   PHP
-   NPM
-   Docker (Optional)

_Note: You could directly use [Laravel Herd](https://herd.laravel.com/windows)_ as it has all the prerequisites installed.

#### Steps

1. Pull Source
    ```console
    git clone https://github.com/Akrista/fillapost
    cd fillapost
    ```
2. Install Dependencies
    ```console
    composer install
    npm install
    ```
3. Setup Environment
    ```console
    cp .env.example .env
    php artisan key:generate
    ```
4. Run the migrations
    ```console
    php artisan migrate --seed
    ```
5. Start the development server
    ```console
    php artisan serve
    ```
6. Visit the site at [http://localhost:8000](http://localhost:8000)
7. Login with the default credentials
    - Email: `demo@fillapost.com`
    - Password: `demo`

## TODO

-   [ ] Repo Related
    -   [ ] Figure out the README
    -   [ ] Add a Logo
        -   [ ] Favicon
        -   [ ] Logo
        -   [ ] Banner
        -   [ ] Github Banner
    -   [ ] Add Social Preview (Github Related) 1280x640
    -   [x] Add a License
    -   [ ] Add a Contributing Guide
    -   [ ] Add a Code of Conduct
    -   [x] Add a Security Policy
    -   [ ] Add a Funding Link
    -   [ ] Add a Changelog
-   [ ] Core Features
    -   [ ] Localisation
        -   [ ] Add support for multiple languages
            -   [x] English
            -   [ ] Spanish
        -   [ ] Add support for multiple timezones???
    -   [ ] Docker Support
        -   [ ] Migrations should be run automatically
        -   [x] Dockerfile
        -   [x] Docker Compose
        -   [ ] Build Image on Github Actions
            -   [ ] Add a badge
            -   [ ] Add a release
    -   [ ] Posts
        -   [ ] Add scheduling
        -   [ ] Posting should use base Linkedin API
        -   [x] List of posts created
        -   [ ] Navbar "Create Post" button MUST work
    -   [ ] Scheduling - Calendar
        -   [ ] Add Calendar
        -   [ ] Repeating Events
    -   [ ] AI Helper
        -   [ ] Post Creation Helper on Editor
        -   [ ] Post Scheduling with Dynamic Values
            -   [ ] Call info relevant to other Services (besides the one that's creating the post)
    -   [ ] Social Media Services
        -   [ ] Add a new Social Media Service
        -   [ ] List of supported providers
            -   [x] Linkedin
            -   [ ] Twitter
            -   [ ] Facebook
            -   [ ] Instagram
            -   [ ] Steam
            -   [ ] Wakatime
            -   [ ] Github
    -   [ ] Service Accounts
        -   [ ] Service Acounts must be created when the Social Media Service is created
        -   [ ] List accounts relevant to the Service Provider
        -   [ ] Locally save avatars related to accounts
    -   [ ] Users
        -   [ ] Access Control
            -   [ ] Roles
            -   [ ] Permissions
            -   [ ] Groups
-   [ ] Unit Tests
    -   [ ] Mayhaps???
