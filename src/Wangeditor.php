<?php

namespace Xuchunyang\Wangeditor;

use Laravel\Nova\Fields\Field;

class Wangeditor extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'wangeditor';

    /**
     * 设置编辑器的模式.
     *
     * @param string $mode default|simple
     */
    public function withMode(string $mode): self
    {
        return $this->withMeta(['wangMode' => $mode]);
    }

    /**
     * 设置编辑器的高度.
     *
     * @param string $height 例如 500px
     */
    public function withHeight(string $height): self
    {
        return $this->withMeta(['height' => $height]);
    }

    /**
     * 设置工具栏的配置.
     *
     * @param array $config
     * @return self
     */
    public function withToolbarConfig(array $config): self
    {
        return $this->withMeta(['toolbarConfig' => $config]);
    }

    /**
     * 设置编辑器的配置.
     *
     * @param array $config
     * @return self
     */
    public function withEditorConfig(array $config): self
    {
        return $this->withMeta(['editorConfig' => $config]);
    }

    /**
     * 设置图片上传的 URL.
     *
     * @param string $url
     * @return self
     */
    public function withImageUploadUrl(string $url): self
    {
        return $this->withMeta(['imageUploadUrl' => $url]);
    }
}
