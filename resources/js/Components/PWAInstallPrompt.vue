<template>
    <n-alert v-if="showInstallPrompt" type="info" closable @close="hidePrompt">
        <template #header>
            Установить приложение
        </template>
        <template #icon>
            <n-icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </n-icon>
        </template>
        Установите Food Tracer на ваше устройство для быстрого доступа!
        <template #action>
            <n-button size="small" @click="installPWA">
                Установить
            </n-button>
        </template>
    </n-alert>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { NAlert, NButton, NIcon } from 'naive-ui'

const showInstallPrompt = ref(false)
let deferredPrompt = null

onMounted(() => {
    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault()
        deferredPrompt = e
        showInstallPrompt.value = true
    })
})

const installPWA = async () => {
    if (deferredPrompt) {
        deferredPrompt.prompt()
        const result = await deferredPrompt.userChoice
        if (result.outcome === 'accepted') {
            console.log('PWA установлено')
        }
        deferredPrompt = null
        showInstallPrompt.value = false
    }
}

const hidePrompt = () => {
    showInstallPrompt.value = false
}
</script>
