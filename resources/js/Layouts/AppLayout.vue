<template>
    <n-config-provider :theme="theme">
        <n-message-provider>
            <FlashMessages />
            <div class="app-layout">
                <main class="main-content">
                    <slot />
                </main>
            </div>
        </n-message-provider>
    </n-config-provider>
</template>

<script setup>
import { darkTheme } from 'naive-ui'
import {
    NConfigProvider,
    NMessageProvider,
    NSpace,
    NButton
} from 'naive-ui'
import FlashMessages from '@/Components/FlashMessages.vue'

defineProps({
    theme: {
        type: Object,
        default: null
    }
})
</script>
