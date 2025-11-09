<template>
    <div class="min-h-screen bg-gray-100 p-4 flex items-center justify-center">
        <n-card title="Добавить прием пищи" class="max-w-md w-full shadow-lg">
            <n-space vertical size="large">
                <!-- Изображение -->
                <div class="text-center">
                    <n-image
                        width="200"
                        :src="photoUrl"
                        alt="Фото блюда"
                        class="rounded-lg"
                    />
                </div>

                <!-- Поле для описания (textarea) -->
                <n-input
                    v-model:value="description"
                    type="textarea"
                    placeholder="Введите описание продукта или блюда..."
                    :autosize="{
                        minRows: 3,
                        maxRows: 5
                    }"
                />

                <!-- Кнопка Добавить -->
                <n-button
                    type="primary"
                    block
                    round
                    size="large"
                >
                    Добавить
                </n-button>

                <n-button
                    strong
                    secondary
                    block
                    round
                    size="large"
                >
                    Отмена
                </n-button>
            </n-space>
        </n-card>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'; // ✅ ИМПОРТИРУЕМ onMounted
import { NCard, NImage, NInput, NButton, NSpace, NText } from 'naive-ui'; // ✅ ИМПОРТИРУЕМ NText

const description = ref('');
const photoUrl = ref(null); // ✅ РЕАКТИВНАЯ ПЕРЕМЕННАЯ ДЛЯ URL ФОТО

// ✅ КОГДА КОМПОНЕНТ ЗАГРУЗИТСЯ
onMounted(() => {
    // 1. Получаем фото из localStorage
    const savedPhoto = localStorage.getItem('newFoodPhoto');

    if (savedPhoto) {
        // 2. Если фото есть, присваиваем его нашей переменной
        photoUrl.value = savedPhoto;

        // 3. (Важно!) Очищаем localStorage, чтобы фото не появилось снова при следующем заходе
        localStorage.removeItem('newFoodPhoto');
    }
});
</script>
