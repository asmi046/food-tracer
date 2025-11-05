<script setup>
// resources/js/Components/FlashMessages.vue
import { onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { useMessage } from 'naive-ui'

const page = usePage()
const message = useMessage()

onMounted(() => {
    console.log('Flash messages:', page.props.flash)
    if (page.props.flash.success) {
        message.success(page.props.flash.success)
    }

    if (page.props.flash.error) {
        message.error(page.props.flash.error)
    }

    if (page.props.flash.warning) {
        message.warning(page.props.flash.warning)
    }

    if (page.props.flash.info) {
        message.info(page.props.flash.info)
    }
})
</script>

<template>

</template>
