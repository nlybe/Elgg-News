# Change Log

## 5.24.4 (May 2024)

- Fix issue on entity delete

## 5.24.3 (Mar 2024)

- Minor update on composer.json

## 5.24.2 (Dec 2023)

- Fixed group language message
- Minor code improvements

## 5.24.1 (Aug 2023)

- Improve error messages and redirects

## 5.24 (June 2023)
- Moved css declaration to elgg-plugins.php
- Fixed migration issue
- Fixed post news link on group module
- Improved error handlers
- Replaced hooks with events


## 5.23 (April 2023)
- Upgraded to be compatible with Elgg 5.x
- Added option to exclude title from news item url
- Fixed issue on featured news widget
- Removed likable hook
- Code improvements and cleanup

## 4.22 (March 2023)
- Update hook params specifications
- Fixed compatibility with Elgg on upgrade functions
- Updated hooks declaration according Elgg v4.3.x

## 4.21 (July 2022)

- Fixed issue for obsolete function elgg_set_ignore_access

## 4.20 (July 2022)

- Fix class function declaration
- Minor code improvements

## 4.19.1 (Dec 2021)

- Added default values on settings

## 4.19 (Dec 2021)

- Upgraded to be compatible with Elgg 4.x
- Rename plugin to elgg-news and relevant fixes
- Code cleanup

## 3.18 (Sep 2021)

- Minor code improvements

## 3.17 (July 2020)

- Removed deprecated file start.php
- Replaced deprecated Elgg functions
- Fixed issue when unselect the option "Display username on list or single view"
- Minor code improvements

## 3.16 (July 2020)

- Fix comments issue for other entities
- Removed unused code and messages

## 3.15 (May 2019)

- Fixed: secured admin actions by setting 'access' => 'admin' on elgg-plugins.php
- Fixed: issue on return value for staff menu item

## 3.14 (Jan 2019)

- Improved: comments display according Elgg 3 API
- Fixed: issue for comment form display for non-admin users
- Fixed: redirect issue on resource files
- Minor code improvements

## 3.13 (Dec 2018)

- Upgraded to be compatible with Elgg 3.x
- Added option to display featured news on sidebar
- Fixed issue on group news option when is disabled by administrator
- Code cleanup

## 2.3.12 (Aug 2018)

- Removed deprecated function elgg_load_js('lightbox')

## 2.3.11 (Feb 2018)

- Removed unused code

## 2.3.10 (July 2017)

- Added option for staff news to set news as featured
- Fixed news permission issues

## 2.3.9 (March 2017)

- Added option to restrict setting news as featured by administrators only

## 2.3.8 (March 2017)

- Added option to set custom size on news photos
- Added a customizable news list view
- Added option in settings to change the default news icon and featured news icon
- Fixed: when saving a news post, the user is redirected to list of news

## 2.3.8 (March 2017)

- Added compatibility with Elgg 2.3.x
- Added line break on summary input/output 
- Improved view news posts on widgets
- Fixed issue on tags field
- Fixed issue on user icon

## 2.0.6 

- fixed: bug while trying to post/delete news in groups as non-admin user
- fixed: small issues

## 2.0.5

- added: option to show news photos on walled garden sites
- fixed: set featured/unfeatured is allowed only to entity owner or admins
- fixed: posts with comments set to Off cannot be commented on river
- fixed: composer file

## 2.0.4 (June 2016)

- Added compatibility with Elgg 2.0
- Added option to set a news item as featured
- Added a featured news widget 
- Added option to upload photos on news item
- News posts are now likeable 
- Plugin now can be installed via composer
- Several code improvements

## 1.11.3 (May 2015)

- Added option to determine users who can post news/announcements (thanks to Pasley70 for contribution)
- Added group widget
- Small bugs fixes

## 1.8.2 (Dec 2014)

- Small bugs fixes

## 1.8.1 (Nov 2014)

- Added option for group owners to post announcements inside group only
- Small bugs fixes

## 1.8.0 (Nov 2014)

Initial release