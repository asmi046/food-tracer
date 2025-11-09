<script setup>
import { ref, onMounted, nextTick } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
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

import SocialButtons from '@/Components/Socialite/SocialButtons.vue';

import AppLayout from '@/Layouts/AppLayout.vue';

const page = usePage()

// Убираем layout для страницы авторизации
defineOptions({
    layout: AppLayout
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
                    <img
                        src="/img/icon_src.webp"
                        alt="Food Tracker Logo"
                        class="w-16 h-16 mx-auto mb-4 drop-shadow-lg"
                        loading="eager"
                    />
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

                        <n-form
                            ref="formRef"
                            :model="form"
                            :rules="rules"
                            label-placement="top"
                            require-mark-placement="right-hanging"
                            size="large"
                            @submit.prevent="submit"
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


                                <n-checkbox
                                    v-model:checked="form.remember"
                                    :disabled="form.processing"
                                >
                                    Запомнить меня
                                </n-checkbox>


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

                            <p>Вы так же может войти через:</p>
                            <br>
                            <SocialButtons />
                        </n-form>
                </n-card>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Нет аккаунта?
                        <n-button
                            text
                            type="primary"
                            @click="$inertia.visit(route('register'))"
                        >
                            Зарегистрироваться
                        </n-button>
                    </p>
                </div>
            </div>
        </div>
    </n-message-provider>
</template>
