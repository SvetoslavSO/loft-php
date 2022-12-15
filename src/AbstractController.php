<?php

namespace Core;

use App\Model\Blog;

abstract class AbstractController
{
    protected $view;
    protected $user;
    protected $blog;
    protected function redirect(string $url)
    {
        throw new RedirectException($url);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function setBlog($history): void
    {
        $this->blog = $history;
    }
}