<script setup>
import { Head, Link } from '@inertiajs/vue3';
import {
    NButton,
    NSpace
} from 'naive-ui';

// Убираем layout для главной страницы
defineOptions({
    layout: null
});

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Food Tracker - Дневник питания">
        <meta name="description" content="Food Tracker - современный дневник питания для отслеживания продуктов" />
        <meta name="keywords" content="дневник питания, food tracker, отслеживание еды, калории" />
        <meta property="og:title" content="Food Tracker - Дневник питания" />
        <meta property="og:description" content="Современное приложение для отслеживания питания" />
        <meta property="og:image" content="/img/icon_src.webp" />
        <meta property="og:type" content="website" />
    </Head>

    <div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 flex items-center justify-center px-4">
        <div class="text-center max-w-md w-full space-y-8">
            <!-- Логотип -->
            <div class="flex justify-center">
                <img
                    src="/img/icon_src.webp"
                    alt="Food Tracker Logo"
                    class="max-w-[310px] w-full h-auto drop-shadow-lg"
                    loading="eager"
                />
            </div>

            <!-- Заголовок -->
            <div class="space-y-4">
                <h1 class="text-4xl font-bold text-gray-800 tracking-tight">
                    Food Tracker
                </h1>

                <p class="text-lg text-gray-600 font-medium">
                    Дневник питания
                </p>
            </div>

            <!-- Кнопки навигации -->
            <div class="space-y-4 pt-6">
                <n-space vertical size="large">
                    <Link v-if="canRegister" :href="route('register')">
                        <n-button
                            type="primary"
                            size="large"
                            block
                            round
                            class="h-12 text-base font-medium"
                        >
                            Создать аккаунт
                        </n-button>
                    </Link>

                    <Link v-if="canLogin" :href="route('login')">
                        <n-button
                            size="large"
                            block
                            round
                            class="h-12 text-base font-medium"
                        >
                            Войти в систему
                        </n-button>
                    </Link>
                </n-space>
            </div>

            <!-- Дополнительная информация -->
            <div class="pt-8 text-center">
                <p class="text-sm text-gray-500">
                    Следите за своим питанием легко и удобно
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.min-h-screen {
    min-height: 100vh;
}

/* Анимация для логотипа */
img {
    animation: fadeInScale 0.8s ease-out;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Анимация для текста */
h1 {
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

p {
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

/* Анимация для кнопок */
.n-space {
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
