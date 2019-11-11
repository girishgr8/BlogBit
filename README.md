# Wordflow

“Wordflow”, aims to bring the content creators together and allow them to share their insights with their own community and improvise themselves<br>
Benefits:
* Sharing of like-ideas through a proper channel
* Easily operable interface
* Platform for creators to show their work, take in suggestions and improvise

Features:
- [x] Blog Editor (WYSIWYG editor)
- [x] Meetup Module (Locate mid-point between locations of two users)


-----------------------------------------------

## Demo

![Alt Text](https://github.com/girishgr8/BlogBit/blob/master/gifs/dashboard.gif)
![Alt Text](https://github.com/girishgr8/BlogBit/blob/master/gifs/meetup.gif)
![Alt Text](https://github.com/girishgr8/BlogBit/blob/master/gifs/blogEditor.gif)

-----------------------------------------------

## Getting Started



### Prerequisites

* A PHP engine - Version 5 or later
* A web server - Apache HTTP Server 2.2 or later
* SQL Database - MySQL Workbench 8.0 or later recommended


### API Integrations

* [Get Google Authentication key](https://developers.google.com/identity/sign-in/web/sign-in)
* [Get the TinyMCE API key](https://www.tiny.cloud/)
* [ Get the HERE Maps app code and app id ](https://developer.here.com/c/mapAPIs?cid=Other-Google-MM-T4-Dev-Brand-E&utm_source=Google&utm_medium=ppc&utm_campaign=Dev_PaidSearch_DevPortal_AlwaysOn&gclid=CjwKCAiAh5_uBRA5EiwASW3IaplFdLkFaSmTyjhYPlNGVZLHpIdJ8wmXqqaPy1JkK6OucFfYFrWLwhoC6F4QAvD_BwE&gclsrc=aw.ds)

### Database Setup

* Create a schema in MySQL Workbench and replace `dbname` with your schema name and other credentials namely `servername`, `port`, `username` and `password` in [configuration](https://github.com/girishgr8/BlogBit/blob/master/config.php) file
* All the required tables are auto-created by the DLL statements in config file


### Configurations

* Edit the [configuration](https://github.com/girishgr8/BlogBit/blob/master/config/.php) file
* Replace `authKey` with 
* Replace the `app_code`, `app_id` and `editorKey` with the keys you have generated from above instructions of API integrations
* Create folders `blogForegroundImages` and `Blogs` in your local system
* Replace the `path` with the path for your folders created above

-----------------------------------------------

## Further Customisations
The contact-form module is generated using Angular Framework<br>
To customise it further, build using [Angular Custom Element Folder](https://github.com/girishgr8/BlogBit/tree/master/angular-custom-element)

### Development server

* Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The app will automatically reload if you change any of the source files.



### Build

* Run `ng build` to build the project. The build artifacts will be stored in the `dist/` directory. Use the `--prod` flag for a production build.

* To build artifacts on the go, execute `npm run build && npm run package`

-----------------------------------------------


## Built With

* [Angular](https://github.com/angular/angular-cli) - Angular CLI version 8.2.0 
* [TinyMCE](https://www.tiny.cloud/) - The Editor API
* [HEREMaps](https://developer.here.com/c/mapAPIs?cid=Other-Google-MM-T4-Dev-Brand-E&utm_source=Google&utm_medium=ppc&utm_campaign=Dev_PaidSearch_DevPortal_AlwaysOn&gclid=CjwKCAiAh5_uBRA5EiwASW3IaplFdLkFaSmTyjhYPlNGVZLHpIdJ8wmXqqaPy1JkK6OucFfYFrWLwhoC6F4QAvD_BwE&gclsrc=aw.ds) - The MAPs API

-----------------------------------------------
## Future Enhancements

- [ ] Add 'Contests' module
- [ ] Build Admin Dashboard

-----------------------------------------------

## Contributions

 We're are open to `enhancements` & `bug-fixes`

 ----------------------------------------------- 

## Contributors
* [Gayatri Srinivasan](https://github.com/gayatri-01)
* [Girish Thatte](https://github.com/girishgr8)
* [Amisha Waghela](https://github.com/amisha-w)

-----------------------------------------------

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

-----------------------------------------------





