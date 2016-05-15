<?php

/**
 * AistInsight (http://mateuszsitek.com/projects/aist-insight)
 *
 * @link      http://github.com/ma-si/aist-insight for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Aist Internet Technologies (http://aist.pl) All rights reserved.
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace AistInsight\View\Helper;

use Zend\View\Helper\AbstractHtmlElement;

class Insight extends AbstractHtmlElement
{
    /**
     * URL to Insight service
     */
    const INSIGHT_URL = 'http://insight.sensiolabs.com/projects';

    /**
     * Secure URL to Insight service
     */
    const INSIGHT_URL_SECURE = 'https://insight.sensiolabs.com/projects';

    /**
     * Default value whether img should be wrapped into html <a> tag
     */
    const LINKED = true;

    /**
     * Insight size
     */
    const SIZE_BIG = 'big';
    const SIZE_SMALL = 'small';
    const SIZE_MINI = 'mini';

    /**
     * Default options
     *
     * @var array
     */
    const OPTIONS = [
        'badge_size' => self::SIZE_BIG,
        'secure' => self::INSIGHT_URL_SECURE,
        'linked' => self::LINKED,
    ];

    /**
     * Insight project key
     *
     * @var string
     */
    protected $projectKey;

    /**
     * Options
     *
     * @var array
     */
    protected $options = self::OPTIONS;

    /**
     * Attributes for HTML image tag
     *
     * @var array
     */
    protected $attribs = [];

    /**
     * Returns an image from Insight's service.
     * $options may include the following:
     * - 'size' size of img to return
     * - 'secure' bool load from the SSL or Non-SSL location
     * - 'linked' bool whether img should be wrapped into html a tag
     *
     * @param  string|null $projectKey Project key..
     * @param  null|array $options Options
     * @param null|array $attribs
     * @return $this
     */
    public function __invoke($projectKey = '', $options = [], $attribs = [])
    {
        $this->setProjectKey($projectKey);

        if (empty($options)) {
            $options = self::OPTIONS;
        }
        if (empty($attribs)) {
            $attribs = [];
        }

        $this->setOptions($options);
        $this->setAttribs($attribs);

        return $this;
    }

    /**
     * Return badge html
     *
     * @return string
     */
    public function __toString()
    {
        return (true === $this->options['linked']) ? $this->getATag() : $this->getImgTag();
    }

    /**
     * Configure state
     *
     * @param  array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }
        }

        return $this;
    }

    /**
     * Get project url
     *
     * @return string
     */
    protected function getProjectUrl()
    {
        $src = $this->getInsightUrl() . '/' . $this->getProjectKey();

        return $src;
    }

    /**
     * Get img url
     *
     * @return string
     */
    protected function getImgUrl()
    {
        $src = $this->getProjectUrl() . '/' . $this->getBadgeSize() . '.png';

        return $src;
    }

    /**
     * Get URL to Insight's service
     *
     * @return string URL
     */
    protected function getInsightUrl()
    {
        return ($this->getSecure() === false) ? self::INSIGHT_URL : self::INSIGHT_URL_SECURE;
    }

    /**
     * Return valid image tag
     *
     * @return string
     */
    public function getImgTag()
    {
        $this->setSrcAttribForImg();
        $html = '<img'
            . $this->htmlAttribs($this->getAttribs())
            . $this->getClosingBracket();

        return $html;
    }

    /**
     * Return valid a tag
     *
     * @return string
     */
    public function getATag()
    {
        $html = '<a'
            . $this->htmlAttribs(['href' => $this->getProjectUrl(), 'target' => '_blank'])
            . $this->getClosingBracket()
            . $this->getImgTag()
            . '</a>'
        ;

        return $html;
    }

    /**
     * Set attribs for image tag
     *
     * Warning! You shouldn't set src attrib for image tag.
     * This attrib is overwritten in protected method setSrcAttribForImg().
     * This method(_setSrcAttribForImg) is called in public method getImgTag().
     *
     * @param  array $attribs
     * @return $this
     */
    public function setAttribs(array $attribs)
    {
        $this->attribs = $attribs;

        return $this;
    }

    /**
     * Get attribs of image
     *
     * Warning!
     * If you set src attrib, you get it, but this value will be overwritten in
     * protected method setSrcAttribForImg(). And finally your get other src
     * value!
     *
     * @return array
     */
    public function getAttribs()
    {
        return $this->attribs;
    }

    /**
     * Set project key
     *
     * @param  string $projectKey
     * @return $this
     */
    public function setProjectKey($projectKey)
    {
        $this->projectKey = $projectKey;

        return $this;
    }

    /**
     * Get project key
     *
     * @return string
     */
    public function getProjectKey()
    {
        return $this->projectKey;
    }

    /**
     * Set linked
     *
     * @param  string $linked Define whether img should be wrapped into html a tag
     * @return $this
     */
    public function setLinked($linked)
    {
        $this->options['linked'] = $linked;

        return $this;
    }

    /**
     * Set badge size
     *
     * @param  string $size Size of img must be one of the: big, small, mini
     * @return $this
     */
    public function setBadgeSize($size)
    {
        $this->options['badge_size'] = $size;

        return $this;
    }

    /**
     * Get badge size
     *
     * @return string The badge size
     */
    public function getBadgeSize()
    {
        return $this->options['badge_size'];
    }

    /**
     * Load from an SSL or No-SSL location?
     *
     * @param  bool $flag
     * @return $this
     */
    public function setSecure($flag)
    {
        $this->options['secure'] = ($flag === null) ? null : (bool) $flag;

        return $this;
    }

    /**
     * Get an SSL or a No-SSL location
     *
     * @return bool
     */
    public function getSecure()
    {
        if ($this->options['secure'] === null) {
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
        }

        return $this->options['secure'];
    }

    /**
     * Set src attrib for image
     *
     * You shouldn't set an own url value!
     * It sets value, uses protected method getImgUrl.
     *
     * If already exists, it will be overwritten.
     *
     * @return void
     */
    protected function setSrcAttribForImg()
    {
        $attribs = $this->getAttribs();
        $attribs['src'] = $this->getImgUrl();
        $this->setAttribs($attribs);
    }
}
