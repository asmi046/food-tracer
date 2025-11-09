<template>
    <n-space vertical="">
        <n-button
            round
            block
            size="large"
            :bordered="false"
            @click="redirectToVK"
            style="background: #4680C2; color: white; flex: 1;"
        >
            <template #icon>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.684 0H8.316C1.592 0 0 1.592 0 8.316v7.368C0 22.408 1.592 24 8.316 24h7.368C22.408 24 24 22.408 24 15.684V8.316C24 1.592 22.408 0 15.684 0zm3.692 17.123h-1.744c-.66 0-.864-.525-2.05-1.723-1.033-1.01-1.49-.9-1.735-.9-.356 0-.458.102-.458.597v1.575c0 .424-.135.678-1.253.678-1.846 0-3.896-1.118-5.335-3.202C4.624 10.857 4.03 8.57 4.03 8.096c0-.254.102-.491.593-.491h1.744c.44 0 .61.203.78.677.863 2.49 2.303 4.675 2.896 4.675.22 0 .322-.102.322-.66V9.721c-.068-1.186-.695-1.287-.695-1.71 0-.204.17-.407.44-.407h2.744c.373 0 .508.203.508.643v3.473c0 .372.17.508.271.508.22 0 .407-.136.813-.542 1.254-1.406 2.151-3.574 2.151-3.574.119-.254.322-.491.763-.491h1.744c.525 0 .644.27.525.643-.22 1.017-2.354 4.031-2.354 4.031-.186.305-.254.44 0 .78.186.254.796.779 1.203 1.253.745.847 1.32 1.558 1.473 2.05.17.49-.085.744-.576.744z"/>
                </svg>
            </template>
            VK ID
        </n-button>

        <n-button
            @click="redirectToYandex"
            round
            block
            size="large"
            :bordered="false"
            style="background: black; color: white; flex: 1;"
        >
            <template #icon>
                <n-icon size="24">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.04 12c0-5.523 4.476-10 10-10 5.522 0 10 4.477 10 10s-4.478 10-10 10c-5.524 0-10-4.477-10-10z" fill="#FC3F1D"/><path d="M13.32 7.666h-.924c-1.694 0-2.585.858-2.585 2.123 0 1.43.616 2.1 1.881 2.959l1.045.704-3.003 4.487H7.49l2.695-4.014c-1.55-1.111-2.42-2.19-2.42-4.015 0-2.288 1.595-3.85 4.62-3.85h3.003v11.868H13.32V7.666z" fill="#fff"/></svg>
                </n-icon>
            </template>
            Яндекс ID
        </n-button>
    </n-space>
</template>

<script setup>
    import { NButton, NSpace, NIcon } from 'naive-ui';

    const redirectToVK = () => {
        window.location.href = route('social.redirect', { provider: 'vkid' })
    }

    const redirectToYandex = () => {
        window.location.href = route('social.redirect', { provider: 'yandex' })
    }
</script>
