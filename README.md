AistInsight
===========
ZF2 View helper plugin for [SensioLabsInsight](https://insight.sensiolabs.com).


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
Available sizes: `big`, `small`, `mini`.
Defaults:
* badge_size `big`
* is_link `true`
* secure `true`

    echo $this->insight('project_key', ['badge_size' => Insight::SIZE_BIG, 'is_link' => true], ['class' => 'pull-right']);
    echo $this->insight('project_key', [], ['class' => 'pull-right']);
    echo $this->insight('project_key', Insight::OPTIONS, ['class' => 'pull-right']);

Each one will render the HTML below:

    <a href="https://insight.sensiolabs.com/projects/{project_key}">
    <img src="https://insight.sensiolabs.com/projects/{project_key}/{size}.png" class="pull-right">
    </a>


## Checklist
- [ ] Add tests
