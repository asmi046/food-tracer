<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
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
    useMessage,
    NAlert
} from 'naive-ui';

// Убираем layout для страницы авторизации
defineOptions({
    layout: null
});

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const formRef = ref(null);

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

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
        }
    ]
};

const submit = () => {
    const message = useMessage(); // Перенесли сюда

    formRef.value?.validate((errors) => {
        if (!errors) {
            form.post(route('login'), {
                onFinish: () => {
                    form.reset('password');
                },
                onSuccess: () => {
                    message.success('Успешная авторизация!');
                },
                onError: () => {
                    message.error('Ошибка авторизации. Проверьте данные.');
                }
            });
        } else {
            message.error('Проверьте правильность заполнения формы');
        }
    });
};

const redirectToVK = () => {
    window.location.href = route('social.redirect', { provider: 'vkontakte' })
}

const redirectToYandex = () => {
    window.location.href = route('social.redirect', { provider: 'yandex' })
}

</script>

<template>
    <Head title="Авторизация">
        <meta name="description" content="Страница авторизации в системе Food Tracer" />
        <meta name="keywords" content="авторизация, вход, food tracer" />
        <meta property="og:title" content="Авторизация - Food Tracer" />
        <meta property="og:description" content="Войдите в систему отслеживания продуктов" />
        <meta property="og:type" content="website" />
    </Head>

    <n-message-provider>
        <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900">Food Tracer</h1>
                    <p class="mt-2 text-gray-600">Система отслеживания продуктов</p>
                </div>

                <n-card
                    title="Авторизация"
                    size="large"
                    bordered
                    class="shadow-lg"
                >
                    <n-alert
                        v-if="status"
                        type="success"
                        :title="status"
                        class="mb-4"
                    />

                    <form @submit.prevent="submit">
                        <n-form
                            ref="formRef"
                            :model="form"
                            :rules="rules"
                            label-placement="top"
                            require-mark-placement="right-hanging"
                            size="large"
                        >
                            <n-form-item
                                label="Email"
                                path="email"
                                :validation-status="form.errors.email ? 'error' : ''"
                            >
                                <n-input
                                    v-model:value="form.email"
                                    placeholder="Введите ваш email"
                                    type="email"
                                    clearable
                                    :disabled="form.processing"
                                    autofocus
                                />
                                <template v-if="form.errors.email" #feedback>
                                    {{ form.errors.email }}
                                </template>
                            </n-form-item>

                            <n-form-item
                                label="Пароль"
                                path="password"
                                :validation-status="form.errors.password ? 'error' : ''"
                            >
                                <n-input
                                    v-model:value="form.password"
                                    placeholder="Введите пароль"
                                    type="password"
                                    show-password-on="click"
                                    clearable
                                    :disabled="form.processing"
                                />
                                <template v-if="form.errors.password" #feedback>
                                    {{ form.errors.password }}
                                </template>
                            </n-form-item>

                            <n-form-item>
                                <n-checkbox
                                    v-model:checked="form.remember"
                                    :disabled="form.processing"
                                >
                                    Запомнить меня
                                </n-checkbox>
                            </n-form-item>

                            <n-form-item>
                                <n-space justify="space-between" align="center" style="width: 100%">
                                    <Link
                                        v-if="canResetPassword"
                                        :href="route('password.request')"
                                    >
                                        <n-button text type="primary" size="small">
                                            Забыли пароль?
                                        </n-button>
                                    </Link>
                                    <div v-else></div>

                                    <n-button
                                        type="primary"
                                        round
                                        size="large"
                                        :loading="form.processing"
                                        attr-type="submit"
                                    >
                                        Войти
                                    </n-button>
                                </n-space>
                            </n-form-item>

                            <n-divider>или</n-divider>

                            <n-space vertical>
                                <n-button
                                    block
                                    size="large"
                                    @click="redirectToVK"
                                    style="background: #4680C2; color: white;"
                                >
                                    <template #icon>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M15.684 0H8.316C1.592 0 0 1.592 0 8.316v7.368C0 22.408 1.592 24 8.316 24h7.368C22.408 24 24 22.408 24 15.684V8.316C24 1.592 22.408 0 15.684 0zm3.692 17.123h-1.744c-.66 0-.864-.525-2.05-1.723-1.033-1.01-1.49-.9-1.735-.9-.356 0-.458.102-.458.597v1.575c0 .424-.135.678-1.253.678-1.846 0-3.896-1.118-5.335-3.202C4.624 10.857 4.03 8.57 4.03 8.096c0-.254.102-.491.593-.491h1.744c.44 0 .61.203.78.677.863 2.49 2.303 4.675 2.896 4.675.22 0 .322-.102.322-.66V9.721c-.068-1.186-.695-1.287-.695-1.71 0-.204.17-.407.44-.407h2.744c.373 0 .508.203.508.643v3.473c0 .372.17.508.271.508.22 0 .407-.136.813-.542 1.254-1.406 2.151-3.574 2.151-3.574.119-.254.322-.491.763-.491h1.744c.525 0 .644.27.525.643-.22 1.017-2.354 4.031-2.354 4.031-.186.305-.254.44 0 .78.186.254.796.779 1.203 1.253.745.847 1.32 1.558 1.473 2.05.17.49-.085.744-.576.744z"/>
                                        </svg>
                                    </template>
                                    Войти через VK
                                </n-button>

                                <n-button
                                    block
                                    size="large"
                                    @click="redirectToYandex"
                                    style="background: #FC3F1D; color: white;"
                                >
                                    <template #icon>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm5.568 17.568h-2.37l-2.553-6.78-1.402 6.78H8.807l2.553-11.136h2.553l2.553 6.78 1.402-6.78h2.37l-2.67 11.136z"/>
                                        </svg>
                                    </template>
                                    Войти через Яндекс ID
                                </n-button>
                            </n-space>
                        </n-form>
                    </form>
                </n-card>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Нет аккаунта?
                        <Link :href="route('register')" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Зарегистрироваться
                        </Link>
                    </p>
                </div>
            </div>
        </div>
    </n-message-provider>
</template>

<style scoped>
.min-h-screen {
    min-height: 100vh;
}
</style>
