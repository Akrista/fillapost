# Fillapost

Fill-A-Post is a social media management tool that allows you to schedule posts to (Linkedin) multiple social media platforms.

## Installation

### Docker Compose

-   Build the Image
    ```bash
    docker-compose build
    ```
-   Run the docker-compose
    ```bash
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

Note: For Windows Users you could use directly Laravel Herd

#### Steps

1. Pull Source
2.

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
