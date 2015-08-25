AistInsight [![SensioLabsInsight](https://insight.sensiolabs.com/projects/49aa984e-d392-4029-aebf-7e92ca7f55aa/big.png)](https://insight.sensiolabs.com/projects/49aa984e-d392-4029-aebf-7e92ca7f55aa)
===========
ZF2 View helper plugin for [SensioLabsInsight](https://insight.sensiolabs.com).

[![Build Status](https://travis-ci.org/ma-si/aist-locale.svg?branch=master)](https://travis-ci.org/ma-si/aist-locale)
[![Total Downloads](https://poser.pugx.org/aist/aist-insight/downloads)](https://packagist.org/packages/aist/aist-insight)
[![Reference Status](https://www.versioneye.com/php/aist:aist-insight/reference_badge.svg?style=flat)](https://www.versioneye.com/php/aist:aist-insight/references)
[![Dependency Status](https://www.versioneye.com/user/projects/55dcaecf8d9c4b0018000955/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55dcaecf8d9c4b0018000955)
[![Packagist](https://img.shields.io/packagist/v/aist/aist-insight.svg)]()
[![Code Climate](https://codeclimate.com/github/ma-si/aist-insight/badges/gpa.svg)](https://codeclimate.com/github/ma-si/aist-insight)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ma-si/aist-insight/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ma-si/aist-insight/?branch=master)
[![License](https://poser.pugx.org/aist/aist-insight/license)](https://packagist.org/packages/aist/aist-insight)

## Installation
Installation of this module uses composer.

For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

1. Install the module via composer by running:

    ```sh
    php composer.phar require aist/aist-insights
    ```

   or download it directly from github and place it in your application's `module/` directory.

2. Add the `AistInsights` module to the module section of your `config/application.config.php`


## Use
Required Insight project key.

    ```php
    echo $this->insight('project_key', ['badge_size' => Insight::SIZE_BIG, 'linked' => true], ['class' => 'pull-right']);
    echo $this->insight('project_key', [], ['class' => 'pull-right']);
    echo $this->insight('project_key', Insight::OPTIONS, ['class' => 'pull-right']);
    ```

each one will render the HTML below:

    ```html
    <a href="https://insight.sensiolabs.com/projects/{project_key}">
    <img src="https://insight.sensiolabs.com/projects/{project_key}/{size}.png" class="pull-right">
    </a>
    ```

Available sizes: `big`, `small`, `mini`.

Defaults:
* badge_size `big`
* linked `true`
* secure `true`


## Checklist
- [ ] Add tests
