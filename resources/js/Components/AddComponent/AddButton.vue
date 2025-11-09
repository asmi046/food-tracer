<template>
    <div class="fixed bottom-0 left-0 right-0 bg-transparent shadow-lg z-50">
            <div class="max-w-4xl mx-auto p-4">
                <div class="flex justify-center">
                    <n-dropdown :options="dropdownOptions" trigger="click" @select="handleDropdownSelect">
                        <n-button type="primary" size="large" class="shadow-lg" round>
                            <template #icon>
                                <n-icon>
                                    <Add20Regular />
                                </n-icon>
                            </template>
                            Добавить блюдо
                        </n-button>
                    </n-dropdown>

                    <input
                        ref="cameraInput"
                        type="file"
                        accept="image/*"
                        capture="capture"
                        style="display: none"
                        @change="handleCameraPhoto"
                    />

                    <input
                        ref="galleryInput"
                        type="file"
                        accept="image/*"
                        style="display: none"
                        @change="handleGalleryPhoto"
                    />

                </div>
            </div>
        </div>
</template>

<script setup>
import { h, ref } from 'vue';
import { NIcon, NButton, NDropdown } from 'naive-ui';
import { Add20Regular, Camera20Regular, Heart20Regular, Image20Regular } from '@vicons/fluent';
import { router } from '@inertiajs/vue3';

const cameraInput = ref(null)
const galleryInput = ref(null)

const handleDropdownSelect = (key) => {
    switch (key) {
        case 'camera':
            cameraInput.value?.click()
            break
        case 'gallery':
            galleryInput.value?.click()
            break
        case 'favorites':
            // Логика для избранного
            break
    }
}

const handleCameraPhoto = (event) => {
    const file = event.target.files[0]
    if (file) {
        processPhoto(file, 'camera')
    }
}

const handleGalleryPhoto = (event) => {
    const file = event.target.files[0]
    if (file) {
        processPhoto(file, 'gallery')
    }
}

const processPhoto = (file, source) => {
    // Создаем preview
    const reader = new FileReader()
    reader.onload = (e) => {
        const imageUrl = e.target.result
        console.log(`Фото из ${source}:`, imageUrl)

        // 1. Сохраняем изображение в localStorage
        localStorage.setItem('newFoodPhoto', imageUrl);

        // 2. Переходим на страницу добавления продукта
        router.visit(route('add-product'));
    }
    reader.readAsDataURL(file)
}

// Опции для выпадающего меню
const dropdownOptions = [
    {
        label: 'Добавить из галереи',
        key: 'gallery',
        icon: () => h(NIcon, null, { default: () => h(Image20Regular) })
    },
    {
        label: 'Сфотографировать',
        key: 'camera',
        icon: () => h(NIcon, null, { default: () => h(Camera20Regular) })
    },
    {
        label: 'Избранное',
        key: 'favorites',
        icon: () => h(NIcon, null, { default: () => h(Heart20Regular) })
    }
];

</script>
