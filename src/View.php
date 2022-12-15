<?php
namespace Core;

class View
{
    const RENDER_TYPE_NATIVE = 1;
    const RENDER_TYPE_TWIG = 2;

    private $templatePath;
    private $data = [];
    private $renderType;
    private $twig;

    public function __construct()
    {
       $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
       $this->renderType = self::RENDER_TYPE_NATIVE;
    }

    public function setRenderType(int $renderType)
    {
        if (!in_array($renderType, [self::RENDER_TYPE_NATIVE, self::RENDER_TYPE_TWIG])) {
            // throw new \Exception('Wrong render type: ' . $renderType);
        }
        $this->renderType = $renderType;
    }

    public function assign(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function render(string $tpl, $data= []) :string
    {
        switch ($this->renderType) {
            case self::RENDER_TYPE_NATIVE:
                    $this->data += $data;
                    ob_start();
                    // C:\OSPanel\domains\dz-4week\src\..\app/View\User/register.phtml
                    include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
                    $content = ob_end_flush();
                    return $content;
                break;
            
            case self::RENDER_TYPE_TWIG:
                    $this->data += $data;
                    $twig = $this->getTwig($tpl);
                    ob_start(null, null, PHP_OUTPUT_HANDLER_STDFLAGS);
                    echo $twig->render($tpl, $this->data);
                    return ob_get_clean();
                break;
        }
    }

    public function getTwig($tpl)
    {
        if (!$this->twig) {
            echo $this->templatePath, '<br>';
            $path = $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
            // C:\OSPanel\domains\dz-4week\src\..\app/View\Blog/index.twig
            echo $path, '<br>';
            $loader = new \Twig\Loader\FilesystemLoader($path);
            $this->twig = new \Twig\Enviroment($loader);
        }
        return $this->twig;
    }

    public function __get($varName)
    {
        return $this->data[$varName] ?? null;
    }
}