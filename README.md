# BlogDumper

## About

The utility to dump your Tumblr blog (and fly away).

## Usage

###  Clone repo (of course)

```
$ git clone git@bitbucket.org:torunar/blog-dumper.git
$ cd blog-dumper
```

### Install dependencies

```
$ composer install
```

### Create Tumblr Application

Register application on <https://www.tumblr.com/oauth/register>

### Configure the environment

#### Copy the default configuration file

```
$ cp src/config.php.example src/config.php
```

#### Make changes

Open the list of your applications at <https://www.tumblr.com/oauth/apps> and press **Explore API** near your application's name.

Grant access of the application to your profile.

Press **Show keys** at the top of the page and fill the following `config.php` fields:

* `consumerKey` - Consumer Key
* `consumerSecret` - Consumer Secret
* `token` - Token
* `tokenSecret` - Token Secret
* `apiKey` - API Key

The following fields must be set, too:

* `blogName` - name of the blog you wish to save
* `writePath` - directory where you wish to save posts

### Open fire

```
$ php bin/blog-dumper
```

After the process is over (it may take some time if your blog is big), you can navigate to the `writePath` directory and see your blog dumped.

## Development

If you are unhappy with the way BlogDumper functions (and you probably are), you can alter its behaviour by writing your own post content handlers and/or writers and putting them in the `src/overrides` directory.

Just keep the same structure the `src` directory has, and the magic will happen.