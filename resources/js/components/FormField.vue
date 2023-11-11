<template>
    <DefaultField
        :field="field"
        :errors="errors"
        :show-help-text="showHelpText"
        :full-width-content="fullWidthContent"
    >
        <template #field>
            <div class="wangeditor-wrap" :class="active && 'wangeditor-wrap--active'">
                <Toolbar
                    class="wangeditor-toolbar"
                    :editor="theEditor"
                    :defaultConfig="toolbarConfig"
                    :mode="wangMode"
                />
                <Editor
                    class="wangeditor-editor wangeditor-user-content"
                    :style="{height}"
                    v-model="value"
                    :defaultConfig="editorConfig"
                    :mode="wangMode"
                    @onCreated="handleCreated"
                    @onFocus="active = true"
                    @onBlur="active = false"
                />
            </div>
        </template>
    </DefaultField>
</template>

<script>
import '@wangeditor/editor/dist/css/style.css';

import {FormField, HandlesValidationErrors} from 'laravel-nova';
import {Editor, Toolbar} from "@wangeditor/editor-for-vue";

export default {
    components: {Editor, Toolbar},
    mixins: [FormField, HandlesValidationErrors],
    props: ['resourceName', 'resourceId', 'field'],

    data() {
        this.theEditor = null;

        return {
            value: '',
            wangMode: 'default',
            toolbarConfig: {},
            editorConfig: {},
            active: false,
            height: "500px",
        };
    },

    beforeMount() {
        if (this.field.wangMode) {
            this.wangMode = this.field.wangMode;
        }

        if (this.field.height) {
            this.height = this.field.height;
        }

        if (this.field.toolbarConfig) {
            this.toolbarConfig = this.field.toolbarConfig;
        }

        if (this.field.editorConfig) {
            this.editorConfig = this.field.editorConfig;
        }

        if (this.field.placeholder && !('placeholder' in this.editorConfig)) {
            this.editorConfig.placeholder = this.field.placeholder;
        }

        if (!('autoFocus' in this.editorConfig)) {
            // NOTE 不知道为什么，不选中编辑器，工具栏就不显示
            // this.editorConfig.autoFocus = false;
        }

        if (this.field.imageUploadUrl) {
            if (!this.editorConfig?.MENU_CONF?.uploadImage) {
                if (!this.editorConfig.MENU_CONF) {
                    this.editorConfig.MENU_CONF = {};
                }
                this.editorConfig.MENU_CONF.uploadImage = {
                    server: this.field.imageUploadUrl,
                };
            }
        }
    },

    beforeUnmount() {
        this.theEditor?.destroy();
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || '';
        },

        handleCreated(editor) {
            this.theEditor = editor;
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.fieldAttribute, this.value || '')
        },
    },
}
</script>

<style>
.wangeditor-wrap {
    --border-color: rgb(187, 187, 187);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    overflow: hidden;
    z-index: 10
}

.wangeditor-toolbar {
    border-bottom: 1px solid var(--border-color);
}

.wangeditor-editor {
    overflow-y: hidden;
}

.wangeditor-wrap--active {
    --border-color: rgb(125, 211, 252);
    box-shadow: 0 0 8px rgba(125, 211, 252, 0.5);
}
</style>
