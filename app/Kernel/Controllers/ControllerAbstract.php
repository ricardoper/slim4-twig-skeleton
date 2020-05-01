<?php
declare(strict_types=1);

namespace App\Kernel\Controllers;

use App\Emitters\HtmlResponseEmitter;
use App\Kernel\App;
use Pimple\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Flash\Messages;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class ControllerAbstract
{

    /**
     * App
     *
     * @var App
     */
    protected $app;

    /**
     * Configs
     *
     * @var array
     */
    protected $configs;

    /**
     * App
     *
     * @var Container
     */
    protected $container;


    /**
     * Controller constructor
     */
    public function __construct()
    {
        $this->app = app();

        $this->configs = $this->app->getConfigs();

        $this->container = $this->app->getContainer();
    }


    /**
     * Get App
     *
     * @return App
     */
    protected function getApp(): App
    {
        return $this->app;
    }

    /**
     * Get Container
     *
     * @param string|null $name
     * @return mixed|null
     */
    protected function getContainer(string $name = null)
    {
        if ($name === null) {
            return $this->container;
        }

        return $this->container[$name] ?? null;
    }

    /**
     * Get Configs
     *
     * @param string|null $name
     * @param mixed $default
     * @return mixed|null
     */
    protected function getConfigs(string $name = null, $default = null)
    {
        $configs = $this->configs ?? null;

        if ($name === null) {
            return $configs;
        } else if ($configs === null) {
            return $default;
        }

        return $configs[$name] ?? $default;
    }

    /**
     * Get Service From Container
     *
     * @param string $name
     * @return mixed|null
     */
    protected function getService(string $name)
    {
        return $this->container[$name] ?? null;
    }

    /**
     * Get Response
     *
     * @return Response
     */
    protected function getResponse(): Response
    {
        return $this->container['response'];
    }

    /**
     * Set Emitter
     *
     * @param string $emitter
     */
    protected function setEmitter(string $emitter): void
    {
        $settings = $this->container['settings'];

        $settings['emitters'] = array_merge($settings['emitters'], [$emitter]);

        $this->container['settings'] = $settings;
    }

    /**
     * Get View Engine
     *
     * @return Twig
     */
    protected function getView(): Twig
    {
        return $this->container['view'];
    }

    /**
     * Render view
     *
     * @param string $template
     * @param array $data
     * @param bool $sendHeaders
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $template, array $data = [], bool $sendHeaders = true): Response
    {
        if ($sendHeaders === true) {
            $this->setEmitter(HtmlResponseEmitter::class);
        }

        return $this->getView()->render($this->getResponse(), $template, $data);
    }

    /**
     * Get Flash
     *
     * @return Messages
     */
    protected function getFlash(): Messages
    {
        return $this->container['flash'];
    }

    /**
     * Set Flash Messages
     *
     * @param string $key
     * @param mixed $message
     */
    protected function setFlashMessage(string $key, $message): void
    {
        $this->container['flash']->addMessage($key, $message);
    }

    /**
     * Has Flash Message
     *
     * @param string $key
     * @return bool
     */
    protected function hasFlashMessage(string $key): bool
    {
        return $this->container['flash']->hasMessage($key);
    }

    /**
     * Get Flash Messages
     *
     * @param string|null $key
     * @return array|null
     */
    protected function getFlashMessages(string $key = null): ?array
    {
        $flash = $this->container['flash'];

        if ($key === null) {
            return $flash->getMessages();
        }

        return $flash->getMessage($key) ?? null;
    }

    /**
     * Get Flash First Message
     *
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    protected function getFlashFirstFMessage(string $key, $default = null)
    {
        return $this->container['flash']->getFirstMessage($key, $default);
    }
}
