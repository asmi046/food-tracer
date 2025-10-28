<template>

        <Head title="Авторизация">
            <meta name="description" content="Страница авторизации в системе Food Tracer" />
            <meta name="keywords" content="авторизация, вход, food tracer" />
            <meta property="og:title" content="Авторизация - Food Tracer" />
            <meta property="og:description" content="Войдите в систему отслеживания продуктов" />
            <meta property="og:type" content="website" />
        </Head>

        <n-grid :x-gap="12" :y-gap="12" cols="1" layout-shift-disabled class="min-h-screen">
            <n-gi class="flex items-center justify-center">
                <n-card style="max-width: 400px; margin: 0 auto;" title="Авторизация" size="huge" bordered>
                    <n-form
                        ref="formRef"
                        :model="form"
                        :rules="rules"
                        label-placement="top"
                        require-mark-placement="right-hanging"
                        size="large"
                    >
                        <n-form-item label="Email" path="email">
                            <n-input
                                v-model:value="form.email"
                                placeholder="Введите ваш email"
                                type="email"
                                clearable
                            />
                        </n-form-item>

                        <n-form-item label="Пароль" path="password">
                            <n-input
                                v-model:value="form.password"
                                placeholder="Введите пароль"
                                type="password"
                                show-password-on="click"
                                clearable
                            />
                        </n-form-item>


                        <n-checkbox v-model:checked="form.remember">
                                Запомнить меня
                        </n-checkbox>



                            <n-button
                                type="primary"
                                block
                                round
                                size="large"
                                :loading="loading"
                                @click="handleLogin"
                                style="margin: 10px 0;"
                            >
                                Войти
                            </n-button>

                            <n-space justify="space-between" style="width: 100%">
                                <n-button text type="primary" size="small">
                                    Забыли пароль?
                                </n-button>
                                <n-button text type="primary" size="small">
                                    Регистрация
                                </n-button>
                            </n-space>

                    </n-form>
                </n-card>
            </n-gi>
        </n-grid>

</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import {
    NGrid,
    NGi,
    NCard,
    NForm,
    NFormItem,
    NInput,
    NButton,
    NCheckbox,
    NSpace,
    NMessageProvider,
    useMessage
} from 'naive-ui'

// Определяем layout для этой страницы
defineOptions({
    layout: AppLayout
})

const message = useMessage()
const formRef = ref(null)
const loading = ref(false)

const form = useForm({
    email: '',
    password: '',
    remember: false
})

const rules = {
    email: [
        {
            required: true,
            message: 'Email обязателен для заполнения',
            trigger: ['input', 'blur']
        },
        {
            type: 'email',
            message: 'Некорректный формат email',
            trigger: ['input', 'blur']
        }
    ],
    password: [
        {
            required: true,
            message: 'Пароль обязателен для заполнения',
            trigger: ['input', 'blur']
        },
        {
            min: 6,
            message: 'Пароль должен содержать минимум 6 символов',
            trigger: ['input', 'blur']
        }
    ]
}

const handleLogin = () => {
    formRef.value?.validate((errors) => {
        if (!errors) {
            loading.value = true

            // Здесь будет логика отправки данных на сервер
            console.log('Форма валидна:', form)

            setTimeout(() => {
                loading.value = false
                message.success('Успешная авторизация!')
            }, 2000)
        } else {
            message.error('Проверьте правильность заполнения формы')
        }
    })
}
</script>

<style scoped>
.min-h-screen {
    min-height: 100vh;
}
</style>
