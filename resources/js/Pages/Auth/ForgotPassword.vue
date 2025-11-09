<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import { nextTick, onMounted } from 'vue';
import {
    NCard,
    NForm,
    NFormItem,
    NInput,
    NButton,
    NAlert,
    NSpace,
    NText,
    NH2,
    NIcon,
    useMessage
} from 'naive-ui';
import { Mail20Regular } from '@vicons/fluent';
import AppLayout from '@/Layouts/AppLayout.vue';

// Убираем layout для страницы восстановления пароля
defineOptions({
    layout: AppLayout
});

defineProps({
    status: {
        type: String,
    },
});

const message = useMessage();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'), {
        onSuccess: () => {
            nextTick(() => {
                message.success('Ссылка для восстановления пароля отправлена на ваш email!');
            });
        },
        onError: () => {
            nextTick(() => {
                message.error('Проверьте правильность введенного email');
            });
        }
    });
};
</script>

<template>
    <Head title="Восстановление пароля" />

    <div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Логотип -->
            <div class="text-center mb-8">
                <img
                    src="/img/icon_src.webp"
                    alt="Food Tracker Logo"
                    class="w-16 h-16 mx-auto mb-4 drop-shadow-lg"
                    loading="eager"
                />
                <n-h2 class="!mb-2">Восстановление пароля</n-h2>
                <n-text class="text-gray-600">
                    Food Tracker
                </n-text>
            </div>

            <!-- Карточка с формой -->
            <n-card size="large" :bordered="false" class="shadow-xl">
                <!-- Описание -->
                <div class="mb-6">
                    <n-alert type="info" :show-icon="false" class="mb-4">
                        <template #header>
                            Забыли пароль?
                        </template>
                        Укажите ваш email адрес и мы отправим вам ссылку для восстановления пароля.
                    </n-alert>

                    <!-- Статус сообщение -->
                    <n-alert
                        v-if="status"
                        type="success"
                        :show-icon="true"
                        class="mb-4"
                    >
                        {{ status }}
                    </n-alert>
                </div>

                <!-- Форма восстановления -->
                <n-form @submit.prevent="submit">
                    <n-form-item
                        label="Email адрес"
                        :validation-status="form.errors?.email ? 'error' : ''"
                    >
                        <n-input
                            v-model:value="form.email"
                            type="email"
                            size="large"
                            placeholder="Введите ваш email"
                            :disabled="form.processing"
                            clearable
                            autofocus
                            autocomplete="username"
                        >
                            <template #prefix>
                                <n-icon class="text-gray-400">
                                    <Mail20Regular />
                                </n-icon>
                            </template>
                        </n-input>

                        <template v-if="form.errors?.email" #feedback>
                            {{ form.errors.email }}
                        </template>
                    </n-form-item>

                    <!-- Кнопки -->
                    <div class="mt-6">
                        <n-space vertical size="large">
                            <n-button
                                type="primary"
                                size="large"
                                block
                                :loading="form.processing"
                                @click="submit"
                                round
                            >
                                Отправить ссылку для восстановления
                            </n-button>

                            <div class="text-center">
                                <Link :href="route('login')" class="inline-block">
                                    <n-button text type="primary">
                                        ← Вернуться к входу
                                    </n-button>
                                </Link>
                            </div>
                        </n-space>
                    </div>
                </n-form>
            </n-card>
        </div>
    </div>
</template>
