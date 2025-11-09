<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
    NCard,
    NForm,
    NFormItem,
    NInput,
    NButton,
    NSpace,
    NMessageProvider,
    useMessage
} from 'naive-ui';
import SocialButtons from '@/Components/Socialite/SocialButtons.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const message = useMessage();
// Убираем layout для страницы регистрации
defineOptions({
    layout: AppLayout
});

const formRef = ref(null);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const rules = {
    name: [
        {
            required: true,
            message: 'Имя обязательно для заполнения',
            trigger: ['input', 'blur']
        },
        {
            min: 2,
            message: 'Имя должно содержать минимум 2 символа',
            trigger: ['input', 'blur']
        }
    ],
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
            min: 8,
            message: 'Пароль должен содержать минимум 8 символов',
            trigger: ['input', 'blur']
        }
    ],
    password_confirmation: [
        {
            required: true,
            message: 'Подтверждение пароля обязательно',
            trigger: ['input', 'blur']
        },
        {
            validator: (rule, value) => {
                return value === form.password;
            },
            message: 'Пароли не совпадают',
            trigger: ['input', 'blur']
        }
    ]
};

const submit = () => {

    console.log('Submitting form...');
    formRef.value?.validate((errors) => {
        if (!errors) {
            form.post(route('register'), {
                onFinish: () => {
                    form.reset('password', 'password_confirmation');
                },
                onSuccess: () => {
                    message.success('Регистрация прошла успешно!');
                },
                onError: () => {
                    message.error('Ошибка регистрации. Проверьте данные.');
                }
            });
        } else {
            message.error('Проверьте правильность заполнения формы');
        }
    });
};
</script>

<template>
    <Head title="Регистрация">
        <meta name="description" content="Страница регистрации в системе Food Tracer" />
        <meta name="keywords" content="регистрация, создание аккаунта, food tracer" />
        <meta property="og:title" content="Регистрация - Food Tracer" />
        <meta property="og:description" content="Создайте аккаунт в системе отслеживания продуктов" />
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
                    title="Регистрация"
                    size="large"
                    bordered
                    class="shadow-lg"
                >

                        <n-form
                            ref="formRef"
                            :model="form"
                            :rules="rules"
                            label-placement="top"
                            require-mark-placement="right-hanging"
                            @submit.prevent="submit"
                            size="large"
                        >
                            <n-form-item
                                label="Имя"
                                path="name"
                            >
                                <n-input
                                    v-model:value="form.name"
                                    placeholder="Введите ваше имя"
                                    clearable
                                    :disabled="form.processing"
                                    autofocus
                                />
                                <template v-if="form.errors.name" #feedback>
                                    {{ form.errors.name }}
                                </template>
                            </n-form-item>

                            <n-form-item
                                label="Email"
                                path="email"
                            >
                                <n-input
                                    v-model:value="form.email"
                                    placeholder="Введите ваш email"
                                    type="email"
                                    clearable
                                    :disabled="form.processing"
                                />
                                <template v-if="form.errors.email" #feedback>
                                    {{ form.errors.email }}
                                </template>
                            </n-form-item>

                            <n-form-item
                                label="Пароль"
                                path="password"
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

                            <n-form-item
                                label="Подтверждение пароля"
                                path="password_confirmation"

                            >
                                <n-input
                                    v-model:value="form.password_confirmation"
                                    placeholder="Повторите пароль"
                                    type="password"
                                    show-password-on="click"
                                    clearable
                                    :disabled="form.processing"
                                />
                                <template v-if="form.errors.password_confirmation" #feedback>
                                    {{ form.errors.password_confirmation }}
                                </template>
                            </n-form-item>

                            <n-form-item>
                                <n-space justify="space-between" align="center" style="width: 100%">
                                    <Link :href="route('login')">
                                        <n-button text type="primary" size="small">
                                            Уже есть аккаунт?
                                        </n-button>
                                    </Link>

                                    <n-button
                                        type="primary"
                                        round
                                        size="large"
                                        :loading="form.processing"
                                        attr-type="submit"
                                    >
                                        Зарегистрироваться
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
                        Уже есть аккаунт?


                        <n-button
                            text
                            type="primary"
                            @click="$inertia.visit(route('login'))"
                        >
                            Войти
                        </n-button>
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
