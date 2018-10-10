# Inpsyde Mountain Conqueror theme

## Technical info
This theme does not use any starter theme but was created from the ground up.
It only depends on the [CarbonFields library](https://carbonfields.net) to easily create an Options admin page.

It uses Gulp for easier management (for SCSS & JS compiling and minification, browser live reloading, translation files creation).

It was developed with flexibility in mind (with hooks, `function_exists()` checks and so on) to let plugin developers interact with it and give users a good base to extend the theme by creating child-themes.

## Hooks (actions & filters)
[A list of all hooks and their description](HOOKS.md) is available in the HOOKS.md file and will be regularly updated.

## Installation
Use `git clone` to clone the repository in your /wp-content/themes/ folder.

### Using composer
You first need to add the private repo to your composer.json file:
```composer config repositories.repo-name vcs git@bitbucket.org:pskli/mountain-conqueror.git```

Then require the theme package with:
```composer require pskli/mountain-conqueror```
or, if you want to test the development version:
```composer require pskli/mountain-conqueror:dev-develop```

### Changelog
#### 1.0.0 - 2018-10-10
First version of the theme, following the requirements for the Inpsyde code exercise.