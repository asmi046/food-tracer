<script setup>
import { Head, router } from '@inertiajs/vue3';

import {
    NCard,
    NImage,
    NIcon,
    NText,
    NH1,
    NSpace,
    NStatistic
} from 'naive-ui';

import {
    Image20Regular,
    Food20Regular
} from '@vicons/fluent';

import AddButton from '@/Components/AddComponent/AddButton.vue';

defineProps({
    auth: {
        type: Object,
    },
});

const handleLogout = () => {

    router.post(route('logout'), {}, {
        onFinish: () => {
        }
    })
}

// Примеры данных для демонстрации интерфейса Dashboard
const foodItems = [
    {
        id: 1,
        name: 'Овсяная каша с ягодами',
        calories: 320,
        image: null,
        time: '08:30'
    },
    {
        id: 2,
        name: 'Куриная грудка с овощами',
        calories: 450,
        image: null,
        time: '13:15'
    },
    {
        id: 3,
        name: 'Греческий салат',
        calories: 280,
        image: null,
        time: '19:00'
    },
    {
        id: 4,
        name: 'Творог с медом и орехами',
        calories: 240,
        image: null,
        time: '21:30'
    },
    {
        id: 5,
        name: 'Греческий салат',
        calories: 280,
        image: null,
        time: '19:00'
    },
    {
        id: 6,
        name: 'Творог с медом и орехами',
        calories: 240,
        image: null,
        time: '21:30'
    },
    {
        id: 7,
        name: 'Греческий салат',
        calories: 280,
        image: null,
        time: '19:00'
    },
    {
        id: 8,
        name: 'Творог с медом и орехами',
        calories: 240,
        image: null,
        time: '21:30'
    },
    {
        id: 9,
        name: 'Греческий салат',
        calories: 280,
        image: null,
        time: '19:00'
    },
    {
        id: 10,
        name: 'Творог с медом и орехами',
        calories: 240,
        image: null,
        time: '21:30'
    },

];



// Подсчет общей калорийности за день
const totalCalories = foodItems.reduce((sum, item) => sum + item.calories, 0);
</script>

<template>
    <Head title="Dashboard - Food Tracker">
        <meta name="description" content="Панель управления дневником питания" />
    </Head>

    <div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 p-4 pb-20">
        <!-- Заголовок Dashboard -->
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8 pt-6">
                <div class="flex items-center justify-center mb-4">
                    <n-icon size="32" class="text-green-600 mr-2">
                        <Food20Regular />
                    </n-icon>
                    <n-h1 class="!mb-0">Дневник питания</n-h1>
                </div>
                <n-text class="text-gray-600">
                    Добро пожаловать, {{ auth?.user?.name || 'пользователь' }}!
                </n-text>
                <div class="mt-4">
                    <n-button
                        size="small"
                        @click="handleLogout"
                    >
                        Выйти из системы
                    </n-button>
                </div>
            </div>

            <!-- Статистика дня -->
            <div class="mb-8">
                <n-card class="text-center">
                    <n-statistic
                        label="Калории за сегодня"
                        :value="totalCalories"
                        suffix=" ккал"
                        class="text-center"
                    >
                        <template #prefix>
                            <n-icon class="text-orange-500">
                                <Food20Regular />
                            </n-icon>
                        </template>
                    </n-statistic>
                </n-card>
            </div>

            <!-- Список продуктов/блюд -->
            <div class="space-y-4">
                <n-card
                    v-for="item in foodItems"
                    :key="item.id"
                    class="hover:shadow-lg transition-shadow duration-200"
                    :bordered="true"
                >
                    <div class="flex items-center gap-4">
                        <!-- Левая часть - фотография или заглушка -->
                        <div class="flex-shrink-0">
                            <n-image
                                v-if="item.image"
                                :src="item.image"
                                alt="Фото блюда"
                                width="80"
                                height="80"
                                object-fit="cover"
                                class="rounded-lg"
                                fallback-src="/img/no-photo-placeholder.jpg"
                            />
                            <div
                                v-else
                                class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center"
                            >
                                <n-icon size="24" class="text-gray-400">
                                    <Image20Regular />
                                </n-icon>
                            </div>
                        </div>

                        <!-- Правая часть - информация о продукте -->
                        <div class="flex-grow">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ item.name }}
                                </h3>
                                <span class="text-sm text-gray-500 font-medium">
                                    {{ item.time }}
                                </span>
                            </div>
                            <n-text class="text-gray-600">
                                Общая калорийность:
                                <span class="font-medium text-orange-600">
                                    {{ item.calories }} ккал
                                </span>
                            </n-text>
                        </div>
                    </div>
                </n-card>

            </div>
        </div>

        <AddButton></AddButton>

    </div>
</template>

<style scoped>
.min-h-screen {
    min-height: 100vh;
}

/* Анимация для карточек */
.n-card {
    animation: fadeInUp 0.6s ease-out;
}

/* Анимация для заголовка */
.n-h1 {
    animation: fadeInDown 0.8s ease-out;
}

/* Анимация появления */
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

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Стилизация заглушки для фото */
.bg-gray-200 {
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    border: 2px dashed #d1d5db;
}

/* Ховер эффекты */
.hover\:shadow-lg:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.transition-shadow {
    transition-property: box-shadow;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

.duration-200 {
    transition-duration: 200ms;
}

/* Анимация для карточки добавления */
.border-dashed:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease;
}

/* Закрепленная панель */
.fixed {
    position: fixed;
}

.bottom-0 {
    bottom: 0;
}

.left-0 {
    left: 0;
}

.right-0 {
    right: 0;
}

.z-50 {
    z-index: 50;
}

.border-t {
    border-top-width: 1px;
}

.border-gray-200 {
    border-color: #e5e7eb;
}

.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.pb-20 {
    padding-bottom: 5rem;
}

/* Статистика */
.n-statistic {
    --n-label-font-size: 16px;
    --n-value-font-size: 32px;
}
</style>
