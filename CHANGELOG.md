# Changelog

All notable changes to this project will be documented in this file.

## [unreleased]

### Chore

- Update Composer deps
- Add more TODO's on the README
- A bit of work on repo docs related
- Modifying the README.md
- Adding a little flavor to the README

### Feat

- Initial Commit
- Added Filament Custom Theme.css
- Added HealthCheckResults section to the App, so user can check overall status of the app
- Added fullcalendar, WIP create a section with a calendar to manage post scheduling and the sorts
- Added filament spotlight, this allow the user to quickly navigate between resources
- Added TinyEditor, WIP to correctly implement it on the PostResource
- Added Filament Curator, to manage media files that can be used on the creation of posts
- Added Filament Logger, this adds an activity log of the App
- WIP advacing more on LinkedinPost related stuff, account creationg based on the service (linkedin)

### Fix

- Working on Data models of the app, added new table related to SocialMediaServices supported
- Applied new deps on composer and package, created SocialMediaService resource, added new sections/modules to the Service Providers
- Moved vendor imported css for custom theme to /resources/ folder, that way the docker build doesn't fail
- Modified docker building process
- Removed unnecesary comments on Dockerfile, Fixed Filament canAccessPanel

<!-- generated by git-cliff -->
